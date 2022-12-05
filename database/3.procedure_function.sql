-- ! Tổng hợp các thủ tục và hàm cho Admin
-- * Thêm sản phẩm
DROP PROCEDURE IF EXISTS ADD_PRODUCT;
DELIMITER //
CREATE PROCEDURE ADD_PRODUCT(
    IN name VARCHAR(50),
    IN description VARCHAR(255),
    IN price FLOAT,
    IN image VARCHAR(255),
    IN discount DECIMAL(10,2),
    IN ranking INT, 
    IN quantity INT,
    IN id_category CHAR(25)
)
BEGIN
    INSERT INTO `tb_product` 
        (name, description, price, image, discount, ranking, quantity, id_category) 
    VALUES 
        (name, description, price, image, discount, ranking, quantity, id_category);
END //
DELIMITER ;

-- * Cập nhật đơn hàng
DROP PROCEDURE IF EXISTS UPDATE_ORDER;
DELIMITER //
CREATE PROCEDURE UPDATE_ORDER(
    IN id CHAR(25),
    IN name varchar(255),
    IN email varchar(255),
    IN phone varchar(11),
    IN province varchar(50),
    IN city varchar(50),
    IN address varchar(255),
    IN status varchar(50)
)
BEGIN
    UPDATE `tb_order` 
    SET name_customer = name,
    email_customer = email,
    phone_customer = phone,
    province_customer = province,
    city_customer = city,
    address_customer = address,
    status = status
    WHERE id_order = id;
END //
    DELIMITER ;

-- CALL UPDATE_ORDER(id, name, email, phone, province, city, address, status);

-- ! Tổng hợp các thủ tục và hàm cho User
-- * Hàm và thủ tục thêm người dùng, không có phone và address
DROP FUNCTION IF EXISTS checkUser;
DELIMITER //
CREATE FUNCTION checkUser(user varchar(255)) RETURNS INT DETERMINISTIC
BEGIN
    DECLARE result INT DEFAULT 0;

    SELECT COUNT(*) INTO result
    FROM `tb_user` 
    WHERE username = user;

    RETURN result;
END //
DELIMITER ;

#* Thử tục thêm người dùng, không có phone và address
DROP PROCEDURE IF EXISTS ADD_USER; 
DELIMITER //
CREATE PROCEDURE ADD_USER(
    IN username VARCHAR(255),
    IN fullname varchar(255),
    IN email varchar(255),
    IN password varchar(255)
)
BEGIN
    INSERT INTO `tb_user` 
        (username, fullname, email, password) 
    VALUES 
        (username, fullname, email, password);
END // 
DELIMITER ;

-- SELECT checkUser('kietgolx65234');

-- * Đặt hàng 
DROP PROCEDURE IF EXISTS CHECKOUT;
DELIMITER //
CREATE PROCEDURE CHECKOUT(
    IN id CHAR(25),
    IN user varchar(255),
    IN name varchar(255),
    IN email varchar(255),
    IN phone varchar(11),
    IN province varchar(50),
    IN city varchar(50),
    IN address varchar(255),
    IN status varchar(50),
    IN orderDate date
)
BEGIN
    INSERT INTO `tb_order`
    (id_order, username, name_customer, phone_customer, address_customer, email_customer, city_customer, province_customer, status, order_date) 
    VALUES 
    (id, user, name, phone, address, email, city, province, status, orderDate);
END //
DELIMITER ;
-- CALL CHECKOUT(id, user, name, email, phone, province, city, address, status, orderDate)

DROP FUNCTION IF EXISTS countPendingOrder;
DELIMITER //
CREATE FUNCTION countPendingOrder() RETURNS INT DETERMINISTIC
BEGIN
    DECLARE result INT DEFAULT 0;
    SELECT count(*) as count INTO result FROM `tb_order` 
    WHERE status = 'pending';
    RETURN result;
END //
DELIMITER ;



-- Hàm tính tổng tiền trong đơn hàng
DROP FUNCTION IF EXISTS totalMoney;
DELIMITER //
CREATE FUNCTION `totalMoney`(id char(10)) RETURNS FLOAT DETERMINISTIC
BEGIN
    DECLARE result FLOAT DEFAULT -1;

    SELECT SUM(total) INTO result FROM 
        (SELECT (p.price - (p.price * p.discount)/100) * od.amount as total 
        FROM `tb_order_details` as od, `tb_product` as p 
        WHERE od.id_product = p.id_product 
        AND id_order = id) as total;

    RETURN result;
END // 
DELIMITER ;

-- * Top 10 sản phẩm bán được nhiều nhất
DROP PROCEDURE IF EXISTS TOP_SELLER_PRODUCT;
DELIMITER //
CREATE PROCEDURE TOP_SELLER_PRODUCT()
BEGIN
    SELECT p.*, COUNT(od.amount) as total_amount
    FROM `tb_order_details` as od, `tb_product` as p
    WHERE od.id_product = p.id_product
    GROUP BY p.id_product
    ORDER BY total_amount DESC
    LIMIT 10;
END //
DELIMITER ;

-- * Trigger khi thêm đơn hàng sẽ tự động trừ vào sản phẩm
DROP TRIGGER IF EXISTS tb_order_details_insert;
DELIMITER //
CREATE TRIGGER `quantity_prodcut_after_insert`
AFTER INSERT ON `tb_order_details`
FOR EACH ROW
BEGIN
    UPDATE `tb_product`
    SET quantity = quantity - NEW.amount
    WHERE id_product = NEW.id_product;
END //
DELIMITER ; 
