-- Insert a new product

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;
    INSERT INTO product (id, product_name, price, stock, discount, star_rating, synopsis, book_width, book_height, prod_type, language_id, editor_id)
        VALUES ($id, $product_name, $price, $stock, $discount, $star_rating, $synopsis, $book_width, $book_height, $prod_type, $language_id, $editor_id);
COMMIT;

-- Insert a new user

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ; 

    INSERT INTO "user" (id,username,email,"password","name",birth_date,id_image)
        VALUES ($id, $username, $email, $"password", $"name", $birth_date, $id_image);

COMMIT;

-- Insert a new review 

BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ; 

    INSERT INTO review (id,date,star_rating,comment,id_user,id_product)
        VALUES ($id, $date, $star_rating, $comment, $id_user, $id_product);

COMMIT;