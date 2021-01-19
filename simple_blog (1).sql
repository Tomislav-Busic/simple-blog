-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2021 at 04:28 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'tomislav.busic89@gmail.com', '5f2e71fe6aa946eb48860385620fe18a'),
(2, 'sicbu95@gmail.com', '1c480d5c5c9ed2144dc0538733cf9aad');

-- --------------------------------------------------------

--
-- Table structure for table `blog_entry`
--

DROP TABLE IF EXISTS `blog_entry`;
CREATE TABLE IF NOT EXISTS `blog_entry` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `entry_text` text,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog_entry`
--

INSERT INTO `blog_entry` (`entry_id`, `title`, `entry_text`, `date_created`) VALUES
(10, 'Novi naslov ', '<p><img src=\"http://vikendplaner.info/universalis/7115/slika/najlepse-slike-macaka-0-1_357827102.jpg\" alt=\"macak\" width=\"730\" height=\"506\" />But if you change the entry a bit more, the message will still insist that Entry was saved, even though you and I know it is misleading. Changes are not saved until you click the Save button. That is bad usability! Misleading feedback from a system can be even worse than no feedback at all. How can you remedy the problem? Is this a task that calls for PHP or JavaScript? Take a minute to reflect before you read on. It is a task that absolutely requires JavaScript! PHP is a server-side scripting language. It runs once every time a PHP script on the server is contacted. PHP runs once for every HTTP request, if the request looks for a PHP resource. Your entry editor is simply an HTML form with a <textarea> element enhanced with a bit of JavaScript and CSS. PHP will only run whenever you submit the form. Typing a few characters into the <textarea> will not submit the form. JavaScript is a client-side scripting language. It runs perfectly well in the browser. You have already seen how JavaScript functions can be called when certain browser events occur. So far, you have learned how JavaScript functions can be called when the HTML DOM content is loaded into the browser, when a user clicks, and when a form is submitted. JavaScript can also respond whenever a user presses a key on the keyboard. You can use that event here. If a user presses a key while the <input name=\'title\'> is in focus, you know that the title was changed. If the title was changed, and the form has not been submitted, you know that changes were not saved in the database yet. Open your editor.js JavaScript file and declare a new function for updating the update message. While youâ€™re at it, add an event listener, to call the new function every time the user changes the title, as follows: <img src=\"http://azdan.com.sa/images/portfolio/956068.jpg\" alt=\"Proba2\" width=\"3508\" height=\"2480\" /></p>', '2021-01-17 13:23:48'),
(9, 'JoÅ¡ jedan bloger ', '<p>With all your images listed, it should be an uncomplicated task to embed an image in one of your blog entries. Find an image you would like use by looking though all your images, at http://localhost/blog/admin.php?page=images. Note how the Source of each image is displayed in your browser. Select and copy the Source of some image you would like to use in a blog post. Now, load an existing blog entry into your blog editor. Note how TinyMCE provides a button for inserting images. Click the Image button, to bring up TinyMCEâ€™s image dialog pop-up, as shown in Figure 11-2. Embed the image by pasting the image src into the Source field.<img src=\"http://azdan.com.sa/images/portfolio/858120.jpg\" alt=\"Proba\" width=\"1500\" height=\"1539\" /></p>', '2021-01-17 13:21:45'),
(11, 'Najnoviji naslov', '<p>The updateEditorMessage() function doesn&rsquo;t do anything meaningful yet. It simply outputs a message to the console. But you can use it, to test your progress. Open your browser and its JavaScript console. If you&rsquo;re using Chrome, you can open the console with Cmd+Alt+J, if you are working on a Mac, or Ctrl+Alt+J, if you are using a Windows machine. Once the browser&rsquo;s JavaScript console is open, you can navigate your browser to http://localhost/blog/ admin.php?page=entries. Click an entry to load it in your blog entry editor. Edit the entry a little and save changes. Note the usual Entry was saved message created by PHP. Now, make a little change in the entry title, and note the output in your console: JavaScript noticed that something happened. Note also that the Entry was saved message has now become misleading (see Figure 11-3): The most recent changes in the entry were not saved!</p>', '2021-01-17 13:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `entry_id` int(11) NOT NULL,
  `author` varchar(75) DEFAULT NULL,
  `txt` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `entry_id` (`entry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `entry_id`, `author`, `txt`, `date`) VALUES
(19, 9, 'tomo', 'Komentar', '2021-01-19 16:23:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
