-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Июн 23 2018 г., 02:28
-- Версия сервера: 5.6.39-cll-lve
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ecommerce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`user_id`, `user_email`, `user_pass`) VALUES
(1, 'petrushen@yahoo.com', 'secretpwd'),
(2, 'google@goo.com', 'secretpwd');

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(100) NOT NULL AUTO_INCREMENT,
  `brand_title` text NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(2, 'DELL'),
(3, 'LG'),
(4, 'Samsung'),
(5, 'Cannon'),
(6, 'HTC'),
(7, 'Sony'),
(8, 'Philips'),
(9, 'Apple'),
(10, 'Toshiba'),
(11, 'HP');

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `p_id` int(10) NOT NULL DEFAULT '1',
  `ip_add` varchar(255) NOT NULL DEFAULT '1',
  `qty` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`p_id`, `ip_add`, `qty`) VALUES
(19, '86.57.145.38', 1),
(24, '86.57.145.38', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(100) NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptops'),
(2, 'Cameras'),
(3, 'Mobiles'),
(4, 'Computers'),
(5, 'iPads'),
(6, 'iPhones'),
(8, 'Tablets'),
(9, 'TVs');

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(5, '93.85.139.72', 'Ihar', 'petrushen@yahoo.com', 'secretpwd', 'United States', 'Los Angeles', '457687', 'Beverly Hills', 'funny-332.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(100) NOT NULL AUTO_INCREMENT,
  `p_id` int(100) NOT NULL,
  `c_id` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `invoice_no` int(100) NOT NULL,
  `status` text NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `p_id`, `c_id`, `qty`, `invoice_no`, `status`, `order_date`) VALUES
(10, 19, 4, 2, 1406502962, 'In progress', '2017-12-22'),
(9, 19, 4, 1, 255166307, 'Completed', '2017-12-22'),
(11, 19, 4, 2, 1100732851, 'In progress', '2017-12-22'),
(12, 18, 4, 2, 46810970, 'In progress', '2017-12-22'),
(13, 24, 0, 1, 106323705, 'In progress', '2017-12-30'),
(14, 24, 0, 1, 378642685, 'In progress', '2017-12-30'),
(15, 24, 0, 1, 457737176, 'In progress', '2017-12-30'),
(16, 24, 0, 1, 2095536799, 'In progress', '2017-12-30'),
(17, 24, 5, 1, 561387225, 'In progress', '2017-12-30'),
(18, 19, 5, 1, 1266498453, 'In progress', '2017-12-31'),
(19, 19, 5, 1, 28804172, 'In progress', '2017-12-31');

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(100) NOT NULL AUTO_INCREMENT,
  `amount` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `currency` text NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`payment_id`, `amount`, `customer_id`, `product_id`, `trx_id`, `currency`, `payment_date`) VALUES
(13, 6, 0, 24, '5KS34612VB133305E', 'USD', '2017-12-30 19:06:01'),
(12, 16, 4, 18, '9N038614RR0430026', 'USD', '2017-12-22 21:46:45'),
(11, 8, 4, 19, '34F2801273779445P', 'USD', '2017-12-22 21:31:20'),
(10, 8, 4, 19, '74G00696N75359847', 'USD', '2017-12-22 16:49:57'),
(9, 4, 4, 19, '66J59871EP7603219', 'USD', '2017-12-22 16:39:56'),
(14, 6, 0, 24, '5KS34612VB133305E', 'USD', '2017-12-30 19:06:12'),
(15, 6, 0, 24, '5KS34612VB133305E', 'USD', '2017-12-30 19:16:21'),
(16, 6, 0, 24, '5KS34612VB133305E', 'USD', '2017-12-30 19:20:48'),
(17, 6, 5, 24, '4JD84146CG614094S', 'USD', '2017-12-30 19:24:37'),
(18, 4, 5, 19, '5HW49019YN5743942', 'USD', '2017-12-31 12:34:27'),
(19, 4, 5, 19, '55J59801LG755902K', 'USD', '2017-12-31 13:11:25');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(100) NOT NULL AUTO_INCREMENT,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(16, 2, 5, 'Camera Cannon ', 12000, '<p>Camera Cannon</p>', 'Canon-EOS-Rebel-T3i.jpg', 'camera, cannon, best'),
(17, 1, 2, 'Dell XPS', 1800, '<p>Dell XPS</p>', '1.jpg', 'laptop, dell, best price'),
(18, 3, 6, 'HTC Google ', 2000, '<p>HTC Google</p>', 'HTC-Google-Nexus-One-2.jpg', 'technologies, smartphone, phone, htc, nexus'),
(19, 8, 4, 'Samsung Tab', 2000, '<p>Samsung Tab</p>', 'Samsung-Galaxy-Tab-tablet.jpg', 'tablet, samsung, price, quality'),
(24, 1, 11, 'hp', 1600, '<p>hp</p>', 'original.jpg', 'guyhiu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
