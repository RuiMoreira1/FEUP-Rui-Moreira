# **EBD: Database Specification Component**

An Online Shop that becomes your ‘street corner’ bookshop only a click away!

# **A4 Conceptual Data Model**


The Conceptual Domain Model identifies all the groups of entities of the domain and the relationships between them in UML class diagram.

The class diagram below represents all the important entities for **'The Last Chapter'** website, the relationships between them with multiplicity associated and also all the relevant attributes with their respective SQL Types.

## A4.1. Class Diagram

![UML Diagram](Pictures/UML_Diagram.png)

*Figure 1: UML Class Diagram*

## A4.2. Additional Business Rules

* **Account Deletion** - In case an account is deleted (by its owner or by an administrator), all the shared user data is kept but made anonymous so that all the relevant information regarding reviews and purchases is maintained (i.e. for statistics).

* **Administrators** - Administrator accounts cannot buy products, as they are the ones that manage them.

* **Write Review** - Only buyers that have bought a product can write a review for that specific product.

* **Edit and Delete Review** - Only the author of a review can edit and/or delete that specific review.

* **Admin Delete Review** - Admins have permission to delete any review.

* **Stock Available** - A registered user can only purchase a product if it is available in stock.

* **Stock Update** - After every purchase, the stocks of the products affected must be updated (decreasing accordingly).

* **Cancel order** - A buyer can only cancel its order if it hasn't already been shipped. (i.e. on the day of the purchase only, not after, not before).

* **Logout** - The logout should only be possible if the user is currently logged in.

# **A5 Relational Schema, validation and schema refinement**

## **Relational Schema**

