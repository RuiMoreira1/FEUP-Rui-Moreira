DROP TABLE IF EXISTS "returned";
DROP TABLE IF EXISTS "delivered";
DROP TABLE IF EXISTS "shipped";
DROP TABLE IF EXISTS "processing";
DROP TABLE IF EXISTS "payment_pending";
DROP TABLE IF EXISTS "quote";
DROP TABLE IF EXISTS faq;
DROP TABLE IF EXISTS default_payment_method;
DROP TABLE IF EXISTS selected_payment_method;
DROP TABLE IF EXISTS card;
DROP TABLE IF EXISTS paypal;
DROP TABLE IF EXISTS payment_method;
DROP TABLE IF EXISTS default_address;
DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS product_author;
DROP TABLE IF EXISTS archieved_product;
DROP TABLE IF EXISTS "edition";
DROP TABLE IF EXISTS product_genre;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS product_order;
DROP TABLE IF EXISTS product_in_cart;
DROP TABLE IF EXISTS product_notification;
DROP TABLE IF EXISTS order_notification;
DROP TABLE IF EXISTS notification;
DROP TABLE IF EXISTS buyer_info;
DROP TABLE IF EXISTS "order";
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS country;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS author_image;
DROP TABLE IF EXISTS author;
DROP TABLE IF EXISTS product_image;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS editor;
DROP TABLE IF EXISTS "language";
DROP TABLE IF EXISTS banned_user;
DROP TABLE IF EXISTS "admin";
DROP TABLE IF EXISTS "user";
DROP TABLE IF EXISTS image;



DROP DOMAIN IF EXISTS TODAY;
DROP TYPE IF EXISTS genre_type;
DROP TYPE IF EXISTS product_type;
DROP TYPE IF EXISTS lang;
DROP TYPE IF EXISTS notif_status;
DROP TYPE IF EXISTS notif_types;
DROP TYPE IF EXISTS status;

CREATE DOMAIN TODAY AS date NOT NULL DEFAULT ('now'::text)::date;
CREATE TYPE genre_type as ENUM ('Detective and Mystery', 'Fantasy', 'Historical Fiction',
								'Horror', 'Literary Fiction', 'Romance', 'Science Fiction',
								'Westerns','Thriller', 'Dystopian');
CREATE TYPE product_type as ENUM ('Hard Cover Book', 'Digital Book');
CREATE TYPE lang as ENUM ('Portuguese','Spanish','French','German','English',
						  'Italian','Latin','Russian','Mandarin','Cantonese');
CREATE TYPE notif_status AS ENUM ('Not Read','Read');
CREATE TYPE notif_types AS ENUM ('Order Payment Approved', 'Order Shipped', 'Order Delivered',
                                 'Order Returned Successfully','Product from Wishlist Available',
                                 'Price Change on Product from Wishlist');
CREATE TYPE status AS ENUM('Payment Pending', 'Processing', 'Shipped','Delivered','Returned');

CREATE TABLE image (
    id               SERIAL,

    path_image       TEXT   CONSTRAINT image_superKey      UNIQUE
                            CONSTRAINT pathImage_notNull   NOT NULL,

    CONSTRAINT imagem_pk    PRIMARY KEY (id)
);


