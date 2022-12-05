-- category
INSERT INTO `tb_category` (`id_category`, `title`, `image`, `active`) 
VALUES
('cake', 'Bánh', 'cake.png', 1),
('candy', 'Kẹo', 'candy.png', 1),
('fastfood', 'Đồ chiên', 'fastfood.png', 1),
('fruit', 'Trái Cây', 'fruit.png', 1),
('icecream', 'Kem', 'icecream.png', 1);

-- product
INSERT INTO `tb_product` (`id_product`, `name`, `description`, `price`, `ranking`, `image`, `discount`, `quantity`, `id_category`) VALUES
(1, 'Bánh HotDog', 'Bánh được làm từ xúc xích chiên trong ngọn lửa hồng', '15000', 7, 'hot_dog.png', '15.00', 7, 'cake'),
(2, 'Bắp Rang', 'Bắp luộc rang ngon lành được làm từ những thiết bị tốt nhất', '25000', 8, 'popcorn_bowl.png', '20.00', 7, 'cake'),
(3, 'Bánh Mì Dài', 'Bánh mì cực ngon luôn', '20000', 8, 'yellow_bread.png', '32.00', 5, 'cake'),
(4, 'Bành mì dài', 'Siêu ngon ko cần bàn cài', '30000', 9, 'yellow_french_bread.png', '24.00', 17, 'cake'),
(5, 'Bánh xếp', 'Ngon từng cái luôn ', '40000', 9, 'sliced_bread.png', '15.00', 5, 'cake'),
(6, 'Kẹo Chocolatey Đen', 'Hương vị đậm đà được làm từ 90% cacao', '120000', 7, 'blue_wrapped_chocolate.png', '25.00', 15, 'candy'),
(7, 'Kẹo Chocolatey Vàng', 'Được làm từ sữa không có chất phụ gia', '80000', 8, 'yellow_wrapped_chocolate.png', '15.00', 84, 'candy'),
(8, 'Đùi Gà Chiên', 'Gà giòn chiên cực ngon luôn', '40000', 9, 'chicken_leg.png', '10.00', 84, 'fastfood'),
(9, 'Kem hộp dâu', 'Kem làm từ dâu và sữa được đóng vô hộp', '100000', 8, 'ice_cream_jar_mokup.png', '10.00', 54, 'icecream'),
(10, 'Kem hộp bạc hà', 'Kem hộp là từ sữa và bạc hà cực ngon không thể nào chê được', '50000', 10, 'mint_ice_cream_cup_mokup.png', '10.00', 52, 'icecream'),
(11, 'Cam', 'Cam ngọt từ trong ra ngoài mỗi vỏ là không ăn được', '10000', 6, 'orange_and_half_of_orange.png', '25.00', 54, 'fruit'),
(12, 'Bơ hột', 'Bơ ngon béo bỡ không gì để chê', '15000', 6, 'half_of_avocado.png', '10.00', 66, 'fruit'),
(13, 'Tôm tươi', 'Tôm tươi ngon được bắt từ dưới biển 100%', '10000', 10, 'pink_shrimp.png', '0.00', 15, 'fastfood'),
(14, 'Khoai tây chiên', 'Ngon không gì để chê ăn chung với gà thì hết nước chấm', '25000', 9, 'french_fries.png', '20.00', 16, 'fastfood'),
(15, 'Củ cà rốt', 'carrot tươi sạch 100% không chỗ nào sạch bằng', '5000', 6, 'carrot.png', '0.00', 100, 'fruit'),
(16, 'Bông cải', 'Bông cải ngon làm mát cơ thể khi ăn', '20000', 8, 'cauliflower_white.png', '10.00', 61, 'fruit'),
(17, 'Cá tra chiên', 'Đây là 1 loại món ăn đặc trưng của miền tây', '35000', 8, 'salmon_steak.png', '10.00', 54, 'fastfood'),
(18, 'Cà rốt trắng', 'Ăn chung với cà rốt đỏ thì siêu ngon luôn nha ', '6000', 7, 'daikon_white.png', '15.00', 0, 'fruit'),
(19, 'Quả dâu tây', 'Quả dâu tây rất ngon', '15000', 7, 'strawberry_pink.png', '10.00', 100, 'fruit');


-- user
INSERT INTO `tb_user` (`username`, `fullname`, `email`, `password`, `active`, `phone`, `address`, `province`, `city`, `ward`) VALUES
('kietgolx65234', 'Lê Tuấn Kiệt', 'kietgolx65234@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '0123456789', '3/2 Đại học Cần Thơ', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('Tas la', 'tempuser', 'asd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, NULL, 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user1', 'Nguyễn Văn A', 'user1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '0123456789', 'Hẻm 1, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user10', 'Lê Văn C', 'user10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '9123456789', 'Hẻm 11, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user123', 'Nguyễn Văn A', 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '0123456789', 'Hẻm 10, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user2', 'Nguyễn Văn B', 'user2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '1123456789', 'Hẻm 2, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user3', 'Nguyễn Văn C', 'user3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2123456789', 'Hẻm 3, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user4', 'Nguyễn Văn D', 'user4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '3123456789', 'Hẻm 4, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user5', 'Nguyễn Văn E', 'user5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '4123456789', 'Hẻm 5, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user6', 'Nguyễn Văn F', 'user6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '5123456789', 'Hẻm 6, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user7', 'Nguyễn Văn G', 'user7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '6123456789', 'Hẻm 7, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user8', 'Lê Văn A', 'user8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '7123456789', 'Hẻm 8, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi'),
('user9', 'Lê Văn B', 'user9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '8123456789', 'Hẻm 9, Nguyễn Văn Linh', 'Cần Thơ', 'Quận Ninh Kiều', 'Phường Hưng Lợi');