| **Relation reference** | **Relation Compact Notation** |
| :--------------: | :---------------------- |
| **R01** | **user**(<ins>id</ins>, username **NN UK CK** 0<length(username)<=50, email **NN UK CK** email **LIKE** “%_@_%”, password **NN CK** length(password) >= 6 and password **LIKE** “%[^a-zA-Z-0-9]”, name **NN**, birth_date **NN CK** today - birthdate >= 18, id_image→image) |
| **R02** | **admin**(<ins>id_user</ins>→user) |
| **R03** | **banned_user**(<ins>id_user</ins>→user) |
| **R04** | **image**(<ins>id</ins>, path_image **NN UK**) |
| **R05** | **product_image**(<ins>id_image</ins>→image, <ins>id_product</ins>→ product) |
| **R06** | **author_image**(<ins>id_image</ins>→image, <ins>id_author</ins>→ author) |
| **R07** | **author**(<ins>id</ins>, name **NN**, bio **NN**) |
| **R08** | **review**(<ins>id</ins>, date **NN CK** date <= Today, star_rating **NN DF** 0.0 **CK** 0.0 <= star_rating <= 5.0, comment **NN CK** 0<length(comment)<=200, id_user→user, id_product→product) |
| **R09** | **buyer_info**(<ins>id_order</ins>→order, id_user→user, name **NN**, phone_number **NN CK** phone_number **LIKE** [^0-9]*9, nif **NN CK** length(nif) == 9 and nif **LIKE** [^0-9]) |
| **R10** | **processing**(<ins>order_id</ins>→order,datepayed **NN** **CK** datepayed <= Today )
| **R11** | **shipped**(<ins>order_id</ins>→order,dateshipped **NN** **CK** dateshipped <= Today)
| **R12** | **delivered**(<ins>order_id</ins>→order,datedelivered **NN** **CK** datedelivered <= Today)
| **R13** | **returned**(<ins>order_id</ins>→order,datereturned **NN** **CK** datereturned <= Today, reason **NN** **CK** 0 <length(reason)<= 200)
| **R14** | **paymentpending**(<ins>order_id</ins>→order)
| **R15** | **order**(<ins>id</ins>  , status **NN** **CK** status **IN** Status, date **NN** **CK** date <= Today, address_id→address )
| **R16** | **product**(<ins>id</ins>, name **NN**, price **CK price >= 0**, stock **CK stock >= 0**, discount **CK discount >= 0 && discount <= 1.0**, starRating **CK starRating >= 0.0 && starRating <= 5.0**, Synopsis **NN**, BookWidth **NN** **CK BookWidth > 0.0**, BookHeight **NN** **CK BookHeight > 0.0**, type **NN** **CK type in ProductType**, language_id→language, editor_id→editor) |
| **R17** | **genre**(<ins>id</ins>, name **NN** **CK name in Genre**) |
| **R18** | **productGenre**(<ins>product_id</ins>→product, <ins>genre_id</ins>→genre) |
| **R19** | **language**(<ins>id</ins>, name **NN** **CK name in Lang**) |
| **R20** | **editor**(<ins>id</ins>,name **NN**) |
| **R21** | **edition**(<ins>product_id</ins>→product, <ins>editor_id</ins>→editor,name **NN**, date **NN** **CK date <= Today**) |
| **R22** | **archievedProduct**(<ins>product-id</ins>→product) |
| **R23** | **productAuthor**(<ins>product_id</ins>->product, <ins>author_id</ins>→author) 
| **R24** | **wishList**(<ins>user_id</ins>→user, <ins>product_id</ins>→product) |
| **R25** | **address**(<ins>id</ins>, street **NN**, adicional_info, code_id->country, zip_code **CK LIKE [^0-9]*4 + "-" + [^0-9]*3**, city) | 
| **R26** | **country**(<ins>code_id</ins>, name **NN**) |
| **R27** | **default_adress**(<ins>id_user</ins>→user, <ins>id_address</ins>→address) |
| **R28** | **selectedPaymentMethod**(<ins>id_order</ins>→order, <ins>id_payment</ins>→payment_method) |
| **R29** | **defaultPaymentMethod**(<ins>id_payment</ins>→payment_method) |
| **R30** | **payment_method**(<ins>id</ins>) | 
| **R31** | **paypal**(<ins>id_payment</ins>→payment_method) |
| **R32** | **card**(<ins>id_payment</ins>→payment_method, <ins>card_number</ins> **CK card_number>=1000000000000000 AND card_number<=9999999999999999**, name **NN**, security_code, expiration_date **CK expiration_date >= Today**) |
| **R33** | **faq**(<ins>id</ins>, question **UK** **NN**, answer **UK** **NN**) |
| **R34** | **quote**(<ins>id</ins>, quote **UK** **NN** ) |
| **R35** | **notification**(<ins>id</ins>, status **NN CK status in Notif_Status** , type **NN CK type in Notif_Types**, id_user->user) |
| **R36** | **order_notification**(<ins>id_order</ins>->order, <ins>id_notification</ins>->notification) |
| **R37** | **product_notification**(<ins>id_product</ins>->product, <ins>id_notification</ins>->notification) |     

## **Domains**