CREATE TABLE "user" (
    id                      SERIAL,

    username                TEXT    CONSTRAINT user_sKU         UNIQUE
                                    CONSTRAINT username_notNull NOT NULL
                                    CONSTRAINT username_valid   CHECK(length(username) > 0 and length(username) <= 50),

    email                   TEXT    CONSTRAINT user_sKE    UNIQUE 
                                    CONSTRAINT email_notNull    NOT NULL
                                    CONSTRAINT email_valid      CHECK (email LIKE '%_@_%._%'),

    "password"              TEXT    CONSTRAINT password_notNull NOT NULL
                                    CONSTRAINT password_valid   CHECK(length(password) >= 6),

    "name"                  TEXT    CONSTRAINT name_notNull     NOT NULL,

    birth_date              DATE    CONSTRAINT is_adult         CHECK(date_part('year',age(birth_date))>=18),

    id_image                INTEGER NOT NULL,


    CONSTRAINT user_pk      PRIMARY KEY (id),
    CONSTRAINT user_img_fk  FOREIGN KEY (id_image)  REFERENCES image(id)   ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE "admin" (
    id_user         INTEGER,

    CONSTRAINT admin_pk     PRIMARY KEY (id_user),
    CONSTRAINT admin_fk     FOREIGN KEY (id_user)   REFERENCES "user"(id)    ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE banned_user (
    id_user         INTEGER,

    reason          TEXT    CONSTRAINT reason_notNull   NOT NULL,

    CONSTRAINT bannedU_pk   PRIMARY KEY (id_user),
    CONSTRAINT bannedU_fk   FOREIGN KEY (id_user)   REFERENCES "user"(id)    ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE "language" (
    id                      SERIAL,
    
    "name"                  lang        CONSTRAINT name_notNULL NOT NULL,

    CONSTRAINT              lang_pk     PRIMARY KEY (id)
);


CREATE TABLE editor (
    id                       SERIAL,
    
    "name"                   TEXT        CONSTRAINT name_notNULL NOT NULL,

    CONSTRAINT editor_pk     PRIMARY KEY (id)
);


CREATE TABLE product (
    id                      SERIAL,
    
    product_name            TEXT                    CONSTRAINT  name_notNULL        NOT NULL,
    
    price                   DOUBLE PRECISION        CONSTRAINT  valid_price         CHECK( price > 0.0 ),
    
    stock                   INTEGER                 CONSTRAINT  valid_stock         CHECK( stock >= 0 ),
    
    discount                DOUBLE PRECISION        CONSTRAINT  valid_discount      CHECK( discount >= 0.0 and discount <= 1.0),
    
    star_rating             DOUBLE PRECISION        CONSTRAINT  valid_rating        CHECK( star_rating >= 0.0 and star_rating <= 5.0)
                                                    CONSTRAINT  rating_dV           DEFAULT 0.0,
    
    synopsis                TEXT                    CONSTRAINT  synopsis_notNULL    NOT NULL,
    
    book_width              DOUBLE PRECISION        CONSTRAINT  bookwidth_notNULL   NOT NULL
                                                    CONSTRAINT  valid_bookWidth     CHECK( book_width > 0.0),
    
    book_height             DOUBLE PRECISION        CONSTRAINT  bookheigth_notNULL  NOT NULL
                                                    CONSTRAINT  valid_bookheigth    CHECK( book_height > 0.0),
    
    prod_type               product_type            CONSTRAINT  type_notNULL        NOT NULL,
    
    language_id             INTEGER                 CONSTRAINT  languageid_notNULL  NOT NULL,
    
    editor_id               INTEGER                 CONSTRAINT  editorid_notNULL    NOT NULL,

    search                  TSVECTOR, 

    CONSTRAINT product_pk   PRIMARY KEY (id),
    CONSTRAINT language_fk  FOREIGN KEY (language_id) REFERENCES "language"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT editor_fk    FOREIGN KEY (editor_id)   REFERENCES editor(id)     ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE product_image (
    id_image            INTEGER     CONSTRAINT id_image_notNull NOT NULL,
    id_product          INTEGER     CONSTRAINT id_product_notNULL NOT NULL,

    CONSTRAINT prod_image_pk        PRIMARY KEY (id_image, id_product),
    CONSTRAINT prod_image_fki       FOREIGN KEY (id_image)   REFERENCES image(id)      ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT prod_image_fkp       FOREIGN KEY (id_product) REFERENCES product(id)     ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE author (
    id              SERIAL,

    name            TEXT    CONSTRAINT name_notNull     NOT NULL,

    bio             TEXT    CONSTRAINT bio_notNull      NOT NULL,

    CONSTRAINT author_pk      PRIMARY KEY (id)
);

CREATE TABLE author_image (
    id_image            INTEGER     CONSTRAINT id_image_notNull NOT NULL,
    id_author           INTEGER     CONSTRAINT id_author_notNull NOT NULL,

    CONSTRAINT author_image_pk      PRIMARY KEY (id_image, id_author),
    CONSTRAINT author_image_fki     FOREIGN KEY (id_image)  REFERENCES image(id)    ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT author_fka           FOREIGN KEY (id_author) REFERENCES author(id)   ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE review (
    id                  SERIAL,

    date                DATE        CONSTRAINT date_notNull     NOT NULL
                                    CONSTRAINT date_valid       CHECK(date <= now()),

    star_rating         DOUBLE PRECISION        CONSTRAINT rating_notNull   NOT NULL
                                                CONSTRAINT rating_dV        DEFAULT 0.0
                                                CONSTRAINT rating_valid     CHECK(star_rating >= 0.0 and star_rating <= 5.0),

    comment             TEXT        CONSTRAINT comment_notNull  NOT NULL
                                    CONSTRAINT comment_valid    CHECK(length(comment) > 0 and length(comment) <= 200),

    id_user             INTEGER     CONSTRAINT id_user_notNull      NOT NULL
                                    CONSTRAINT id_user_dV           DEFAULT -1,

    id_product           INTEGER     CONSTRAINT id_product_notNull   NOT NULL,

    CONSTRAINT review_pk            PRIMARY KEY (id),
    CONSTRAINT review_superKey      UNIQUE (id_user, id_product),
    CONSTRAINT review_fku           FOREIGN KEY (id_user)  REFERENCES "user"(id)    ON UPDATE CASCADE ON DELETE SET DEFAULT,
    CONSTRAINT review_fkp           FOREIGN KEY (id_product) REFERENCES product(id)   ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE "country" (
    code_id SERIAL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE "address" (
    id SERIAL PRIMARY KEY,
    street TEXT NOT NULL, 
    adicional_info TEXT,
    code_id INTEGER REFERENCES country(code_id) ON UPDATE CASCADE ON DELETE CASCADE,
    zip_code TEXT CHECK (zip_code ~ '^[0-9]{4}-[0-9]{3}$'),
    city TEXT
);


CREATE TABLE "order"(
    id SERIAL PRIMARY KEY,
    "type" status NOT NULL,
    date DATE NOT NULL CHECK (date <= now()),
    address_id INTEGER NOT NULL REFERENCES "address"(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE buyer_info (
    id_order            INTEGER     CONSTRAINT id_order_notNull NOT NULL,
    id_user             INTEGER     CONSTRAINT id_user_notNull  NOT NULL
                                    CONSTRAINT id_user_dV       DEFAULT -1, 

    name                TEXT        CONSTRAINT name_notNull     NOT NULL,

    phone_number        BIGINT      CONSTRAINT phone_number_notNull NOT NULL
                                    CONSTRAINT phone_number_valid   CHECK(phone_number >= 100000000 and phone_number <= 999999999),

    nif                 BIGINT      CONSTRAINT nif_notNull NOT NULL
                                    CONSTRAINT nif_valid   CHECK(nif >= 100000000 and nif <= 999999999),

    CONSTRAINT buyer_info_pk        PRIMARY KEY (id_order),
    CONSTRAINT buyer_info_fko       FOREIGN KEY (id_order) REFERENCES "order"(id)   ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT buyer_info_fku       FOREIGN KEY (id_user)  REFERENCES "user"(id)    ON UPDATE CASCADE ON DELETE SET DEFAULT
);

CREATE TABLE notification (
    id                  SERIAL,
    status              Notif_Status    CONSTRAINT status_notNull NOT NULL,
    type                Notif_Types    CONSTRAINT type_notNull NOT NULL,

    id_user             INTEGER     CONSTRAINT id_user_notNull  NOT NULL
                                    CONSTRAINT id_user_dV       DEFAULT -1, 

    CONSTRAINT notif_pk             PRIMARY KEY (id),
    CONSTRAINT notif_fku            FOREIGN KEY (id_user)  REFERENCES "user"(id)    ON UPDATE CASCADE ON DELETE SET DEFAULT
);

CREATE TABLE order_notification (
    id_order            INTEGER     CONSTRAINT id_order_notNull NOT NULL,
    id_notification     INTEGER     CONSTRAINT id_notification_notNull NOT NULL,

    CONSTRAINT ord_notif_pk      PRIMARY KEY (id_order, id_notification),
    CONSTRAINT ord_notif_fko     FOREIGN KEY (id_order)  REFERENCES "order"(id)    ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT ord_notif_fkn     FOREIGN KEY (id_notification) REFERENCES notification(id)   ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE product_notification (
    id_product          INTEGER     CONSTRAINT id_order_notNull NOT NULL,
    id_notification     INTEGER     CONSTRAINT id_notification_notNull NOT NULL,

    CONSTRAINT prod_notif_pk      PRIMARY KEY (id_product, id_notification),
    CONSTRAINT prod_notif_fkp     FOREIGN KEY (id_product)  REFERENCES product(id)    ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT prod_notif_fkn     FOREIGN KEY (id_notification) REFERENCES notification(id)   ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE product_in_cart (
    id_product          INTEGER     CONSTRAINT id_product_notNULL   NOT NULL
                                    CONSTRAINT id_product_dV        DEFAULT -1,
    id_user             INTEGER     CONSTRAINT id_user_notNull      NOT NULL
                                    CONSTRAINT id_user_dV           DEFAULT -1,
    quantity            INTEGER     CONSTRAINT quantity_notNull     NOT NULL
                                    CONSTRAINT quantity_valid       CHECK(quantity > 0),

    CONSTRAINT prod_cart_pk        PRIMARY KEY (id_product, id_user),
    CONSTRAINT prod_cart_fkp       FOREIGN KEY (id_product) REFERENCES product(id)    ON UPDATE CASCADE ON DELETE SET DEFAULT,
    CONSTRAINT prod_cart_fku       FOREIGN KEY (id_user)   REFERENCES "user"(id)      ON UPDATE CASCADE ON DELETE SET DEFAULT
);

CREATE TABLE product_order (
    id_product          INTEGER     CONSTRAINT id_product_notNULL   NOT NULL,
    id_order            INTEGER     CONSTRAINT id_user_notNull      NOT NULL,
    quantity            INTEGER     CONSTRAINT quantity_notNull     NOT NULL
                                    CONSTRAINT quantity_valid       CHECK(quantity > 0),
    
    CONSTRAINT prod_order_pk        PRIMARY KEY (id_product, id_order),
    CONSTRAINT prod_order_fkp       FOREIGN KEY (id_product) REFERENCES product(id)  ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT prod_order_fko       FOREIGN KEY (id_order)   REFERENCES "order"(id)      ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE genre (
    id                      SERIAL,
    
    "name"                  genre_type               CONSTRAINT name_notNULL NOT NULL,

    CONSTRAINT              genre_pk PRIMARY KEY (id)              
);

CREATE TABLE product_genre (
    product_id              INTEGER     CONSTRAINT prodid_notNULL NOT NULL,
   
    genre_id                INTEGER     CONSTRAINT genreid_notNULL NOT NULL,

    CONSTRAINT pgenre_pk    PRIMARY KEY (product_id, genre_id),
    CONSTRAINT pid_fk       FOREIGN KEY (product_id) REFERENCES product(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT gid_fk       FOREIGN KEY (genre_id)   REFERENCES genre(id)   ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "edition" (
    product_id               INTEGER     CONSTRAINT pid_notNULL NOT NULL, 
    editor_id                INTEGER     CONSTRAINT eid_notNULL NOT NULL, 

    "name"                   TEXT        CONSTRAINT name_notNULL NOT NULL,
    
    "date"                   DATE        CONSTRAINT date_not_NULL NOT NULL
                                         CONSTRAINT valid_date   CHECK( date <= now() ),
    
    CONSTRAINT edition_pk    PRIMARY KEY (product_id, editor_id),
    CONSTRAINT pid_fk        FOREIGN KEY (product_id) REFERENCES product(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT editor_fk     FOREIGN KEY (editor_id)  REFERENCES editor(id)  ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE archieved_product (
    product_id               INTEGER     CONSTRAINT pid_notNULL NOT NULL,

    CONSTRAINT archieved_pk  PRIMARY KEY (product_id),
    CONSTRAINT archieved_fk  FOREIGN KEY (product_id) REFERENCES product(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE product_author (
    product_id              INTEGER     CONSTRAINT pid_notNULL NOT NULL,
    author_id               INTEGER     CONSTRAINT aid_notNULL NOT NULL,

    CONSTRAINT prod_aut_pk  PRIMARY KEY (product_id, author_id),
    CONSTRAINT prod_fk      FOREIGN KEY (product_id) REFERENCES product(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT aut_fk       FOREIGN KEY (author_id)  REFERENCES author(id)  ON UPDATE CASCADE ON DELETE CASCADE 
);


CREATE TABLE wishlist (
    product_id              INTEGER     CONSTRAINT pid_notNULL NOT NULL,
    id_user                 INTEGER     CONSTRAINT uid_notNULL NOT NULL,

    CONSTRAINT wish_pk      PRIMARY KEY (product_id,id_user),
    CONSTRAINT prod_fk      FOREIGN KEY (product_id) REFERENCES product(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT user_fk      FOREIGN KEY (id_user)    REFERENCES "user"(id)  ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "default_address"(
    id_user INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_address INTEGER NOT NULL REFERENCES address(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE "payment_method"(
    id SERIAL PRIMARY KEY
);


CREATE TABLE "paypal"(
    id_payment INTEGER NOT NULL REFERENCES payment_method(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE "card" (
    id_payment INTEGER NOT NULL REFERENCES payment_method(id) ON UPDATE CASCADE ON DELETE CASCADE,
    card_number BIGINT UNIQUE CHECK (card_number>=1000000000000000 AND card_number<=9999999999999999), 
    name TEXT NOT NULL,
    security_code INT NOT NULL,
    expiration_date DATE CHECK (expiration_date >= now())
);


CREATE TABLE "selected_payment_method"(
    id_order INTEGER NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    id_payment INTEGER NOT NULL REFERENCES payment_method(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE "default_payment_method"(
    id_payment INTEGER NOT NULL REFERENCES payment_method(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE "faq"(
    id SERIAL PRIMARY KEY,
    question TEXT UNIQUE NOT NULL,
    answer TEXT UNIQUE NOT NULL
);


CREATE TABLE "quote"(
    id SERIAL PRIMARY KEY,
    quote TEXT UNIQUE NOT NULL
);

CREATE TABLE "payment_pending"(
 	order_id INTEGER  NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE ,
    PRIMARY KEY (order_id)
);

CREATE TABLE "processing"(
 	order_id INTEGER  NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE,
	date_payed DATE NOT NULL CHECK (date_payed <= now()),
    PRIMARY KEY (order_id)
);


CREATE TABLE "shipped"(
    order_id INTEGER NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    date_shipped DATE NOT NULL CHECK (date_shipped <= now()),
    PRIMARY KEY (order_id)
);


CREATE TABLE "delivered"(
    order_id INTEGER NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    date_delivered DATE NOT NULL CHECK (date_delivered <= now()),
    PRIMARY KEY (order_id)
);


CREATE TABLE "returned"(
    order_id INTEGER NOT NULL REFERENCES "order"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    date_returned DATE NOT NULL CHECK (date_returned <= now()),
    reason TEXT NOT NULL CHECK (length(reason)> 0  and length(reason) <= 200),
    PRIMARY KEY (order_id)
);
