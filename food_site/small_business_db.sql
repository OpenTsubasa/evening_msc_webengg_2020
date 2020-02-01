-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 11:30 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `small_business_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_text` text NOT NULL,
  `announcement_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_text`, `announcement_date`) VALUES
(3, 'We now have a YELP BIZ at http://www.yelp.com/biz/astor-mediterranean-arlington', '2014-04-27'),
(4, 'We now have a Facebook Page at https://www.facebook.com/pages/Astor-Mediterranean/106931009369809', '2014-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'appetizers'),
(2, 'sandwiches'),
(3, 'grill'),
(4, 'salads'),
(5, 'sides'),
(6, 'vegetarian'),
(7, 'pizza'),
(8, 'desserts'),
(9, 'beer-wine'),
(10, 'beverages');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_description`, `category_id`) VALUES
(1, 'Hummus', '4.50', 'The classic mix of chick peas, tahini, garlic, lemon juice, & olive oil served with pita.', 1),
(12, 'Baba Ghanooj', '4.95', 'Baked eggplant, tahini, garlic, & spices topped with olive oil served with pita bread.', 1),
(13, 'Eggplant', '4.95', 'Baked eggplant with tomato, garlic sauce & olive oil with pita.', 1),
(14, 'Fava Bean Dip', '4.50', 'Fava bean, tahini, garlic, lemon, & olive oil served with pita.', 1),
(15, 'Spinach Pie', '4.25', 'Sauteed spinach, garlic, onion, & feta baked in puff pastry.', 1),
(16, 'Stuffed Grape Leaves', '4.50', 'Vine leaves stuffed with rice & fresh herbs.', 1),
(17, 'Tabouli', '4.50', 'Bulgar wheat, parsley, tomato, onion, lemon juice, & olive oil.', 1),
(18, 'Egyptian Salad', '4.50', 'Tomato, cucumber, red onion, & cilantro with olive oil & fresh herbs.', 1),
(19, 'Lentil Salad', '4.50', 'Lentils served with onion, carrot, celery, cilantro & olive oil.', 1),
(20, 'Chick Pea Salad', '4.50', 'Chick peas served with onion, carrot, celery, cilantro, & olive oil.', 1),
(21, 'Fresh Beet Salad', '4.50', 'Fresh beets, celery, carrot, herbs, olive oil, & vinegar.', 1),
(22, 'Gyro', '6.50', 'Seasoned lamb with tzatsiki, feta, tomato, cucumber, red onion & cilantro served in a pita.', 2),
(23, 'Mediterranean Chicken', '6.50', 'Marinated chicken with tzatsiki, feta, tomato, cucumber, red onion, & cilantro served in a pita.', 2),
(24, 'Grilled Chicken Veggie Wrap', '6.50', 'Marinated chicken breast, grilled mushroom, bell pepper, onion, lettuce, tomato, provolone,& mayo served in a pita.', 2),
(25, 'Kufta', '6.50', 'Ground sirloin & seasoned lamb with tzatsiki, feta, tahini, tomato, cucumber, red onion, & cilantro served in a pita.', 2),
(26, 'Beef Souvlaki', '6.50', 'Marinated beef sirloin with tzatsiki, feta, tahini, tomato, cucumber, red onion, & cilantro served in a pita.', 2),
(27, 'Astor Burger', '4.50', 'Fresh mixture of ground sirloin mixed with spices served on a kaiser roll with lettuce, tomato, feta, & tzatsiki.', 2),
(28, 'Steak & Cheese Wrap', '6.50', 'Grilled steak, provolone, mushroom, bell peppers, onion, lettuce, tomato, & mayo served in a pita.', 2),
(29, 'Steak & Cheese Panini', '6.65', 'Grilled rib eye steak, grilled onion, mayo, & provolone cheese pressed in hot Italian bread.', 2),
(30, 'Chicken & Cheese Panini', '6.65', 'Grilled chicken breast, grilled onion, mayo, & provolone cheese pressed in hot Italian bread.', 2),
(31, 'Eggplant Parmesan Panini', '6.65', 'Eggplant sauteed in tomato sauce & fresh garlic, topped with mozzarella & parmesan cheese pressed in hot Italian bread.', 2),
(32, 'Chicken Kabob', '9.95', 'A full skewer of chicken breast cubes with grilled mixed vegetables. Served with rice and Egyptian salad.', 3),
(33, 'Beef Kabob', '9.95', 'A full skewer of sirloin cubes with grilled mixed vegetables. Served with rice and Egyptian salad.', 3),
(34, 'Lamb Kabob', '11.95', 'Leg of lamb cubes skewered with grilled mixed vegetables. Served with rice and Egyptian salad.', 3),
(35, 'Kufta Kabob', '9.95', 'A full skewer of seasoned ground sirloin & lamb with grilled mixed vegetables. Served with rice and Egyptian salad.', 3),
(36, 'Mixed Kabob', '13.95', 'A full skewer of beef, chicken, lamb, & kufta with grilled mixed vegetables. Served with rice and Egyptian salad.', 3),
(37, 'Quarter Chicken', '7.50', 'Leg or breast of chicken served with your choice of 2 sides – steamed vegetables, rice, potatoes, or spicy chick peas.', 3),
(38, 'Half Chicken', '9.95', 'Leg and breast of chicken served with your choice of 2 sides – steamed vegetables, rice, potatoes, or spicy chick peas.', 3),
(39, 'Lamb Shank', '13.95', 'Leg of lamb served with your choice of 2 sides – steamed vegetables, rice, potatoes, or spicy chick peas.', 3),
(40, 'Prime Ribeye Steak', '13.95', '12 oz prime ribeye steak served with your choice of 2 sides – steamed vegetables, rice, potatoes, or spicy chick peas.', 3),
(41, 'Salmon', '13.95', '8 oz. fresh salmon fillet served with syour choice of 2 sides – steamed vegetables, rice, potatoes, or spicy chick peas.', 3),
(42, 'Garden Salad', '5.95', 'Romaine, mixed greens, red cabbage, carrot, cucumber, & tomato.', 4),
(43, 'Greek Salad', '6.95', 'Romaine, mixed greens, red cabbage, carrot, cucumber, tomato, feta, kalamata olives, grape leaves, & pepperocini.', 4),
(44, 'Greek Salad w/Grill Item', '6.95', 'Greek salad with your choice of grill item.', 4),
(45, 'Homemade Soup', '4.50', 'Bowl of lentil or the soup of the day.', 5),
(46, 'Steamed Vegetables', '3.95', 'Daily vegetable medley.', 5),
(47, 'Side of Rice', '3.00', 'Two scoops of steamed white rice.', 5),
(48, 'Pita', '0.91', 'Hot, pocket bread.', 5),
(49, 'French Fries', '1.95', 'Basket of crispy thin-cut fries.', 5),
(50, 'Spicy Chick Peas', '4.50', 'Hot chick peas in our spicy, curry sauce.', 5),
(51, 'Spicy Chick Peas & Rice', '5.95', 'Hot curried, chick peas served over rice.', 5),
(52, 'Astor Vegetarian', '9.95', 'A healthy sampling of hummus, baba ghanooj, eggplant, fava bean dip, spinach pie, stuffed grape leaves, tabouli, Egyptian salad, lentil salad, chick pea salad, fresh beet salad, & falafel with pita bread.', 6),
(53, 'Eggplant Wrap', '6.50', 'Eggplant sauteed in tomato sauce & fresh garlic, with lettuce, tomato, & cucumber salad served in a pita.', 6),
(54, 'Falafel Platter', '7.95', 'A fresh mixture of chick peas, vegetables, & Mediterranean spices deep-fried in peanut oil and served with hummus, pita bread, tahini, & Egyptian salad.', 6),
(55, 'Falafel Sandwich', '6.25', 'A fresh mixture of chick peas, vegetables, & Mediterranean spices deepfried in peanut oil and served with tzatsiki, tahini, tomato, cucumber, red onion, & cilantro in a pita.', 6),
(56, 'Pepperoni', '11.95', 'A classic taste, pepperoni, tomato sauce, & whole milk mozzarella on our square-cut crust.', 7),
(57, 'Sausage & Peppers', '17.00', 'Kufta sausage, jalapeno pepper, mushroom, onion, tomato sauce, & mozzarella on our square-cut crust.', 7),
(58, 'Mediterranean', '17.00', 'Grilled chicken, kalamata olives, pepperocini, green pepper, tomato sauce, mozzarella, & feta on our square-cut crust.', 7),
(59, 'Greek', '17.00', 'Gyro, spinach, kalamata olives, pepperocini, fresh garlic, fresh tomatoes, tomato sauce, mozzarella, & feta on our square-cut crust.', 7),
(60, 'Egyptian', '17.00', 'Eggplant, green pepper, garlic, jalapeno pepper, fresh tomatoes, tomato sauce, mozzarella, & feta on our square-cut crust.', 7),
(61, 'Veggie', '17.00', 'Spinach, eggplant, fresh garlic, green pepper, mushrooms, kalamata olives, fresh tomatoes, tomato sauce, & mozzarella, on our squarecut crust.', 7),
(62, 'White', '17.00', 'Olive oil, basil, parmesan, fresh tomatoes, fresh garlic, & mozzarella on our square-cut crust.', 7),
(63, 'Regular', '10.95', 'Tomato sauce and whole-milk mozzarella on our square-cut crust. Customize by adding extra toppings to create a delicious treat.', 7),
(64, 'Extra Topping (Each)', '1.50', 'Pepperoni, kufta sausage, chicken, gyro, green pepper, red pepper, jalapeno peppers, pepperocini, mushrooms, kalamata olives, onion, fresh tomato, fresh garlic, spinach, eggplant, soy cheese and feta.', 7),
(65, 'Baklava', '3.50', 'A rich, sweet pastry made of layers of phyllo dough filled with chopped walnuts, sliced almonds, & sweetened with honey.', 8),
(66, 'Rice Pudding', '3.50', 'The classic dessert spiced with cinnamon, coconut, & topped with California raisins.', 8),
(67, 'Imported Beers', '4.25', 'Bottles of Amstellight, Blue Moon Ale, Corona Extra, Heineken, or Sam Adams Boston Lager (yes, we know imported from Boston). Dine-In only.', 9),
(68, 'Domestic Beers', '0.35', 'Bottles of Miller Light or Yuengling Lager. Dine-in only.', 9),
(69, 'Chardonnay', '6.00', 'Kendall Jackson by the glass.', 9),
(70, 'Merlot', '5.50', 'Yellow tail by the glass.', 9),
(71, 'Cabernet Sauvignon', '6.00', 'Woodbridge by the glass.', 9),
(72, 'Soda', '1.75', 'We carry Coca-Cola® products.', 10),
(73, 'Bottled Water', '1.75', 'We carry Deer Park® products.', 10),
(74, 'Bottled Julces & Drinks', '2.25', 'No description available.', 10),
(75, 'Coffee', '1.75', 'No description available.', 10),
(76, 'Espresso', '2.50', 'No description available.', 10),
(77, 'Organic Hot Tea', '1.75', 'No description available.', 10),
(78, 'Cappucino or Latte', '3.00', 'No description available.', 10);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `mailing_address` text NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `first_name`, `last_name`, `mailing_address`, `email_address`, `category_id`, `user_id`) VALUES
(6, 'Windows 8', 'Blue', 'Micro Earth', 'micro@soft.com', 3, 6),
(7, 'Unknown', 'Unknown', 'Unknown', 'example@domain.com', 0, 7),
(8, 'Maxwell', 'The Great', 'AAustrailia', 'max@well.com', 6, 8),
(9, 'Messi', 'Leo', 'Barselona', 'messi@leo.com', 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_password`) VALUES
(6, 'microsoft', '5f532a3fc4f1ea403f37070f59a7a53a'),
(7, 'google', 'c822c1b63853ed273b89687ac505f9fa'),
(8, 'cricket', '247184f5fcf8c0afea1291676dc6df8f'),
(9, 'football', '37b4e2d82900d5e94b8da524fbeb33c0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