| **Domain Name** | **Domain Specification** |
| :------:        | :----- |
| **Today** | DATE DEFAULT CURRENT_DATE |
| **Notif_Status** | **ENUM**('Not Read','Read')|
| **Notif_Types** | **ENUM**('Order Payment Approved', 'Order Shipped, 'Order Delivered’, 'Order Returned Successfully’ 'Product from Wishlist Available', 'Price Change on Product from Wishlist') |
| **Genre** | **ENUM**('Detective and Mystery', 'Fantasy', 'Historical Fiction', 'Horror', 'Literary Fiction', 'Romance, 'Science Fiction', 'Westerns,'Thriller', 'Dystopian') |
| **ProductType** | **ENUM**('Hard Cover Book', 'Digital Book') |
| **Lang** | **ENUM**('Portuguese','Spanish','French','German','English','Italian','Latin','Russian','Mandarin','Cantonese') |
| **Status** | **ENUM**(‘Payment Pending’, ‘Processing’, ‘Shipped’,’Delivered’,’Returned’) |


## **Schema Validation**

| **Table R01** | **User** |
| :--------------:| :----------- |
| **Keys** | {id}, {username}, {email} |
| **Functional Dependencies** | |
| **FD0101** | id → {username, email, password, name, birth_date, id_image} |
| **FD0102** | username → {id, email, password, name, birth_date, id_image} |
| **FD0103** | email → {id, username, password, name, birth_date, id_image} |
| **Normal Form** | **BCNF** |

| **Table R02** | **Admin** |
| :--------------:| :----------- |
| **Keys** | {id_user} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R03** | **Banned_User** |
| :--------------:| :----------- |
| **Keys** | {id_user} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R04** | **Image** |
| :--------------:| :----------- |
| **Keys** | {id}, {path_image} |
| **Functional Dependencies** | |
| **FD0401** | id → {path_image} |
| **FD0402** | path_image → {id} |
| **Normal Form** | **BCNF** |

| **Table R05** | **Product_image** |
| :--------------:| :----------- |
| **Keys** | {id_image, id_product} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R06** | **Author_Image** |
| :--------------:| :----------- |
| **Keys** | {id_image, id_author} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R07** | **Author** |
| :--------------:| :----------- |
| **Keys** | {id} |
| **Functional Dependencies** | |
| **FD0701** | {id} → {name, bio} |
| **Normal Form** | **BCNF** |

| **Table R08** | **Review** |
| :--------------:| :----------- |
| **Keys** | {id}, {id_user, id_product} |
| **Functional Dependencies** | |
| **FD0801** | {id} → {date, star_rating, comment, id_user, id_product}|
| **FD0802** | {id_user, id_product} → {id, date, star_rating, comment} |
| **Normal Form** | **BCNF** |

| **Table R09** | **Buyer_info** |
| :--------------:| :----------- |
| **Keys** | {id_order} |
| **Functional Dependencies** | |
| **FD0901** | {id_order} -> {id_user, name, phone_number, nif}|
| **Normal Form** | **BCNF** |

|**Table R10**| **Processing**|
| :--------: | :--------|
|**Keys:**| {order_id}|
|**Functional Dependencies**|
|**FD1001**|{order_id} → {datepayed}|
|**Normal Form**|**BCNF**|

|**Table R11**|**Shipped**|
| :--------: | :--------:|
|**Keys:**|{order_id}|
|**Functional Dependencies**|
|**FD1101**|{order_id} → {dateshipped}|
|**Normal Form**|**BCNF**|

|**Table R12**|**Delivered**|
| :--------: | :--------:|
|**Keys:**|{order_id}|
|**Functional Dependencies**|
|**FD1201**|{order_id} → {datedelivered}|
|**Normal Form**|**BCNF**|

|**Table R13**|**Returned**|
| :--------: | :--------:|
|**Keys:**|{order_id}|
|**Functional Dependencies**|
|**FD1301**|{order_id} → {datereturned, reason}|
|**Normal Form**|**BCNF**|

| **Table R14** | **Paymentpending** |
| :--------------:| :----------- |
| **Keys** | {order_id} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

|**Table R15**|**Order**|
| :--------: | :--------:|
|**Keys:**|{id}|
|**Functional Dependencies**|
|**FD1401**|{id} → {status,date,adress_id}|
|**Normal Form**|**BCNF**|

| **Table R16** | **Product** |
| :------------:| :--------------------|
| **Keys**      | {id} |
| **Functional Dependencies** |  |
| **FD1601**    | id → {name, price, stoock, discount, starRating, Synopsis, BookWidth, type, language_id, editor_id} |
| **Normal Form** | **BCNF** |

| **Table R17** | **Genre** |
| :------------:| :--------------------|
| **Keys**      | {id} |
| **Functional Dependencies** |  |
| **FD1701**    | id → {name} |
| **Normal Form** | **BCNF** |

| **Table R18** | **ProductGenre** |
| :------------:| :--------------------|
| **Keys**      | {product_id, genre_id} |
| **Functional Dependencies** |  |
| none | |
| **Normal Form** | **BCNF** |

| **Table R19** | **Language** |
| :------------:| :--------------------|
| **Keys**      | {id} |
| **Functional Dependencies** |  |
| **FD1901** | id → {name} |
| **Normal Form** | **BCNF** |

| **Table R20** | **Editor** |
| :------------:| :--------------------|
| **Keys**      | {id} |
| **Functional Dependencies** |  |
| **FD2001** | id → {name} |
| **Normal Form** | **BCNF** |

| **Table R21** | **Edition** |
| :------------:| :--------------------|
| **Keys**      | {product_id, editor_id} |
| **Functional Dependencies** |  |
| **FD2101**    | {product_id, editor_id} → {name,date} |
| **Normal Form** | **BCNF** |

| **Table R22** | **Archieved Product** |
| :------------:| :--------------------|
| **Keys**      | {product_id} |
| **Functional Dependencies** |  |
| none | |
| **Normal Form** | **BCNF** |

| **Table R23** | **Product Author** |
| :-----------: | :------- |
| **Keys**      | {product_id, author_id} |
| **Functional Dependencies** |  |
| none| |
| **Normal Form** | **BCNF** |

| **Table R24** | **WishList** |
| :------------:| :--------------------|
| **Keys** | {code_id} |
| **Functional Dependencies** |  |
| none | |
| **Normal Form** | **BCNF** |

| **Table R25** | **Address** |
| :------------:| :--------------------|
| **Keys** | {id} |
| **Functional Dependencies** |  |
| **FD2501** | id → {street, adicional_info, code_id, zip_code} |
| **Normal Form** | **BCNF** |

| **Table R26** | **Country** |
| :------------:| :--------------------|
| **Keys** | {code_id} |
| **Functional Dependencies** | |
| **FD2501** | code_id → {name}|
| **Normal Form** | **BCNF** |

| **Table R27** | **Default_adress** |
| :------------:| :--------------------|
| **Keys** | {id_user, id_address} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R28** | **selectedPaymentMethod** |
| :------------:| :--------------------|
| **Keys** | {id_order, id_payment} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R29** | **defaultPaymentMethod** |
| :------------:| :--------------------|
| **Keys** | {id_payement} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R30** | **Payment_method** |
| :------------:| :--------------------|
| **Keys** | {id} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R31** | **Paypal** |
| :------------:| :--------------------|
| **Keys** | {id_payment} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R32** | **Card** |
| :------------:| :--------------------|
| **Keys** | {id_payment, card_number} |
| **Functional Dependencies** | |
| **FD2901** | {id_payment, card_number} → {name, security_code, expiration_date} |
| **Normal Form** | **BCNF** |

| **Table R33** | **FAQ** |
| :------------:| :--------------------|
| **Keys** | {id} |
| **Functional Dependencies** | |
| **FD3001** | id → {question, answer} |
| **Normal Form** | **BCNF** |

| **Table R34** | **Quote** |
| :------------:| :--------------------|
| **Keys** | {id} |
| **Functional Dependencies** | |
| **FD3101** | id → {quote} |
| **Normal Form** | **BCNF** |

| **Table R35** | **Notification** |
| :--------------: | :-----------: |
| **Keys** | {id} |
| **Functional Dependencies** | |
| **FD03501** | id → {status, type} |
| **Normal Form** | **BCNF** |

| **Table R36** | **Order_notification** |
| :--------------: | :-----------: |
| **Keys** | {id_order, id_notification} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |

| **Table R37** | **Product_notification** |
| :--------------: | :-----------: |
| **Keys** | {id_product, id_notification} |
| **Functional Dependencies** | |
| none | |
| **Normal Form** | **BCNF** |





# **A6 Indexes, triggers, transactions and database population**
