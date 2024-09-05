-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2024 at 07:07 AM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoptome_selfdrive-yc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admins', 'skg.otp2@gmail.com', 'selfdrivezone', NULL, '665db9865182a1717418374.png', '$2y$10$cglnflBzKr1qBsFiv8oCeOaar55Wif8F9UAEC7ME7mGzZqpPU.o1C', 'B3ANziwrLenQx1jaGhOOtNxjTkUvJ7ASkzSG0lhcXSPiWSdPs3i5mNaPr1xw', NULL, '2024-06-03 06:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `click_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `user_id`, `title`, `is_read`, `click_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'New member registered', 0, '/admin/users/detail/1', '2024-08-23 13:58:02', '2024-08-23 13:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mahindra Thar', 1, '2024-08-23 13:50:13', '2024-08-23 13:50:13'),
(2, 'WagonR', 1, '2024-08-23 13:50:30', '2024-08-23 13:50:30'),
(3, 'Verna', 1, '2024-08-23 13:50:39', '2024-08-23 13:50:39'),
(4, 'Venue', 1, '2024-08-23 13:51:05', '2024-08-23 13:51:05'),
(5, 'Seltos', 1, '2024-08-23 13:51:13', '2024-08-23 13:51:13'),
(6, 'Nios i10', 1, '2024-08-23 13:51:23', '2024-08-23 13:51:23'),
(7, 'Swift', 1, '2024-08-23 13:51:47', '2024-08-23 13:51:47'),
(8, 'Fronx', 1, '2024-08-23 13:51:58', '2024-08-23 13:51:58'),
(9, 'Ciaz', 1, '2024-08-23 13:52:07', '2024-08-23 13:52:07'),
(10, 'Baleno', 1, '2024-08-23 13:52:19', '2024-08-23 13:52:19'),
(11, 'Altroz', 1, '2024-08-23 13:52:29', '2024-08-23 13:52:29'),
(12, 'XUV 500', 1, '2024-08-23 13:52:44', '2024-08-23 13:52:44'),
(13, 'Maruti Alto 800', 1, '2024-08-23 13:52:55', '2024-08-23 13:52:55'),
(14, 'XUV 700', 1, '2024-08-23 13:54:02', '2024-08-23 13:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rent_id` int(11) NOT NULL DEFAULT 0,
  `method_code` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `method_currency` varchar(40) DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `final_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `detail` text DEFAULT NULL,
  `btc_amount` varchar(255) DEFAULT NULL,
  `btc_wallet` varchar(255) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `payment_try` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `script` text DEFAULT NULL,
  `shortcode` text DEFAULT NULL COMMENT 'object',
  `support` text DEFAULT NULL COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, '2019-10-18 23:16:05', '2022-03-22 05:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, '2019-10-18 23:16:05', '2024-06-03 23:10:43'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, '2019-10-18 23:16:05', '2024-06-03 06:45:03'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{app_key}}\"></script>\r\n                <script>\r\n                  window.dataLayer = window.dataLayer || [];\r\n                  function gtag(){dataLayer.push(arguments);}\r\n                  gtag(\"js\", new Date());\r\n                \r\n                  gtag(\"config\", \"{{app_key}}\");\r\n                </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, '2021-05-04 10:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.PNG', 0, NULL, '2022-03-22 05:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `form_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `act`, `form_data`, `created_at`, `updated_at`) VALUES
