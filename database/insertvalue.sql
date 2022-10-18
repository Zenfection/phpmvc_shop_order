-- category
INSERT INTO `tb_category` (`id_category`, `title`, `image`, `active`) 
VALUES
('cake', 'Bánh', 'cake.png', 1),
('candy', 'Kẹo', 'candy.png', 1),
('fastfood', 'Đồ chiên', 'fastfood.png', 1),
('fruit', 'Trái Cây', 'fruit.png', 1),
('icecream', 'Kem', 'icecream.png', 1);

-- product
INSERT INTO `tb_product` (`name`, `description`, `price`, `ranking`, `image`, `discount`, `quantity`, `id_category`) VALUES
('Bánh HotDog', 'Bánh được làm từ xúc xích chiên trong ngọn lửa hồng', 1.8, 7, 'hot dog.png', '15.00', 17, 'cake'),
('Bắp Rang', 'Bắp luộc rang ngon lành được làm từ những thiết bị tốt nhất', 1, 8, 'popcorn bowl.png', '20.00', 13, 'cake'),
('Bánh Mì Dài', 'Bánh mì cực ngon luôn', 2, 8, 'yellow bread.png', '32.00', 10, 'cake'),
('Bành mì dài', 'Siêu ngon ko cần bàn cài', 3, 9, 'yellow french bread.png', '24.00', 20, 'cake'),
('Bánh xếp', 'Ngon từng cái luôn ', 4, 9, 'sliced bread.png', '15.00', 10, 'cake'),
('Kẹo Chocolatey Đen', 'Hương vị đậm đà được làm từ 90% cacao', 12, 7, 'blue wrapped chocolate.png', '25.00', 20, 'candy'),
('Kẹo Chocolatey Vàng', 'Được làm từ sữa không có chất phụ gia', 2, 8, 'yellow wrapped chocolate.png', '15.00', 86, 'candy'),
('Đùi Gà Chiên', 'Gà giòn chiên cực ngon luôn', 2, 9, 'chicken leg.png', '10.00', 87, 'fastfood'),
('Kem hộp dâu', 'Kem làm từ dâu và sữa được đóng vô hộp', 10, 8, 'ice cream jar mokup.png', '10.00', 54, 'icecream'),
('Kem hộp bạc hà', 'Kem hộp là từ sữa và bạc hà cực ngon không thể nào chê được', 3, 10, 'mint ice cream cup mokup.png', '10.00', 53, 'icecream'),
('Cam', 'Cam ngọt từ trong ra ngoài mỗi vỏ là không ăn được', 1, 6, 'orange and half of orange.png', '25.00', 54, 'fruit'),
('Bơ hột', 'Bơ ngon béo bỡ không gì để chê', 0.5, 6, 'half of avocado.png', '10.00', 66, 'fruit'),
('Tôm tươi', 'Tôm tươi ngon được bắt từ dưới biển 100%', 2, 10, 'pink shrimp.png', '0.00', 15, 'fastfood'),
('Khoai tây chiên', 'Ngon không gì để chê ăn chung với gà thì hết nước chấm', 2, 9, 'french fries.png', '20.00', 19, 'fastfood'),
('Củ cà rốt', 'carrot tươi sạch 100% không chỗ nào sạch bằng', 0.8, 6, 'carrot.png', '0.00', 100, 'fruit'),
('Bông cải', 'Bông cải ngon làm mát cơ thể khi ăn', 1.5, 8, 'cauliflower white.png', '10.00', 62, 'fruit'),
('Cá tra chiên', 'Đây là 1 loại món ăn đặc trưng của miền tây', 3, 8, 'salmon steak.png', '10.00', 54, 'fastfood'),
('Cà rốt trắng', 'Ăn chung với cà rốt đỏ thì siêu ngon luôn nha ', 1.2, 7, 'daikon white.png', '15.00', 0, 'fruit'),
('Quả dâu tây', 'Quả dâu tây rất ngon', 2, 7, 'strawberry pink.png', '10.00', 100, 'fruit');


-- user
INSERT INTO `tb_user` (`username`, `fullname`, `email`, `password`, `phone`, `address`) VALUES
('kietgolx65234', 'Lê Tuấn Kiệt', 'kietgolx65234@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', '3/2 Đại học Cần Thơ'),
('Tas la', 'tempuser', 'asd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
('user1', 'Nguyễn Văn A', 'user1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', 'Hẻm 1, Nguyễn Văn Linh'),
('user10', 'Lê Văn C', 'user10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9123456789', 'Hẻm 11, Nguyễn Văn Linh'),
('user123', 'Nguyễn Văn A', 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', 'Hẻm 10, Nguyễn Văn Linh'),
('user2', 'Nguyễn Văn B', 'user2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1123456789', 'Hẻm 2, Nguyễn Văn Linh'),
('user3', 'Nguyễn Văn C', 'user3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2123456789', 'Hẻm 3, Nguyễn Văn Linh'),
('user4', 'Nguyễn Văn D', 'user4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '3123456789', 'Hẻm 4, Nguyễn Văn Linh'),
('user5', 'Nguyễn Văn E', 'user5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '4123456789', 'Hẻm 5, Nguyễn Văn Linh'),
('user6', 'Nguyễn Văn F', 'user6@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '5123456789', 'Hẻm 6, Nguyễn Văn Linh'),
('user7', 'Nguyễn Văn G', 'user7@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6123456789', 'Hẻm 7, Nguyễn Văn Linh'),
('user8', 'Lê Văn A', 'user8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '7123456789', 'Hẻm 8, Nguyễn Văn Linh'),
('user9', 'Lê Văn B', 'user9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8123456789', 'Hẻm 9, Nguyễn Văn Linh');

