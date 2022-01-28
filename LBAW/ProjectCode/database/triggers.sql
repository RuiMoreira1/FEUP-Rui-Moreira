DROP FUNCTION IF EXISTS check_return_date();
DROP FUNCTION IF EXISTS check_delivery_date();
DROP FUNCTION IF EXISTS check_shipment_date();
DROP FUNCTION IF EXISTS check_payment_date();
DROP FUNCTION IF EXISTS update_product_stock();
DROP FUNCTION IF EXISTS check_stock(); 
DROP FUNCTION IF EXISTS check_in_stock();
DROP FUNCTION IF EXISTS archieve_product();
DROP FUNCTION IF EXISTS remove_from_cart();
DROP FUNCTION IF EXISTS review_product();
DROP FUNCTION IF EXISTS send_notif_price_change();
DROP FUNCTION IF EXISTS update_prod_rating();
DROP FUNCTION IF EXISTS remove_prod_from_wishlist();
DROP FUNCTION IF EXISTS update_text_search();

DROP TRIGGER IF EXISTS add_wishlist_prod_to_cart ON product_in_cart;
DROP TRIGGER IF EXISTS prod_rating_review_updt ON review;
DROP TRIGGER IF EXISTS product_price_change_notif ON product;
DROP TRIGGER IF EXISTS add_product_review ON review;
DROP TRIGGER IF EXISTS remove_from_cart ON product_order;
DROP TRIGGER IF EXISTS archieve_product ON archived_product;
DROP TRIGGER IF EXISTS check_stock ON product_in_cart;
DROP TRIGGER IF EXISTS buy_product ON product_order;
DROP TRIGGER IF EXISTS update_stock ON product_order;
DROP TRIGGER IF EXISTS check_payment ON "processing";
DROP TRIGGER IF EXISTS check_shipment ON "shipped";
DROP TRIGGER IF EXISTS check_delivery ON "delivered";
DROP TRIGGER IF EXISTS check_return ON "returned";
DROP TRIGGER IF EXISTS update_text_search ON product;

-- TRIGGER03
-- Description - When an item from wishlist is added to the cart it is removed from the wishlist

CREATE FUNCTION remove_prod_from_wishlist()
RETURNS TRIGGER AS
$BODY$
BEGIN
    DELETE FROM wishlist
    WHERE id_user = New.id_user AND id_product = New.id_product;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_wishlist_prod_to_cart 
AFTER INSERT ON product_in_cart
EXECUTE PROCEDURE remove_prod_from_wishlist();

-- TRIGGER07
-- Description - When a new review is added, the product rating is recalculated.

CREATE FUNCTION update_prod_rating()
RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE product
    SET 
        star_rating = (SELECT AVG(star_rating)
                 FROM review 
                 WHERE id_product = New.id_product)
    WHERE id = New.id_product;
END
$BODY$
LANGUAGE plpgsql;


CREATE TRIGGER prod_rating_review_updt
AFTER INSERT ON review
EXECUTE PROCEDURE update_prod_rating();

-- TRIGGER 11
-- Description - When a product price is updated and it is on wishlist, a new notification is sent.

CREATE FUNCTION send_notif_price_change()
RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (status, type, id_user)
    VALUES ('Not Read', 'Price Change on Product from Wishlist',
        (SELECT id_user from wishlist where id_product = New.id));

    INSERT INTO product_notification(id_notification, id_product)
    VALUES ((SELECT notification.id from notification, wishlist 
            where wishlist.id_user = notification.id_user and id_product = New.id and notification.status = 'Not Read'), New.id);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER product_price_change_notif
AFTER UPDATE OF price ON product
FOR EACH ROW 
EXECUTE PROCEDURE send_notif_price_change();

-- TRIGGER 01  User can only review products if he is a buyer

CREATE FUNCTION review_product() 
RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS (SELECT Product.id_product
                    FROM buyer_info AS Buyer, product_order AS Product
                    WHERE Buyer.id_order == Product.id_order AND New.id_user == Buyer.id_user AND New.id_product == Product.id_product )
    THEN RAISE EXCEPTION 'You can not review a product you have not bougth.';

    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_product_review
BEFORE INSERT OR UPDATE ON review
FOR EACH ROW 
EXECUTE PROCEDURE review_product();


-- TRIGGER 06 Upon buying a product the product gets removed from the cart 
CREATE FUNCTION remove_from_cart() 
RETURNS TRIGGER AS
$BODY$
BEGIN   
    DELETE FROM product_in_cart
    WHERE id_product = New.id_product AND id_user = (SELECT id_user FROM buyer_info WHERE buyer_info.id_order = New.id_order);
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_from_cart AFTER INSERT 
ON product_order
EXECUTE PROCEDURE remove_from_cart();

