-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 09:42 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--
CREATE DATABASE IF NOT EXISTS `cineplex`;
CREATE TABLE IF NOT EXISTS `tbl_bookings` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(30) NOT NULL,
  `t_id` int(11) NOT NULL COMMENT 'theater id',
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `no_seats` int(3) NOT NULL COMMENT 'number of seats',
  `seatno` varchar(200) NOT NULL,
  `amount` int(5) NOT NULL,
  `ticket_date` date NOT NULL,
  `date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`book_id`, `ticket_id`, `t_id`, `user_id`, `show_id`, `screen_id`, `no_seats`, `amount`, `ticket_date`, `date`, `status`) VALUES
(12, 'BKID1415876', 15, 4, 19, 5, 4,'4D,4E,4F,4G',400, '2023-07-12', '2023-07-11', 1),
(14, 'BKID2260051', 16, 4, 21, 7, 4,'6E,6F,6G,6H', 600, '2023-07-18', '2023-07-17', 1),
(15, 'BKID1581951', 15, 4, 20, 6, 4,'9E,9F,9G,9H', 600, '2023-07-19', '2023-07-18', 1),
(16, 'BKID2055363', 15, 4, 20, 6, 3,'6E,6F,6G', 450, '2023-07-22', '2023-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` int(11) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT 'email',
  `password` varchar(50) NOT NULL,
  `user_type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `user_id`, `username`, `password`, `user_type`) VALUES
(1, 0, 'admin', 'password', 0);
(17, 4, 'valarmathi3690@gmail.com', 'd44cf7b4afada752690d524c4156e71e', 2),
(18, 15, 'kasi', 'password', 1),
(19, 16, 'marina', 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

CREATE TABLE IF NOT EXISTS `tbl_movie` (
  `movie_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL COMMENT 'theatre id',
  `movie_name` varchar(100) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `release_date` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0 means active ',
  `lang_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`movie_id`, `t_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `status`) VALUES
(11, 15, 'Thankam', 'Girish,Vineeth,Biju,Aparna', 'The movie portrays their travel to Mumbai to distribute gold and the following mishaps they face at their journey.', '2023-07-14', 'images/thankam.jpg', 'https://youtu.be/FZ1IhRZ8o_Y', 0,2,2),
(12, 15, 'Ponniyin Selvan 2', 'Vikram, Aishwarya Rai Bachchan, Karthi, Trisha', 'Arulmozhi Varman continues on his journey to become Rajaraja I, the greatest ruler of the historic Chola empire of south India.', '2023-04-08', 'images/ps2.jpg', 'https://www.youtube.com/watch?v=EnhS3matIoU', 0, 2, 1),
(13, 15, 'Barbie', 'Margot Robbie ,Ryan Gosling , Ariana Greenblatt , America Ferrera ', 'To live in Barbie Land is to be a perfect being in a perfect place. Unless you have a full-on existential crisis. Or you`re a Ken.', '2023-07-20', 'images/barbie.jfif', 'https://youtu.be/qcGMKd8iego', 0, 1, 5),
(16, 15, 'Love Today', 'Pradeep Ranganathan,Ivana,Yogi Babu,Raveena Ravi', 'While a couple is deeply in love, the girls father challenges the two to switch their phones with each other to test their relationship. Chaos ensues as the lovers secrets are unearthed.', '2022-04-21', 'images/lovetoday.jpg', 'https://www.youtube.com/watch?v=FaQe8JFGdaM', 0 ,2, 3);

-- --------------------------------------------------------
*/
--
-- Table structure for table `tbl_news`
--

