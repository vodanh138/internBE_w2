DROP SCHEMA IF EXISTS shopee;
CREATE SCHEMA shopee;
DROP TABLE IF EXISTS shopee.user_table;
CREATE TABLE shopee.user_table (
    uid INT AUTO_INCREMENT,
    username VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    ori_username VARCHAR(255),
    PRIMARY KEY (uid)
);
DROP TABLE IF EXISTS shopee.product_table;
CREATE TABLE shopee.product_table (
    pid INT AUTO_INCREMENT,
    pname VARCHAR(255), 
    image VARCHAR(255), 
    Price INT, 
    State VARCHAR(255), 
    City VARCHAR(255), 
    District VARCHAR(255),
    uid INT,
    PRIMARY KEY (pid),
    FOREIGN KEY (uid) REFERENCES user_table(uid)
);