-- TRIGGER 05 When a product is archieved, it should get removed from the cart
CREATE FUNCTION archieve_product()
RETURNS TRIGGER AS
$BODY$
BEGIN 
    DELETE FROM product_in_cart
    WHERE product_id = New.id;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER archieve_product 
AFTER INSERT ON archieved_product
FOR EACH ROW
EXECUTE PROCEDURE archieve_product();

-- TRIGGER 09 When user tries to add products to cart, check if out of stock!

CREATE FUNCTION check_in_stock()
RETURNS TRIGGER AS
$BODY$
BEGIN
    IF 
        EXISTS ( SELECT * FROM products WHERE id = New.id_product AND stock = 0 )
    THEN
        RAISE EXCEPTION 'Stock not available for the required product';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_stock 
BEFORE INSERT ON product_in_cart
FOR EACH ROW
EXECUTE PROCEDURE check_in_stock();

-- TRIGGER02
--User can only buy the available stock at the time
CREATE FUNCTION check_stock() 
RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT *
                FROM  product
                 WHERE New.quantity > product.stock)
    THEN RAISE EXCEPTION 'You can only buy % units which is the available stock at the time of product %', New.quantity, New.id_product;

    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER buy_product
BEFORE INSERT ON product_order
EXECUTE PROCEDURE check_stock();


/*UPDATE PRODUCT STOCK AFTER ORDER*/

CREATE FUNCTION update_product_stock() RETURNS TRIGGER AS
$BODY$
BEGIN
  UPDATE product
  SET stock = stock - New.quantity
  WHERE id = New.product_id;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_stock AFTER INSERT
ON product_order
EXECUTE PROCEDURE update_product_stock();

/*CHECK PAYMENT DATE*/

CREATE FUNCTION check_payment_date() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF 
		NOT EXISTS 
			(SELECT date FROM "order" 
			WHERE id = New.order_id 
			AND date <= New.date_payed) 
	THEN
		RAISE EXCEPTION 'Payment must be done after order';
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_payment BEFORE INSERT
ON "processing"
EXECUTE PROCEDURE check_payment_date();

/*CHECK SHIPMENT DATE*/

CREATE FUNCTION check_shipment_date() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF 
		NOT EXISTS 
			(SELECT date FROM "order" 
			WHERE id = New.order_id 
			AND date <= New.date_shipped) 
	THEN
		RAISE EXCEPTION 'Shipment must be done after order';
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_shipment BEFORE INSERT
ON "shipped"
EXECUTE PROCEDURE check_shipment_date();

/*CHECK DELIVERY DATE*/

CREATE FUNCTION check_delivery_date() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF 
		NOT EXISTS 
			(SELECT date FROM "order" 
			WHERE id = New.order_id 
			AND date <= New.date_delivered) 
	THEN
		RAISE EXCEPTION 'Delivery must be done after order';
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_delivery BEFORE INSERT
ON "delivered"
EXECUTE PROCEDURE check_delivery_date();

/*CHECK RETURN DATE*/

CREATE FUNCTION check_return_date() RETURNS TRIGGER AS
$BODY$
BEGIN
  IF 
		NOT EXISTS 
			(SELECT date FROM "order" 
			WHERE id = New.order_id 
			AND date <= New.date_returned) 
	THEN
		RAISE EXCEPTION 'The return must be after the order';
	END IF;
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_return BEFORE INSERT
ON "returned"
EXECUTE PROCEDURE check_return_date();

-- TRIGGER 07 -> FULL TEXT SEARCH
CREATE FUNCTION update_text_search()
RETURNS TRIGGER AS
$BODY$
BEGIN   
        IF TG_OP = 'INSERT' THEN
                    New.search = setweigth(to_tsvector ('english', New.product_name), A) ||
                                 setweigth(to_tsvector ('english', New.synopsis), B) ||
                                 setweigth(to_tsvector ('english', New.prod_type), C);
        END IF;
        IF TG_OP = 'UPDATE' THEN
                    IF New.product_name <> Old.product_name THEN
                        New.search = setweigth(to_tsvector ('english', New.product_name), A) ||
                                    setweigth(to_tsvector ('english', New.synopsis), B) ||
                                    setweigth(to_tsvector ('english', New.product_name), C);
                    END IF;
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_text_search
BEFORE INSERT OR UPDATE ON product
FOR EACH ROW
EXECUTE PROCEDURE update_text_search();