CREATE TABLE IF NOT EXISTS `tbl_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cast` varchar(100) NOT NULL,
  `news_date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`news_id`, `name`, `cast`, `news_date`, `description`, `attachment`) VALUES
(3, 'Leo', ' Vijay , Trisha ', '2023-10-19', 'Reported to be a gangster drama 'Leo' will see Vijay as a ruthless gangster, and the pan-Indian drama also has Sanjay Dut, Trisha, Arjun Sarja, Gautham Menon, Priya Anand, Mansoor Ali Khan, Mysskin, Sandy, and Mathew Thomas among others in important roles.', 'images/leo.jfif'),
(5, 'Jailer', ' Rajinikanth , Tamannaah Bhatia ,  Ramya Krishnan ', '2023-08-10', 'Muthuvel Pandian is a strict yet empathetic jailer who sets out to stop a gang from trying to rescue their leader from the prison.', 'images/jailer.jfif'),
(6, 'Maamanan', ' Vadivelu , Fahadh Faasil , Keerthy Suresh , Udhayanidhi Stalin ', '2023-07-29', 'A veteran statesman and his son are pulled into a violent power struggle when a cold-blooded political scion pursues a vengeful rise.', 'images/maamanan.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `name`, `email`, `phone`, `age`, `gender`) VALUES
(4, 'Valar', 'valarmathi3690@gmail.com', '9445729893', 20, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_screens`
--

CREATE TABLE IF NOT EXISTS `tbl_screens` (
  `screen_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) NOT NULL COMMENT 'theatre id',
  `screen_name` varchar(110) NOT NULL,
  `seats` int(11) NOT NULL COMMENT 'number of seats',
  `charge` int(11) NOT NULL,
  PRIMARY KEY (`screen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_screens`
--

INSERT INTO `tbl_screens` (`screen_id`, `t_id`, `screen_name`, `seats`, `charge`) VALUES
(5, 15, 'Screen1', 100, 100),
(6, 15, 'imax', 200, 150),
(7, 16, 'imax', 150, 150);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shows`
--

CREATE TABLE IF NOT EXISTS `tbl_shows` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_id` int(11) NOT NULL COMMENT 'show time id',
  `theatre_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 means show available',
  `r_status` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_shows`
--

INSERT INTO `tbl_shows` (`s_id`, `st_id`, `theatre_id`, `movie_id`, `start_date`, `status`, `r_status`) VALUES
(19, 16, 15, 11, '2023-07-11', 1, 1),
(20, 18, 15, 12, '2023-07-17', 1, 1),
(21, 19, 16, 12, '2023-07-17', 1, 1),
(22, 17, 15, 13, '2023-07-21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_show_time`
--

CREATE TABLE IF NOT EXISTS `tbl_show_time` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT 'noon,second,etc',
  `start_time` time NOT NULL,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_show_time`
--

INSERT INTO `tbl_show_time` (`st_id`, `screen_id`, `name`, `start_time`) VALUES
(1, 1, 'Noon', '10:00:00'),
(2, 1, 'Matinee', '14:00:00'),
(3, 1, 'First', '18:00:00'),
(4, 1, 'Second', '21:00:00'),
(5, 2, 'Noon', '10:00:00'),
(6, 2, 'Matinee', '14:00:00'),
(7, 2, 'First', '18:00:00'),
(8, 2, 'Second', '21:00:00'),
(9, 3, 'Noon', '10:00:00'),
(10, 3, 'Matinee', '14:00:00'),
(11, 3, 'First', '18:00:00'),
(12, 3, 'Second', '21:00:00'),
(14, 4, 'Noon', '12:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theatre`
--

CREATE TABLE IF NOT EXISTS `tbl_theatre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place` varchar(100) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_theatre`
--

INSERT INTO `tbl_theatre` (`id`, `name`, `address`, `place`, `state`, `pin`) VALUES
(15, 'Kasi Theatres', 'Ashok Nagar', 'Chennai', 'TamilNadu', 600065),
(16, 'Marina Mall', 'Padur', 'Chennai', 'TamilNadu', 600878);


CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('1','drama');
INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('2','action');
INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('3','romance');
INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('4','anime');
INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('5','comedy');
INSERT INTO `genre`(`genre_id`, `genre`) VALUES ('6','animation');


CREATE TABLE IF NOT EXISTS `lang` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(50) NOT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
INSERT INTO `lang`(`lang_id`, `lang`) VALUES ('1','english');
INSERT INTO `lang`(`lang_id`, `lang`) VALUES ('2','tamil');
INSERT INTO `lang`(`lang_id`, `lang`) VALUES ('3','hindi');
INSERT INTO `lang`(`lang_id`, `lang`) VALUES ('4','malayalam');

CREATE TABLE IF NOT EXISTS `reviews` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`page_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`content` text NOT NULL,
	`rating` tinyint(1) NOT NULL,
	`submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
