DROP DATABASE IF EXISTS `shop_order`;
CREATE DATABASE `shop_order`;
USE `shop_order`;
CREATE TABLE tb_cart
(
  id_product int      NOT NULL,
  username   char(50) NOT NULL,
  amount     int      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_category
(
  id_category char(50)     NOT NULL,
  title       varchar(50)  NOT NULL,
  image       varchar(255) NOT NULL,
  active      tinyint(1)   NOT NULL,
  PRIMARY KEY (id_category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_order
(
  id_order          char(10)     NOT NULL,
  username          char(50)     NOT NULL,
  name_customer     varchar(255) NOT NULL,
  phone_customer    varchar(11)  NOT NULL,
  address_customer  varchar(255) NOT NULL,
  email_customer    varchar(255) NOT NULL,
  city_customer     varchar(255) NOT NULL,
  ward_customer     varchar(255) NOT NULL,
  province_customer varchar(255) NOT NULL,
  status            varchar(50)  NOT NULL,
  order_date        DATE         NOT NULL,
  shipped_date      DATE         NULL    ,
  process_date      DATE         NULL    ,
  total_money       FLOAT        NULL    ,
  PRIMARY KEY (id_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_order_details
(
  id_order   char(10) NOT NULL,
  id_product int      NOT NULL,
  amount     int      NOT NULL,
  price      decimal  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_product
(
  id_product  int           NOT NULL AUTO_INCREMENT,
  name        varchar(50)   NOT NULL,
  description varchar(255)  NOT NULL,
  price       decimal       NOT NULL,
  ranking     int           NOT NULL,
  image       varchar(255)  NOT NULL,
  quantity    int           NOT NULL,
  discount    decimal(10,2) NULL    ,
  id_category char(50)      NOT NULL,
  PRIMARY KEY (id_product)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_recent_product
(
  id_recent  int(10)      NOT NULL AUTO_INCREMENT,
  username   varchar(255) NOT NULL,
  id_product int          NOT NULL,
  PRIMARY KEY (id_recent)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE tb_user
(
  username varchar(50)  NOT NULL,
  fullname varchar(255) NOT NULL,
  email    varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  active   tinyint(1)   NOT NULL,
  phone    varchar(11)  NULL    ,
  province varchar(255) NULL    ,
  city     varchar(255) NULL    ,
  ward     varchar(255) NULL    ,
  address  varchar(255) NULL    ,
  PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE tb_cart
  ADD CONSTRAINT FK_tb_user_TO_tb_cart
    FOREIGN KEY (username)
    REFERENCES tb_user (username);

ALTER TABLE tb_cart
  ADD CONSTRAINT FK_tb_product_TO_tb_cart
    FOREIGN KEY (id_product)
    REFERENCES tb_product (id_product);

ALTER TABLE tb_order
  ADD CONSTRAINT FK_tb_user_TO_tb_order
    FOREIGN KEY (username)
    REFERENCES tb_user (username);

ALTER TABLE tb_order_details
  ADD CONSTRAINT FK_tb_order_TO_tb_order_details
    FOREIGN KEY (id_order)
    REFERENCES tb_order (id_order);

ALTER TABLE tb_order_details
  ADD CONSTRAINT FK_tb_product_TO_tb_order_details
    FOREIGN KEY (id_product)
    REFERENCES tb_product (id_product);

ALTER TABLE tb_product
  ADD CONSTRAINT FK_tb_category_TO_tb_product
    FOREIGN KEY (id_category)
    REFERENCES tb_category (id_category);

ALTER TABLE tb_recent_product
  ADD CONSTRAINT FK_tb_user_TO_tb_recent_product
    FOREIGN KEY (username)
    REFERENCES tb_user (username);

ALTER TABLE tb_recent_product
  ADD CONSTRAINT FK_tb_product_TO_tb_recent_product
    FOREIGN KEY (id_product)
    REFERENCES tb_product (id_product);