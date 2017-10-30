-- MySQL dump 10.13  Distrib 5.7.18, for Win32 (AMD64)
--
-- Host: localhost    Database: grabamazon
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `amazon_bad_words`
--

DROP TABLE IF EXISTS `amazon_bad_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_bad_words` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_bad_words`
--

LOCK TABLES `amazon_bad_words` WRITE;
/*!40000 ALTER TABLE `amazon_bad_words` DISABLE KEYS */;
INSERT INTO `amazon_bad_words` VALUES (1,'Privacy Notice'),(2,'Conditions of Use'),(3,'Prime PhotosUnlimited Photo Storage Free With Prime'),(4,'Prime NowFREE 2-Hour Delivery on Everyday Items'),(5,'Junglee.comShop Online in India'),(6,'IMDbMovies, TV & Celebrities'),(7,'Interest-Based Ads'),(8,'Help'),(9,'Your Account'),(10,'Your Orders'),(11,'Amazon.com Store Card'),(12,'See all'),(13,'Self-Publish with Us'),(14,'Sell on Amazon Business'),(15,'Sell Your Services on Amazon'),(16,'Try Prime'),(17,'Orders'),(18,'Hello. Sign inAccount & ListsSign inAccount & Lists'),(19,'Create a List'),(20,'Find a Gift'),(21,'Save Items from the Web'),(22,'Get started'),(23,'Sign in'),(24,'Start here.'),(25,'Start here'),(26,'Sign in securely'),(27,'Learn more about Amazon Prime.'),(28,'Gift Cards & Registry'),(29,'Your Amazon.com'),(30,'Cart0'),(31,'Amazon'),(32,'Your Video Subscriptions'),(33,'Your Music Subscriptions'),(34,'Your Garage'),(35,'Register for a Business Account'),(36,'Your Prime Membership'),(37,'Your Digital Subscriptions'),(38,'Your Subscribe & Save Items'),(39,'Your Recommendations'),(40,'Your Lists'),(41,'Pantry Lists'),(42,'Your Hearts'),(43,'Friends & Family Gifting'),(44,'School Lists'),(45,'Back to top'),(46,'Sign in to view orders'),(47,'Amazon Devices'),(48,'alt='),(49,'View Cart(0 items)(0 item)(0 items)'),(50,'View all orders'),(51,'id=      src= alt=/'),(52,'go to your cart'),(53,'Items in your Cart'),(54,'Prime Pantry Items'),(55,'Your Android Apps & Devices'),(56,'Your Video Library'),(57,'Your Kindle Unlimited'),(58,'Your Prime Video'),(59,'Your Prime Photos'),(60,'Your Music Library'),(61,'About Amazon'),(62,'Your Watchlist'),(63,'Manage Your Content and Devices'),(64,'Your Amazon Credit Card Accounts'),(65,'Your Service Requests'),(66,'Wedding Registry'),(67,'Amazon.com Rewards Visa Card'),(68,'Become an Amazon Vendor'),(69,'Amazon.com Corporate Credit Line'),(70,'Shop with Points'),(71,'Reload Your Balance'),(72,'Amazon BusinessEverything For Your Business'),(73,'Home ServicesHandpicked Pros Happiness Guarantee'),(74,'AmazonGlobalShip Orders Internationally'),(75,'Mexico'),(76,'Brazil'),(77,'Australia'),(78,'Amazon Assistant'),(79,'Returns & Replacements'),(80,'Shipping Rates & Policies'),(81,'Become an Affiliate'),(82,'Sell on Amazon'),(83,'AmazonFreshGroceries & More Right To Your Door'),(84,'Credit Card Marketplace'),(85,'Amazon Prime'),(86,'Find a List or Registry'),(87,'Baby Registry');
/*!40000 ALTER TABLE `amazon_bad_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_categoies`
--

DROP TABLE IF EXISTS `amazon_categoies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_categoies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `in_hot` tinyint(1) DEFAULT NULL,
  `in_focus` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `links` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_categoies`
--

LOCK TABLES `amazon_categoies` WRITE;
/*!40000 ALTER TABLE `amazon_categoies` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_categoies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_focus_tags`
--

DROP TABLE IF EXISTS `amazon_focus_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_focus_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_focus_tags`
--