(1, 'kyc', '{\"full_name\":{\"name\":\"Full Name\",\"label\":\"full_name\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"text\"},\"address\":{\"name\":\"Address\",\"label\":\"address\",\"is_required\":\"required\",\"extensions\":\"\",\"options\":[],\"type\":\"textarea\"},\"aadhar_card\":{\"name\":\"Aadhar Card\",\"label\":\"aadhar_card\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png,pdf\",\"options\":[],\"type\":\"file\"},\"driving_license\":{\"name\":\"Driving License\",\"label\":\"driving_license\",\"is_required\":\"required\",\"extensions\":\"jpg,jpeg,png,pdf\",\"options\":[],\"type\":\"file\"}}', '2024-08-23 16:49:16', '2024-08-23 16:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_keys` varchar(40) DEFAULT NULL,
  `data_values` longtext DEFAULT NULL,
  `tempname` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `tempname`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"vehicle\",\"rental\",\"platform\",\"car\",\"car rent\",\"bike\",\"truck\"],\"description\":\"Discover top-notch rentals tailored to your needs on the Vehicle Rental Platform. Start your search now and experience hassle-free leasing like never before!\",\"social_title\":\"Self Drive Zone - Self Drive Car Rentals in Cuttack Bhubaneswar\",\"social_description\":\"Discover top-notch rentals tailored to your needs on the Vehicle Rental Platform. Start your search now and experience hassle-free leasing like never before!\",\"image\":\"665dbac405f121717418692.png\"}', NULL, '2020-07-04 23:42:52', '2024-08-17 21:50:19'),
(41, 'cookie.data', '{\"short_desc\":\"We may use cookies or any other tracking technologies when you visit our website, including any other media form, mobile website, or mobile application related or connected to help customize the Site and improve your experience.\",\"description\":\"<div><h5>What information do we collect?<\\/h5><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br><\\/p><\\/div><div><h5>How do we protect your information?<\\/h5><p>All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br><\\/p><\\/div><div><h5>Do we disclose any information to outside parties?<\\/h5><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><p><br><\\/p><\\/div><div><h5>Children\'s Online Privacy Protection Act Compliance<\\/h5><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br><\\/p><\\/div><div><h5>Changes to our Privacy Policy<\\/h5><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br><\\/p><\\/div><div><h5>How long we retain your information?<\\/h5><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br><\\/p><\\/div><div><h5>What we don\\u2019t do with your data<\\/h5><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', NULL, '2020-07-04 23:42:52', '2024-05-31 23:27:40'),
(44, 'maintenance.data', '{\"description\":\"<div class=\\\"mb-5\\\" style=\\\"color: rgb(111, 111, 111); font-family: Nunito, sans-serif; margin-bottom: 3rem !important;\\\"><h3 class=\\\"mb-3\\\" style=\\\"text-align: center; font-weight: 600; line-height: 1.3; font-size: 24px; font-family: Exo, sans-serif; color: rgb(54, 54, 54);\\\">What information do we collect?<\\/h3><p class=\\\"font-18\\\" style=\\\"text-align: center; margin-right: 0px; margin-left: 0px; font-size: 18px !important;\\\">We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><\\/div>\"}', NULL, '2020-07-04 23:42:52', '2022-05-11 03:57:17'),
(45, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', 'basic', '2024-03-25 02:35:42', '2024-03-25 03:13:41'),
(46, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/www.twitter.com\\/\"}', 'basic', '2024-03-25 02:35:59', '2024-03-25 03:13:57'),
(47, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', 'basic', '2024-03-25 02:36:17', '2024-03-25 03:14:16'),
(48, 'footer.content', '{\"has_image\":\"1\",\"description\":\"Explore our platform for hassle-free vehicle rentals. Book your ride easily and embark on unforgettable journeys with confidence.\",\"subscribe_title\":\"Subscribe\",\"subscribe_subtitle\":\"Subscribe to our mailing list for the latest updates!\",\"image\":\"660139ae97f2a1711356334.png\"}', 'basic', '2024-03-25 02:45:34', '2024-03-25 02:45:35'),
(49, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div><h5>What information do we collect?<\\/h5><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br \\/><\\/p><\\/div><div><h5>How do we protect your information?<\\/h5><p>All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Do we disclose any information to outside parties?<\\/h5><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or wellbeing.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Children\'s Online Privacy Protection Act Compliance<\\/h5><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Changes to our Privacy Policy<\\/h5><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br \\/><\\/p><\\/div><div><h5>How long we retain your information?<\\/h5><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br \\/><\\/p><\\/div><div><h5>What we don\\u2019t do with your data<\\/h5><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', 'basic', '2024-03-25 03:02:09', '2024-05-31 23:27:18'),
(50, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div><p>We claim all authority to dismiss, end, or handicap any help with or without cause per administrator discretion. This is a Complete independent facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by submitting solicitations or protests we will impair your record. The solitary time you should reach us about the seaward facilitating is if there is an issue with the worker. We have not many substance limitations and everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p><\\/div><div><ul><li>Configuration requests - If you have a fully managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs, DNS, and httpd configurations.<\\/li><li>Software requests - Cpanel Extension Installation will be granted as long as it does not interfere with the security, stability, and performance of other users on the server.<\\/li><li>Emergency Support - We do not provide emergency support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li><li>Webmaster help - We do not offer any support for webmaster related issues and difficulty including coding, & installs, Error solving. if there is an issue where a library or configuration of the server then we can help you if it\'s possible from our end.<\\/li><li>Backups - We keep backups but we are not responsible for data loss, you are fully responsible for all backups.<\\/li><li><br \\/><\\/li><li>We Don\'t support any child porn or such material.<\\/li><li>No spam-related sites or material, such as email lists, mass mail programs, and scripts, etc.<\\/li><li>No harassing material that may cause people to retaliate against you.<\\/li><li>No phishing pages.<\\/li><li>You may not run any exploitation script from the server. reason can be terminated immediately.<\\/li><li>If Anyone attempting to hack or exploit the server by using your script or hosting, we will terminate your account to keep safe other users.<\\/li><li>Malicious Botnets are strictly forbidden.<\\/li><li>Spam, mass mailing, or email marketing in any way are strictly forbidden here.<\\/li><li>Malicious hacking materials, trojans, viruses, & malicious bots running or for download are forbidden.<\\/li><li>Resource and cronjob abuse is forbidden and will result in suspension or termination.<\\/li><li>Php\\/CGI proxies are strictly forbidden.<\\/li><li>CGI-IRC is strictly forbidden.<\\/li><li>No fake or disposal mailers, mass mailing, mail bombers, SMS bombers, etc.<\\/li><li>NO CREDIT OR REFUND will be granted for interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li><\\/ul><\\/div><div><h5>Terms & Conditions for Users<\\/h5><p>Before getting to this site, you are consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Support<\\/h5><p>Whenever you have downloaded our item, you may get in touch with us for help through email and we will give a valiant effort to determine your issue. We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and Livechat.<\\/p><p>On the off chance that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p><ul><li>Hang tight for additional update discharge.<\\/li><li>Or on the other hand, enlist a specialist (We offer customization for extra charges).<\\/li><li><br \\/><\\/li><\\/ul><\\/div><div><h5>Ownership<\\/h5><p>You may not guarantee scholarly or selective possession of any of our items, altered or unmodified. All items are property, we created them. Our items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no occasion will our juridical individual be subject to any harms including, however not restricted to, immediate, roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Warranty<\\/h5><p>We don\'t offer any guarantee or assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component, as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Unauthorized\\/Illegal Usage<\\/h5><p>You may not utilize our things for any illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale (counting yet not restricted to copyright laws) just as the laws of your nation and International law. Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality, illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of the offered on our things, or admittance to the administration without the express composed consent by us or item proprietor.<br \\/>Our Members are liable for all substance posted on the discussion and demo and movement that happens under your record.<br \\/>We hold the chance of hindering your participation account quickly if we will think about a particularly not allowed conduct.<br \\/>If you make a record on our site, you are liable for keeping up the security of your record, and you are completely answerable for all exercises that happen under the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Fiverr, Seoclerks Sellers Or Affiliates<\\/h5><p>We do NOT ensure full SEO campaign conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires time touchy outcomes, utilize Our SEO Services at your own risk<\\/p><p><br \\/><\\/p><\\/div><div><h5>Payment\\/Refund Policy<\\/h5><p>No refund or cash back will be made. After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t document a debate or a chargeback against us in any way, shape, or form.<br \\/>If you document a debate or chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your record. There are no special cases.<\\/p><p><br \\/><\\/p><\\/div><div><h5>Free Balance \\/ Coupon Policy<\\/h5><p>We offer numerous approaches to get FREE Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free Balance from your record balance, and your record balance becomes negative, at that point the record will naturally be suspended. If your record is suspended because of a negative Balance you can request to make a custom payment to settle your equilibrium to actuate your record.<\\/p><\\/div>\"}', 'basic', '2024-03-25 03:02:33', '2024-05-31 23:29:54'),
(51, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', 'basic', '2024-03-25 03:15:29', '2024-03-25 03:15:29'),
(52, 'contact_us.content', '{\"title\":\"Get in Touch\",\"short_details\":\"Reach out to us for any inquiries or assistance.\",\"map_embedded_link\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d2993.6862912792812!2d2.1202448764395387!3d41.38089999639698!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a498f576297baf%3A0x44f65330fe1b04b9!2sSpotify%20Camp%20Nou!5e0!3m2!1sen!2sbd!4v1717222893198!5m2!1sen!2sbd\",\"contact_address\":\"123 Sample St, Sydney NSW 2000 AU\",\"contact_email\":\"hello@relume.io\",\"contact_number\":\"+1(555)000-0000\"}', 'basic', '2024-03-25 03:30:06', '2024-06-23 05:53:40'),
(56, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"Start Your Journey,\",\"subheading\":\"Your Ultimate Vehicle Rental Platform\",\"short_description\":\"Rent a luxury vehicle for as low as $150 daily from our extensive network of over 100 premium locations.\",\"button_name\":\"Contact Us\",\"button_link\":\"\\/contact\",\"background_image\":\"66026be329c8d1711434723.png\"}', 'basic', '2024-03-26 00:32:03', '2024-05-31 23:34:27'),
(57, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"660270b43b8811711435956.png\"}', 'basic', '2024-03-26 00:32:21', '2024-03-26 00:52:36'),
(58, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"660270c0733361711435968.png\"}', 'basic', '2024-03-26 00:32:26', '2024-03-26 00:52:48'),
(59, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"660270c63ee321711435974.png\"}', 'basic', '2024-03-26 00:32:30', '2024-03-26 00:52:54'),
(60, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"660270cb1e56c1711435979.png\"}', 'basic', '2024-03-26 00:32:34', '2024-03-26 00:52:59'),
(61, 'banner.element', '{\"has_image\":\"1\",\"slider_image\":\"660270cfdb5ef1711435983.png\"}', 'basic', '2024-03-26 00:32:39', '2024-03-26 00:53:03'),
(62, 'how_to_work.content', '{\"heading\":\"How it\\u2019s Works\",\"subheading\":\"Fast and Convenient Vehicle Rental\"}', 'basic', '2024-03-26 00:59:45', '2024-03-26 00:59:45'),
(63, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-fi_14183674\\\"><\\/i>\",\"title\":\"Choose a vehicle\",\"short_description\":\"Explore our diverse fleet and find the perfect vehicle to suit your needs, preferences, and budget effortlessly\"}', 'basic', '2024-03-26 01:01:46', '2024-03-26 01:01:46'),
(64, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-Group-17\\\"><\\/i>\",\"title\":\"Pick location & date\",\"short_description\":\"Select your preferred location and dates seamlessly to ensure a smooth and hassle-free rental experience tailored to your schedule\"}', 'basic', '2024-03-26 01:03:39', '2024-03-26 01:03:39'),
(65, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-fi_3436734\\\"><\\/i>\",\"title\":\"Make a booking\",\"short_description\":\"Easily confirm your reservation online with just a few clicks, securing your chosen vehicle for your desired dates instantly.\"}', 'basic', '2024-03-26 01:04:23', '2024-03-26 01:04:23'),
(66, 'how_to_work.element', '{\"icon\":\"<i class=\\\"icon-Group-18\\\"><\\/i>\",\"title\":\"Sit back & relax\",\"short_description\":\"Once booked, sit back and relax as we prepare your chosen vehicle for a seamless and enjoyable rental experience.\"}', 'basic', '2024-03-26 01:04:53', '2024-03-26 01:04:53'),
(67, 'vehicle.content', '{\"has_image\":\"1\",\"heading\":\"Enjoy Your Ride\",\"subheading\":\"Our Fleet of Vehicles\",\"background_image\":\"66027586907ac1711437190.png\"}', 'basic', '2024-03-26 01:11:37', '2024-03-26 01:13:12'),
(68, 'feature.content', '{\"has_image\":\"1\",\"heading\":\"Our Features\",\"subheading\":\"Experience seamless vehicle rental with our hassle-free service.\",\"background_image\":\"66027966ef4131711438182.png\",\"image\":\"66027967135571711438183.png\"}', 'basic', '2024-03-26 01:29:42', '2024-03-26 01:29:43'),
(69, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_3706334\\\"><\\/i>\",\"title\":\"Free Delivery\",\"description\":\"Enjoy the convenience of complimentary delivery for your rented vehicle at no extra cost.\"}', 'basic', '2024-03-26 01:30:54', '2024-03-26 01:30:54'),
(70, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_854952\\\"><\\/i>\",\"title\":\"Any Pickup Location\",\"description\":\"Choose any location for convenient vehicle pickup, tailored to your needs and preferences\"}', 'basic', '2024-03-26 01:31:33', '2024-03-26 01:31:33'),
(71, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_8541356\\\"><\\/i>\",\"title\":\"Customers Satisfaction\",\"description\":\"Our priority is ensuring customer satisfaction through excellent service, reliability, and personalized attention to your needs.\"}', 'basic', '2024-03-26 01:32:01', '2024-03-26 01:32:01'),
(72, 'feature.element', '{\"icon\":\"<i class=\\\"icon-fi_9156007\\\"><\\/i>\",\"title\":\"Easier & Faster Bookings\",\"description\":\"Simplify and expedite the booking process with our platform for quicker access to your desired vehicle.\"}', 'basic', '2024-03-26 01:32:40', '2024-03-26 01:32:40'),
(73, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9bdaea4e91717476314.png\"}', 'basic', '2024-03-26 01:52:43', '2024-06-03 22:45:14'),
(74, 'service.content', '{\"has_image\":\"1\",\"heading\":\"Our Services\",\"subheading\":\"What Makes Us Different?\",\"background_image\":\"660283f34c5451711440883.png\"}', 'basic', '2024-03-26 02:06:08', '2024-03-26 21:09:05'),
(75, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group\\\"><\\/i>\",\"title\":\"Pick up and Drop\",\"description\":\"<font color=\\\"#ffffff\\\" size=\\\"4\\\">Our pick-up and drop service ensures your rental experience is seamless. Select your preferred location for vehicle collection, whether it\'s at the airport, hotel, or any other convenient spot.\\u00a0<\\/font><div><font color=\\\"#ffffff\\\" size=\\\"4\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\" size=\\\"4\\\">Our team will coordinate the pick-up time to align with your schedule. Similarly, when your rental period ends, we offer hassle-free drop-off options.\\u00a0<\\/font><\\/div><div><font color=\\\"#ffffff\\\" size=\\\"4\\\"><br \\/><\\/font><\\/div><div><font color=\\\"#ffffff\\\" size=\\\"4\\\">Simply choose a location that suits you best, and our staff will be there to receive the vehicle. With this service, you can enjoy the freedom of exploring without worrying about logistical hassles, making your journey more convenient and enjoyable<\\/font><\\/div>\",\"image\":\"660282920fa221711440530.png\"}', 'basic', '2024-03-26 02:08:50', '2024-03-26 02:26:12'),
(76, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-1\\\"><\\/i>\",\"title\":\"Maintained Cars\",\"description\":\"<font size=\\\"4\\\" color=\\\"#ffffff\\\">Maintaining your car is essential for its longevity and performance. Regular upkeep includes oil changes, tire rotations, brake inspections, and fluid checks.\\u00a0<\\/font><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Following the manufacturer\'s recommended maintenance schedule ensures optimal functioning and prevents costly repairs. Addressing minor issues promptly can prevent them from escalating into major problems.<\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Additionally, keeping your car clean and organized enhances comfort and resale value. Regularly check your car\'s exterior and interior for signs of wear and tear. Proper maintenance not only extends your car\'s lifespan but also ensures your safety and the safety of others on the road.<\\/font><br \\/><\\/div>\",\"image\":\"660282db69c8a1711440603.png\"}', 'basic', '2024-03-26 02:10:03', '2024-03-26 02:26:47'),
(77, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-2\\\"><\\/i>\",\"title\":\"Professional Staff\",\"description\":\"<font size=\\\"4\\\" color=\\\"#ffffff\\\">Our professional staff is dedicated to providing top-notch service, whether you\'re renting a vehicle or seeking assistance.\\u00a0<\\/font><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">With extensive training and expertise, they\'re equipped to answer your questions, offer recommendations, and ensure your needs are met with efficiency and courtesy.\\u00a0<\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Their attention to detail and commitment to customer satisfaction set us apart, guaranteeing a positive experience every time. From helping you choose the perfect vehicle to providing support throughout your rental period, our team is here to make your journey smooth and enjoyable.\\u00a0<\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Trust our professional staff to exceed your expectations and deliver exceptional service at every interaction.<\\/font><br \\/><\\/div>\",\"image\":\"6602831344dfd1711440659.png\"}', 'basic', '2024-03-26 02:10:59', '2024-03-26 02:27:21'),
(78, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Clip-path-group-4\\\"><\\/i>\",\"title\":\"Excellent Prices\",\"description\":\"<font size=\\\"4\\\" color=\\\"#ffffff\\\">At our company, we prioritize offering excellent prices without compromising on quality or service. We understand the importance of value for money, which is why we strive to provide competitive rates for all our products and services.\\u00a0<\\/font><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Through strategic partnerships and efficient operations, we\'re able to keep our prices affordable without sacrificing the standards our customers deserve.\\u00a0<\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/div><div><font size=\\\"4\\\" color=\\\"#ffffff\\\">Whether you\'re renting a vehicle, purchasing a product, or utilizing our services, you can trust that you\'re getting exceptional value for your money. Experience the satisfaction of receiving high-quality offerings at unbeatable prices when you choose us as your preferred provider.<\\/font><br \\/><\\/div>\",\"image\":\"6602835642e3a1711440726.png\"}', 'basic', '2024-03-26 02:12:06', '2024-03-26 02:27:44'),
(79, 'service.element', '{\"has_image\":[\"1\"],\"icon\":\"<i class=\\\"icon-Layer_1\\\"><\\/i>\",\"title\":\"Easy Booking\",\"description\":\"<div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\">With our easy booking process, renting a vehicle has never been simpler.\\u00a0<\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\">Our user-friendly platform allows you to browse through a wide selection of vehicles, select your desired options, and make a reservation in just a few clicks.\\u00a0<\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\">Whether you prefer to book online or through our mobile app, you\'ll find the process intuitive and straightforward. We prioritize convenience and efficiency, so you can quickly finalize your booking and get on the road without any hassle.\\u00a0<\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\"><br \\/><\\/font><\\/span><\\/div><div><span><font size=\\\"4\\\" color=\\\"#ffffff\\\">Plus, our customer support team is always available to assist you along the way, ensuring a smooth and stress-free experience from start to finish.<\\/font><\\/span><br \\/><\\/div>\",\"image\":\"6602838a85f101711440778.png\"}', 'basic', '2024-03-26 02:12:58', '2024-03-26 02:28:50'),
(80, 'testimonial.content', '{\"heading\":\"Feedback\",\"subheading\":\"Our Customer Reviews\"}', 'basic', '2024-03-26 02:31:59', '2024-03-26 02:31:59'),
(81, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Emily Johnson\",\"designation\":\"Marketing Manager\",\"company_name\":\"Bright Ideas Inc.\",\"quotes\":\"Renting a vehicle from  Bright Ideas Inc was a breeze! Their easy booking process and excellent prices made my trip stress-free.\",\"image\":\"66028b2673b821711442726.png\"}', 'basic', '2024-03-26 02:45:26', '2024-03-26 02:45:26'),
(82, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"David Smith\",\"designation\":\"CEO\",\"company_name\":\"Summit Solutions\",\"quotes\":\"The professionalism of the Summit Solutions staff stood out to me. They helped me find the perfect vehicle for my needs at an unbeatable price.\",\"image\":\"66028b43c9e0e1711442755.png\"}', 'basic', '2024-03-26 02:45:55', '2024-03-26 02:45:55'),
(83, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Sophia Lee\",\"designation\":\"Freelance\",\"company_name\":\"Photography LLC\",\"quotes\":\"I rely on Photography LLC for all my travel needs. Their convenient pick-up and drop-off services make my photography assignments a breeze\",\"image\":\"66028b76702fd1711442806.png\"}', 'basic', '2024-03-26 02:46:46', '2024-03-26 02:46:46'),
(84, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Michael Anderson\",\"designation\":\"Traveller\",\"company_name\":\"Travel Enthusiast\",\"quotes\":\"I\'ve tried many rental services, but none compare to Travel Enthusiast. Their excellent prices and easy booking process keep me coming back every time!\",\"image\":\"66028b9a1eb7c1711442842.png\"}', 'basic', '2024-03-26 02:47:22', '2024-03-26 02:47:22'),
(85, 'cta.content', '{\"has_image\":\"1\",\"heading\":\"200+ sports & luxury vehicles\",\"subheading\":\"DRIVE YOUR DREAM VEHICLE TODAY\",\"short_description\":\"Rent a sports or luxury car , delivered directly to your hotel in Dubai\",\"video_link\":\"https:\\/\\/url8.viserlab.com\\/justhire\\/video.mp4\",\"button_name\":\"Book Ride\",\"button_link\":\"\\/user\\/login\",\"image\":\"66028d9a8b2321711443354.png\"}', 'basic', '2024-03-26 02:55:54', '2024-06-03 05:04:34'),
(86, 'faq.content', '{\"heading\":\"Do You Have\",\"subheading\":\"Any Questions?\"}', 'basic', '2024-03-26 02:59:12', '2024-03-26 02:59:12'),
(87, 'faq.element', '{\"question\":\"How can I make a reservation?\",\"answer\":\"Making a reservation is easy! Simply visit our website or download our mobile app, choose your desired vehicle, select your pickup and drop-off locations and dates, and complete the booking process.\"}', 'basic', '2024-03-26 03:11:33', '2024-03-26 03:11:33'),
(88, 'faq.element', '{\"question\":\"Do you offer delivery and pickup services?\",\"answer\":\"Yes, we do! We offer convenient delivery and pickup services to various locations, including airports, hotels, and more. Just let us know your preferred location, and we\'ll take care of the rest.\"}', 'basic', '2024-03-26 03:11:45', '2024-03-26 03:11:45'),
(89, 'faq.element', '{\"question\":\"What are your rental rates?\",\"answer\":\"Our rental rates vary depending on the vehicle type, rental duration, and other factors. You can find our competitive rates displayed on our website or by contacting our customer support team for a personalized quote.\"}', 'basic', '2024-03-26 03:11:58', '2024-03-26 03:11:58'),
(90, 'faq.element', '{\"question\":\"What documents do I need to rent a vehicle?\",\"answer\":\"To rent a vehicle, you\'ll typically need a valid driver\'s license, a credit card for payment and security deposit, and proof of insurance. Additional requirements may vary depending on your location and the type of vehicle you\'re renting.\"}', 'basic', '2024-03-26 03:12:09', '2024-03-26 03:12:09'),
(91, 'faq.element', '{\"question\":\"Is there an age requirement for renting a vehicle?\",\"answer\":\"Yes, the minimum age requirement for renting a vehicle is usually 21 years old. However, some locations may have higher age requirements or additional restrictions for certain vehicle types.\"}', 'basic', '2024-03-26 03:12:22', '2024-03-26 03:12:22'),
(92, 'faq.element', '{\"question\":\"What happens if I need to cancel my reservation?\",\"answer\":\"We understand that plans can change, which is why we offer flexible cancellation policies. Depending on the timing of your cancellation, there may be applicable fees. Please refer to our terms and conditions or contact our customer support team for assistance with cancellations.\"}', 'basic', '2024-03-26 03:12:36', '2024-03-26 03:12:36'),
(93, 'cta_contact.content', '{\"has_image\":\"1\",\"heading\":\"Rentaly customer care is here to help you anytime.\",\"subheading\":\"Committed to Providing Prompt and Reliable Support for a Seamless and Enjoyable Rental Experience\",\"contact_button\":\"Contact US\",\"contact_button_link\":\"\\/contact\",\"image\":\"667a811d374ac1719304477.png\"}', 'basic', '2024-03-26 03:30:44', '2024-06-25 02:34:37'),
(94, 'about.content', '{\"has_image\":\"1\",\"heading\":\"About Company\",\"subheading\":\"You start the engine and your adventure begins\",\"description\":\"Certain but she but shyness why cottage. Guy the put instrument sir entreaties affronting. Pretended exquisite see cordially the you. Weeks quiet do vexed or whose. Motionless if no to affronting imprudence no precaution. My indulged as disposal strongly attended.\",\"image\":\"660297b13aed61711445937.png\"}', 'basic', '2024-03-26 03:38:57', '2024-03-26 03:38:57'),
(95, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_9851490\\\"><\\/i>\",\"amount\":\"5\",\"title\":\"Car Types\"}', 'basic', '2024-03-26 03:43:49', '2024-06-25 02:40:50'),
(96, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_6686695\\\"><\\/i>\",\"amount\":\"8\",\"title\":\"Rental Outlet\"}', 'basic', '2024-03-26 03:44:11', '2024-06-25 02:41:00'),
(97, 'about.element', '{\"icon\":\"<i class=\\\"icon-fi_3534548\\\"><\\/i>\",\"amount\":\"10\",\"title\":\"Service Point\"}', 'basic', '2024-03-26 03:44:41', '2024-06-25 02:41:04'),
(98, 'support.content', '{\"has_image\":\"1\",\"heading\":\"Save big with our cheap car rental!\",\"subheading\":\"Top outlet. Local Suppliers. 24\\/7 Support.\",\"button_one_name\":\"Book Ride\",\"button_one_link\":\"\\/user\\/register\",\"button_two_name\":\"Contact Us\",\"button_two_link\":\"\\/contact\",\"image\":\"667a830beec561719304971.jpg\"}', 'basic', '2024-03-26 04:15:37', '2024-06-25 02:42:52'),
(99, 'why_choose_us.content', '{\"has_image\":\"1\",\"heading\":\"Why Choose Us\",\"subheading\":\"Experience Excellence in Every Mile\",\"short_description\":\"Discover unparalleled convenience, reliability, and value with our exceptional service. From hassle-free bookings to top-notch vehicles, we\'re your ultimate travel partner.\",\"button_name\":\"Find Deal\",\"button_link\":\"\\/\",\"image\":\"66038e5badc7e1711509083.png\"}', 'basic', '2024-03-26 21:11:23', '2024-03-26 21:14:33'),
(100, 'why_choose_us.element', '{\"title\":\"Expert Staff\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:11:35', '2024-03-26 21:19:59'),
(101, 'why_choose_us.element', '{\"title\":\"Convenient Booking\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:11:42', '2024-03-26 21:20:03'),
(102, 'why_choose_us.element', '{\"title\":\"Reliable Vehicles\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:11:47', '2024-03-26 21:20:07'),
(103, 'why_choose_us.element', '{\"title\":\"Affordable Rates\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:11:53', '2024-03-26 21:20:10'),
(104, 'why_choose_us.element', '{\"title\":\"Exceptional Service\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:12:01', '2024-03-26 21:20:13'),
(105, 'why_choose_us.element', '{\"title\":\"Easy Process\",\"icon\":\"<i class=\\\"icon-Group-20\\\"><\\/i>\"}', 'basic', '2024-03-26 21:13:43', '2024-03-26 21:20:16'),
(106, 'blog.content', '{\"heading\":\"Blogs\",\"subheading\":\"Our Latest Blogs\"}', 'basic', '2024-03-26 21:48:28', '2024-03-26 21:48:28'),
(107, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Exploring the Unknown: Embracing the Joy of Travel\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"660397926bcc51711511442.png\"}', 'basic', '2024-03-26 21:50:42', '2024-06-25 02:52:30'),
(108, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Embracing the Journey: Finding Serenity on the Open Roa\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"66039c3e0c0c41711512638.png\"}', 'basic', '2024-03-26 22:10:38', '2024-06-25 02:52:57'),
(109, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Embracing Adventure Beyond the Beaten Path\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"66039ce2aaf7b1711512802.png\"}', 'basic', '2024-03-26 22:13:22', '2024-06-25 02:53:05'),
(110, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Discovering the World One Journey at a Time\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"66039e06e8c1c1711513094.png\"}', 'basic', '2024-03-26 22:18:14', '2024-06-25 02:53:12'),
(111, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Welcome Back\",\"subheading\":\"Login to Your Account\",\"image\":\"6603a3b1ebfa71711514545.png\"}', 'basic', '2024-03-26 22:42:25', '2024-03-26 22:42:26'),
(112, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Create Your Account\",\"subheading\":\"Join Us Today for Exclusive Benefits\",\"image\":\"6603aa0d43f461711516173.png\"}', 'basic', '2024-03-26 23:09:33', '2024-03-26 23:09:33'),
(113, 'vehicle_store.content', '{\"store_required_content\":\"Your vehicle store registration is incomplete. Please provide necessary details for approval.\",\"store_pending_content\":\"Your vehicle store registration is pending. All listings are disabled until approval.\",\"store_approved_content\":\"If you wish to update your vehicle store, please contact the admin via support ticket for assistance.\"}', 'basic', '2024-03-27 22:49:24', '2024-03-27 22:49:24'),
(114, 'kyc.content', '{\"kyc_pending\":\"Your account verification is pending approval. Certain features may be limited until KYC is complete.\",\"kyc_required\":\"Your account verification is pending. Please complete KYC by providing the required documents for approval.\"}', 'basic', '2024-03-29 22:27:28', '2024-03-29 22:27:28');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `tempname`, `created_at`, `updated_at`) VALUES
(115, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Curabitur at lacus ac velit ornare lobortis. Suspendisse feugiat.\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"665abc0bf0a111717222411.png\"}', 'basic', '2024-06-01 00:13:31', '2024-06-25 02:53:31'),
(116, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Praesent adipiscing. Cras dapibus.\",\"description\":\"Retirement planning is essential for ensuring financial security and peace of mind in your golden years. In this blog post, we discuss key retirement planning strategies, including setting retirement goals, estimating retirement expenses, maximizing retirement savings accounts, and creating a sustainable withdrawal plan. Whether you\'re decades away from retirement or nearing your retirement age, this guide will help you take proactive steps towards a financially secure future.<br \\/><br \\/>\\r\\n<h5>From setting clear retirement goals to estimating your future expenses and income needs<\\/h5>\\r\\n<div>we\'ll guide you through the process of creating a solid retirement plan tailored to your unique circumstances. Whether you\'re decades away from retirement or nearing your retirement age, this guide offers valuable insights to help you make informed decisions and take proactive steps towards achieving your retirement objectives.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n\\r\\n<blockquote style=\\\"font-style:italic;text-align:center;padding:20px;background:#ffdec4;font-weight:500;font-size:18px;border-left:4px solid #fe8628;\\\">Aenean metus lectus at id. Morbi aliquet commodo a sodales eget. Eu justo ante nibh et a turpis, aliquam phasellus hymenaeos, imperdiet eget cras sociosqu, tincidunt a amet. Faucibus urna luctus, arcu ni<\\/blockquote>\\r\\n\\r\\n\\r\\n<h5>Planning for retirement doesn\'t end with accumulating savings<\\/h5>\\r\\n<div>It also involves developing a sustainable withdrawal strategy to ensure your funds last throughout your retirement years. We\'ll discuss key factors to consider when creating a withdrawal plan, such as your expected lifespan, inflation, and investment returns, to help you strike the right balance between enjoying your retirement lifestyle and preserving your financial security.<br \\/><\\/div>\\r\\n<div><br \\/><\\/div>\\r\\n<h5>Planning before starting<\\/h5>\\r\\n<div>Whether you\'re just starting your career, mid-career, or approaching retirement age, it\'s never too early or too late to begin planning for your future. Join us as we empower you with the knowledge and tools you need to take control of your retirement destiny and embark on the path towards a financially secure and fulfilling retirement.<br \\/><\\/div>\",\"image\":\"665abc199a3461717222425.png\"}', 'basic', '2024-06-01 00:13:45', '2024-06-25 02:53:38'),
(117, 'banned.content', '{\"has_image\":\"1\",\"heading\":\"You Are Banned\",\"image\":\"665e9b56e320b1717476182.png\"}', 'basic', '2024-06-03 22:43:02', '2024-06-03 22:43:02'),
(118, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9be0f22a61717476320.png\"}', 'basic', '2024-06-03 22:45:20', '2024-06-03 22:45:21'),
(119, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9be5d8cbb1717476325.png\"}', 'basic', '2024-06-03 22:45:25', '2024-06-03 22:45:25'),
(120, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9bebab7651717476331.png\"}', 'basic', '2024-06-03 22:45:31', '2024-06-03 22:45:31'),
(121, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9bf06ee961717476336.png\"}', 'basic', '2024-06-03 22:45:36', '2024-06-03 22:45:36'),
(122, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9bf54e41e1717476341.png\"}', 'basic', '2024-06-03 22:45:41', '2024-06-03 22:45:41'),
(123, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9d524a3471717476690.png\"}', 'basic', '2024-06-03 22:51:30', '2024-06-03 22:51:30'),
(124, 'partner.element', '{\"has_image\":\"1\",\"image\":\"665e9d568142f1717476694.png\"}', 'basic', '2024-06-03 22:51:34', '2024-06-03 22:51:34'),
(125, 'cta_contact.element', '{\"title\":\"24\\/7 Roadside Assistance\"}', 'basic', '2024-06-25 02:36:14', '2024-06-25 02:36:14'),
(126, 'cta_contact.element', '{\"title\":\"Inquiries and Modifications\"}', 'basic', '2024-06-25 02:36:25', '2024-06-25 02:36:25'),
(127, 'cta_contact.element', '{\"title\":\"Vehicle Selection Guidance\"}', 'basic', '2024-06-25 02:36:35', '2024-06-25 02:36:35'),
(128, 'cta_contact.element', '{\"title\":\"Advice and Support\"}', 'basic', '2024-06-25 02:36:49', '2024-06-25 02:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `code` int(11) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `alias` varchar(40) NOT NULL DEFAULT 'NULL',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text DEFAULT NULL,
  `supported_currencies` text DEFAULT NULL,
  `crypto` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"sb-owud61543012@business.example.com\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:04:38'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"hR26aw02Q1eEeUPSIfuwNypXX\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:35:33'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:48:36'),
(4, 0, 104, 'Skrill', 'Skrill', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"merchant@skrill.com\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"---\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:30:16'),
(5, 0, 105, 'PayTM', 'Paytm', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"DIY12386817555501617\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"bKMfNxPPf_QdZppa\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"DIYtestingweb\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"Retail\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"WEB\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/oltp-web\\/processTransaction\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"https:\\/\\/pguat.paytm.com\\/paytmchecksum\\/paytmCallback.jsp\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 03:00:44'),
(6, 0, 106, 'Payeer', 'Payeer', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"866989763\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"7575\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 13:14:22', '2022-08-28 10:11:14'),
(7, 0, 107, 'PayStack', 'Paystack', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"pk_test_3c9c87f51b13c15d99eb367ca6ebc52cc9eb1f33\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"sk_test_2a3f97a146ab5694801f993b60fcb81cd7254f12\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 13:14:22', '2024-04-04 00:28:44'),
(8, 0, 108, 'VoguePay', 'Voguepay', 1, '{\"merchant_id\":{\"title\":\"MERCHANT ID\",\"global\":true,\"value\":\"demo\"}}', '{\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 01:22:38'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-06-05 11:37:45'),
(10, 0, 110, 'RazorPay', 'Razorpay', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"rzp_test_kiOtejPbRZU90E\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"osRDebzEqbsE1kbyQJ4y0re7\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:51:32'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 00:53:10'),
(12, 0, 112, 'Instamojo', 'Instamojo', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_2241633c3bc44a3de84a3b33969\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"test_279f083f7bebefd35217feef22d\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"19d38908eeff4f58b2ddda2c6d86ca25\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:56:20'),
(13, 0, 501, 'Blockchain', 'Blockchain', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2022-03-21 07:41:56'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 13:14:22', '2023-04-08 03:17:18'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"93a1e014c4ad60a7980b4a7239673cb4\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2024-04-04 00:27:12'),
(17, 0, 505, 'Coingate', 'Coingate', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"6354mwVCEw5kHzRJ6thbGo-N\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2022-03-30 09:24:57'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"c47cd7df-d8e8-424b-a20a\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"55871878-2c32-4f64-ab66\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 02:02:47'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"Ae0-tixtSV7DvLwIh3Bmu7JvHrjh5EfGdXr_cEklKAVjjezRZ747BxKILiBdzlKKyp-W8W_T7CKH1Ken\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"EOhbvHZgFNO21soQJT1L9Q00M3rK6PIEsdiTgXRBt2gtGtxwRer5JvKnVUGNU5oE63fFnjnYY7hq3HBA\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-20 23:01:08'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"sk_test_51I6GGiCGv1sRiQlEi5v1or9eR0HVbuzdMd2rW4n3DxC8UKfz66R4X6n4yYkzvI2LeAIuRU9H99ZpY7XCNFC9xMs500vBjZGkKG\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"pk_test_51I6GGiCGv1sRiQlEOisPKrjBqQqqcFsw8mXNaZ2H2baN6R01NulFS7dKFji1NRRxuchoUTEDdB7ujKcyKYSVc0z500eth7otOM\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"whsec_lUmit1gtxwKTveLnSe88xCSDdnPOt8g5\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 13:14:22', '2021-05-21 00:58:38'),
(27, 0, 115, 'Mollie', 'Mollie', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"vi@gmail.com\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"test_cucfwKTWfft9s337qsVfn5CC4vNkrn\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 13:14:22', '2021-05-21 02:44:45'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"3748\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"546254628759524554647987\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2021-06-22 08:05:04'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"APP_USR-7924565816849832-082312-21941521997fab717db925cf1ea2c190-1071840315\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-09-14 07:41:14'),
(37, 0, 120, 'Authorize.net', 'Authorize', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"59e4P9DBcZv\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"47x47TJyLw2E7DbR\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2022-08-28 09:33:06'),
(46, 0, 121, 'NMI', 'NMI', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"2F822Rw39fx762MaV7Yy86jXGTC7sCDy\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2022-08-28 10:32:31'),
(50, 0, 507, 'BTCPay', 'BTCPay', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"HsqFVTXSeUFJu7caoYZc3CTnP8g5LErVdHhEXPVTheHf\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"4436bd706f99efae69305e7c4eff4780de1335ce\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"https:\\/\\/testnet.demo.btcpayserver.org\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"SUCdqPn9CDkY7RmJHfpQVHP2Lf2\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2023-02-14 04:42:09'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 05:08:23'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2023-02-14 05:08:04'),
(53, 0, 122, '2Checkout', 'TwoCheckout', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"253248016872\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"eQM)ID@&vG84u!O*g[p+\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 1, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2023-04-29 09:21:58'),
(54, 0, 123, 'Checkout', 'Checkout', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2023-05-06 07:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `currency` varchar(40) DEFAULT NULL,
  `symbol` varchar(40) DEFAULT NULL,
  `method_code` int(11) DEFAULT NULL,
  `gateway_alias` varchar(40) DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `max_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) NOT NULL DEFAULT 0.00,
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(255) DEFAULT NULL,
  `gateway_parameter` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(40) DEFAULT NULL,
  `cur_text` varchar(40) DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) DEFAULT NULL,
  `email_template` text DEFAULT NULL,
  `sms_body` varchar(255) DEFAULT NULL,
  `sms_from` varchar(255) DEFAULT NULL,
  `base_color` varchar(40) DEFAULT NULL,
  `secondary_color` varchar(40) DEFAULT NULL,
  `mail_config` text DEFAULT NULL COMMENT 'email configuration',
  `sms_config` text DEFAULT NULL,
  `global_shortcodes` text DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0,
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'sms notification, 0 - dont send, 1 - send',
  `force_ssl` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance_mode` tinyint(1) NOT NULL DEFAULT 0,
  `secure_password` tinyint(1) NOT NULL DEFAULT 0,
  `agree` tinyint(1) NOT NULL DEFAULT 0,
  `multi_language` tinyint(1) NOT NULL DEFAULT 1,
  `registration` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) DEFAULT NULL,
  `system_info` text DEFAULT NULL,
  `last_cron` datetime DEFAULT NULL,
  `system_customized` tinyint(1) NOT NULL DEFAULT 0,
  `max_image_upload` int(11) NOT NULL DEFAULT 0,
  `rental_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `api_key` varchar(255) DEFAULT NULL,
  `socialite_credentials` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_template`, `sms_body`, `sms_from`, `base_color`, `secondary_color`, `mail_config`, `sms_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `force_ssl`, `maintenance_mode`, `secure_password`, `agree`, `multi_language`, `registration`, `active_template`, `system_info`, `last_cron`, `system_customized`, `max_image_upload`, `rental_charge`, `api_key`, `socialite_credentials`, `created_at`, `updated_at`) VALUES
(1, 'Self Drive Zone', 'INR', '₹', 'info@viserlab.com', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">{{site_name}}</a>&nbsp;. All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'ViserAdmin', '215efd', '008aff', '{\"name\":\"php\"}', '{\"name\":\"nexmo\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 'basic', '[]', NULL, 0, 5, 20.00000000, 'AIzaSyBO6NEqyKY_FjgZP1HEuMgcoIb2Fa0ebBg', '{\"google\":{\"client_id\":\"-------------------\",\"client_secret\":\"-------------------\",\"status\":0},\"facebook\":{\"client_id\":\"----------------------\",\"client_secret\":\"---------------------\",\"status\":0},\"linkedin\":{\"client_id\":\"--------------------\",\"client_secret\":\"--------------------\",\"status\":0}}', NULL, '2024-08-23 13:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: not default language, 1: default language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, '2020-07-06 03:47:55', '2022-04-09 03:47:04'),
(5, 'Hindi', 'hn', 0, '2020-12-29 02:20:07', '2022-04-09 03:47:04'),
(9, 'Bangla', 'bn', 0, '2021-03-14 04:37:41', '2022-03-30 12:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) DEFAULT NULL,
  `sent_from` varchar(40) DEFAULT NULL,
  `sent_to` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `notification_type` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `subj` varchar(255) DEFAULT NULL,
  `email_body` text DEFAULT NULL,
  `sms_body` text DEFAULT NULL,
  `shortcodes` text DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subj`, `email_body`, `sms_body`, `shortcodes`, `email_status`, `sms_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', '<div><div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been added to your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}&nbsp;</span></font><br></div><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin note:&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 12px; font-weight: 600; white-space: nowrap; text-align: var(--bs-body-text-align);\">{{remark}}</span></div>', '{{amount}} {{site_currency}} credited in your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin note is \"{{remark}}\"', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:18:28'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} {{site_currency}} has been subtracted from your account .</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">Your Current Balance is :&nbsp;</span><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">{{post_balance}}&nbsp; {{site_currency}}</span></font><br><div><font style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></font></div><div>Admin Note: {{remark}}</div>', '{{amount}} {{site_currency}} debited from your account. Your Current Balance {{post_balance}} {{site_currency}} . Transaction: #{{trx}}. Admin Note is {{remark}}', '{\"trx\":\"Transaction number for the action\",\"amount\":\"Amount inserted by the admin\",\"remark\":\"Remark inserted by the admin\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-03 02:24:11'),
(3, 'DEPOSIT_COMPLETE', 'Payment- Automated - Successful', 'Payment Completed Successfully', '<div>Your payment of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been completed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Deposit :<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Received : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} Payment successfully by {{method_name}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2024-04-01 00:35:54'),
(4, 'DEPOSIT_APPROVE', 'Payment - Manual - Approved', 'Your Payment is Approved', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>is Approved .<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\"><span style=\"font-weight: bolder;\"><br></span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Admin Approve Your {{amount}} {{site_currency}} payment request by {{method_name}} transaction : {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2024-04-01 00:34:28'),
(5, 'DEPOSIT_REJECT', 'Payment - Manual - Rejected', 'Your Payment Request is Rejected', '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}} has been rejected</span>.<span style=\"font-weight: bolder;\"><br></span></div><div><br></div><div><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Received : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge: {{charge}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number was : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">if you have any queries, feel free to contact us.<br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><br><br></div><span style=\"color: rgb(33, 37, 41); font-family: Montserrat, sans-serif;\">{{rejection_message}}</span><br>', 'Admin Rejected Your {{amount}} {{site_currency}} payment request by {{method_name}}\r\n\r\n{{rejection_message}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"rejection_message\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2024-04-01 00:34:42'),
(6, 'DEPOSIT_REQUEST', 'Payment - Manual - Requested', 'Payment Request Submitted Successfully', '<div>Your payment request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp;is via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>submitted successfully<span style=\"font-weight: bolder;\">&nbsp;.<br></span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your Payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div>Transaction Number : {{trx}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment requested by {{method_name}}. Charge: {{charge}} . Trx: {{trx}}', '{\"trx\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, 1, '2021-11-03 12:00:00', '2024-04-01 00:35:07'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have reset your password', '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not change that, please contact us as soon as possible.</font></span></p>', 'Your password has been changed successfully', '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, 1, '2021-11-03 12:00:00', '2022-04-05 03:46:35'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For joining us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use the below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', '{\"code\":\"Email verification code\"}', 1, 0, '2021-11-03 12:00:00', '2022-04-03 02:32:07'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', '---', 'Your phone verification code is: {{code}}', '{\"code\":\"SMS Verification Code\"}', 0, 1, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(12, 'WITHDRAW_APPROVE', 'Withdraw - Approved', 'Withdraw Request has been Processed and your money is sent', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Processed Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Processed Payment :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div>', 'Admin Approve Your {{amount}} {{site_currency}} withdraw request by {{method_name}}. Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"admin_details\":\"Details provided by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:50:16'),
(13, 'WITHDRAW_REJECT', 'Withdraw - Rejected', 'Withdraw Request has been Rejected and your money is refunded to your account', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been Rejected.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You should get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">----</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><br></font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\">{{amount}} {{currency}} has been&nbsp;<span style=\"font-weight: bolder;\">refunded&nbsp;</span>to your account and your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}}</span><span style=\"font-weight: bolder;\">&nbsp;{{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">-----</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\">Details of Rejection :</font></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\"><span style=\"font-weight: bolder;\">{{admin_details}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br><br><br></div><div></div><div></div>', 'Admin Rejected Your {{amount}} {{site_currency}} withdraw request. Your Main Balance {{post_balance}}  {{method_name}} , Transaction {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this action\",\"admin_details\":\"Rejection message by the admin\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-20 20:57:46'),
(14, 'WITHDRAW_REQUEST', 'Withdraw - Requested', 'Withdraw Request Submitted Successfully', '<div style=\"font-family: Montserrat, sans-serif;\">Your withdraw request of&nbsp;<span style=\"font-weight: bolder;\">{{amount}} {{site_currency}}</span>&nbsp; via&nbsp;&nbsp;<span style=\"font-weight: bolder;\">{{method_name}}&nbsp;</span>has been submitted Successfully.<span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your withdraw:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">You will get: {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number : {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"5\">Your current Balance is&nbsp;<span style=\"font-weight: bolder;\">{{post_balance}} {{site_currency}}</span></font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br><br><br></div>', '{{amount}} {{site_currency}} withdraw requested by {{method_name}}. You will get {{method_amount}} {{method_currency}} Trx: {{trx}}', '{\"trx\":\"Transaction number for the withdraw\",\"amount\":\"Amount requested by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the withdraw method\",\"method_currency\":\"Currency of the withdraw method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after fter this transaction\"}', 1, 1, '2021-11-03 12:00:00', '2022-03-21 04:39:03'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', '{{message}}', '{{message}}', '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, 1, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(16, 'KYC_APPROVE', 'KYC Approved', 'KYC has been approved', NULL, NULL, '[]', 1, 1, NULL, NULL),
(17, 'KYC_REJECT', 'KYC Rejected Successfully', 'KYC has been rejected', NULL, NULL, '[]', 1, 1, NULL, NULL),
(18, 'STORE_APPROVED', 'Store Approved', 'Vehicle store has been approved', 'Dear {{username}},<div><br></div><div>Your vehicle store&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{store}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;has been approved successfully.</span></div><div><br></div>', 'Dear {{username}},\r\n\r\nYour vehicle store {{store}} has been approved successfully.', '{\n    \"username\":\"Store Creator\",\n    \"store\":\"Store Name\"\n}', 1, 1, NULL, '2024-03-25 01:24:14'),
(19, 'STORE_REJECTED', 'Store Rejected', 'Vehicle store has been rejected', '<span style=\"color: rgb(33, 37, 41);\">Dear {{username}},</span><div><br></div><div>Your vehicle store&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{store}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;has been rejected.</span></div><div><br></div><div>Reason :&nbsp;</div><div>{{store_feedback}}</div>', 'Dear {{username}},\r\n\r\nYour vehicle store {{store}} has been rejected.', '\n{\n    \"username\":\"Store Creator\",\n    \"store\":\"Store Name\",\n    \"store_feedback\":\"Store Rejected Reason\"\n}', 1, 1, NULL, '2024-03-25 01:24:45'),
(20, 'VEHICLE_APPROVED', 'Vehicle Approved', 'Vehicle has been approved', 'Dear {{username}},<div><br></div><div>Your vehicle has been approved successfully.</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div>', 'Your vehicle has been approved successfully.', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\"\n    }', 1, 1, NULL, '2024-04-06 01:25:48'),
(21, 'VEHICLE_REJECTED', 'Vehicle Rejected', 'Vehicle has been rejected', '<div>Dear {{username}},<div><br></div><div>Your vehicle has been rejected</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div></div><div>Rejected Reason :</div><div>{{admin_feedback}}</div>', 'Your vehicle has been rejected', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\",\n        \"admin_feedback\": \"Vehicle Rejected Reason\"\n    }', 1, 1, NULL, '2024-04-06 01:25:59'),
(22, 'VEHICLE_REQUEST', 'Vehicle Request', 'Vehicle request is pending', 'Dear {{username}},<div><br></div><div>Your vehicle request is pending</div><div>Identification No : {{identification_number}}</div><div>Manufactured By : {{brand}}</div><div>Name:{{name}}</div><div>Model: {{model}}</div><div><br></div>', 'Your vehicle request is pending', '{\n        \"username\" : \"vehicle Owner Username\",\n        \"identification_number\" : \"Vehicle Identification Number\",\n        \"brand\":\"Vehicle Manufactured By\",\n        \"name\" : \"Vehicle Name\",\n        \"model\": \"Vehicle Model\"\n    }', 1, 1, NULL, '2024-04-06 01:01:32'),
(23, 'RENTAL_REQUEST', 'Rental Request', 'Rental request is pending', '<div><div>Dear {{username}},</div><div><br></div><div>Thank you for choosing our rental service! We are pleased to confirm your recent rental request with the following details:</div><div><br></div><div>Rental Number:{{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Your request is now being processed, and we will notify you once it\'s approved. If you have any questions or need further assistance, please don\'t hesitate to contact us.</div></div>', 'Your request is now being processed, and we will notify you once it\'s approved. If you have any questions or need further assistance, please don\'t hesitate to contact us.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, NULL, '2024-04-02 00:27:42'),
(24, 'VEHICLE_RENTAL_REQUEST', 'Vehicle Rental Request', 'Rental Request for Your Vehicle', '<div>Dear {{username}}</div><div><br></div><div>We hope this email finds you well. We wanted to inform you that a rental request has been made for your vehicle with the following details:</div><div><br></div><div>Rental Request By: {{rented_user}}</div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Your vehicle has been requested for rental, and we are currently processing the request. We will keep you updated on the status of the rental request.</div>', 'We wanted to inform you that a rental request has been made for your vehicle', '{\r\n\"username\": \"Vehicle Owner\",\r\n  \"rented_user\": \"Requested For Rent\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, NULL, '2024-04-02 00:28:00'),
(25, 'RENTAL_APPROVED', 'Rental Approved', 'Rental Request Approved', '<div>Dear {{username}},</div><div><br></div><div>We\'re excited to inform you that your rental request has been approved! You can now proceed with the rental of the following vehicle:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Your rental request has been confirmed, and the vehicle is ready for pickup. Please review the details and make the necessary arrangements to collect the vehicle.</div>', 'We\'re excited to inform you that your rental request has been approved!', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, NULL, '2024-04-02 00:27:22'),
(26, 'RENTAL_CANCELLED', 'Rental Cancelled', 'Rental Request Cancelled', '<div>Dear {{username}}</div><div><br></div><div>We regret that the vehicle owner has canceled your rental request. We apologize for any inconvenience this may cause.</div><div><br></div><div>The rental request for the following vehicle has been canceled:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div>Post Balance:{{post_balance}}</div><div><br></div><div>If you have any questions or need further assistance, please don\'t hesitate to contact us</div>', 'We regret that the vehicle owner has canceled your rental request.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\",\n\"post_balance\":\"User Post Balance\"\n}', 1, 1, NULL, '2024-04-02 00:39:21'),
(27, 'RENTAL_ONGOING', 'Rental On Going', 'Rental Vehicle Ongoing', '<div>Dear {{username}},</div><div><br></div><div>We want to inform you that the vehicle owner has accessed the ongoing rental for driving the vehicle.</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for your understanding.<br></div>', 'We want to inform you that the vehicle owner has accessed the ongoing rental for driving the vehicle.', '{\r\n  \"username\": \"Requested For Rent\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, NULL, '2024-04-02 02:21:44'),
(28, 'RENTAL_VEHICLE_RECEIVED', 'Rental Vehicel Received', 'Rental Vehicel Received', '<div>Dear {{username}},</div><div><br></div><div>We are writing to inform you that the vehicle owner has accessed the ongoing rental to drive the vehicle. During this time, please be aware that the vehicle may be temporarily unavailable for pickup or dropoff.</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for your understanding.<br></div>', 'We are writing to inform you that the vehicle owner has accessed the ongoing rental to drive the vehicle. During this time, please be aware that the vehicle may be temporarily unavailable for pickup or dropoff.', '{\r\n  \"username\": \"Receiving Store Username\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, NULL, '2024-04-02 02:24:58'),
(29, 'RENTAL_COMPLETED', 'Rental Completed', 'Rental Vehicle Completed', '<div>Dear {{username}},</div><div><br></div><div>We are pleased to inform you that the rental for the following vehicle has been completed:</div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for choosing our rental service. We hope you had a pleasant experience. If you have any feedback or questions, please feel free to reach out to us.<br></div>', 'We are pleased to inform you that the rental for the following vehicle has been completed.', '{\n  \"username\": \"Requested For Rent\",\n  \"rent_no\": \"Rent Request Number\",\n  \"brand\": \"Vehicle Brand\",\n  \"name\": \"Vehicle Name\",\n  \"model\": \"Vehicle Model\",\n  \"price\": \"Rented Price\",\n  \"start_date\": \"Rent Started At\",\n  \"end_date\": \"Rent End At\",\n  \"pickup\": \"Pickup Location\",\n  \"dropoff\": \"Drop Off Location\"\n}', 1, 1, NULL, '2024-04-03 23:11:36'),
(30, 'VEHICLE_RETURN_CONFIRMATION', 'Vehicle Return Confirmation', 'Vehicle Return Confirmation', '<div>Dear {{username}},</div><div><br></div><div>We\'re pleased to inform you that the rental for your vehicle has been completed. The vehicle has been returned according to the agreed terms and conditions.<br></div><div><br></div><div>Rental Number: {{rent_no}}</div><div>Vehicle Brand: {{brand}}</div><div>Vehicle Name: {{name}}</div><div>Vehicle Model: {{model}}</div><div>Rental Price: {{price}} {{site_currency}}</div><div>Start Date: {{start_date}}</div><div>End Date: {{end_date}}</div><div>Pickup Location: {{pickup}}</div><div>Dropoff Location: {{dropoff}}</div><div><br></div><div>Thank you for being part of our rental network. If you have any questions or require further assistance, please don\'t hesitate to contact us.<br></div>', 'We\'re pleased to inform you that the rental for your vehicle has been completed. The vehicle has been returned according to the agreed terms and conditions.', '{\r\n  \"username\": \"Vehicle Owner\",\r\n  \"rent_no\": \"Rent Request Number\",\r\n  \"brand\": \"Vehicle Brand\",\r\n  \"name\": \"Vehicle Name\",\r\n  \"model\": \"Vehicle Model\",\r\n  \"price\": \"Rented Price\",\r\n  \"start_date\": \"Rent Started At\",\r\n  \"end_date\": \"Rent End At\",\r\n  \"pickup\": \"Pickup Location\",\r\n  \"dropoff\": \"Drop Off Location\"\r\n}', 1, 1, NULL, '2024-04-03 23:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `slug` varchar(40) DEFAULT NULL,
  `tempname` varchar(40) DEFAULT NULL COMMENT 'template name',
  `secs` text DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"how_to_work\",\"vehicle\",\"feature\",\"partner\",\"service\",\"faq\",\"cta\",\"testimonial\",\"cta_contact\",\"blog\"]', 1, '2020-07-11 06:23:58', '2024-06-23 05:52:32'),
(4, 'Blog', 'blog', 'templates.basic.', '[\"cta_contact\"]', 1, '2020-10-22 01:14:43', '2024-03-26 22:14:22'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, 1, '2020-10-22 01:14:53', '2024-04-08 00:11:56'),
(19, 'About', 'about', 'templates.basic.', '[\"about\",\"support\",\"why_choose_us\",\"cta\",\"faq\",\"blog\"]', 0, '2024-03-26 03:55:09', '2024-06-25 01:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) DEFAULT NULL,
  `token` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `vehicle_user_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pick_up_zone_id` int(11) NOT NULL DEFAULT 0,
  `drop_off_zone_id` int(11) NOT NULL DEFAULT 0,
  `pick_up_location_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `drop_off_location_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `price` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `rent_no` varchar(40) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `rental_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_id` int(11) NOT NULL DEFAULT 0,
  `star` tinyint(1) NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_message_id` int(10) UNSIGNED DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `support_ticket_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `message` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `ticket` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `remark` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(40) DEFAULT NULL,
  `update_log` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` int(11) NOT NULL DEFAULT 0,
  `zone_id` int(11) NOT NULL DEFAULT 0,
  `firstname` varchar(40) DEFAULT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `country_code` varchar(40) DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `ref_by` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL COMMENT 'contains full address',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: banned, 1: active',
  `kyc_data` text DEFAULT NULL,
  `kv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: KYC Unverified, 2: KYC pending, 1: KYC verified',
  `ev` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT 0,
  `store` tinyint(1) NOT NULL DEFAULT 0,
  `store_data` text DEFAULT NULL,
  `store_feedback` varchar(255) DEFAULT NULL,
  `ver_code` varchar(40) DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `ts` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: 2fa off, 1: 2fa on',
  `tv` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: 2fa unverified, 1: 2fa verified',
  `tsc` varchar(255) DEFAULT NULL,
  `login_by` varchar(255) DEFAULT NULL,
  `ban_reason` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `location_id`, `zone_id`, `firstname`, `lastname`, `username`, `email`, `country_code`, `mobile`, `ref_by`, `balance`, `password`, `address`, `image`, `status`, `kyc_data`, `kv`, `ev`, `sv`, `profile_complete`, `store`, `store_data`, `store_feedback`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `login_by`, `ban_reason`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'Swaroop', 'Dash', 'selfdrivezone', 'skg.otp2@gmail.com', 'IN', '919692126454', 0, 0.00000000, '$2y$10$Xf78YUj4FzaFX3hgJPJDAe3c2HUzpeMPe8.KBCPIcAzR9U/3zQuEa', '{\"country\":\"India\",\"address\":\"Buxi bazar\",\"state\":\"Odisha\",\"zip\":\"753002\",\"city\":\"Cuttack\"}', NULL, 1, NULL, 1, 1, 1, 1, 0, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2024-08-23 13:58:02', '2024-08-23 13:58:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `country_code` varchar(40) DEFAULT NULL,
  `longitude` varchar(40) DEFAULT NULL,
  `latitude` varchar(40) DEFAULT NULL,
  `browser` varchar(40) DEFAULT NULL,
  `os` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `user_ip`, `city`, `country`, `country_code`, `longitude`, `latitude`, `browser`, `os`, `created_at`, `updated_at`) VALUES
(1, 1, '152.58.167.97', '', 'India', 'IN', '88.367', '22.572', 'Chrome', 'Windows 10', '2024-08-23 13:58:02', '2024-08-23 13:58:02'),
(2, 1, '152.58.167.253', '', 'India', 'IN', '88.367', '22.572', 'Chrome', 'Windows 10', '2024-08-24 07:47:01', '2024-08-24 07:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_type_id` int(11) NOT NULL DEFAULT 0,
  `vehicle_class_id` int(11) NOT NULL DEFAULT 0,
  `brand_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `model` varchar(40) DEFAULT NULL,
  `cc` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `bhp` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `speed` int(11) NOT NULL DEFAULT 0,
  `cylinder` int(11) NOT NULL DEFAULT 0,
  `year` year(4) DEFAULT NULL,
  `color` varchar(40) DEFAULT NULL,
  `identification_number` varchar(40) DEFAULT NULL,
  `mileage` varchar(40) DEFAULT NULL,
  `vehicle_condition` varchar(40) DEFAULT NULL,
  `transmission_type` varchar(40) DEFAULT NULL,
  `fuel_type` varchar(40) DEFAULT NULL,
  `seat` tinyint(1) DEFAULT 0,
  `price` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `total_run` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `image` varchar(40) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `rating` decimal(5,2) NOT NULL DEFAULT 0.00,
  `rented` tinyint(1) NOT NULL DEFAULT 0,
  `approval_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `admin_feedback` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_classes`
--

CREATE TABLE `vehicle_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_type_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `manage_class` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `description`, `slug`, `image`, `manage_class`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hatchback Cars', 'Enjoy compact and efficient travel with our self-drive hatchback car rentals in Cuttack and Bhubaneswar. Perfect for city driving and short trips, our hatchbacks are economical, easy to maneuver, and great for navigating busy streets.', 'hatchback-cars_1724400477', '66c8419ff243a1724400031.webp', 0, 1, '2024-08-23 13:30:31', '2024-08-23 13:37:57'),
(2, 'SUV Cars', 'Explore the city or take on rugged terrains with our self-drive SUV car rentals in Cuttack and Bhubaneswar. Perfect for long road trips or family adventures, our spacious SUVs offer comfort, power, and premium features for a thrilling driving experience.', 'suv-cars_1724400447', '66c8433f2f0141724400447.webp', 0, 1, '2024-08-23 13:37:27', '2024-08-23 13:37:27'),
(3, 'Sedan Cars', 'Experience luxury and comfort with our self-drive sedan cars in Cuttack and Bhubaneswar. Ideal for business trips, city cruising, or weekend getaways, our sedan rentals offer smooth rides and high-end features for the ultimate driving pleasure.', 'sedan-cars_1724400519', '66c84387146711724400519.webp', 0, 1, '2024-08-23 13:38:39', '2024-08-23 13:38:39'),
(4, 'Luxury Cars', 'Indulge in a premium driving experience with our self-drive luxury car rentals in Cuttack and Bhubaneswar. Whether it’s a special occasion or you simply want to travel in style, our luxury cars offer unmatched comfort, performance, and elegance.', 'luxury-cars_1724400563', '66c843b385d761724400563.webp', 0, 1, '2024-08-23 13:39:23', '2024-08-23 13:39:23'),
(5, 'MPV Cars', 'Need space for the whole family or group? Rent a self-drive MPV in Cuttack and Bhubaneswar for maximum comfort and space. Ideal for long-distance road trips or family vacations, our MPVs ensure everyone travels together with ease and comfort.', 'mpv-cars_1724400600', '66c843d8e5bfe1724400600.webp', 0, 1, '2024-08-23 13:40:00', '2024-08-23 13:40:00'),
(6, 'Electric Cars', 'Go green and rent a self-drive electric car in Cuttack and Bhubaneswar. Enjoy eco-friendly travel with zero emissions while experiencing modern technology and impressive range. Perfect for environmentally conscious drivers.', 'electric-cars_1724400742', '66c84466e58f41724400742.webp', 0, 1, '2024-08-23 13:42:22', '2024-08-23 13:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_zones`
--

CREATE TABLE `vehicle_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `zone_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `method_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `currency` varchar(40) DEFAULT NULL,
  `rate` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx` varchar(40) DEFAULT NULL,
  `final_amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `after_charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `withdraw_information` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>success, 2=>pending, 3=>cancel,  ',
  `admin_feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(40) DEFAULT NULL,
  `min_limit` decimal(28,8) DEFAULT 0.00000000,
  `max_limit` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `fixed_charge` decimal(28,8) DEFAULT 0.00000000,
  `rate` decimal(28,8) DEFAULT 0.00000000,
  `percent_charge` decimal(5,2) DEFAULT NULL,
  `currency` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `coordinates` text DEFAULT NULL,
  `zoom` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`id`, `name`, `coordinates`, `zoom`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bhubaneswar', '20.305945,85.540027,20.226072,85.56612,20.169363,85.640277,20.133265,85.713062,20.122949,85.853138,20.175808,85.980854,20.213185,86.041278,20.287913,86.063251,20.331702,86.041278,20.397362,85.949268,20.416669,85.752887,20.403798,85.616931,20.329126,85.542774', 10, 1, '2024-08-23 13:49:07', '2024-08-23 13:49:07'),
(2, 'Cuttack', '20.433451,85.718263,20.415112,85.738519,20.408355,85.830186,20.405781,85.889924,20.408999,85.941423,20.422191,85.988458,20.517397,85.955842,20.535724,85.944169,20.529937,85.811647,20.512574,85.765298,20.482667,85.739549,20.464977,85.716203', 12, 1, '2024-08-23 13:49:53', '2024-08-23 13:49:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_classes`
--
ALTER TABLE `vehicle_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_zones`
--
ALTER TABLE `vehicle_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_classes`
--
ALTER TABLE `vehicle_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle_zones`
--
ALTER TABLE `vehicle_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
