-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 10:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scsstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(11) NOT NULL,
  `car_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `availability_code` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `date_issued` date NOT NULL,
  `order_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `trip_id`, `date_issued`, `order_date`, `total_price`, `payment_code`) VALUES
(11, 12, NULL, '2022-04-12', '2022-04-14', '1000.00', NULL),
(12, 13, NULL, '2022-04-12', '2022-04-13', '1000.00', NULL),
(13, 12, NULL, '2022-04-12', '2022-04-14', '1329.00', NULL),
(14, 13, NULL, '2022-04-12', '2022-04-13', '329.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `quantity`, `unit_price`, `image`, `description`, `type`) VALUES
(1, 'iPhone 11', 1000, '679.00', 'https://s.yimg.com/uu/api/res/1.2/LZSIFcS0YHQig1hG66WVLA--~B/aD0xMjU5O3c9MjAwMDthcHBpZD15dGFjaHlvbg--/https://s.yimg.com/uu/api/res/1.2/wKtNq2jo_Qww2GqS5OfbnA--~B/aD0xMjU5O3c9MjAwMDthcHBpZD15dGFjaHlvbg--/https://o.aolcdn.com/hss/storage/midas/be8deaf69ebb2e866257646588bb5999/206681111/IPHONE.jpg.cf.jpg', 'The iPhone 11 offers more features like a larger screen, longer battery life and a dual-camera with wide and ultra-wide lenses. If it fits your budget, this may be your best option for an affordable iPhone.', 'Phones'),
(2, 'AirPods Pro', 1000, '329.00', 'https://cdn.road.cc/sites/default/files/styles/main_width/public/2021-apple-airpods-pro.jpg', 'AirPods Pro have been designed to deliver Active Noise Cancellation for immersive sound, Transparency mode so you can hear your surroundings and a customisable fit for all-day comfort. ', 'Accessories'),
(3, 'Samsung Galaxy S22', 1000, '1000.00', 'https://cdn.dxomark.com/wp-content/uploads/medias/post-107405/Samsung-Galaxy-S22-Ultra-featured-image-packshot-review-Recovered.jpg', 'The Galaxy S22 series has a design similar to preceding S series phones, with an Infinity-O display containing a circular cutout in the top center for the front selfie camera. ', 'Phones'),
(4, 'Beats Studio3 Wireless Headphones', 1000, '345.00', 'https://cdn.vox-cdn.com/thumbor/SGcsHOFjfXOOyBX2ZqXAYbUaBZk=/0x0:1536x1152/1200x800/filters:focal(646x454:890x698)/cdn.vox-cdn.com/uploads/chorus_image/image/56508813/Image_11.0.jpg', 'The Beats Studio3 Wireless headphone is designed for long-term comfort to match its impressive battery life of up to 22 hours for all-day play. The soft over-ear cushions feature advanced venting.', 'Accessories'),
(5, 'MacBook Air', 1000, '1299.00', 'https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/macbook-air-space-gray-config-201810?wid=1078&hei=624&fmt=jpeg&qlt=80&.v=1633033424000', 'The thinnest, lightest notebook, completely transformed by the Apple M1 chip. CPU speeds up to 3.5x faster. GPU speeds up to 5x faster. The longest battery life ever in a MacBook Air.  ', 'Laptops'),
(6, 'iPad mini', 1000, '649.00', 'https://images.macrumors.com/article-new/2013/09/ipad-mini-6-lineup.jpg', 'The size and power of iPad mini make it indispensable for a wide range of uses, like conducting aircraft safety checks and streaming a workout. The magic of iPad in the palm of your hand.', 'Tablets'),
(7, 'Nikon Z6 II', 1000, '2699.99', 'https://cdn.mos.cms.futurecdn.net/JN4id4eQ79r4c4JzHVNtH5-1200-80.jpg', 'Enjoy extreme versatility and high-speed performance with the Nikon Z 6II FX mirrorless camera (body only). It has 2 card slots that help you separate still shots and videos, create backups, or expand your storage capacity.', 'Accessories'),
(8, 'Google Pixel 6', 0, '799.00', 'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Google_Pixel_6__Portfolio_Shot_345IXG4.max-1000x1000.jpg', 'These new phones redefine what it means to be a Pixel. From the new design that combines the same beautiful aesthetic across software and hardware with Android 12, to the new Tensor SoC, everything about using the Pixel is better. ', 'Phones'),
(9, 'Dell XPS 15', 1000, '2499.99', 'https://icdn.digitaltrends.com/image/digitaltrends/dell-xps-15-2020-gaming.jpg', 'Dell XPS 15 is a Windows 10 Professional laptop with a 15.60-inch display that has a resolution of 1920x1080 pixels. The Dell XPS 15 packs 256GB of SSD storage. Graphics are powered by Nvidia GeForce GTX 1050 Ti.', 'Laptops'),
(10, 'Amazon Kindle Paperwhite', 1000, '149.99', 'https://s.hdnux.com/photos/01/23/03/65/21773674/3/ratio3x2_1800.jpg', 'Now with a 6.8” display and thinner borders, adjustable warm light, up to 10 weeks of battery life, and 20% faster page turns. Purpose-built for reading – With a flush-front design and 300 ppi glare-free display that reads like real paper.', 'Tablets'),
(11, 'Microsoft Surface Pro 7', 1000, '1239.00', 'https://m.media-amazon.com/images/I/714cHoaDUpL._AC_SL1500_.jpg', 'Next-gen, best-in-class laptop with the versatility of a studio and tablet, so you can type, touch, draw, write, work, and play more naturally. Faster than surface pro 6, with a 10th gen intel core processor.', 'Laptops'),
(12, 'iPad Pro', 1000, '999.00', 'https://www.apple.com/newsroom/images/tile-images/Apple_new-ipad-pro_03182020.jpg.landing-big_2x.jpg', 'Now with the A12Z Bionic chip, iPad Pro is faster and more powerful than most Windows PC laptops. The new iPad Pro adds an Ultra Wide camera, studio-quality mics, a breakthrough LiDAR Scanner, along with pro cameras.', 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productorder`
--

INSERT INTO `productorder` (`product_id`, `order_id`) VALUES
(2, 13),
(2, 14),
(3, 11),
(3, 12),
(3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `text` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `product_id`, `text`, `stars`) VALUES
(1, 1, 'The iPhone 11 delivers superb cameras, fast performance and excellent battery life, making it the iPhone to buy for many people, especially after Apple cut the price once again.', 4),
(2, 2, 'If you are an iPhone user and have been toying with the idea of going true wireless with your earbuds, then the Apple AirPods Pro are a great choice. The new noise-cancelling feature is neat and useful, and the overall improvements to sound and design could not be more welcome – though, they are quite pricey.', 5),
(3, 1, 'The iPhone 11 - the successor to the iPhone XR - has gone from secondary handset to firmly taking the limelight. Offering most of the top-end camera technology of the powerful iPhone 11 Pro, it packs good spec and manages to do so for a lower cost than many would expect - this is the one to go for if you want a good value new iPhone.', 5),
(9, 4, 'The Beats by Dre Studio3 Wireless is a great gadget, but was hard to justify for the original $345 price tag. ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `source_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `tel_no`, `email`, `address`, `city_code`, `login_id`, `password_hash`, `salt`, `balance`) VALUES
(12, 'Mike James', '416-111-1112', 'DSDDSSD@gmail.com', '55 Bay Street', 'TO', NULL, '44e23312686986fb9b4ae258f08ad50c', 'Yq07z7KHL4rwFblgMsQd', NULL),
(13, 'Admin', '416-000-0000', 'admin@gmail.com', '5 Street East', 'TO', NULL, 'fb3e41164b2733880f36dbb7a2d78794', 'fcSXQzEkH7iBmHsG3c1Q', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders-user-id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD PRIMARY KEY (`product_id`,`order_id`) USING BTREE,
  ADD KEY `productorder_order_id` (`order_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_product_id` (`product_id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`trip_id`),
  ADD KEY `trip_car_id` (`car_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `productorder_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productorder_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_car_id` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