LOCK TABLES `amazon_focus_tags` WRITE;
/*!40000 ALTER TABLE `amazon_focus_tags` DISABLE KEYS */;
INSERT INTO `amazon_focus_tags` VALUES (2,'clothes',1),(3,'women\'s dresses',1),(4,'cloth',1),(5,'dress',1),(6,'polo',1),(7,'shirt',1),(8,'shoes',1),(9,'ring',1);
/*!40000 ALTER TABLE `amazon_focus_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_html_rules`
--

DROP TABLE IF EXISTS `amazon_html_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_html_rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind` tinyint(2) DEFAULT NULL,
  `rule_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `query_selector_1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `query_selector_2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `query_selector_3` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `query_selector_4` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `query_selector_5` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rule_string` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_regular` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_is_regular` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_html_rules`
--

LOCK TABLES `amazon_html_rules` WRITE;
/*!40000 ALTER TABLE `amazon_html_rules` DISABLE KEYS */;
INSERT INTO `amazon_html_rules` VALUES (5,1,'url','分类里的链接','.s-result-list a',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'url','分类里的链接','#merchandised-content a',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'url','分类里的分页','.pagnLink a',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,'url','bester seller的分页','.zg_page a',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,'invalid_url','排除无用链接','#customerReviews','/offer-listing/',NULL,NULL,NULL,NULL,NULL,NULL),(7,1,'url','产品页的链接','.bucket a',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,2,'mbc','跟卖数','.mbc-offer-row',NULL,NULL,NULL,NULL,NULL,NULL,0),(9,2,'reviews','评论数','#acrCustomerReviewText',NULL,NULL,NULL,NULL,'customer reviews','/^[1-9]\\d*/',1),(10,2,'asks','问答数','#askATFLink',NULL,NULL,NULL,NULL,'answered questions','/^[1-9]\\d*/',1),(11,2,'rank','Ranks','.prodDetTable .prodDetSectionEntry',NULL,NULL,NULL,NULL,NULL,NULL,0),(12,1,'url','分类里的链接','#centerSlots a',NULL,NULL,NULL,NULL,NULL,NULL,0),(13,2,'rank','Ranks','#SalesRank',NULL,NULL,NULL,NULL,NULL,NULL,0),(14,2,'rank','Ranks','#productDetailsTable #SalesRank',NULL,NULL,NULL,NULL,NULL,NULL,0),(15,1,'invalid_url','帮助类url过滤','/help/','/customer/','/product-reviews/','/forum',NULL,NULL,NULL,0),(16,2,'name','商品标题','title',NULL,NULL,NULL,NULL,NULL,NULL,0),(17,2,'name','商品标题','#productTitle',NULL,NULL,NULL,NULL,NULL,NULL,0),(18,2,'description','商品描述','#aplus',NULL,NULL,NULL,NULL,NULL,NULL,0),(19,2,'price','商品价格','#priceblock_ourprice',NULL,NULL,NULL,NULL,NULL,NULL,0),(20,2,'description','商品描述','#feature-bullets',NULL,NULL,NULL,NULL,NULL,NULL,0),(21,2,'images','商品图片','div#imageBlock_feature_div',NULL,NULL,NULL,NULL,'register(\"ImageBlockATF\"','/hiRes\\\":\\\"(.*?)\\\"/i',1);
/*!40000 ALTER TABLE `amazon_html_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_nok_products`
--

DROP TABLE IF EXISTS `amazon_nok_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_nok_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_nok_products`
--

LOCK TABLES `amazon_nok_products` WRITE;
/*!40000 ALTER TABLE `amazon_nok_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_nok_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_categoies`
--

DROP TABLE IF EXISTS `amazon_ok_categoies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_categoies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(2000) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `in_hot` tinyint(1) DEFAULT NULL,
  `in_focus` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `step` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_categoies`
--

LOCK TABLES `amazon_ok_categoies` WRITE;
/*!40000 ALTER TABLE `amazon_ok_categoies` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_ok_categoies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_product_images`
--

DROP TABLE IF EXISTS `amazon_ok_product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_product_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id_2` (`product_id`,`image`),
  KEY `amazon_ok_product_images_product_id_index` (`product_id`),
  KEY `product_id` (`product_id`),
  KEY `label` (`label`),
  KEY `image` (`image`),
  KEY `sort_order` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_product_images`
--

LOCK TABLES `amazon_ok_product_images` WRITE;
/*!40000 ALTER TABLE `amazon_ok_product_images` DISABLE KEYS */;
INSERT INTO `amazon_ok_product_images` VALUES (1,66,NULL,'B01LZ6ZV03_71HBgctxp-L_UL1500_.jpg',0),(2,66,NULL,'B01LZ6ZV03_61u4-ZXpa6L_UL1500_.jpg',0),(3,66,NULL,'B01LZ6ZV03_719S2okWYwL_UL1500_.jpg',0),(4,67,'Flywm Women\'s Casual Long Sleeve Crew Neck Button Decor T Shirt Tunic Top Loose Blouse','B074LFNQQ4_61mY0pOxMIL_UL1500_.jpg',0),(5,67,'Flywm Women\'s Casual Long Sleeve Crew Neck Button Decor T Shirt Tunic Top Loose Blouse','B074LFNQQ4_619EG8KxeJL_UL1500_.jpg',0),(6,67,'Flywm Women\'s Casual Long Sleeve Crew Neck Button Decor T Shirt Tunic Top Loose Blouse','B074LFNQQ4_61Cn5v6u9hL_UL1500_.jpg',0),(7,67,'Flywm Women\'s Casual Long Sleeve Crew Neck Button Decor T Shirt Tunic Top Loose Blouse','B074LFNQQ4_711jBDIHk6L_UL1500_.jpg',0),(8,68,'Yidarton Womens Tops Chiffon Long Sleeve Shirts Casual Blouse','B01FFA8SL2_513oCSzHNeL_UL1500_.jpg',0),(9,68,'Yidarton Womens Tops Chiffon Long Sleeve Shirts Casual Blouse','B01FFA8SL2_51XDpXQwyTL_UL1500_.jpg',0),(10,68,'Yidarton Womens Tops Chiffon Long Sleeve Shirts Casual Blouse','B01FFA8SL2_61jTLJV4EuL_UL1500_.jpg',0),(11,68,'Yidarton Womens Tops Chiffon Long Sleeve Shirts Casual Blouse','B01FFA8SL2_613mi-8WYXL_UL1500_.jpg',0),(12,69,'ECOWISH Womens Floral Printed V-Neck Long Sleeves Geometric Pattern Blouses Casual Tops','B072KK61RW_81GdR8BGyNL_UL1500_.jpg',0),(13,69,'ECOWISH Womens Floral Printed V-Neck Long Sleeves Geometric Pattern Blouses Casual Tops','B072KK61RW_81zISIP4YxL_UL1500_.jpg',0),(14,69,'ECOWISH Womens Floral Printed V-Neck Long Sleeves Geometric Pattern Blouses Casual Tops','B072KK61RW_81G2V5m6OjL_UL1500_.jpg',0),(15,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61a-Ey61MHL_UL1500_.jpg',0),(16,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_51LJaJL2BezL_UL1500_.jpg',0),(17,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61xcFqQigUL_UL1500_.jpg',0),(18,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61Lg41L90nL_UL1500_.jpg',0),(19,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61VS6aV7rhL_UL1500_.jpg',0),(20,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61t0xPs4CZL_UL1500_.jpg',0),(21,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_51vZqlSB2tL_UL1500_.jpg',0),(22,31,'Adult Sheer Wrap Skirt,TH5109','B00AMPZEOK_61EqSnzPBmL_UL1500_.jpg',0),(23,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_81Dq0TpXbEL_UL1500_.jpg',0),(24,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_81UdHyN2BeLL_UL1500_.jpg',0),(25,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_81YB0uwzIEL_UL1500_.jpg',0),(26,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_91PHeENqrBL_UL1500_.jpg',0),(27,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_813wMLvh8CL_UL1500_.jpg',0),(28,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_A1JQw-HhXJL_UL1500_.jpg',0),(29,35,'Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','B0748DKWNS_614RksumyrL_UL1500_.jpg',0),(30,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_51OqycUCyKL_SL1200_.jpg',0),(31,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_61itk-R58CL_SL1200_.jpg',0),(32,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_71C2Bu4W40lL_SL1200_.jpg',0),(33,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_71Kn7W59cQL_SL1200_.jpg',0),(34,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_71nfIeYEcML_SL1200_.jpg',0),(35,16,'Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','B00VX9WN34_61jriPDq0gL_SL1200_.jpg',0),(36,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_81RtMMKmysL_UL1500_.jpg',0),(37,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_71t9Fexwk1L_UL1500_.jpg',0),(38,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_71Da6RJ3bKL_UL1500_.jpg',0),(39,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_71s02EGIN3L_UL1500_.jpg',0),(40,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_81zGwoy4glL_UL1500_.jpg',0),(41,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_81ZNYmw6QVL_UL1500_.jpg',0),(42,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_81dcoq2BWPgL_UL1500_.jpg',0),(43,4,'Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','B01MYA52EH_815wgqouXoL_UL1500_.jpg',0);
/*!40000 ALTER TABLE `amazon_ok_product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_product_option_provs`
--

DROP TABLE IF EXISTS `amazon_ok_product_option_provs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_product_option_provs` (
  `product_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  KEY `amazon_ok_product_option_provs_product_id_index` (`product_id`),
  KEY `amazon_ok_product_option_provs_option_id_index` (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_product_option_provs`
--

LOCK TABLES `amazon_ok_product_option_provs` WRITE;
/*!40000 ALTER TABLE `amazon_ok_product_option_provs` DISABLE KEYS */;
INSERT INTO `amazon_ok_product_option_provs` VALUES (67,1);
/*!40000 ALTER TABLE `amazon_ok_product_option_provs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_product_option_values`
--

DROP TABLE IF EXISTS `amazon_ok_product_option_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_product_option_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amazon_ok_product_option_values_option_id_index` (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_product_option_values`
--

LOCK TABLES `amazon_ok_product_option_values` WRITE;
/*!40000 ALTER TABLE `amazon_ok_product_option_values` DISABLE KEYS */;
INSERT INTO `amazon_ok_product_option_values` VALUES (1,1,'Red',0,0),(2,1,'Green',1,0),(3,1,'Blue',2,0),(4,1,'Yellow',3,0);
/*!40000 ALTER TABLE `amazon_ok_product_option_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_product_options`
--

DROP TABLE IF EXISTS `amazon_ok_product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_product_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `format` text COLLATE utf8_unicode_ci,
  `format_value` text COLLATE utf8_unicode_ci,
  `typecsvname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `amazon_ok_product_options_label_index` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_product_options`
--

LOCK TABLES `amazon_ok_product_options` WRITE;
/*!40000 ALTER TABLE `amazon_ok_product_options` DISABLE KEYS */;
INSERT INTO `amazon_ok_product_options` VALUES (1,'Color','drop_down','',0,NULL,NULL,NULL),(6,'Size','drop_down','M',0,'Size:drop_down:20:1 ','S:fixed:0.00:17||M:fixed:0.00:18||L:fixed:0.00:19||XL:fixed:0.00:20||2XL:fixed:0.00:21||3XL:fixed:0.00:22 ',NULL);
/*!40000 ALTER TABLE `amazon_ok_product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_product_ranks`
--

DROP TABLE IF EXISTS `amazon_ok_product_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_product_ranks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `catalog_id` int(11) DEFAULT NULL,
  `mbc` int(11) DEFAULT NULL,
  `reviews` int(11) DEFAULT NULL,
  `asks` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT '0',
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_product_ranks`
--

LOCK TABLES `amazon_ok_product_ranks` WRITE;
/*!40000 ALTER TABLE `amazon_ok_product_ranks` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_ok_product_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_ok_products`
--

DROP TABLE IF EXISTS `amazon_ok_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_ok_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) DEFAULT NULL,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `rank` text CHARACTER SET utf8,
  `up_or_down` int(11) DEFAULT NULL,
  `up_or_down_diff` int(11) DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  `price` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mbc` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `typecsvname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品类型',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_format` text COLLATE utf8_unicode_ci,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size_format` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_ok_products`
--

LOCK TABLES `amazon_ok_products` WRITE;
/*!40000 ALTER TABLE `amazon_ok_products` DISABLE KEYS */;
INSERT INTO `amazon_ok_products` VALUES (1,NULL,'B01N2U1IBQ','Columbia Women\'s Glacial Fleece III 1/2 Zip Jacket','https://www.amazon.com/Columbia-Sizeanytime-Outdoor-Boulder-Regular/dp/B01N2U1IBQ/ref=sr_1_3?s=apparel&ie=UTF8&qid=1505009860&sr=1-3&nodeID=7141123011&psd=1&keywords=outdoor&refinements=p_n_feature_eighteen_browse-bin%3A14630392011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$19.99 - $73.89',0,'Feather Weight Fleece: 100% Polyester Importado Zipper closure Machine Wash Omni-shade UPF 50 sun protection Active fit',NULL,NULL,NULL,NULL,NULL),(3,NULL,'B0131LJM5I','KEEN Men\'s Glenhaven - M Shoe','https://www.amazon.com/KEEN-Mens-Glenhaven-Cascade-Brown/dp/B0131LJM5I/ref=sr_1_8?s=apparel&ie=UTF8&qid=1505014459&sr=1-8&nodeID=7141123011&psd=1&keywords=outdoor&refinements=p_n_feature_eighteen_browse-bin%3A14630392011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$62.52 - $120.00',0,'Leather Made in the USA and Imported Rubber sole Breathable leather lining.',NULL,NULL,NULL,NULL,NULL),(4,NULL,'B01MYA52EH','Skechers Performance Men\'s Go Outdoors 2 Walking Shoe','https://www.amazon.com/Skechers-Performance-Outdoors-Walking-Charcoal/dp/B01MYA52EH/ref=sr_1_9?s=apparel&ie=UTF8&qid=1505014459&sr=1-9&nodeID=7141123011&psd=1&keywords=outdoor&refinements=p_n_feature_eighteen_browse-bin%3A14630392011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$50.99 - $87.00',0,'Leather and Textile Imported Rubber sole Lightweight and responsive 5gen cushioning Skechers goga max high rebound insole Water resistant upper Durable traction outsole',NULL,NULL,NULL,NULL,NULL),(5,NULL,'B074PS8GF6','Dearfoams Women\'s Indoor/Outdoor Mixed Material Slipper Booties with Faux Shearling Lining','https://www.amazon.com/Dearfoams-Outdoor-Material-Slipper-Shearling/dp/B074PS8GF6/ref=sr_1_16?s=apparel&ie=UTF8&qid=1505014459&sr=1-16&nodeID=7141123011&psd=1&keywords=outdoor&refinements=p_n_feature_eighteen_browse-bin%3A14630392011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$19.95 - $34.95',0,'fabric-and-synthetic Get cozy with a pair of these supremely comfortable slipper booties from Dearfoams! Premium Duraluxe high-density foam cushioning and plush faux shearling lining for indulgent comfort! Slip-resistant, indoor/outdoor soles Machine washable All manmade materials.',NULL,NULL,NULL,NULL,NULL),(6,NULL,'B01D3XL09A','Calvin Klein Jeans Women\'s Ultimate Skinny Jean','https://www.amazon.com/Calvin-Klein-Womens-Ultimate-Skinny/dp/B01D3XL09A/ref=sr_1_9?s=apparel&ie=UTF8&qid=1505015754&sr=1-9&nodeID=1048188&psd=1&keywords=outdoor',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$9.99 - $54.99',0,'95% Cotton, 3% Other Fibers, 2% Elastane Imported Machine Wash Fabric content varies by color. Please select color above to see fabric content. Ultimate Skinny jean featuring five-pocket styling with signature omega stitch on back pocket Leg Opening: 12\" Button with zipper fly closure These jeans can be elevated with heels and a CK knit top, or dressed down with flats and a Calvin Klein logo t-shirt for a modern look',NULL,NULL,NULL,NULL,NULL),(7,NULL,'B002D47XL0','Capezio Daisy 205 Ballet Shoe (Toddler/Little Kid)','https://www.amazon.com/dp/B002D47XL0/ref=twister_B002G9UFNK',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$13.37 - $23.00',0,'Leather Imported Leather sole Refer to the Shoe fit guide in images for proper sizing. Order one size up Constructed of high quality, lightweight, soft, durable leather, Bar-tacked elastic drawstring Full chrome tanned suede leather outsole for durability. Wider fit, shaped on a generous women\'s last. Begin with street shoe size Daisy print on hung cotton lining, Unisex no-print lining for black colorway5/8\" pre-attached one-sided plush elastic rolls with the foot and does not dig inPlease note that Childrens shoes are cut wider and a size 1 child is equivalent to a size 3 adultShow more',NULL,NULL,NULL,NULL,NULL),(8,NULL,'B0002USBAE','Capezio Daisy 205 Ballet Shoe (Toddler/Little Kid)','https://www.amazon.com/dp/B0002USBAE/ref=twister_B002G9UFNK?th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$13.37 - $23.00',0,'Leather Imported Leather sole Refer to the Shoe fit guide in images for proper sizing. Order one size up Constructed of high quality, lightweight, soft, durable leather, Bar-tacked elastic drawstring Full chrome tanned suede leather outsole for durability. Wider fit, shaped on a generous women\'s last. Begin with street shoe size Daisy print on hung cotton lining, Unisex no-print lining for black colorway5/8\" pre-attached one-sided plush elastic rolls with the foot and does not dig inPlease note that Childrens shoes are cut wider and a size 1 child is equivalent to a size 3 adultShow more',NULL,NULL,NULL,NULL,NULL),(9,NULL,'B0002USEH4','Capezio Daisy 205 Ballet Shoe (Toddler/Little Kid)','https://www.amazon.com/dp/B0002USEH4/ref=twister_B002G9UFNK?th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$13.37 - $23.00',0,'Leather Imported Leather sole Refer to the Shoe fit guide in images for proper sizing. Order one size up Constructed of high quality, lightweight, soft, durable leather, Bar-tacked elastic drawstring Full chrome tanned suede leather outsole for durability. Wider fit, shaped on a generous women\'s last. Begin with street shoe size Daisy print on hung cotton lining, Unisex no-print lining for black colorway5/8\" pre-attached one-sided plush elastic rolls with the foot and does not dig inPlease note that Childrens shoes are cut wider and a size 1 child is equivalent to a size 3 adultShow more',NULL,NULL,NULL,NULL,NULL),(10,NULL,'B008MWJWRK','Columbia Women\'s Anytime Outdoor Boot Cut Pant','https://www.amazon.com/Columbia-Womens-Anytime-Outdoor-Regular/dp/B008MWJWRK/ref=sr_1_12?s=apparel&ie=UTF8&qid=1505015988&sr=1-12&nodeID=7147440011&psd=1&keywords=outdoor',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$34.99 - $79.86',0,'Omni Shield Summiteer Lite: 96% Nylon, 4% Elastane Imported Drawstring closure Machine Wash Omni-shield advanced repellency Omni-shade UPF 50 sun protection 2-way comfort stretch,Omni-Shieldâ¢Water and Stain RepellentActive fit. Mid riseBoot cutShow more',NULL,NULL,NULL,NULL,NULL),(11,NULL,'B018L2WM86','Vont Bright 2 Pack Portable Outdoor LED Camping Lantern, Black, Collapsible','https://www.amazon.com/Vont-Portable-Outdoor-Camping-Collapsible/dp/B018L2WM86/ref=zg_bs_sporting-goods_2?_encoding=UTF8&psc=1&refRID=NSH0BTG0C342VVN3QZW3','Amazon Best Sellers Rank: #20 in Sports & Outdoors (See Top 100 in Sports & Outdoors)  #2 inÂ Sports & Outdoors > Outdoor Recreation > Camping & Hiking > Lights & Lanterns > Lanterns',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,1,'This fits yourÂ .      Enter your model number to make sure this fits.     P.when(\"ReplacementPartsBulletLoader\").execute(function(module){ module.initializeDPX(); }) BRIGHTEST LANTERN ON AMAZON: You will be pleasant surprised with this lantern from the moment you unbox it, insert the batteries and switch it on. As a small business we are able to deliver superior quality products & customer support than our competitors. You\'re in safe hands. MILITARY GRADE MATERIALS: Each of our premium lanterns are hand built with military grade, water resistant plastic - making them extra durable wherever you may be. The lantern is built for both the indoors & outdoors. LOW CONSUMPTION: Over 12 hours of lighting means this lantern won\'t be letting you down anytime soon. Your batteries will no longer be drained. ADVANCED COLLAPSIBLE DESIGN: Superior design and construction allows our lantern to be SUPER lightweight and compact. Our lantern is EASILY collapsible with a simple push allowing you to adjust its brightness. SUPER LONG BATTERY LIFE: Built with 30 different individual premium LEDs, our lantern is built for maximum brightness whilst maintaining a super long battery life. The lantern is compatible with rechargeable batteries!',NULL,NULL,NULL,NULL,NULL),(12,NULL,'B00ZGUADZ6','Columbia Women\'s Anytime Outdoor Long Short','https://www.amazon.com/Columbia-Womens-Anytime-Outdoor-Short/dp/B00ZGUADZ6/ref=sr_1_11?s=apparel&ie=UTF8&qid=1505016211&sr=1-11&nodeID=1040660&psd=1&keywords=outdoor&refinements=p_n_feature_eighteen_browse-bin%3A14630392011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$29.99 - $40.00',0,'96% Nylon, 4% Elastane Machine Wash Omni-shield advanced repellency Omni-shade UPF 50 sun protection 2-way comfort stretch Mid rise active fit Inseam length: 13\"',NULL,NULL,NULL,NULL,NULL),(13,NULL,'B0181ZNYIK','ZANZEA Women\'s Sexy Long Batwing Sleeve Loose Pullover Casual Top Blouse T-Shirt','https://www.amazon.com/ZANZEA-Womens-Batwing-Pullover-T-Shirt/dp/B0181ZNYIK/ref=zg_bs_2368343011_1?_encoding=UTF8&refRID=XEK6V6KRF6FC4B7MMXXJ&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$8.75 - $14.98',0,'Please Refer To The Size Details Before You Purchase.( 2cm/1 inch Inaccuracy May Exist Due To Hand Measure.) There have 6 size and 15 color you can choose,enough to meet different body and different styles, our size is Asian size,each ASIAN Size Corresponding US size: US 6-ASIAN S,US 8 = ASIAN M,US 10 = ASIAN L, US 12 = ASIAN XL, US 14-16=ASIAN 2XL, US 18-20 = ASIAN 3XL. Color: Beige, Black, Blue, Brown, Green, Gray, Orange, Red, White,Army Green,Navy,.Rose,Wine Red,Purple,Coffee ZANZEA Long Batwing Sleeve Loose Pullover Casual tops is perfect for Autumn/ Spring .Very comfortable and soft for a casual day .With O-neck and applique decoration,this loose batwing pullover shirt make you look beautiful and cute Loose, Baggy, Oversized Tunic Tops Ideal To Pair With Jeans, Leggings Or Trousers/Or it still looks cute with a camisole or Basic Tank Tops underneath too./Asymmetric Design,Elegant Top Blouse To Show Off your Charming Curves./New For This Season, An Essential For Every Fashion Women Or Girl Select Material, Suitable For Beach,Cocktail,Party,Club,Or Just Daily Wear',NULL,NULL,NULL,NULL,NULL),(14,NULL,'B0039NNBWE','Capezio Toddler/Little Kid Jr.Tyette N625C Tap Shoe','https://www.amazon.com/Capezio-Toddler-Little-Jr-Tyette-N625C/dp/B0039NNBWE/ref=zg_bs_fashion_8?_encoding=UTF8&refRID=EAEG4FEZAM293WDNN0F1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$13.99 - $30.00',0,'Synthetic Imported Synthetic sole Heel measures approximately 1\" Glossy tap shoe with ribbon tie closure Firm heel counter and light toebox for support, snug fit, and comfort Foam padded footbed',NULL,NULL,NULL,NULL,NULL),(15,NULL,'B073HP1JPZ','Columbia Women\'s Just Right Straight-Leg Pant','https://www.amazon.com/Columbia-Womens-Just-Right-Straight-Leg/dp/B073HP1JPZ/ref=pd_sim_193_5?_encoding=UTF8&refRID=58A9182HK0K7FQJW16TE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$29.16 - $60.00',0,'Omni Shield Summiteer Lite: 96% Nylon, 4% Elastane Imported Button Fly closure Machine Wash Straight-leg active pant with two-way comfort stretch featuring decorative tonal seaming and zippered security pocket at left leg Contoured waistband with button Omni-shield advanced stain repellency technology Omni-shade UPF 50 sun protection',NULL,NULL,NULL,NULL,NULL),(16,NULL,'B00VX9WN34','Duduma Polarized Designer Fashion Sports Sunglasses for Baseball Cycling Fishing Golf Tr62 Superlight Frame','https://www.amazon.com/Duduma-Polarized-Designer-Sunglasses-Superlight/dp/B00VX9WN34/ref=zg_bs_11443923011_2?_encoding=UTF8&refRID=7CMEXPSVJSB37QF54HKP','Amazon Best Sellers Rank: #882 in Sports & Outdoors (See Top 100 in Sports & Outdoors)   #1 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Men > Accessories > Sunglasses   #1 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Women > Accessories > Sunglasses   #1 inÂ Sports & Outdoors > Sports & Fitness > Clothing > Women > Accessories > Sunglasses',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'This fits yourÂ .      Enter your model number to make sure this fits.     P.when(\"ReplacementPartsBulletLoader\").execute(function(module){ module.initializeDPX(); }) TAC POLARIZED LENS- 100% UV400 protection coating, blocks 100% harmful UVA & UVB Rays. Restore true color, eliminate reflected light and scattered light and protect eyes perfectly. TAC lens includes 7 layers. The 1st layer is polarization layer. The 2nd and 3rd layers are bonding layers to enable durability. The 4th and 5th layers are UV protection layers to absorb UV light. The 6th and 7th layers are shatterproof layers. PRODUCTS DIMENSION- Lens height:40 mm (1.57 inches); lens width:66mm (2.59 inches); leg length:140mm(5.51 inches); nose bridge:12-30 mm (0.47-1.18 inches); frame length: 140mm (5.51 inches). GOOD LOOK, SUPERLIGHT, STYLISH, DURABLE AND CLEAR- Flattering lines & design features create aesthetically pleasing appearance. Lightweight design is ideal for motorcycle and cycling bicycle, driving, running, fishing, racing, skiing, climbing, trekking or other outdoor activities. Fashion and stylish design, with rich color combinations of frames and lens. Polycarbonate lens and frames are impact, scratch resistant and durable. Rimless jacket frame design enables clear lower vision field. LIFETIME BREAKAGE WARRANTY ON FRAME- Frames and lens are unbreakable for no risk purchasing. In case any broken problem happens, contact the seller of Duduma without hesitation to solve the problem until satisfaction. Duduma provides lifetime after sale service for all Duduma products. 30 DAY MONEY BACK GUARANTEE- All Duduma customers enjoy 30 Day Money Back Guarantee. Customers can return and get refunded in case the purchasing is not satisfactory for any reason. You have no risk to try.',NULL,NULL,NULL,NULL,NULL),(17,NULL,'B01GCJ6EG6','Shinymod UV Protection Cooling Arm Sleeves for Men Women Sunblock Cooler Protective Sports Gloves Running Golf Cycling Basketball Driving Fishing 1 Pair/ 3 Pairs/ 5 Pairs Long Tattoo Cover Arm Warmer','https://www.amazon.com/Shinymod-Protection-Sunblock-Protective-Basketball/dp/B01GCJ6EG6/ref=zg_bs_11443923011_3?_encoding=UTF8&refRID=7CMEXPSVJSB37QF54HKP','Amazon Best Sellers Rank: #875 in Sports & Outdoors (See Top 100 in Sports & Outdoors)   #1 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Women > Accessories > Armwarmers   #5 inÂ Sports & Outdoors > Outdoor Recreation > Cycling > Clothing > Women',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'This fits yourÂ .      Enter your model number to make sure this fits.     P.when(\"ReplacementPartsBulletLoader\").execute(function(module){ module.initializeDPX(); }) â THE HOTTEST SALE ON AMAZON, WIDELY WON CUSTOMER HIGH PRAISE - Shinymod began to sell cooling sleeves in last summer, so far, Shinymod cooling sleeves are the most popular one among Amazon customers. To meet customersâ various needs, we have released more colors & combination choice, welcome to pick your favorite cooling arm sleeves â ABOUT SIZE - Shinymod arm sleeves is unisex. For the size, we tested and get a conclusion that if your bicep size is 8inch - 13inch, you may feel most comfortable when wearing Shinymod arm sleeves. If you have a larger bicep, they may feel little tight. And to meet our customerâs need, our sleeves in larger will coming soon âBETTER WEAR EXPERIENCE & PROTECTION - In summer, definitely feel cool when these sleeves on, but in winter, it can make your arm warmer too, yes , it is so amazing. 99.8% UV Protection, got no sunburn or bug bites. Not easy to cause bacteria, fast sweat kick-away and fast dry, make your skin fresh all day. Designed by considering all muscle line of body to protect muscle. Promotes faster muscle recovery and blood circulation. Make your muscle feel comfortable when doing sport â FOR ALL OUTDOOR SPORTS AND ACTIVITIES - Such as golfing, cycling, fishing, driving, jogging, claiming, boating, gardening, basketball, tennis and so on. Great skin protection when you working outside or doing any outdoor activities. Suitable for Indoor Activities too, even your workplaces (You arms won\'t sticky on your desk) â BETTER MATERIAL THAN OTHER BRAND - Make of cooling protofilament (92% polyamide, 8% spandex). This is cooler and protect your skin better than other brand. There is no need to use sunscreen anymore',NULL,NULL,NULL,NULL,NULL),(18,NULL,'B001AKUHGG','Women\'s Scrub Set, Assorted Colors, XXS-5X, Plus Sizes Available','https://www.amazon.com/Womens-Assorted-Colors-XXS-5X-Available/dp/B001AKUHGG/ref=zg_bs_7581679011_17?_encoding=UTF8&refRID=1AD6T59RJQA5YAF9VMCE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$8.99 - $102.72',0,'Poly-cotton 65% Polyester//35% Cotton V-Neck Top and Pants set Top--2 Lower Pockets//Pants--2 Side+2 Back Pockets Special Color-Fast Fabric--Colors do not fade Triple Reinforced Seams and Stitches for added durability',NULL,NULL,NULL,NULL,NULL),(19,NULL,'B00WAXEEU2','Cherokee Women\'s Infinity Round Neck Top','https://www.amazon.com/Cherokee-Womens-Infinity-Round-Neck/dp/B00WAXEEU2/ref=zg_bs_7581679011_35?_encoding=UTF8&refRID=R7A4V3WNNJ6BKR4AJTR8',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$17.91 - $39.99',0,'95% Polyester, 5% Spandex Imported Machine Wash Round neck top with rib inset front neckband Certainty antimicrobial fabric protection technology Bungee ID badge loop, two patch pockets, one interior pocket, and side vents Stretch rib knit at the center back panel gives this top its slimming shape',NULL,NULL,NULL,NULL,NULL),(20,NULL,'B00BVGC05A','Columbia Women\'s Anytime Outdoor Capri Pant','https://www.amazon.com/Columbia-Womens-Anytime-Outdoor-Capri/dp/B00BVGC05A/ref=sr_1_19?s=apparel&ie=UTF8&qid=1505015988&sr=1-19&nodeID=7147440011&psd=1&keywords=outdoor',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$27.93 - $60.00',0,'Omni Shield Summiteer Lite: 96% Nylon, 4% Elastane Importado Drawstring closure Machine Wash Mid-rise Capri pant with drawstring waist and slant hand pockets Single back welt pocket Omni-shade UPF 50 fabric for sun protection',NULL,NULL,NULL,NULL,NULL),(21,NULL,'B009Q1AA0Y','Outdoor Research Rocky Mountain High Gaiters, Women\'s','https://www.amazon.com/Outdoor-Research-Mountain-Gaiters-Womens/dp/B009Q1AA0Y/ref=pd_sim_468_8?_encoding=UTF8&refRID=5A26QMRGMEEV6Y9ZHSAV','Amazon Best Sellers Rank: #56,020 in Sports & Outdoors (See Top 100 in Sports & Outdoors)  #16 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Men > Accessories > Leg Gaiters   #28 inÂ Sports & Outdoors > Outdoor Recreation > Winter Sports > Snowshoeing   #56 inÂ Sports & Outdoors > Outdoor Recreation > Climbing > Mountaineering & Ice Equipment',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$32.08 - $44.00',0,'100% nylon, 420D Imported Reinforced Boot Lace Hook Durable, Water Resistant and Breathable 1-Inch Wide Hook/Loop Front Closure Bottom Shear Tab Secures Front Closure Hypalon Instep Strap',NULL,NULL,NULL,NULL,NULL),(22,NULL,'B00D5OVP70','Miss Elaine Women\'s Tricot Long Flutter-Sleeve Nightgown','https://www.amazon.com/Miss-Elaine-Womens-Flutter-Sleeve-Nightgown/dp/B00D5OVP70/ref=pd_sbs_193_8?_encoding=UTF8&refRID=G6QSSQCNG8PDVMBMY9EM',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$28.73 - $118.00',0,'100% Nylon Imported Machine Wash Flutter-sleeve nightgown with floral embroidery at neckline',NULL,NULL,NULL,NULL,NULL),(23,NULL,'B00L5DBE9C','Columbia Sportswear Women\'s Saturday Trail Pant','https://www.amazon.com/Columbia-Sportswear-Womens-Saturday-Trail/dp/B00L5DBE9C/ref=zg_bs_11443923011_5?_encoding=UTF8&refRID=QBWVE7NCXAVNKAZP8HYX','Amazon Best Sellers Rank: #1,442 in Sports & Outdoors (See Top 100 in Sports & Outdoors)  #1 inÂ Sports & Outdoors > Outdoor Recreation > Camping & Hiking > Clothing > Women > Pants   #4 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Women > Pants   #39 inÂ Clothing, Shoes & Jewelry > Women > Clothing > Active > Active Pants',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$34.05 - $87.13',0,'96% Nylon/4% Elastane Imported Omni-Shade UPF 50 sun protection and advanced repellency Roll-up legs convert pant to capri, Articulated knees 2-way comfort stretch Zip-closed security pocket Straight leg, mid rise, active fit',NULL,NULL,NULL,NULL,NULL),(24,NULL,'B0192JCTG2','Timeson Womens Long Sleeve Knitted Panel Hooded Casual Sweatshirt','https://www.amazon.com/Timeson-Womens-Sleeve-Knitted-Sweatshirt/dp/B0192JCTG2/ref=zg_bs_11443923011_15?_encoding=UTF8&refRID=QBWVE7NCXAVNKAZP8HYX',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Fabric: #31- 10% Cotton 30% Polyurethane (Spandex) 60% Polyester #06 - Fabric: 40% Cotton 60% Polyurethane (Spandex) Garment Care: Machine Washable(Recommended Hand Wash) Timeson\'s pullover sweater, styled with an attached hood and kangroo pocket, makes the perfect top layer for cool days and chilly breezes Featuring lightweight and soft material, this casual pullover hoodie sweater is easy to wear with your favorite jeans, leggings and more Please check the size information under the Product Description before ordering, rather than the \"size chart\" beside the drop down box',NULL,NULL,NULL,NULL,NULL),(25,NULL,'B01M593QWL','EA Selection Women\'s Plaid Hem Funnel Neck Pullover Hoodie','https://www.amazon.com/EA-Selection-Womens-Funnel-Pullover/dp/B01M593QWL/ref=pd_sim_193_5?_encoding=UTF8&refRID=GWSVHPFG2SJWYDPCV83W',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$22.99 - $29.99',0,'Shell:87% Polyester/ 13% Cotton ; Hood/Hem:47% Cotton/ 47% Polyester/ 6% Rayon Pull On closure Machine wash, Cold Faux twinset, side pockets, long sleeve Loose fit, Check pattern at hood,cuff and hemline Warm reminder: All the size measurements were adjusted on 1st Feb. 2017. Please just place order with your normal size. No need to choose one size up or down.',NULL,NULL,NULL,NULL,NULL),(26,NULL,'B01LZ2BLWJ','Messic Women\'s Long Sleeve Hooded Shirt Lightweight Zipper Pullover Hoodie','https://www.amazon.com/Messic-Womens-Sleeve-Lightweight-Pullover/dp/B01LZ2BLWJ/ref=pd_sim_193_6?_encoding=UTF8&refRID=N4DD517D1RJFZA4NXRTY',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Comfortable Fabric - 35% Cotton 60% Polyester and 5% Spandex.Soft and Elastic Fabric,Slim Fit Cut to Posture Completely Unfolded Washing Care - Machine or Hand wash in Cold water,Natural Air drying is better Providing the nicest and most stylish hooded fleece jacket. Lightweight hoody blouse, the fabric is thin but not sheer An intricate and ingenious Hoodie Sweatshirt.Long Sleeve Splicing Color make it fashion and active, Slim Fit curve with a great Kangaroo Pocket,you can put purse and keys and phone in it 1/4 Zipper closure & Hooded with Interior Drawcord.Suitable for Outdoor, Sport, Gym, Running and so on This Long Sleeve Hoodie Sweatshirt is perfect for autumn and spring. Suitable to go with jeans, pants and other sports wear or casual wear. WATCH FOR SIZE - From Size M - Size XXL, Please refer to size chart under the Product Description before ordering.Thank you!Messic is registered trademark in America,please choose and buy from \"Messicdirect\".We are committed to providing the best quality products and sincere service to all customers',NULL,NULL,NULL,NULL,NULL),(27,NULL,'B01MDK1YU6','Zeagoo Women\'s Long Sleeve Side Zip Funnel Neck Pullover Tunic Hoodie Sweatshirt Outerwear Tops','https://www.amazon.com/Zeagoo-Womens-Pullover-Sweatshirt-Outerwear/dp/B01MDK1YU6/ref=pd_sim_193_5?_encoding=UTF8&refRID=8AC26CCAB3P315XA1ADJ',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$23.99 - $26.99',0,'Pull On closure Material: 60% Polyester and 40% Cotton.Warm enough in Spring and Fall.Fabric is neither too thin nor too thick or heavy. Pull on closure with zipper and buttons,front with kangaroo pocket.Unique design of ruched necklink with buttons. Pullover hoodie, Funnel neck, High collar, Lightweight, Adjustable drawstring hood, Kangraoo pockets, Casual style. This Casual Pullover Hoodie Sweatshirt is Easy to Wear with Your Favorite Jeans, Leggings etc. Please check product description before ordering to ensure accurate fitting',NULL,NULL,NULL,NULL,NULL),(28,NULL,'B075388TJV','Kisscy Women\'s Funnel Neck Pouch Pocket Contrast Color Fleeces Hoodies Sweatshirts','https://www.amazon.com/dp/B075388TJV',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$15.99 - $22.99',0,'Material:Cotton Blended. Thicken,Warm,Fleeces Inside. Funnel Neck with Drawstring. Pouch Pocket Front.Contrast Color. Casual,Active Style. Easy to Match Your Skinny Jeans,Leggings,Pants. Relaxed Fitted,Figure Flattering Shape. Machine Washable.',NULL,NULL,NULL,NULL,NULL),(29,NULL,'B0185F1YLK','Zookki Cycling Gloves Mountain Bike Gloves Road Racing Bicycle Gloves Light Silicone Gel Pad Riding Gloves Half Finger Biking Gloves Men/Women Work Gloves','https://www.amazon.com/Zookki-Cycling-Mountain-Bicycle-Silicone/dp/B0185F1YLK/ref=zg_bs_11443923011_12?_encoding=UTF8&refRID=QBWVE7NCXAVNKAZP8HYX','Amazon Best Sellers Rank: #2,989 in Sports & Outdoors (See Top 100 in Sports & Outdoors)  #3 inÂ Sports & Outdoors > Outdoor Recreation > Cycling > Clothing > Women > Gloves   #3 inÂ Sports & Outdoors > Outdoor Recreation > Outdoor Clothing > Women > Accessories > Gloves, Mittens & Liners   #5 inÂ Sports & Outdoors > Outdoor Recreation > Cycling > Clothing > Men > Gloves',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Please attention: the size is measured by circumference. the actual gloves size for L and XL is smaller than the size chart, which means if your hand size is L, you should order XL gloves, if your hand size is medium you should order M or L gloves . we are supper sorry for the inconvenience, and we will solve this problem very soon Mesh cloth, lycra fabric and triple sandwich mesh cloth on the surface, 3 dimensional tailoring, highly elastic, moisture-wicking, breathable. Lycra fabric has great elasticity and is used widely. A combination of the three functions of composite fabric cloth. The palm fabric is skip-proof and hard wearing. Its special thickening palm pad can absorb the shock and reduce numbness on the bumpy road effectively. Silica gel pad in palm works well as a buffer layer. Ease your palm fatigue and reduce the probability of skipping in riding. Reflective piping on hand surface for optimum visibility and safety nightly. The terry cloth design on thumbs is mainly used to wipe the dripping and distracting sweat instead of wiping face in large range.',NULL,NULL,NULL,NULL,NULL),(30,NULL,'','Capezio Women\'s Tank Leotard','https://www.amazon.com/gp/product/B002XULQHQ/ref=s9u_simh_gw_i2?ie=UTF8&fpl=fresh&pd_rd_i=B002XULQHQ&pd_rd_r=S03EMBB5YQ6C9YS3GQR1&pd_rd_w=I7li7&pd_rd_wg=ui8TE&pf_rd_m=ATVPDKIKX0DER&pf_rd_s=&pf_rd_r=HAK8FQQT7SAS225HY8XT&pf_rd_t=36701&pf_rd_p=1cf9d009-399c-49e1-901a-7b8786e59436&pf_rd_i=desktop',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$15.00 - $22.95',0,'100% Nylon 90% Nylon, 10% Spandex Soft, breathable, quick-drying Fabric has excellent stretch Machine wash cold, no bleach hang to dry Imported',NULL,NULL,NULL,NULL,NULL),(31,NULL,'B00AMPZEOK','Adult Sheer Wrap Skirt,TH5109','https://www.amazon.com/Adult-Sheer-Wrap-Skirt-TH5109/dp/B00AMPZEOK/ref=pd_rhf_se_s_cp_8?_encoding=UTF8&pd_rd_i=B00AMPZCX8&pd_rd_r=H1GS039MB8J6VXXV2YPV&pd_rd_w=msK6M&pd_rd_wg=0U5ii&refRID=H1GS039MB8J6VXXV2YPV&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$9.14',0,'100% Polyester',NULL,NULL,NULL,NULL,NULL),(32,NULL,'B073Y512FK','SHAPE activewear Women\'s Denim Moto Jacket','https://www.amazon.com/SHAPE-activewear-Womens-Denim-Jacket/dp/B073Y512FK/ref=lp_17225448011_1_8?s=apparel&ie=UTF8&qid=1505476256&sr=1-8&nodeID=17225448011&psd=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$108.00',0,'39% Rayon, 29% Polyester, 27% Nylon, 5% Spandex Imported Machine Wash Performance 4 way stretch denim Stylish jacket for going to and from Moisture Wicking to keep you dry, cool and comfortable Asymmetrical zipper and motorcycle details',NULL,NULL,NULL,NULL,NULL),(33,NULL,'B010JI1CR2','AvaCostume Chiffon Tiered High Side Slit Maxi Skirt for Belly Dance','https://www.amazon.com/dp/B010JI1CR2',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$18.79',0,'All veils are made of chiffon Including skirt only Reversible skirt, Double sides split skirt Perfect for Belly dance, Performance, Casual beach, Cocktail party etc. Please find the matched top or shoes in our stores',NULL,NULL,NULL,NULL,NULL),(34,NULL,'B072MMT7VY','G2009 latin ball ballroom dance professional classic irregular oblique swing skirts provided by GloriaDance','https://www.amazon.com/dp/B072MMT7VY',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$29.98',0,'1.Title------latin dance and ballroom dance professional classic irregular oblique swing skirts 2.Style------ irregular oblique swing 3.Material------ lycra 4.Performance-Index------(Softness-Index:moderate;Elasticity-Index: super stretchy ; Personal-Index: slim ; Pressure-Index:moderate ; Thickness-Index:moderate) 5. Attention(1)-the âSize Selectionâ refer to the âProduct Descriptionâ below;Attention(2)-the goods is only this skirts,not include other apparel and accessories ; Attention(3)-washing instruction(no insolation ; no chlorine bleaching ; no machine-wash ;be naturally drying) ; Attention(4)-the dress size is measured manually,please allow 0.39-1.18 inch deviation; Attention(5)-the color is not 100% the same as the actual product because of the camera, monitor and others',NULL,NULL,NULL,NULL,NULL),(35,NULL,'B0748DKWNS','Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','https://www.amazon.com/dp/B0748DKWNS',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$23.99',0,'âMaterial: 95% Polyester, 5% Spandex. Breathable, stretchy, lightweight, fast-dry. âEssential full-zip performance pullover featureing long sleeves with thumbholes and mock turtleneck collar. Front zipper with locking zipper pull. Elastic cuff added thumb holes, fully covered and protect hands when doing sports, it will look very cool. Raglan sleeves allow freely movement with ease, fit for Yoga, Running, Biking, or Other Sports, an ideal ally for all your professional needs. âIt is perfect when you need just a little warmth. Fast-dry wicking fabric helps evaporate moisture. âSoft and comfortable fit: Two-way flex stretch design for ease of movement; Flat seams to minimize chafing. âOccasion: Sports, Outdoor Activities, Workout, Daily Wear, Biking, Running, Yoga, Gym, School.',NULL,NULL,NULL,NULL,NULL),(36,NULL,'B071PF6YNV','Nanette Lepore Play Women\'s Mesh Slv Cut Out Crew Top','https://www.amazon.com/Nanette-Lepore-Play-Womens-Black/dp/B071PF6YNV/ref=lp_17225448011_1_27?s=apparel&ie=UTF8&qid=1505476256&sr=1-27&nodeID=17225448011&psd=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$58.00',0,'46% Polyester, 25% Rayon, 24% Cotton, 5% Spandex Imported Machine Wash French terry Mesh details',NULL,NULL,NULL,NULL,NULL),(37,NULL,'B01N4EN4QA','HARHAY Women\'s Cotton Knitted Long Sleeve Lightweight Tunic Sweatshirt Tops','https://www.amazon.com/HARHAY-Womens-Knitted-Lightweight-Sweatshirt/dp/B01N4EN4QA/ref=pd_rhf_dp_s_cp_1?_encoding=UTF8&pd_rd_i=B01N4EN4QA&pd_rd_r=3ZQS26CHHDSWBDSNTK1F&pd_rd_w=QDTo9&pd_rd_wg=GJfq5&refRID=3ZQS26CHHDSWBDSNTK1F',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$10.99 - $16.99',0,'Material:35? cotton 65% polyester+Knitted HARHAY Women\'s Cotton Knitted Long Sleeve Lightweight Tunic Sweatshirt Tops Round neck,long sleeve, soft material,long length,can be worn with leggings, high heels,boots etc. Machine or hand wash, do not bleach Please allow a little error due to measurement method is different.',NULL,NULL,NULL,NULL,NULL),(38,NULL,'B0748DWLTT','Unibelle Women\'s Workout and Yoga Zip Up Fast-Dry Stretchy Jacket Top with Thumb Holes (M-XXL)','https://www.amazon.com/Unibelle-Womens-Workout-Fast-Dry-Stretchy/dp/B0748DWLTT/ref=pd_sbs_193_5?_encoding=UTF8&refRID=T8AEC4KXE6K9X7N2DXGV',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$23.99',0,'95% polyester âMaterial: 95% Polyester, 5% Spandex. Breathable, stretchy, lightweight, fast-dry. âEssential full-zip performance pullover featureing long sleeves with thumbholes and mock turtleneck collar. Front zipper with locking zipper pull. Elastic cuff added thumb holes, fully covered and protect hands when doing sports, it will look very cool. Raglan sleeves allow freely movement with ease, fit for Yoga, Running, Biking, or Other Sports, an ideal ally for all your professional needs. âIt is perfect when you need just a little warmth. Fast-dry wicking fabric helps evaporate moisture. âSoft and comfortable fit: Two-way flex stretch design for ease of movement; Flat seams to minimize chafing. âOccasion: Sports, Outdoor Activities, Workout, Daily Wear, Biking, Running, Yoga, Gym, School.',NULL,NULL,NULL,NULL,NULL),(39,NULL,'B072121RP4','NAKOKOU Latin Dance Skirt Square Dance Tango Swing Rumba ChaCha Ballroom Costume','https://www.amazon.com/NAKOKOU-Square-ChaCha-Ballroom-Costume/dp/B072121RP4/ref=pd_sbs_193_7?_encoding=UTF8&refRID=KXGRP76PTSW9W3PHST3F',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$25.99',0,'Size smaller than Amazon size chart. Please refer to following size details before ordering. Great For Latin Tango Cha Cha Ballroom Modern Waltz Foxtrot Show Case, Practise & Performance,Standard Ballroom Dance Quality,fashion design,fine Workmanship. Milk silk fabric, soft skin-friendly, breathable fresh, natural antibacterial Made in comfortable stretchy fabric .',NULL,NULL,NULL,NULL,NULL),(40,NULL,'B000A2FTN6','Capezio Girls\' Ultra Soft Transition Tight','https://www.amazon.com/Capezio-Girls-Ultra-Transition-Tight/dp/B000A2FTN6/ref=pd_rhf_se_s_cp_2?_encoding=UTF8&pd_rd_i=B002R0F8NU&pd_rd_r=H1GS039MB8J6VXXV2YPV&pd_rd_w=msK6M&pd_rd_wg=0U5ii&refRID=H1GS039MB8J6VXXV2YPV&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$10.40 - $15.50',0,'86% Tactel Nylon, 14% Spandex Imported Hand or machine wash in cold water, tumble dry low. Plush elastic waistband Dyed-to-match gusset',NULL,NULL,NULL,NULL,NULL),(41,NULL,'','Champion Women\'s French Terry Jogger','https://www.amazon.com/gp/product/B073FQNBS8/ref=s9_acsd_aas_bw_c_x_5_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-2&pf_rd_r=4RFVCRC0VA6C9RBBZ646&pf_rd_r=4RFVCRC0VA6C9RBBZ646&pf_rd_t=101&pf_rd_p=2581e0f5-77ed-43d0-a7c6-16d18f0e4c95&pf_rd_p=2581e0f5-77ed-43d0-a7c6-16d18f0e4c95&pf_rd_i=17225448011',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$14.03 - $39.99',0,'Body: 43% Rayon, 43% Polyester, 14% Cotton; Rib: 59% Rayon, 39% Polyester, 2% Spandex Imported Machine Wash Lightweight French terry fabrication Tapered leg with ribbed cuffs for a modern look Contrast draw cord for adjustability On-seam pockets for storage Relaxed fit',NULL,NULL,NULL,NULL,NULL),(42,NULL,'B00X8TE83K','Women\'s Handkerchief Uneven Hem Jersey Knit Comfy Midi Skirt USA','https://www.amazon.com/dp/B00X8TE83K',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$21.00 - $24.00',0,'100% Rayon Lightweight Super Soft Rayon Fabric Made in USA Women comfy trendy handkerchief uneven flare midi skirt. Features an elasticized waistline and raw hem. It\'s made of a super soft jersey knit material providing great stretch for comfort. These skirts are unlined. Hand Wash Cold. Do Not Bleach. Hang Dry. Do Not Iron. Please check the size chart: Small-Waist:26\" Length:37â, Medium-Waist:28\" Length:38â, Large-Waist:30\" Length: 39â.',NULL,NULL,NULL,NULL,NULL),(43,NULL,'B0722M43ZL','Alvaq Women Coral Print Long Maxi Skirt (8 Colors And Design Print )','https://www.amazon.com/Alvaq-Women-Summer-Colors-Design/dp/B0722M43ZL/ref=zg_bs_1045022_28?_encoding=UTF8&refRID=YDE0DRWYKEJJCR79CATE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Polyester + Spandex 8 colors and different print design Great choose for summer / spring Multicolored Printed Maxi Skirt 5 size can be choosed Skirts are trendy and must-have to wardrobes',NULL,NULL,NULL,NULL,NULL),(44,NULL,'B00XU1SKYY','Urban CoCo Womens Elastic Waist Pleated Short Braces Skirt','https://www.amazon.com/Urban-CoCo-Womens-Elastic-Pleated/dp/B00XU1SKYY/ref=zg_bs_1045022_38?_encoding=UTF8&refRID=YDE0DRWYKEJJCR79CATE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$11.85 - $13.85',0,'92.9%polyester+7.1%spandex Pls note that all the Asian sizes are kind of small compared to the US/EU sizes. Material: Polyester. Stretch and Comfortable fabric Elastic Waist, Zipper Back, Stretch Straps 100% Brand New / Without any accessories Please check the size detail below before purchase',NULL,NULL,NULL,NULL,NULL),(45,NULL,'B01FNUPOF2','TRENDY UNITED Women\'s High Waist Fold Over Pocket Shirring Skirt','https://www.amazon.com/TRENDY-UNITED-Womens-Pocket-Shirring/dp/B01FNUPOF2/ref=zg_bs_1045022_36?_encoding=UTF8&refRID=YDE0DRWYKEJJCR79CATE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Material: Rayon 95% + Spandex 5%, Extremely Soft Fabric. High Quality Heavy Fabric Minimizing See Through. Comfy Style. Easy Flowing Material. Skirts with Pockets. High Waisted, Side Shirring Detail on the side. Maxi Skirt - S0015 [Small - Length : 40\"~41.5\" Waist : 25\"~25.5\"][Medium - Length : 40\"~41.5\" Waist : 27\"~27.5\"][Large - Length : 40\"~41.5\" Waist : 29\"~29.5\"][X-Large - Length : 40.5\"~42\" Waist : 31\"~31.5\"][XX-Large - Length : 40.5\"~42\" Waist : 33\"~33.5\"] Ankle Length Skirt - S0035 [Small - Length : 35\"~35.5\" Waist : 25\"~25.5\"][Medium - Length : 35\"~35.5\" Waist : 27\"~27.5\"][Large - Length : 35\"~35.5\" Waist : 29\"~29.5\"][X-Large - Length : 35.5\"~36\" Waist : 31\"~31.5\"][XX-Large - Length : 35.5\"~36\" Waist : 33\"~33.5\"] Hand wash recommended. No heat dry, bleach, or iron. \"TRENDY UNITED\" is a registered trademark brand name and items sold by \"LQShop\" is the only genuine product. Product sold by any other seller are counterfeit item from China.',NULL,NULL,NULL,NULL,NULL),(46,NULL,'B01LW7X2P6','Doublju Elastic High Waist A-Line Flared Midi Skirt For Women With Plus Size (Made In USA)','https://www.amazon.com/Doublju-Elastic-Waist-Line-Flared/dp/B01LW7X2P6/ref=zg_bs_1045022_41?_encoding=UTF8&refRID=42MSV7FG9SW0KCFYGNWX',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$11.99 - $16.99',0,'96% Polyester / 4% Spandex Made in USA Hand Wash With Cold Water / Do Not Bleach / Hang Or Line Dry #AWBMS0180 - Elastic High Waist A-Line Flared Midi Skirt For Women With Plus Size (Made In USA) / #AWBMS0185 - Floral Printed Elastic High Waist A-Line Flared Midi Skirt Women With Plus Size (Made In USA) Features Elastic High Waist Band, Solid Color and Floral Printed, Vent Flared, And Stretchy Fabric Please be advised to see our size chart for the most accurate fit. Color disclaimer: Due to monitor settings and monitor pixel definition, we cannot guarantee the color that you see will be exact from the actual color of the product.',NULL,NULL,NULL,NULL,NULL),(47,NULL,'B073W5YQDD','YiLiQi Women\'s Rayon Span Stylish High Waisted Maxi Skirt - Solid','https://www.amazon.com/YiLiQi-Womens-Rayon-Stylish-Waisted/dp/B073W5YQDD/ref=zg_bs_1045022_47?_encoding=UTF8&refRID=42MSV7FG9SW0KCFYGNWX',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$9.99 - $16.99',0,'Imported Pull On closure closure Maxi Skirts is made of 94% Rayon and 6% Spandex HAND WASH IN COLD WATER / DO NOT BLEACH / LAY FLAT TO DRY / DRY CLEAN IF NEEDED Lightweight fabric with stretch and unlined.S: size: Waist :25.5/ Length :41/ M: size: Waist :28/ Length :41.5/ L: size: Waist :30.5/ Length :42/ XL: size: Waist :33.5/ Length :42.5/ This is an amazing skirt perfect for both day and romantic night life, Perfect for dressing it up or wear it casual. Please check the size chart in our images to ensure your order / Color Disclaimer : Due to monitor settings, monitor pixel definitions, we cannot guarantee that the color you see on your screen as an exact color of the product. We strive to make our colors as accurate as possible. however, colors are approximations of actual colors.',NULL,NULL,NULL,NULL,NULL),(48,NULL,'B004BFKCEE','Body Wrapper Women\'s 27\" Stirrup Acrylic Legwarmers','https://www.amazon.com/Body-Wrapper-Stirrup-Acrylic-Legwarmers/dp/B004BFKCEE/ref=pd_rhf_ee_s_cp_9?_encoding=UTF8&pd_rd_i=B004BFKCEE&pd_rd_r=Y2TTTJ7DY0MXM3HHGJES&pd_rd_w=fVreT&pd_rd_wg=fFWHl&refRID=Y2TTTJ7DY0MXM3HHGJES',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$9.50',2,'100% Acrylic 27â (69 cm) stirrup warmers Material: Acrylic',NULL,NULL,NULL,NULL,NULL),(49,NULL,'B00P8VODGS','V28 Women Juniors 80s Eighty\'s Ribbed Leg Warmers for Party Sports','https://www.amazon.com/Juniors-Eightys-Ribbed-Warmers-Sports/dp/B00P8VODGS/ref=zg_bs_2376198011_2?_encoding=UTF8&refRID=JHZ5G3S4ZHC47Q64KJF5',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Ladies and Girls Fashion Leg Warmer, Great for 80âs Party/Costume Play/Yoga Sport/Fitness / Casual Dresses Leg Warmers Are Made of 80% Viscose 20% Nylon . Length: 18ââ, Machine Washable at Cold Water; Hang Dry V28 is the ONLY Supplier making this Leg Warmer with Extra Stretch Yarn giving it better Elasticity & Last Years',NULL,NULL,NULL,NULL,NULL),(50,NULL,'B01N5LN21S','Arshiner Women\'s Tank Leotard','https://www.amazon.com/Arshiner-AMS005052-Womens-Tank-Leotard/dp/B01N5LN21S/ref=pd_rhf_dp_s_cp_1?_encoding=UTF8&pd_rd_i=B01N5LN21S&pd_rd_r=1VVP02BKPA1BNGP5CEA1&pd_rd_w=6ORaU&pd_rd_wg=0TvL4&refRID=1VVP02BKPA1BNGP5CEA1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$12.99 - $19.95',0,'Imported Brand: Arshiner Material: 90% Cotton Soft, breathable,high elasticity Fabric has excellent stretch Ballet leg line',NULL,NULL,NULL,NULL,NULL),(51,NULL,'B01HTDE6XW','Speerise Long Sleeve Adult Ballet Dance Leotards for Women','https://www.amazon.com/Speerise-Sleeve-Adult-Ballet-Leotards/dp/B01HTDE6XW/ref=pd_sbs_193_6?_encoding=UTF8&refRID=7XTE4AJBEN6JVXGN2475',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$16.99 - $24.99',0,'82% Nylon/18% Spandex A ballet cut leg line High neck leotard,zipper back Great for class, performances or costumes Hand wash in cold water, hang dry The model is our co-worker, wear S, tops 62\"',NULL,NULL,NULL,NULL,NULL),(52,NULL,'B071HGC8NN','Dress, Han Shi Sexy Women Sleeveless Stripes Dress Casual Ladies O-Neck Ankle-Length Bodycon Party Dress Skirts Sundress','https://www.amazon.com/Han-Shi-Sleeveless-Ankle-Length-Sundress/dp/B071HGC8NN/ref=sr_1_3?ie=UTF8&qid=1508823253&sr=8-3&keywords=women',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$2.99 - $4.99',0,'Cotton Blended Imported Asian size (smaller than US) âMaterial: Cotton blended, Very Soft and Comfortable. âO-Neck Striped Beach Casual Evening Party Cocktail Dress âSleeveless & Slim & Charming âNew Fashion Darling & Market\'s Favorite Dress âCasual & Comfortable & Fashion & Sexy',NULL,NULL,NULL,NULL,NULL),(53,NULL,'B073WDVFTL','Allegra K Women\'s Stripe Panel Boat Neck Side Slits Drop Shoulder Top','https://www.amazon.com/Allegra-Womens-Stripe-Panel-Shoulder/dp/B073WDVFTL/ref=sr_1_17_sspa?ie=UTF8&qid=1508823398&sr=8-17-spons&keywords=women&psc=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Body: 95% Polyester, 5% Spandex; Trim: 95% Polyester, 5% Spandex 3/4 Sleeves, Double Side Slits Stripe Panel, Boat Neck, Drop Shoulder Relaxed Fit Machine Wash Cold with Like Colors Model Body Size: Height: 5\'6\", Chest: 32 1/4 inches, Waist: 23 5/8 inches, Hip: 34 1/4 inches, Weight: 105 lbs, model is wearing a X-Small',NULL,NULL,NULL,NULL,NULL),(54,NULL,'B075581DPC','Women\'s Long Sleeve Pocket Casual Loose T-Shirt Dress','https://www.amazon.com/Womens-Sleeve-Pocket-Casual-T-Shirt/dp/B075581DPC/ref=zg_bsnr_fashion_home_1?_encoding=UTF8&refRID=4AG9Q0MWN6ZEQ5QN4ST6',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$9.99 - $16.99',0,'95% Rayon ,5% Spandex Pull On closure Size:Small/US 4-6 ,Medium/US 8-10,Large/US 12-14,X-Large/US 16-18 This super comfy jersey knit dress has a rounded neckline and long sleeve with hidden side seam pockets.Comfy swing silhouette flares gently to a perfect finish. Perfect dress to hang around the house with or go out and do errands with.It can also look sexy if you pair it with a belt for a night out. Hand wash cold/Hang or line dry. Model information for reference:Height: 5\'8\",Bust: 33\",Waist: 24\",Hip: 34\"',NULL,NULL,NULL,NULL,NULL),(55,NULL,'B07519S91K','FISACE Women\'s Loose Fit Long Sleeve Knitted Cardigan Sweaters Outerwear with Pocket','https://www.amazon.com/FISACE-Knitted-Cardigan-Sweaters-Outerwear/dp/B07519S91K/ref=sr_1_30?ie=UTF8&qid=1508823398&sr=8-30&keywords=women',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$28.99 - $31.99',0,'â¿ FISACE owns its own trademarks. â¿ Please hand wash or dry clean and ashing at 40â maxiumum. Please do not bleach. iron 110â maximum. â¿ Features: open front, long sleeves, side pockets, cute candy color, stylish style, weave knit, loose fit. â¿ It is perfect with all kinds of garments, like leggings, jeans, high heels, boots to tops, shirts, etc. â¿ Please be advised to see our size chart for the most accurate fit. This item is made from non-flexible material, simply choose a single size larger than you normally would if you have a curvy body type, especially in the hip or thigh area. If not, simply select your exact size.',NULL,NULL,NULL,NULL,NULL),(56,NULL,'B075Q8YPL2','Twippo Women\'s Long Sleeve Casual Blouse Shirt Tops Tunic','https://www.amazon.com/Womens-Comfy-Loose-Sleeve-Blouse/dp/B075Q8YPL2/ref=sr_1_19?ie=UTF8&qid=1508823398&sr=8-19&keywords=women',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'ATTENTION: Please be sure purchase from our EXCLUSIVE Amazon Store \"Twippo\". Quality and expedited shipping would be guaranteed! ***BEWARE of LOW QUALITY COUNTERFEITS from any other seller!*** 70% POLYESTER and 30% COTTON / Trendy and stylish blouse / Soft and Comfortable / Machine Washable It flatters your waist and hip curves and can also cover up any bulges you may have. Accentuating Bust: It looks youthful but not young and makes your bust look a bit bigger. Perfect for a business casual workplace, to wear with leggings, skinny jeans/pants and boots',NULL,NULL,NULL,NULL,NULL),(57,NULL,'B074HC6SJ3','Twippo Women\'s Long Sleeve Casual Blouse Shirt Tops Tunic','https://www.amazon.com/Womens-Comfy-Loose-Sleeve-Blouse/dp/B074HC6SJ3/ref=sr_1_19?ie=UTF8&qid=1508823398&sr=8-19&keywords=women&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'ATTENTION: Please be sure purchase from our EXCLUSIVE Amazon Store \"Twippo\". Quality and expedited shipping would be guaranteed! ***BEWARE of LOW QUALITY COUNTERFEITS from any other seller!*** 70% POLYESTER and 30% COTTON / Trendy and stylish blouse / Soft and Comfortable / Machine Washable It flatters your waist and hip curves and can also cover up any bulges you may have. Accentuating Bust: It looks youthful but not young and makes your bust look a bit bigger. Perfect for a business casual workplace, to wear with leggings, skinny jeans/pants and boots',NULL,NULL,NULL,NULL,NULL),(58,NULL,'B071S2TZFT','[BLANKNYC] Women\'s Floral Moto Jacket','https://www.amazon.com/blanknyc-Womens-Floral-Jacket-Medium/dp/B071S2TZFT/ref=br_asw_pdt-2?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=&pf_rd_r=M1F3C3PH0Q01BZHJKARR&pf_rd_t=36701&pf_rd_p=ccf12100-db96-4a4f-825f-a4a7f1f788c5&pf_rd_i=desktop',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$168.00',0,'60% Polyurethane, 40% Viscose Imported Hand Wash Floral print Vegan leather Front length 23 inch',NULL,NULL,NULL,NULL,NULL),(59,NULL,'B0746JT4XX','Star Vixen Women\'s Plus Size Str Ponte Classic Fauxwrap Dress W Collar','https://www.amazon.com/Star-Vixen-Classic-Fauxwrap-Charcoal/dp/B0746JT4XX/ref=lp_17225461011_1_1_mc?s=apparel&ie=UTF8&qid=1509081401&sr=1-1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$57.00',0,'89% Polyester, 7% Rayon, 4% Spandex Imported Pull On closure Hand Wash Classic, timeless, go-anywhere silhouette Stretch ponte knit holds you firmly, securely Tie wrap adjusts for perfect fit No wrinklingGo from day to night with a change of accessoriesShow more',NULL,NULL,NULL,NULL,NULL),(60,NULL,'B0746JL4Q9','Star Vixen Women\'s Plus Size Str Ponte Classic Fauxwrap Dress W Collar','https://www.amazon.com/Star-Vixen-Classic-Fauxwrap-Charcoal/dp/B0746JL4Q9/ref=lp_17225461011_1_1_mc?s=apparel&ie=UTF8&qid=1509081401&sr=1-1&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$57.00',0,'89% Polyester, 7% Rayon, 4% Spandex Imported Pull On closure Hand Wash Classic, timeless, go-anywhere silhouette Stretch ponte knit holds you firmly, securely Tie wrap adjusts for perfect fit No wrinklingGo from day to night with a change of accessoriesShow more',NULL,NULL,NULL,NULL,NULL),(61,NULL,'B00HD6QHWY','Star Vixen Women\'s Plus-Size 3/4 Sleeve Fauxwrap Dress with Collar','https://www.amazon.com/Star-Vixen-Womens-Plus-Size-Fauxwrap/dp/B00HD6QHWY/ref=pd_d0_recs_v2_cwb_193_6?_encoding=UTF8&pd_rd_i=B00HD6QHWY&pd_rd_r=D48QFZ7RQAVB9YGVTKAS&pd_rd_w=sKL8t&pd_rd_wg=Hc7BD&refRID=D48QFZ7RQAVB9YGVTKAS',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$33.33',0,'92% Polyester, 8% Spandex Made in the USA and Imported Hand Wash Wrap tie for perfect fit Forgiving, easy-care knit Classic work-to-night silhouette',NULL,NULL,NULL,NULL,NULL),(62,NULL,'B00HD6QYS6','Star Vixen Women\'s Plus-Size 3/4 Sleeve Fauxwrap Dress with Collar','https://www.amazon.com/Star-Vixen-Womens-Plus-Size-Fauxwrap/dp/B00HD6QYS6/ref=pd_d0_recs_v2_cwb_193_6?_encoding=UTF8&pd_rd_i=B00HD6QHWY&pd_rd_r=D48QFZ7RQAVB9YGVTKAS&pd_rd_w=sKL8t&pd_rd_wg=Hc7BD&refRID=D48QFZ7RQAVB9YGVTKAS&th=1',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$33.33',0,'92% Polyester, 8% Spandex Made in the USA and Imported Hand Wash Wrap tie for perfect fit Forgiving, easy-care knit Classic work-to-night silhouette',NULL,NULL,NULL,NULL,NULL),(63,NULL,'B00QIW8GIC','Star Vixen Women\'s Plus-Size Sleeveless Fauxwrap Dress with Piping, Red/Black, 2X','https://www.amazon.com/Star-Vixen-Plus-Size-Sleeveless-Fauxwrap/dp/B00QIW8GIC/ref=pd_d0_recs_v2_cwb_193_6?_encoding=UTF8&pd_rd_i=B00QIW8GIC&pd_rd_r=CHY584YV5P8R2KPRWFJ4&pd_rd_w=8wobV&pd_rd_wg=haQYk&psc=1&refRID=CHY584YV5P8R2KPRWFJ4',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$34.99',0,'92% Polyester/8% Spandex Made in the USA and Imported Hand Wash Classic silhouette Ties for perfect fit No wrinkles Sleeveless v-neck fit-and-flare cocktail dress in Multi',NULL,NULL,NULL,NULL,NULL),(64,NULL,'B007WFXKAS','Danshuz Neoprene Half Soles','https://www.amazon.com/Danshuz-Womens-Neoprene-Ballet-Slip/dp/B007WFXKAS/ref=sr_1_13_mc?s=apparel&ie=UTF8&qid=1509081562&sr=1-13&keywords=dance','Amazon Best Sellers Rank: #4,444 in Sports & Outdoors (See Top 100 in Sports & Outdoors)   #14 inÂ Clothing, Shoes & Jewelry > Women > Shoes > Athletic > Women\'s   #5965 inÂ Clothing, Shoes & Jewelry > Women > Shops',NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$10.26 - $26.95',0,'Neoprene fabric. Neoprene fabric ensures a secure fit and provides padded comfort Double stitched suede sole patch for smooth turns Stitched binding for maximum durability Easily slips on and off without uncomfortable straps between the toes Shoe size equivalents: XS (Child 11 - Adult 2), S (2.5 - 5), M (5.5 - 8), L (8.5 - 11), XL (11.5 - 13)',NULL,NULL,NULL,NULL,NULL),(65,NULL,'B0079MG3PS','\"Footnote\" Neoprene Half Sole,T8940','https://www.amazon.com/Footnote-Neoprene-Half-Sole-T8940/dp/B0079MG3PS/ref=pd_sim_200_5?_encoding=UTF8&pd_rd_i=B0079MG3PS&pd_rd_r=JEFR12W7S3KC4S5PV246&pd_rd_w=nBjnS&pd_rd_wg=m0Mpq&refRID=JEFR12W7S3KC4S5PV246',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'$10.33 - $14.00',0,'Leather Upper',NULL,NULL,NULL,NULL,NULL),(66,NULL,'B01LZ6ZV03','Our Precious Women\'s Lapel Neck Long Sleeve Loose Sides Slit Shirt Tunic Dress','https://www.amazon.com/Our-Precious-Womens-Lapel-Sleeve/dp/B01LZ6ZV03/ref=pd_rhf_se_7?_encoding=UTF8&pd_rd_i=B01LZ6ZV03&pd_rd_r=ZVAC0694S9ZQ8W2FVDTE&pd_rd_w=3WFsh&pd_rd_wg=ri7SY&refRID=ZVAC0694S9ZQ8W2FVDTE',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'Bust Size: XS(US 0-2): 33.8\", S(US 4-6): 34.6\", M(US 6-8): 37\", L(US 8-10): 38.5\", XL(12-14): 41.7\" 65% Mercerized Cotton, 30% Polyester, 5% Spandex Pull On closure Silky long tunic,Super cute and comfy The back is longer than the front, lengthen the curve of legs Feasures: casual style, short length, long sleeve, turn down button collar Fabric not too thin or thick, can be wear all year around Handwash in cold water and dry, no bleach, mix to wash',NULL,NULL,NULL,NULL,NULL),(67,NULL,'B074LFNQQ4','Flywm Women\'s Casual Long Sleeve Crew Neck Button Decor T Shirt Tunic Top Loose Blouse','https://www.amazon.com/Flywm-Womens-Casual-Sleeve-Button/dp/B074LFNQQ4/ref=pd_sim_193_10?_encoding=UTF8&pd_rd_i=B074LFNQQ4&pd_rd_r=8KHHP40RDY384SRKRCR9&pd_rd_w=TBvzx&pd_rd_wg=HndRY&refRID=8KHHP40RDY384SRKRCR9',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'95%Polyester 5%Spandex Imported Soft cozy fabric made, Lightweight Brown buttons on the side, Crew Neck Loose fit and long enough to elongate a slim figure Hand Wash, Hang dry, Do not Bleach Great tunic tops for spring-autumn. Well paired with leggings or jeans.',NULL,NULL,NULL,NULL,NULL),(68,NULL,'B01FFA8SL2','Yidarton Womens Tops Chiffon Long Sleeve Shirts Casual Blouse','https://www.amazon.co.uk/Yidarton-Womens-Chiffon-Sleeve-Shirts/dp/B01FFA8SL2/ref=pd_sim_193_4?_encoding=UTF8&refRID=V7XCBXQNC6JXA16TP5P2',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,NULL,0,'S is for UK 8,M is for UK 10,L is for UK 12,XL is for UK 14,XXL is for UK 16,more details please check the size chart in the photo gallery left Classic and elegant v neckline,to show off your charming curves and grace 100% Chiffon,lightweight and soft,hand wash recommeded. Buttons at the back with stretch elastic to do up the buttons and gives a fitted look Lovely design---The front has a double layer and the back is single layer Suitable for work,casual or vacation,also for some formal occasions.','Tops',NULL,NULL,NULL,NULL),(69,NULL,'B072KK61RW','ECOWISH Womens Floral Printed V-Neck Long Sleeves Geometric Pattern Blouses Casual Tops','https://www.amazon.co.uk/ECOWISH-Printed-Sleeves-Geometric-Pattern/dp/B072KK61RW/ref=pd_sim_193_9?_encoding=UTF8&refRID=JJMRBKTH1PTY3PGEMPSK',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,0,0,0,0,0,'Â£10.99',0,'Please Choose Your Normal Size or Check The Size Chart! Any Questions, Please Contact Us Directly! Occasion: Casual, Beach, Work, Vacation, Daily Life. Material: 85% Polyester; 15% Cotton EH516 Feature: Floral Printed; V-Neck; Long Sleeves; Geometric Pattern; Casual Blouses. Size: UK S ; UK M ; UK L ; UK XL ; UK XXL .','Tops',NULL,NULL,'Size:drop_down:20:1','S:fixed:0.00:17||M:fixed:0.00:18||L:fixed:0.00:19||XL:fixed:0.00:20||2XL:fixed:0.00:21');
/*!40000 ALTER TABLE `amazon_ok_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_product_focus`
--

DROP TABLE IF EXISTS `amazon_product_focus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_product_focus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) DEFAULT NULL,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `up_or_down` int(11) DEFAULT NULL,
  `up_or_down_diff` int(11) DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_product_focus`
--

LOCK TABLES `amazon_product_focus` WRITE;
/*!40000 ALTER TABLE `amazon_product_focus` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_product_focus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_product_ranks`
--

DROP TABLE IF EXISTS `amazon_product_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_product_ranks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `catalog_id` int(11) DEFAULT NULL,
  `mbc` int(11) DEFAULT NULL,
  `reviews` int(11) DEFAULT NULL,
  `asks` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT '0',
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_product_ranks`
--

LOCK TABLES `amazon_product_ranks` WRITE;
/*!40000 ALTER TABLE `amazon_product_ranks` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_product_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amazon_products`
--

DROP TABLE IF EXISTS `amazon_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amazon_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) DEFAULT NULL,
  `asin` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `rank` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `up_or_down` int(11) DEFAULT NULL,
  `up_or_down_diff` int(11) DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `d1` int(11) NOT NULL DEFAULT '0',
  `d2` int(11) NOT NULL DEFAULT '0',
  `d3` int(11) NOT NULL DEFAULT '0',
  `d4` int(11) NOT NULL DEFAULT '0',
  `d5` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amazon_products`
--

LOCK TABLES `amazon_products` WRITE;
/*!40000 ALTER TABLE `amazon_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_category`
--

DROP TABLE IF EXISTS `article_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_category`
--

LOCK TABLES `article_category` WRITE;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `author_id` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `top` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `share` tinyint(1) NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_url_key_index` (`url_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `block` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `block_flag_index` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `block`
--

LOCK TABLES `block` WRITE;
/*!40000 ALTER TABLE `block` DISABLE KEYS */;
/*!40000 ALTER TABLE `block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `in_top` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `_lft` int(10) unsigned NOT NULL,
  `_rgt` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quote_user_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `capital` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `citizenship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_sub_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iso_3166_2` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `iso_3166_3` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sub_region_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `eea` tinyint(1) NOT NULL DEFAULT '0',
  `calling_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_id_index` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (4,'Kabul','Afghan','004','afghani','AFN','pul','؋','Islamic Republic of Afghanistan','AF','AFG','Afghanistan','142','034',0,'93','AF.png'),(8,'Tirana','Albanian','008','lek','ALL','(qindar (pl. qindarka))','Lek','Republic of Albania','AL','ALB','Albania','150','039',0,'355','AL.png'),(10,'Antartica','of Antartica','010','','','','','Antarctica','AQ','ATA','Antarctica','','',0,'672','AQ.png'),(12,'Algiers','Algerian','012','Algerian dinar','DZD','centime','DZD','People’s Democratic Republic of Algeria','DZ','DZA','Algeria','002','015',0,'213','DZ.png'),(16,'Pago Pago','American Samoan','016','US dollar','USD','cent','$','Territory of American','AS','ASM','American Samoa','009','061',0,'1','AS.png'),(20,'Andorra la Vella','Andorran','020','euro','EUR','cent','€','Principality of Andorra','AD','AND','Andorra','150','039',0,'376','AD.png'),(24,'Luanda','Angolan','024','kwanza','AOA','cêntimo','Kz','Republic of Angola','AO','AGO','Angola','002','017',0,'244','AO.png'),(28,'St John’s','of Antigua and Barbuda','028','East Caribbean dollar','XCD','cent','$','Antigua and Barbuda','AG','ATG','Antigua and Barbuda','019','029',0,'1','AG.png'),(31,'Baku','Azerbaijani','031','Azerbaijani manat','AZN','kepik (inv.)','ман','Republic of Azerbaijan','AZ','AZE','Azerbaijan','142','145',0,'994','AZ.png'),(32,'Buenos Aires','Argentinian','032','Argentine peso','ARS','centavo','$','Argentine Republic','AR','ARG','Argentina','019','005',0,'54','AR.png'),(36,'Canberra','Australian','036','Australian dollar','AUD','cent','$','Commonwealth of Australia','AU','AUS','Australia','009','053',0,'61','AU.png'),(40,'Vienna','Austrian','040','euro','EUR','cent','€','Republic of Austria','AT','AUT','Austria','150','155',1,'43','AT.png'),(44,'Nassau','Bahamian','044','Bahamian dollar','BSD','cent','$','Commonwealth of the Bahamas','BS','BHS','Bahamas','019','029',0,'1','BS.png'),(48,'Manama','Bahraini','048','Bahraini dinar','BHD','fils (inv.)','BHD','Kingdom of Bahrain','BH','BHR','Bahrain','142','145',0,'973','BH.png'),(50,'Dhaka','Bangladeshi','050','taka (inv.)','BDT','poisha (inv.)','BDT','People’s Republic of Bangladesh','BD','BGD','Bangladesh','142','034',0,'880','BD.png'),(51,'Yerevan','Armenian','051','dram (inv.)','AMD','luma','AMD','Republic of Armenia','AM','ARM','Armenia','142','145',0,'374','AM.png'),(52,'Bridgetown','Barbadian','052','Barbados dollar','BBD','cent','$','Barbados','BB','BRB','Barbados','019','029',0,'1','BB.png'),(56,'Brussels','Belgian','056','euro','EUR','cent','€','Kingdom of Belgium','BE','BEL','Belgium','150','155',1,'32','BE.png'),(60,'Hamilton','Bermudian','060','Bermuda dollar','BMD','cent','$','Bermuda','BM','BMU','Bermuda','019','021',0,'1','BM.png'),(64,'Thimphu','Bhutanese','064','ngultrum (inv.)','BTN','chhetrum (inv.)','BTN','Kingdom of Bhutan','BT','BTN','Bhutan','142','034',0,'975','BT.png'),(68,'Sucre (BO1)','Bolivian','068','boliviano','BOB','centavo','$b','Plurinational State of Bolivia','BO','BOL','Bolivia, Plurinational State of','019','005',0,'591','BO.png'),(70,'Sarajevo','of Bosnia and Herzegovina','070','convertible mark','BAM','fening','KM','Bosnia and Herzegovina','BA','BIH','Bosnia and Herzegovina','150','039',0,'387','BA.png'),(72,'Gaborone','Botswanan','072','pula (inv.)','BWP','thebe (inv.)','P','Republic of Botswana','BW','BWA','Botswana','002','018',0,'267','BW.png'),(74,'Bouvet island','of Bouvet island','074','','','','kr','Bouvet Island','BV','BVT','Bouvet Island','','',0,'47','BV.png'),(76,'Brasilia','Brazilian','076','real (pl. reais)','BRL','centavo','R$','Federative Republic of Brazil','BR','BRA','Brazil','019','005',0,'55','BR.png'),(84,'Belmopan','Belizean','084','Belize dollar','BZD','cent','BZ$','Belize','BZ','BLZ','Belize','019','013',0,'501','BZ.png'),(86,'Diego Garcia','Changosian','086','US dollar','USD','cent','$','British Indian Ocean Territory','IO','IOT','British Indian Ocean Territory','','',0,'246','IO.png'),(90,'Honiara','Solomon Islander','090','Solomon Islands dollar','SBD','cent','$','Solomon Islands','SB','SLB','Solomon Islands','009','054',0,'677','SB.png'),(92,'Road Town','British Virgin Islander;','092','US dollar','USD','cent','$','British Virgin Islands','VG','VGB','Virgin Islands, British','019','029',0,'1','VG.png'),(96,'Bandar Seri Begawan','Bruneian','096','Brunei dollar','BND','sen (inv.)','$','Brunei Darussalam','BN','BRN','Brunei Darussalam','142','035',0,'673','BN.png'),(100,'Sofia','Bulgarian','100','lev (pl. leva)','BGN','stotinka','лв','Republic of Bulgaria','BG','BGR','Bulgaria','150','151',1,'359','BG.png'),(104,'Yangon','Burmese','104','kyat','MMK','pya','K','Union of Myanmar/','MM','MMR','Myanmar','142','035',0,'95','MM.png'),(108,'Bujumbura','Burundian','108','Burundi franc','BIF','centime','BIF','Republic of Burundi','BI','BDI','Burundi','002','014',0,'257','BI.png'),(112,'Minsk','Belarusian','112','Belarusian rouble','BYR','kopek','p.','Republic of Belarus','BY','BLR','Belarus','150','151',0,'375','BY.png'),(116,'Phnom Penh','Cambodian','116','riel','KHR','sen (inv.)','៛','Kingdom of Cambodia','KH','KHM','Cambodia','142','035',0,'855','KH.png'),(120,'Yaoundé','Cameroonian','120','CFA franc (BEAC)','XAF','centime','FCF','Republic of Cameroon','CM','CMR','Cameroon','002','017',0,'237','CM.png'),(124,'Ottawa','Canadian','124','Canadian dollar','CAD','cent','$','Canada','CA','CAN','Canada','019','021',0,'1','CA.png'),(132,'Praia','Cape Verdean','132','Cape Verde escudo','CVE','centavo','CVE','Republic of Cape Verde','CV','CPV','Cape Verde','002','011',0,'238','CV.png'),(136,'George Town','Caymanian','136','Cayman Islands dollar','KYD','cent','$','Cayman Islands','KY','CYM','Cayman Islands','019','029',0,'1','KY.png'),(140,'Bangui','Central African','140','CFA franc (BEAC)','XAF','centime','FCF','Central African Republic','CF','CAF','Central African Republic','002','017',0,'236','CF.png'),(144,'Colombo','Sri Lankan','144','Sri Lankan rupee','LKR','cent','₨','Democratic Socialist Republic of Sri Lanka','LK','LKA','Sri Lanka','142','034',0,'94','LK.png'),(148,'N’Djamena','Chadian','148','CFA franc (BEAC)','XAF','centime','XAF','Republic of Chad','TD','TCD','Chad','002','017',0,'235','TD.png'),(152,'Santiago','Chilean','152','Chilean peso','CLP','centavo','CLP','Republic of Chile','CL','CHL','Chile','019','005',0,'56','CL.png'),(156,'Beijing','Chinese','156','renminbi-yuan (inv.)','CNY','jiao (10)','¥','People’s Republic of China','CN','CHN','China','142','030',0,'86','CN.png'),(158,'Taipei','Taiwanese','158','new Taiwan dollar','TWD','fen (inv.)','NT$','Republic of China, Taiwan (TW1)','TW','TWN','Taiwan, Province of China','142','030',0,'886','TW.png'),(162,'Flying Fish Cove','Christmas Islander','162','Australian dollar','AUD','cent','$','Christmas Island Territory','CX','CXR','Christmas Island','','',0,'61','CX.png'),(166,'Bantam','Cocos Islander','166','Australian dollar','AUD','cent','$','Territory of Cocos (Keeling) Islands','CC','CCK','Cocos (Keeling) Islands','','',0,'61','CC.png'),(170,'Santa Fe de Bogotá','Colombian','170','Colombian peso','COP','centavo','$','Republic of Colombia','CO','COL','Colombia','019','005',0,'57','CO.png'),(174,'Moroni','Comorian','174','Comorian franc','KMF','','KMF','Union of the Comoros','KM','COM','Comoros','002','014',0,'269','KM.png'),(175,'Mamoudzou','Mahorais','175','euro','EUR','cent','€','Departmental Collectivity of Mayotte','YT','MYT','Mayotte','002','014',0,'262','YT.png'),(178,'Brazzaville','Congolese','178','CFA franc (BEAC)','XAF','centime','FCF','Republic of the Congo','CG','COG','Congo','002','017',0,'242','CG.png'),(180,'Kinshasa','Congolese','180','Congolese franc','CDF','centime','CDF','Democratic Republic of the Congo','CD','COD','Congo, the Democratic Republic of the','002','017',0,'243','CD.png'),(184,'Avarua','Cook Islander','184','New Zealand dollar','NZD','cent','$','Cook Islands','CK','COK','Cook Islands','009','061',0,'682','CK.png'),(188,'San José','Costa Rican','188','Costa Rican colón (pl. colones)','CRC','céntimo','₡','Republic of Costa Rica','CR','CRI','Costa Rica','019','013',0,'506','CR.png'),(191,'Zagreb','Croatian','191','kuna (inv.)','HRK','lipa (inv.)','kn','Republic of Croatia','HR','HRV','Croatia','150','039',1,'385','HR.png'),(192,'Havana','Cuban','192','Cuban peso','CUP','centavo','₱','Republic of Cuba','CU','CUB','Cuba','019','029',0,'53','CU.png'),(196,'Nicosia','Cypriot','196','euro','EUR','cent','CYP','Republic of Cyprus','CY','CYP','Cyprus','142','145',1,'357','CY.png'),(203,'Prague','Czech','203','Czech koruna (pl. koruny)','CZK','halér','Kč','Czech Republic','CZ','CZE','Czech Republic','150','151',1,'420','CZ.png'),(204,'Porto Novo (BJ1)','Beninese','204','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Benin','BJ','BEN','Benin','002','011',0,'229','BJ.png'),(208,'Copenhagen','Danish','208','Danish krone','DKK','øre (inv.)','kr','Kingdom of Denmark','DK','DNK','Denmark','150','154',1,'45','DK.png'),(212,'Roseau','Dominican','212','East Caribbean dollar','XCD','cent','$','Commonwealth of Dominica','DM','DMA','Dominica','019','029',0,'1','DM.png'),(214,'Santo Domingo','Dominican','214','Dominican peso','DOP','centavo','RD$','Dominican Republic','DO','DOM','Dominican Republic','019','029',0,'1','DO.png'),(218,'Quito','Ecuadorian','218','US dollar','USD','cent','$','Republic of Ecuador','EC','ECU','Ecuador','019','005',0,'593','EC.png'),(222,'San Salvador','Salvadoran','222','Salvadorian colón (pl. colones)','SVC','centavo','$','Republic of El Salvador','SV','SLV','El Salvador','019','013',0,'503','SV.png'),(226,'Malabo','Equatorial Guinean','226','CFA franc (BEAC)','XAF','centime','FCF','Republic of Equatorial Guinea','GQ','GNQ','Equatorial Guinea','002','017',0,'240','GQ.png'),(231,'Addis Ababa','Ethiopian','231','birr (inv.)','ETB','cent','ETB','Federal Democratic Republic of Ethiopia','ET','ETH','Ethiopia','002','014',0,'251','ET.png'),(232,'Asmara','Eritrean','232','nakfa','ERN','cent','Nfk','State of Eritrea','ER','ERI','Eritrea','002','014',0,'291','ER.png'),(233,'Tallinn','Estonian','233','euro','EUR','cent','kr','Republic of Estonia','EE','EST','Estonia','150','154',1,'372','EE.png'),(234,'Tórshavn','Faeroese','234','Danish krone','DKK','øre (inv.)','kr','Faeroe Islands','FO','FRO','Faroe Islands','150','154',0,'298','FO.png'),(238,'Stanley','Falkland Islander','238','Falkland Islands pound','FKP','new penny','£','Falkland Islands','FK','FLK','Falkland Islands (Malvinas)','019','005',0,'500','FK.png'),(239,'King Edward Point (Grytviken)','of South Georgia and the South Sandwich Islands','239','','','','£','South Georgia and the South Sandwich Islands','GS','SGS','South Georgia and the South Sandwich Islands','','',0,'44','GS.png'),(242,'Suva','Fijian','242','Fiji dollar','FJD','cent','$','Republic of Fiji','FJ','FJI','Fiji','009','054',0,'679','FJ.png'),(246,'Helsinki','Finnish','246','euro','EUR','cent','€','Republic of Finland','FI','FIN','Finland','150','154',1,'358','FI.png'),(248,'Mariehamn','Åland Islander','248','euro','EUR','cent',NULL,'Åland Islands','AX','ALA','Åland Islands','150','154',0,'358',NULL),(250,'Paris','French','250','euro','EUR','cent','€','French Republic','FR','FRA','France','150','155',1,'33','FR.png'),(254,'Cayenne','Guianese','254','euro','EUR','cent','€','French Guiana','GF','GUF','French Guiana','019','005',0,'594','GF.png'),(258,'Papeete','Polynesian','258','CFP franc','XPF','centime','XPF','French Polynesia','PF','PYF','French Polynesia','009','061',0,'689','PF.png'),(260,'Port-aux-Francais','of French Southern and Antarctic Lands','260','euro','EUR','cent','€','French Southern and Antarctic Lands','TF','ATF','French Southern Territories','','',0,'33','TF.png'),(262,'Djibouti','Djiboutian','262','Djibouti franc','DJF','','DJF','Republic of Djibouti','DJ','DJI','Djibouti','002','014',0,'253','DJ.png'),(266,'Libreville','Gabonese','266','CFA franc (BEAC)','XAF','centime','FCF','Gabonese Republic','GA','GAB','Gabon','002','017',0,'241','GA.png'),(268,'Tbilisi','Georgian','268','lari','GEL','tetri (inv.)','GEL','Georgia','GE','GEO','Georgia','142','145',0,'995','GE.png'),(270,'Banjul','Gambian','270','dalasi (inv.)','GMD','butut','D','Republic of the Gambia','GM','GMB','Gambia','002','011',0,'220','GM.png'),(275,NULL,'Palestinian','275',NULL,NULL,NULL,'₪',NULL,'PS','PSE','Palestinian Territory, Occupied','142','145',0,'970','PS.png'),(276,'Berlin','German','276','euro','EUR','cent','€','Federal Republic of Germany','DE','DEU','Germany','150','155',1,'49','DE.png'),(288,'Accra','Ghanaian','288','Ghana cedi','GHS','pesewa','¢','Republic of Ghana','GH','GHA','Ghana','002','011',0,'233','GH.png'),(292,'Gibraltar','Gibraltarian','292','Gibraltar pound','GIP','penny','£','Gibraltar','GI','GIB','Gibraltar','150','039',0,'350','GI.png'),(296,'Tarawa','Kiribatian','296','Australian dollar','AUD','cent','$','Republic of Kiribati','KI','KIR','Kiribati','009','057',0,'686','KI.png'),(300,'Athens','Greek','300','euro','EUR','cent','€','Hellenic Republic','GR','GRC','Greece','150','039',1,'30','GR.png'),(304,'Nuuk','Greenlander','304','Danish krone','DKK','øre (inv.)','kr','Greenland','GL','GRL','Greenland','019','021',0,'299','GL.png'),(308,'St George’s','Grenadian','308','East Caribbean dollar','XCD','cent','$','Grenada','GD','GRD','Grenada','019','029',0,'1','GD.png'),(312,'Basse Terre','Guadeloupean','312','euro','EUR ','cent','€','Guadeloupe','GP','GLP','Guadeloupe','019','029',0,'590','GP.png'),(316,'Agaña (Hagåtña)','Guamanian','316','US dollar','USD','cent','$','Territory of Guam','GU','GUM','Guam','009','057',0,'1','GU.png'),(320,'Guatemala City','Guatemalan','320','quetzal (pl. quetzales)','GTQ','centavo','Q','Republic of Guatemala','GT','GTM','Guatemala','019','013',0,'502','GT.png'),(324,'Conakry','Guinean','324','Guinean franc','GNF','','GNF','Republic of Guinea','GN','GIN','Guinea','002','011',0,'224','GN.png'),(328,'Georgetown','Guyanese','328','Guyana dollar','GYD','cent','$','Cooperative Republic of Guyana','GY','GUY','Guyana','019','005',0,'592','GY.png'),(332,'Port-au-Prince','Haitian','332','gourde','HTG','centime','G','Republic of Haiti','HT','HTI','Haiti','019','029',0,'509','HT.png'),(334,'Territory of Heard Island and McDonald Islands','of Territory of Heard Island and McDonald Islands','334','','','','$','Territory of Heard Island and McDonald Islands','HM','HMD','Heard Island and McDonald Islands','','',0,'61','HM.png'),(336,'Vatican City','of the Holy See/of the Vatican','336','euro','EUR','cent','€','the Holy See/ Vatican City State','VA','VAT','Holy See (Vatican City State)','150','039',0,'39','VA.png'),(340,'Tegucigalpa','Honduran','340','lempira','HNL','centavo','L','Republic of Honduras','HN','HND','Honduras','019','013',0,'504','HN.png'),(344,'(HK3)','Hong Kong Chinese','344','Hong Kong dollar','HKD','cent','$','Hong Kong Special Administrative Region of the People’s Republic of China (HK2)','HK','HKG','Hong Kong','142','030',0,'852','HK.png'),(348,'Budapest','Hungarian','348','forint (inv.)','HUF','(fillér (inv.))','Ft','Republic of Hungary','HU','HUN','Hungary','150','151',1,'36','HU.png'),(352,'Reykjavik','Icelander','352','króna (pl. krónur)','ISK','','kr','Republic of Iceland','IS','ISL','Iceland','150','154',1,'354','IS.png'),(356,'New Delhi','Indian','356','Indian rupee','INR','paisa','₹','Republic of India','IN','IND','India','142','034',0,'91','IN.png'),(360,'Jakarta','Indonesian','360','Indonesian rupiah (inv.)','IDR','sen (inv.)','Rp','Republic of Indonesia','ID','IDN','Indonesia','142','035',0,'62','ID.png'),(364,'Tehran','Iranian','364','Iranian rial','IRR','(dinar) (IR1)','﷼','Islamic Republic of Iran','IR','IRN','Iran, Islamic Republic of','142','034',0,'98','IR.png'),(368,'Baghdad','Iraqi','368','Iraqi dinar','IQD','fils (inv.)','IQD','Republic of Iraq','IQ','IRQ','Iraq','142','145',0,'964','IQ.png'),(372,'Dublin','Irish','372','euro','EUR','cent','€','Ireland (IE1)','IE','IRL','Ireland','150','154',1,'353','IE.png'),(376,'(IL1)','Israeli','376','shekel','ILS','agora','₪','State of Israel','IL','ISR','Israel','142','145',0,'972','IL.png'),(380,'Rome','Italian','380','euro','EUR','cent','€','Italian Republic','IT','ITA','Italy','150','039',1,'39','IT.png'),(384,'Yamoussoukro (CI1)','Ivorian','384','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Côte d’Ivoire','CI','CIV','Côte d\'Ivoire','002','011',0,'225','CI.png'),(388,'Kingston','Jamaican','388','Jamaica dollar','JMD','cent','$','Jamaica','JM','JAM','Jamaica','019','029',0,'1','JM.png'),(392,'Tokyo','Japanese','392','yen (inv.)','JPY','(sen (inv.)) (JP1)','¥','Japan','JP','JPN','Japan','142','030',0,'81','JP.png'),(398,'Astana','Kazakh','398','tenge (inv.)','KZT','tiyn','лв','Republic of Kazakhstan','KZ','KAZ','Kazakhstan','142','143',0,'7','KZ.png'),(400,'Amman','Jordanian','400','Jordanian dinar','JOD','100 qirsh','JOD','Hashemite Kingdom of Jordan','JO','JOR','Jordan','142','145',0,'962','JO.png'),(404,'Nairobi','Kenyan','404','Kenyan shilling','KES','cent','KES','Republic of Kenya','KE','KEN','Kenya','002','014',0,'254','KE.png'),(408,'Pyongyang','North Korean','408','North Korean won (inv.)','KPW','chun (inv.)','₩','Democratic People’s Republic of Korea','KP','PRK','Korea, Democratic People\'s Republic of','142','030',0,'850','KP.png'),(410,'Seoul','South Korean','410','South Korean won (inv.)','KRW','(chun (inv.))','₩','Republic of Korea','KR','KOR','Korea, Republic of','142','030',0,'82','KR.png'),(414,'Kuwait City','Kuwaiti','414','Kuwaiti dinar','KWD','fils (inv.)','KWD','State of Kuwait','KW','KWT','Kuwait','142','145',0,'965','KW.png'),(417,'Bishkek','Kyrgyz','417','som','KGS','tyiyn','лв','Kyrgyz Republic','KG','KGZ','Kyrgyzstan','142','143',0,'996','KG.png'),(418,'Vientiane','Lao','418','kip (inv.)','LAK','(at (inv.))','₭','Lao People’s Democratic Republic','LA','LAO','Lao People\'s Democratic Republic','142','035',0,'856','LA.png'),(422,'Beirut','Lebanese','422','Lebanese pound','LBP','(piastre)','£','Lebanese Republic','LB','LBN','Lebanon','142','145',0,'961','LB.png'),(426,'Maseru','Basotho','426','loti (pl. maloti)','LSL','sente','L','Kingdom of Lesotho','LS','LSO','Lesotho','002','018',0,'266','LS.png'),(428,'Riga','Latvian','428','lats (pl. lati)','LVL','santims','Ls','Republic of Latvia','LV','LVA','Latvia','150','154',1,'371','LV.png'),(430,'Monrovia','Liberian','430','Liberian dollar','LRD','cent','$','Republic of Liberia','LR','LBR','Liberia','002','011',0,'231','LR.png'),(434,'Tripoli','Libyan','434','Libyan dinar','LYD','dirham','LYD','Socialist People’s Libyan Arab Jamahiriya','LY','LBY','Libya','002','015',0,'218','LY.png'),(438,'Vaduz','Liechtensteiner','438','Swiss franc','CHF','centime','CHF','Principality of Liechtenstein','LI','LIE','Liechtenstein','150','155',1,'423','LI.png'),(440,'Vilnius','Lithuanian','440','litas (pl. litai)','LTL','centas','Lt','Republic of Lithuania','LT','LTU','Lithuania','150','154',1,'370','LT.png'),(442,'Luxembourg','Luxembourger','442','euro','EUR','cent','€','Grand Duchy of Luxembourg','LU','LUX','Luxembourg','150','155',1,'352','LU.png'),(446,'Macao (MO3)','Macanese','446','pataca','MOP','avo','MOP','Macao Special Administrative Region of the People’s Republic of China (MO2)','MO','MAC','Macao','142','030',0,'853','MO.png'),(450,'Antananarivo','Malagasy','450','ariary','MGA','iraimbilanja (inv.)','MGA','Republic of Madagascar','MG','MDG','Madagascar','002','014',0,'261','MG.png'),(454,'Lilongwe','Malawian','454','Malawian kwacha (inv.)','MWK','tambala (inv.)','MK','Republic of Malawi','MW','MWI','Malawi','002','014',0,'265','MW.png'),(458,'Kuala Lumpur (MY1)','Malaysian','458','ringgit (inv.)','MYR','sen (inv.)','RM','Malaysia','MY','MYS','Malaysia','142','035',0,'60','MY.png'),(462,'Malé','Maldivian','462','rufiyaa','MVR','laari (inv.)','Rf','Republic of Maldives','MV','MDV','Maldives','142','034',0,'960','MV.png'),(466,'Bamako','Malian','466','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Mali','ML','MLI','Mali','002','011',0,'223','ML.png'),(470,'Valletta','Maltese','470','euro','EUR','cent','MTL','Republic of Malta','MT','MLT','Malta','150','039',1,'356','MT.png'),(474,'Fort-de-France','Martinican','474','euro','EUR','cent','€','Martinique','MQ','MTQ','Martinique','019','029',0,'596','MQ.png'),(478,'Nouakchott','Mauritanian','478','ouguiya','MRO','khoum','UM','Islamic Republic of Mauritania','MR','MRT','Mauritania','002','011',0,'222','MR.png'),(480,'Port Louis','Mauritian','480','Mauritian rupee','MUR','cent','₨','Republic of Mauritius','MU','MUS','Mauritius','002','014',0,'230','MU.png'),(484,'Mexico City','Mexican','484','Mexican peso','MXN','centavo','$','United Mexican States','MX','MEX','Mexico','019','013',0,'52','MX.png'),(492,'Monaco','Monegasque','492','euro','EUR','cent','€','Principality of Monaco','MC','MCO','Monaco','150','155',0,'377','MC.png'),(496,'Ulan Bator','Mongolian','496','tugrik','MNT','möngö (inv.)','₮','Mongolia','MN','MNG','Mongolia','142','030',0,'976','MN.png'),(498,'Chisinau','Moldovan','498','Moldovan leu (pl. lei)','MDL','ban','MDL','Republic of Moldova','MD','MDA','Moldova, Republic of','150','151',0,'373','MD.png'),(499,'Podgorica','Montenegrin','499','euro','EUR','cent',NULL,'Montenegro','ME','MNE','Montenegro','150','039',0,'382',NULL),(500,'Plymouth (MS2)','Montserratian','500','East Caribbean dollar','XCD','cent','$','Montserrat','MS','MSR','Montserrat','019','029',0,'1','MS.png'),(504,'Rabat','Moroccan','504','Moroccan dirham','MAD','centime','MAD','Kingdom of Morocco','MA','MAR','Morocco','002','015',0,'212','MA.png'),(508,'Maputo','Mozambican','508','metical','MZN','centavo','MT','Republic of Mozambique','MZ','MOZ','Mozambique','002','014',0,'258','MZ.png'),(512,'Muscat','Omani','512','Omani rial','OMR','baiza','﷼','Sultanate of Oman','OM','OMN','Oman','142','145',0,'968','OM.png'),(516,'Windhoek','Namibian','516','Namibian dollar','NAD','cent','$','Republic of Namibia','NA','NAM','Namibia','002','018',0,'264','NA.png'),(520,'Yaren','Nauruan','520','Australian dollar','AUD','cent','$','Republic of Nauru','NR','NRU','Nauru','009','057',0,'674','NR.png'),(524,'Kathmandu','Nepalese','524','Nepalese rupee','NPR','paisa (inv.)','₨','Nepal','NP','NPL','Nepal','142','034',0,'977','NP.png'),(528,'Amsterdam (NL2)','Dutch','528','euro','EUR','cent','€','Kingdom of the Netherlands','NL','NLD','Netherlands','150','155',1,'31','NL.png'),(531,'Willemstad','Curaçaoan','531','Netherlands Antillean guilder (CW1)','ANG','cent',NULL,'Curaçao','CW','CUW','Curaçao','019','029',0,'599',NULL),(533,'Oranjestad','Aruban','533','Aruban guilder','AWG','cent','ƒ','Aruba','AW','ABW','Aruba','019','029',0,'297','AW.png'),(534,'Philipsburg','Sint Maartener','534','Netherlands Antillean guilder (SX1)','ANG','cent',NULL,'Sint Maarten','SX','SXM','Sint Maarten (Dutch part)','019','029',0,'721',NULL),(535,NULL,'of Bonaire, Sint Eustatius and Saba','535','US dollar','USD','cent',NULL,NULL,'BQ','BES','Bonaire, Sint Eustatius and Saba','019','029',0,'599',NULL),(540,'Nouméa','New Caledonian','540','CFP franc','XPF','centime','XPF','New Caledonia','NC','NCL','New Caledonia','009','054',0,'687','NC.png'),(548,'Port Vila','Vanuatuan','548','vatu (inv.)','VUV','','Vt','Republic of Vanuatu','VU','VUT','Vanuatu','009','054',0,'678','VU.png'),(554,'Wellington','New Zealander','554','New Zealand dollar','NZD','cent','$','New Zealand','NZ','NZL','New Zealand','009','053',0,'64','NZ.png'),(558,'Managua','Nicaraguan','558','córdoba oro','NIO','centavo','C$','Republic of Nicaragua','NI','NIC','Nicaragua','019','013',0,'505','NI.png'),(562,'Niamey','Nigerien','562','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Niger','NE','NER','Niger','002','011',0,'227','NE.png'),(566,'Abuja','Nigerian','566','naira (inv.)','NGN','kobo (inv.)','₦','Federal Republic of Nigeria','NG','NGA','Nigeria','002','011',0,'234','NG.png'),(570,'Alofi','Niuean','570','New Zealand dollar','NZD','cent','$','Niue','NU','NIU','Niue','009','061',0,'683','NU.png'),(574,'Kingston','Norfolk Islander','574','Australian dollar','AUD','cent','$','Territory of Norfolk Island','NF','NFK','Norfolk Island','009','053',0,'672','NF.png'),(578,'Oslo','Norwegian','578','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr','Kingdom of Norway','NO','NOR','Norway','150','154',1,'47','NO.png'),(580,'Saipan','Northern Mariana Islander','580','US dollar','USD','cent','$','Commonwealth of the Northern Mariana Islands','MP','MNP','Northern Mariana Islands','009','057',0,'1','MP.png'),(581,'United States Minor Outlying Islands','of United States Minor Outlying Islands','581','US dollar','USD','cent','$','United States Minor Outlying Islands','UM','UMI','United States Minor Outlying Islands','','',0,'1','UM.png'),(583,'Palikir','Micronesian','583','US dollar','USD','cent','$','Federated States of Micronesia','FM','FSM','Micronesia, Federated States of','009','057',0,'691','FM.png'),(584,'Majuro','Marshallese','584','US dollar','USD','cent','$','Republic of the Marshall Islands','MH','MHL','Marshall Islands','009','057',0,'692','MH.png'),(585,'Melekeok','Palauan','585','US dollar','USD','cent','$','Republic of Palau','PW','PLW','Palau','009','057',0,'680','PW.png'),(586,'Islamabad','Pakistani','586','Pakistani rupee','PKR','paisa','₨','Islamic Republic of Pakistan','PK','PAK','Pakistan','142','034',0,'92','PK.png'),(591,'Panama City','Panamanian','591','balboa','PAB','centésimo','B/.','Republic of Panama','PA','PAN','Panama','019','013',0,'507','PA.png'),(598,'Port Moresby','Papua New Guinean','598','kina (inv.)','PGK','toea (inv.)','PGK','Independent State of Papua New Guinea','PG','PNG','Papua New Guinea','009','054',0,'675','PG.png'),(600,'Asunción','Paraguayan','600','guaraní','PYG','céntimo','Gs','Republic of Paraguay','PY','PRY','Paraguay','019','005',0,'595','PY.png'),(604,'Lima','Peruvian','604','new sol','PEN','céntimo','S/.','Republic of Peru','PE','PER','Peru','019','005',0,'51','PE.png'),(608,'Manila','Filipino','608','Philippine peso','PHP','centavo','Php','Republic of the Philippines','PH','PHL','Philippines','142','035',0,'63','PH.png'),(612,'Adamstown','Pitcairner','612','New Zealand dollar','NZD','cent','$','Pitcairn Islands','PN','PCN','Pitcairn','009','061',0,'649','PN.png'),(616,'Warsaw','Polish','616','zloty','PLN','grosz (pl. groszy)','zł','Republic of Poland','PL','POL','Poland','150','151',1,'48','PL.png'),(620,'Lisbon','Portuguese','620','euro','EUR','cent','€','Portuguese Republic','PT','PRT','Portugal','150','039',1,'351','PT.png'),(624,'Bissau','Guinea-Bissau national','624','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Guinea-Bissau','GW','GNB','Guinea-Bissau','002','011',0,'245','GW.png'),(626,'Dili','East Timorese','626','US dollar','USD','cent','$','Democratic Republic of East Timor','TL','TLS','Timor-Leste','142','035',0,'670','TL.png'),(630,'San Juan','Puerto Rican','630','US dollar','USD','cent','$','Commonwealth of Puerto Rico','PR','PRI','Puerto Rico','019','029',0,'1','PR.png'),(634,'Doha','Qatari','634','Qatari riyal','QAR','dirham','﷼','State of Qatar','QA','QAT','Qatar','142','145',0,'974','QA.png'),(638,'Saint-Denis','Reunionese','638','euro','EUR','cent','€','Réunion','RE','REU','Réunion','002','014',0,'262','RE.png'),(642,'Bucharest','Romanian','642','Romanian leu (pl. lei)','RON','ban (pl. bani)','lei','Romania','RO','ROU','Romania','150','151',1,'40','RO.png'),(643,'Moscow','Russian','643','Russian rouble','RUB','kopek','руб','Russian Federation','RU','RUS','Russian Federation','150','151',0,'7','RU.png'),(646,'Kigali','Rwandan; Rwandese','646','Rwandese franc','RWF','centime','RWF','Republic of Rwanda','RW','RWA','Rwanda','002','014',0,'250','RW.png'),(652,'Gustavia','of Saint Barthélemy','652','euro','EUR','cent',NULL,'Collectivity of Saint Barthélemy','BL','BLM','Saint Barthélemy','019','029',0,'590',NULL),(654,'Jamestown','Saint Helenian','654','Saint Helena pound','SHP','penny','£','Saint Helena, Ascension and Tristan da Cunha','SH','SHN','Saint Helena, Ascension and Tristan da Cunha','002','011',0,'290','SH.png'),(659,'Basseterre','Kittsian; Nevisian','659','East Caribbean dollar','XCD','cent','$','Federation of Saint Kitts and Nevis','KN','KNA','Saint Kitts and Nevis','019','029',0,'1','KN.png'),(660,'The Valley','Anguillan','660','East Caribbean dollar','XCD','cent','$','Anguilla','AI','AIA','Anguilla','019','029',0,'1','AI.png'),(662,'Castries','Saint Lucian','662','East Caribbean dollar','XCD','cent','$','Saint Lucia','LC','LCA','Saint Lucia','019','029',0,'1','LC.png'),(663,'Marigot','of Saint Martin','663','euro','EUR','cent',NULL,'Collectivity of Saint Martin','MF','MAF','Saint Martin (French part)','019','029',0,'590',NULL),(666,'Saint-Pierre','St-Pierrais; Miquelonnais','666','euro','EUR','cent','€','Territorial Collectivity of Saint Pierre and Miquelon','PM','SPM','Saint Pierre and Miquelon','019','021',0,'508','PM.png'),(670,'Kingstown','Vincentian','670','East Caribbean dollar','XCD','cent','$','Saint Vincent and the Grenadines','VC','VCT','Saint Vincent and the Grenadines','019','029',0,'1','VC.png'),(674,'San Marino','San Marinese','674','euro','EUR ','cent','€','Republic of San Marino','SM','SMR','San Marino','150','039',0,'378','SM.png'),(678,'São Tomé','São Toméan','678','dobra','STD','centavo','Db','Democratic Republic of São Tomé and Príncipe','ST','STP','Sao Tome and Principe','002','017',0,'239','ST.png'),(682,'Riyadh','Saudi Arabian','682','riyal','SAR','halala','﷼','Kingdom of Saudi Arabia','SA','SAU','Saudi Arabia','142','145',0,'966','SA.png'),(686,'Dakar','Senegalese','686','CFA franc (BCEAO)','XOF','centime','XOF','Republic of Senegal','SN','SEN','Senegal','002','011',0,'221','SN.png'),(688,'Belgrade','Serb','688','Serbian dinar','RSD','para (inv.)',NULL,'Republic of Serbia','RS','SRB','Serbia','150','039',0,'381',NULL),(690,'Victoria','Seychellois','690','Seychelles rupee','SCR','cent','₨','Republic of Seychelles','SC','SYC','Seychelles','002','014',0,'248','SC.png'),(694,'Freetown','Sierra Leonean','694','leone','SLL','cent','Le','Republic of Sierra Leone','SL','SLE','Sierra Leone','002','011',0,'232','SL.png'),(702,'Singapore','Singaporean','702','Singapore dollar','SGD','cent','$','Republic of Singapore','SG','SGP','Singapore','142','035',0,'65','SG.png'),(703,'Bratislava','Slovak','703','euro','EUR','cent','Sk','Slovak Republic','SK','SVK','Slovakia','150','151',1,'421','SK.png'),(704,'Hanoi','Vietnamese','704','dong','VND','(10 hào','₫','Socialist Republic of Vietnam','VN','VNM','Viet Nam','142','035',0,'84','VN.png'),(705,'Ljubljana','Slovene','705','euro','EUR','cent','€','Republic of Slovenia','SI','SVN','Slovenia','150','039',1,'386','SI.png'),(706,'Mogadishu','Somali','706','Somali shilling','SOS','cent','S','Somali Republic','SO','SOM','Somalia','002','014',0,'252','SO.png'),(710,'Pretoria (ZA1)','South African','710','rand','ZAR','cent','R','Republic of South Africa','ZA','ZAF','South Africa','002','018',0,'27','ZA.png'),(716,'Harare','Zimbabwean','716','Zimbabwe dollar (ZW1)','ZWL','cent','Z$','Republic of Zimbabwe','ZW','ZWE','Zimbabwe','002','014',0,'263','ZW.png'),(724,'Madrid','Spaniard','724','euro','EUR','cent','€','Kingdom of Spain','ES','ESP','Spain','150','039',1,'34','ES.png'),(728,'Juba','South Sudanese','728','South Sudanese pound','SSP','piaster',NULL,'Republic of South Sudan','SS','SSD','South Sudan','002','015',0,'211',NULL),(729,'Khartoum','Sudanese','729','Sudanese pound','SDG','piastre',NULL,'Republic of the Sudan','SD','SDN','Sudan','002','015',0,'249',NULL),(732,'Al aaiun','Sahrawi','732','Moroccan dirham','MAD','centime','MAD','Western Sahara','EH','ESH','Western Sahara','002','015',0,'212','EH.png'),(740,'Paramaribo','Surinamese','740','Surinamese dollar','SRD','cent','$','Republic of Suriname','SR','SUR','Suriname','019','005',0,'597','SR.png'),(744,'Longyearbyen','of Svalbard','744','Norwegian krone (pl. kroner)','NOK','øre (inv.)','kr','Svalbard and Jan Mayen','SJ','SJM','Svalbard and Jan Mayen','150','154',0,'47','SJ.png'),(748,'Mbabane','Swazi','748','lilangeni','SZL','cent','SZL','Kingdom of Swaziland','SZ','SWZ','Swaziland','002','018',0,'268','SZ.png'),(752,'Stockholm','Swedish','752','krona (pl. kronor)','SEK','öre (inv.)','kr','Kingdom of Sweden','SE','SWE','Sweden','150','154',1,'46','SE.png'),(756,'Berne','Swiss','756','Swiss franc','CHF','centime','CHF','Swiss Confederation','CH','CHE','Switzerland','150','155',1,'41','CH.png'),(760,'Damascus','Syrian','760','Syrian pound','SYP','piastre','£','Syrian Arab Republic','SY','SYR','Syrian Arab Republic','142','145',0,'963','SY.png'),(762,'Dushanbe','Tajik','762','somoni','TJS','diram','TJS','Republic of Tajikistan','TJ','TJK','Tajikistan','142','143',0,'992','TJ.png'),(764,'Bangkok','Thai','764','baht (inv.)','THB','satang (inv.)','฿','Kingdom of Thailand','TH','THA','Thailand','142','035',0,'66','TH.png'),(768,'Lomé','Togolese','768','CFA franc (BCEAO)','XOF','centime','XOF','Togolese Republic','TG','TGO','Togo','002','011',0,'228','TG.png'),(772,'(TK2)','Tokelauan','772','New Zealand dollar','NZD','cent','$','Tokelau','TK','TKL','Tokelau','009','061',0,'690','TK.png'),(776,'Nuku’alofa','Tongan','776','pa’anga (inv.)','TOP','seniti (inv.)','T$','Kingdom of Tonga','TO','TON','Tonga','009','061',0,'676','TO.png'),(780,'Port of Spain','Trinidadian; Tobagonian','780','Trinidad and Tobago dollar','TTD','cent','TT$','Republic of Trinidad and Tobago','TT','TTO','Trinidad and Tobago','019','029',0,'1','TT.png'),(784,'Abu Dhabi','Emirian','784','UAE dirham','AED','fils (inv.)','AED','United Arab Emirates','AE','ARE','United Arab Emirates','142','145',0,'971','AE.png'),(788,'Tunis','Tunisian','788','Tunisian dinar','TND','millime','TND','Republic of Tunisia','TN','TUN','Tunisia','002','015',0,'216','TN.png'),(792,'Ankara','Turk','792','Turkish lira (inv.)','TRY','kurus (inv.)','YTL','Republic of Turkey','TR','TUR','Turkey','142','145',0,'90','TR.png'),(795,'Ashgabat','Turkmen','795','Turkmen manat (inv.)','TMT','tenge (inv.)','m','Turkmenistan','TM','TKM','Turkmenistan','142','143',0,'993','TM.png'),(796,'Cockburn Town','Turks and Caicos Islander','796','US dollar','USD','cent','$','Turks and Caicos Islands','TC','TCA','Turks and Caicos Islands','019','029',0,'1','TC.png'),(798,'Funafuti','Tuvaluan','798','Australian dollar','AUD','cent','$','Tuvalu','TV','TUV','Tuvalu','009','061',0,'688','TV.png'),(800,'Kampala','Ugandan','800','Uganda shilling','UGX','cent','UGX','Republic of Uganda','UG','UGA','Uganda','002','014',0,'256','UG.png'),(804,'Kiev','Ukrainian','804','hryvnia','UAH','kopiyka','₴','Ukraine','UA','UKR','Ukraine','150','151',0,'380','UA.png'),(807,'Skopje','of the former Yugoslav Republic of Macedonia','807','denar (pl. denars)','MKD','deni (inv.)','ден','the former Yugoslav Republic of Macedonia','MK','MKD','Macedonia, the former Yugoslav Republic of','150','039',0,'389','MK.png'),(818,'Cairo','Egyptian','818','Egyptian pound','EGP','piastre','£','Arab Republic of Egypt','EG','EGY','Egypt','002','015',0,'20','EG.png'),(826,'London','British','826','pound sterling','GBP','penny (pl. pence)','£','United Kingdom of Great Britain and Northern Ireland','GB','GBR','United Kingdom','150','154',1,'44','GB.png'),(831,'St Peter Port','of Guernsey','831','Guernsey pound (GG2)','GGP (GG2)','penny (pl. pence)',NULL,'Bailiwick of Guernsey','GG','GGY','Guernsey','150','154',0,'44',NULL),(832,'St Helier','of Jersey','832','Jersey pound (JE2)','JEP (JE2)','penny (pl. pence)',NULL,'Bailiwick of Jersey','JE','JEY','Jersey','150','154',0,'44',NULL),(833,'Douglas','Manxman; Manxwoman','833','Manx pound (IM2)','IMP (IM2)','penny (pl. pence)',NULL,'Isle of Man','IM','IMN','Isle of Man','150','154',0,'44',NULL),(834,'Dodoma (TZ1)','Tanzanian','834','Tanzanian shilling','TZS','cent','TZS','United Republic of Tanzania','TZ','TZA','Tanzania, United Republic of','002','014',0,'255','TZ.png'),(840,'Washington DC','American','840','US dollar','USD','cent','$','United States of America','US','USA','United States','019','021',0,'1','US.png'),(850,'Charlotte Amalie','US Virgin Islander','850','US dollar','USD','cent','$','United States Virgin Islands','VI','VIR','Virgin Islands, U.S.','019','029',0,'1','VI.png'),(854,'Ouagadougou','Burkinabe','854','CFA franc (BCEAO)','XOF','centime','XOF','Burkina Faso','BF','BFA','Burkina Faso','002','011',0,'226','BF.png'),(858,'Montevideo','Uruguayan','858','Uruguayan peso','UYU','centésimo','$U','Eastern Republic of Uruguay','UY','URY','Uruguay','019','005',0,'598','UY.png'),(860,'Tashkent','Uzbek','860','sum (inv.)','UZS','tiyin (inv.)','лв','Republic of Uzbekistan','UZ','UZB','Uzbekistan','142','143',0,'998','UZ.png'),(862,'Caracas','Venezuelan','862','bolívar fuerte (pl. bolívares fuertes)','VEF','céntimo','Bs','Bolivarian Republic of Venezuela','VE','VEN','Venezuela, Bolivarian Republic of','019','005',0,'58','VE.png'),(876,'Mata-Utu','Wallisian; Futunan; Wallis and Futuna Islander','876','CFP franc','XPF','centime','XPF','Wallis and Futuna','WF','WLF','Wallis and Futuna','009','061',0,'681','WF.png'),(882,'Apia','Samoan','882','tala (inv.)','WST','sene (inv.)','WS$','Independent State of Samoa','WS','WSM','Samoa','009','061',0,'685','WS.png'),(887,'San’a','Yemenite','887','Yemeni rial','YER','fils (inv.)','﷼','Republic of Yemen','YE','YEM','Yemen','142','145',0,'967','YE.png'),(894,'Lusaka','Zambian','894','Zambian kwacha (inv.)','ZMW','ngwee (inv.)','ZK','Republic of Zambia','ZM','ZMB','Zambia','002','014',0,'260','ZM.png');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coupon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `begin` date NOT NULL,
  `expire` date NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `discount` double(8,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `evaluate_id` int(11) NOT NULL,
  `link_discount` tinyint(1) NOT NULL,
  `currecy` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `decimal_place` int(11) NOT NULL,
  `value` double(15,8) NOT NULL,
  `decimal_point` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `thousand_point` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'U.S. Dollar','$','','USD',2,1.00000000,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(2,'Euro','€','','EUR',2,0.74970001,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(3,'Pound Sterling','£','','GBP',2,0.62220001,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(4,'Australian Dollar','$','','AUD',2,0.94790000,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(5,'Canadian Dollar','$','','CAD',2,0.98500001,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(6,'Czech Koruna','','Kč','CZK',2,19.16900063,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(7,'Danish Krone','kr','','DKK',2,5.59420013,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(8,'Hong Kong Dollar','$','','HKD',2,7.75290012,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(9,'Hungarian Forint','Ft','','HUF',2,221.27000427,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(10,'Israeli New Sheqel','?','','ILS',2,3.73559999,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(11,'Japanese Yen','¥','','JPY',2,88.76499939,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(12,'Mexican Peso','$','','MXN',2,12.63899994,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(13,'Norwegian Krone','kr','','NOK',2,5.52229977,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(14,'New Zealand Dollar','$','','NZD',2,1.18970001,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(15,'Philippine Peso','Php','','PHP',2,40.58000183,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(16,'Polish Zloty','','zł','PLN',2,3.08590007,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(17,'Singapore Dollar','$','','SGD',2,1.22560000,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(18,'Swedish Krona','kr','','SEK',2,6.45870018,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(19,'Swiss Franc','CHF','','CHF',2,0.92259997,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(20,'Taiwan New Dollar','NT$','','TWD',2,28.95199966,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38'),(21,'Thai Baht','฿','','THB',2,30.09499931,'.',',',1,'2013-11-29 11:51:38','2013-11-29 11:51:38');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_user` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `group_user_group_id_index` (`group_id`),
  KEY `group_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_user`
--

LOCK TABLES `group_user` WRITE;
/*!40000 ALTER TABLE `group_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_permission`
--

DROP TABLE IF EXISTS `menu_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_permission` (
  `permission_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  KEY `menu_permission_permission_id_index` (`permission_id`),
  KEY `menu_permission_menu_id_index` (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_permission`
--

LOCK TABLES `menu_permission` WRITE;
/*!40000 ALTER TABLE `menu_permission` DISABLE KEYS */;
INSERT INTO `menu_permission` VALUES (9,1),(11,2),(11,3),(1,16),(1,15),(1,14),(1,13),(1,12),(1,11),(1,10),(1,9),(1,8),(1,7),(1,1),(1,6),(1,5),(1,4),(1,3),(1,17);
/*!40000 ALTER TABLE `menu_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `in_top` tinyint(1) DEFAULT NULL,
  `_lft` int(10) unsigned DEFAULT NULL,
  `_rgt` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (3,'编辑菜单','编辑菜单','admin/menus','',1,0,2,3,1),(4,'编辑权限','编辑权限','admin/permissions','',1,0,4,5,1),(5,'编辑角色','编辑角色','admin/users/roles','',1,1,6,7,1),(6,'编辑用户组','编辑用户组','admin/groups','',1,0,8,9,1),(1,'系统设置','系统设置','','',1,0,1,12,NULL),(7,'变量设置',NULL,'admin/setting',NULL,1,0,10,11,1),(8,'Amazons',NULL,NULL,NULL,1,1,13,26,NULL),(9,'过滤规则','抓取的html内容过滤规则设置','admin/amazon/rules',NULL,1,0,14,15,8),(10,'amazon分类','amazon分类处理','admin/amazon/categories',NULL,1,0,16,17,8),(11,'词过滤','词过滤','admin/amazon/blacks',NULL,1,0,18,19,8),(12,'一级筛选结果','一级筛选产品结果','admin/amazon/products/rank',NULL,1,0,20,21,8),(13,'优先词','优先词分类数据先抓','admin/amazon/focustags',NULL,1,0,22,23,8),(14,'二级筛选结果',NULL,'admin/amazon/products/rank2',NULL,1,0,24,25,8),(15,'抓取商品',NULL,NULL,NULL,1,1,27,32,NULL),(16,'定制属性',NULL,'admin/amazon/product/options',NULL,1,0,28,29,15),(17,'商品来源','抓取亚马逊商品，做成csv','admin/amazon/products/lists',NULL,1,1,30,31,15);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=317 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (256,'2013_11_26_161501_create_currency_table',1),(257,'2014_10_12_000000_create_users_table',1),(258,'2014_10_12_100000_create_password_resets_table',1),(259,'2015_03_18_082332_create_setting_table',1),(260,'2015_03_18_092905_create_group_user_table',1),(261,'2015_03_18_095134_create_role_user_table',1),(262,'2015_03_19_033112_create_permission_role_table',1),(263,'2015_03_19_053924_create_permissions_table',1),(264,'2015_03_20_055713_create_menu_permission_table',1),(265,'2015_03_21_072522_create_groups_table',1),(266,'2015_03_21_072608_create_roles_table',1),(267,'2015_03_21_073748_create_menus_table',1),(268,'2015_07_08_134440_create_articles_table',1),(269,'2015_07_08_150726_create_categories_table',1),(270,'2015_07_08_151249_create_article_categories_table',1),(271,'2015_07_16_152244_create_comments_table',1),(272,'2015_07_29_122931_create_setting_groups_table',1),(273,'2015_07_29_123731_create_languages_table',1),(308,'2017_01_21_134124_create_amazon_focus_tags_table',5),(307,'2017_01_04_083239_create_amazon_bad_words_table',4),(282,'2016_01_28_052658_setup_countries_table',1),(283,'2016_01_28_052659_charify_countries_table',1),(284,'2016_01_28_064204_search_log',1),(285,'2016_02_04_015153_Block',1),(286,'2016_02_04_052940_page',1),(306,'2017_01_02_062839_amazon_html_rules',3),(305,'2017_01_02_061649_amazon_ok_categoies',2),(304,'2017_01_02_061611_amazon_ok_product_ranks',2),(303,'2017_01_02_061541_amazon_nok_products',2),(302,'2017_01_02_061522_amazon_ok_products',2),(301,'2017_01_02_052544_amazon_product_ranks',2),(300,'2016_12_30_092959_amazon_product_focus',2),(298,'2016_12_30_092850_amazon_categoies',2),(295,'2016_03_10_090506_create_social_accounts_table',1),(299,'2016_12_30_092902_amazon_products',2),(309,'2017_10_27_151009_create_amazon_ok_product_images_table',6),(316,'2017_10_27_162237_create_amazon_ok_product_option_provs_table',7),(315,'2017_10_27_155638_create_amazon_ok_product_option_values_table',7),(314,'2017_10_27_155043_create_amazon_ok_product_options_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_url_key_index` (`url_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  KEY `permission_role_role_id_index` (`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,10),(1,3),(1,2),(1,1),(2,2),(23,2),(23,1),(23,3),(29,1),(29,2),(29,3),(30,4),(30,3),(30,2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin的权限','admin的菜单权限','','2015-07-08 01:35:04','2016-01-04 19:23:06'),(2,'user的权限','user的菜单权限','','2015-07-08 01:35:04','2016-01-04 19:24:25'),(3,'普通人员的权限','普通人员的权限','','2015-07-10 22:49:19','2015-07-10 22:49:19'),(10,'杜兵007','无权限用户','','2015-07-10 23:24:03','2016-01-04 19:22:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','administrator',NULL,NULL),(2,'customer','customer',NULL,NULL),(3,'new customer','无权限用户',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `search_log`
--

DROP TABLE IF EXISTS `search_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `search_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `times` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `search_log`
--

LOCK TABLES `search_log` WRITE;
/*!40000 ALTER TABLE `search_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `search_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `serialized` tinyint(1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,NULL,1,'user-agent-1','User-Agent-Firefox','Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0',NULL,1),(2,NULL,1,'user-agent-2','User-Agent-chrome','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36',NULL,2),(3,NULL,1,'user-agent-3','User-Agent-Opera','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36 OPR/37.0.2178.32',NULL,3),(4,NULL,1,'user-agent-4','User-Agent-Safari','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2',NULL,4),(5,NULL,1,'user-agent-5','User-Agent-Edge','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586',NULL,5),(6,NULL,1,'user-agent-6','User-Agent-IE11','Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; rv:11.0) like Gecko',NULL,6),(7,NULL,1,'user-agent-7','User-Agent-IE10',' Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)',NULL,7),(8,NULL,2,'amazon-first-page','Amazon Page','https://www.amazon.com/gp/bestsellers/',NULL,0),(9,NULL,3,'rank-min','Rank Min','1',NULL,20),(10,NULL,3,'rank-max','Rank Max','10000',NULL,21),(11,NULL,3,'amazon-product-rank-diff-levels','统计rank等级占比','50|100|150|200|300|500|1000|3000',NULL,22),(12,NULL,3,'amazon-grab-interval','抓取间隔-默认2天抓一次','86400',NULL,23);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_groups`
--

DROP TABLE IF EXISTS `setting_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_groups`
--

LOCK TABLES `setting_groups` WRITE;
/*!40000 ALTER TABLE `setting_groups` DISABLE KEYS */;
INSERT INTO `setting_groups` VALUES (1,'User-Agents',NULL),(2,'AmazonPage',NULL),(3,'Ranks',NULL);
/*!40000 ALTER TABLE `setting_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_accounts`
--

DROP TABLE IF EXISTS `social_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_accounts` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_accounts`
--

LOCK TABLES `social_accounts` WRITE;
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ado','1303457961@qq.com','$2y$10$sVF3rfcOFTeQNCNj7tYzRe2CKVcYtOSSVNSTbxy6x9bIJ2Q7wqmW6','FoOGOxrMAwhPJwtYAXQ978p3IwHlYnqNEtEECqfK1igg9VEPV7HQ55DuaJfM',NULL,'2017-01-02 23:39:58',1),(2,'dobing','114458573@qq.com','$2y$10$ETFAgMw2QXyd4hdj1XB3Rea3/xVAqeowCyuFyvDz34EMd.W.NzA1C',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-30 13:13:59
