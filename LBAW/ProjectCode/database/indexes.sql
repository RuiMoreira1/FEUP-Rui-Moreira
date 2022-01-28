CREATE INDEX users_by_username ON "user" USING HASH (username);
CREATE INDEX product_reviews ON review USING HASH (id_product);
CREATE INDEX product_pricing ON products USING BTREE (price);
CREATE INDEX search_idx ON products USING GIST(search);
