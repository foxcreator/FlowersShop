-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: mysql    Database: flowers_shop
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `title_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text_uk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_text_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banners_product_id_foreign` (`product_id`),
  CONSTRAINT `banners_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_uk` text COLLATE utf8mb4_unicode_ci,
  `description_ru` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_show_on_homepage` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Букеты','Букеты','<p>БукетыБукетыБукеты</p>','<p>БукетыБукетыБукеты</p>','public/xiWpZHDyijcAT1gk_1718296321.png',1,'2024-06-13 16:32:01','2024-06-13 16:32:01');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flower_product`
--

DROP TABLE IF EXISTS `flower_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flower_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `flower_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flower_product_product_id_foreign` (`product_id`),
  KEY `flower_product_flower_id_foreign` (`flower_id`),
  CONSTRAINT `flower_product_flower_id_foreign` FOREIGN KEY (`flower_id`) REFERENCES `flowers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `flower_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flower_product`
--

LOCK TABLES `flower_product` WRITE;
/*!40000 ALTER TABLE `flower_product` DISABLE KEYS */;
INSERT INTO `flower_product` VALUES (1,100,1,NULL,NULL);
/*!40000 ALTER TABLE `flower_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flowers`
--

DROP TABLE IF EXISTS `flowers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flowers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flowers`
--

LOCK TABLES `flowers` WRITE;
/*!40000 ALTER TABLE `flowers` DISABLE KEYS */;
INSERT INTO `flowers` VALUES (1,'роза','роза','2024-06-13 16:32:34','2024-06-13 16:32:34');
/*!40000 ALTER TABLE `flowers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_03_30_132540_create_categories_table',1),(6,'2024_03_30_132647_create_products_table',1),(7,'2024_03_30_135713_create_banners_table',1),(8,'2024_03_30_140026_create_orders_table',1),(9,'2024_03_30_151428_create_order_products_table',1),(10,'2024_04_03_112656_create_product_photos_table',1),(11,'2024_04_06_183149_add_column_to_orders_table',1),(12,'2024_04_06_183959_add_column_to_order_products_table',1),(13,'2024_04_18_084505_create_subjects_table',1),(14,'2024_04_18_084515_create_flowers_table',1),(15,'2024_04_18_084948_create_product_subject_table',1),(16,'2024_04_18_085014_create_flower_product_table',1),(17,'2024_04_19_154935_create_comments_table',1),(18,'2024_04_28_130556_drop_column_from_orders_table',1),(19,'2024_04_28_130812_add_column_to_orders_table',1),(20,'2024_04_28_134927_update_column_delivery_time_in_orders_table',1),(21,'2024_05_01_101435_update_orders_table',1),(22,'2024_05_03_093452_add_column_to_users_table',1),(23,'2024_05_03_133401_create_user_favorite_products_table',1),(24,'2024_05_04_200801_add_column_to_orders_table',1),(25,'2024_05_07_152312_add_column_to_users_table',1),(26,'2024_05_09_065547_add_column_to_products_table',1),(27,'2024_05_20_154518_create_feedback_table',1),(28,'2024_05_27_123702_add_column_to_product_table',1),(29,'2024_05_28_190404_create_subcategories_table',1),(30,'2024_05_29_080134_add_column_to_products_table',1),(31,'2024_06_10_123730_add_columns_to_products_table',1),(32,'2024_06_10_161100_add_columns_to_orders_table',1),(33,'2024_06_12_084744_add_columns_to_order_products_table',1),(34,'2024_06_14_060254_update_column_in_users_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `opt_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_products_order_id_foreign` (`order_id`),
  KEY `order_products_product_id_foreign` (`product_id`),
  CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES (1,1,100,'Букет красивый 1',1,0.00,0.00,'2024-06-13 19:56:28','2024-06-13 19:56:28'),(2,2,100,'Букет красивый 1',1,0.00,0.00,'2024-06-13 19:56:33','2024-06-13 19:56:33'),(3,3,100,'Букет красивый 1',1,0.00,0.00,'2024-06-13 19:56:58','2024-06-13 19:56:58'),(4,3,101,'Букет красивый 2',1,0.00,0.00,'2024-06-13 19:56:58','2024-06-13 19:56:58'),(5,3,102,'Букет красивый 3',1,0.00,0.00,'2024-06-13 19:56:58','2024-06-13 19:56:58'),(6,4,103,'Букет красивый 4',1,0.00,0.00,'2024-06-13 20:02:23','2024-06-13 20:02:23'),(7,6,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:04:37','2024-06-13 20:04:37'),(8,7,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:04:52','2024-06-13 20:04:52'),(9,8,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:05:23','2024-06-13 20:05:23'),(10,9,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:05:39','2024-06-13 20:05:39'),(11,10,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:05:53','2024-06-13 20:05:53'),(12,11,104,'Букет красивый 5',1,60.00,50.00,'2024-06-13 20:06:04','2024-06-13 20:06:04'),(13,13,104,'Букет красивый 5',2,60.00,50.00,'2024-06-13 20:30:33','2024-06-13 20:30:33'),(14,13,105,'Букет красивый 6',1,90.00,50.00,'2024-06-13 20:30:33','2024-06-13 20:30:33'),(15,14,104,'Букет красивый 5',2,60.00,50.00,'2024-06-13 20:31:31','2024-06-13 20:31:31'),(16,14,105,'Букет красивый 6',2,90.00,50.00,'2024-06-13 20:31:31','2024-06-13 20:31:31');
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anonymously` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_option` enum('courier','self') COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_postcard` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('cash','bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `amount` decimal(8,2) NOT NULL,
  `opt_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `pay_with_bonus` decimal(8,2) DEFAULT NULL,
  `status` enum('received','progress','awaiting','executed','decline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `call` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','19:56','cash',1,320.00,150.00,NULL,'received',NULL,'2024-06-13 19:56:28','2024-06-13 19:56:28','0'),(2,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','19:56','cash',1,320.00,150.00,NULL,'received',NULL,'2024-06-13 19:56:33','2024-06-13 19:56:33','0'),(3,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','19:56','cash',1,320.00,150.00,NULL,'received',NULL,'2024-06-13 19:56:58','2024-06-13 19:56:58','0'),(4,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:02','cash',1,90.00,50.00,NULL,'executed',NULL,'2024-06-13 20:02:23','2024-06-13 20:02:23','0'),(5,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:03','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:03:56','2024-06-13 20:03:56','0'),(6,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:04','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:04:37','2024-06-13 20:04:37','0'),(7,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:04','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:04:52','2024-06-13 20:04:52','0'),(8,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:05','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:05:23','2024-06-13 20:05:23','0'),(9,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:05','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:05:39','2024-06-13 20:05:39','0'),(10,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:05','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:05:53','2024-06-13 20:05:53','0'),(11,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:06','cash',1,60.00,50.00,NULL,'executed',NULL,'2024-06-13 20:06:04','2024-06-13 20:06:04','0'),(12,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:30','cash',1,210.00,150.00,NULL,'executed',NULL,'2024-06-13 20:30:08','2024-06-13 20:30:08','0'),(13,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:30','cash',1,210.00,150.00,NULL,'executed',NULL,'2024-06-13 20:30:33','2024-06-13 20:30:33','0'),(14,6245,'thelotus@gmail.com','0','Сотрудник','0935464969','','','self',NULL,'','2024-06-13','20:31','cash',1,300.00,200.00,NULL,'executed',NULL,'2024-06-13 20:31:31','2024-06-13 20:31:31','0');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_photos`
--

DROP TABLE IF EXISTS `product_photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_photos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `order` int NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_photos_file_name_unique` (`file_name`),
  KEY `product_photos_product_id_index` (`product_id`),
  CONSTRAINT `product_photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_photos`
--

LOCK TABLES `product_photos` WRITE;
/*!40000 ALTER TABLE `product_photos` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_subject`
--

DROP TABLE IF EXISTS `product_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_subject` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_subject_product_id_foreign` (`product_id`),
  KEY `product_subject_subject_id_foreign` (`subject_id`),
  CONSTRAINT `product_subject_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `product_subject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_subject`
--

LOCK TABLES `product_subject` WRITE;
/*!40000 ALTER TABLE `product_subject` DISABLE KEYS */;
INSERT INTO `product_subject` VALUES (1,100,1,NULL,NULL);
/*!40000 ALTER TABLE `product_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `title_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `description_uk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ru` text COLLATE utf8mb4_unicode_ci,
  `quantity` double(8,2) NOT NULL,
  `article` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `badge` enum('sale','newPrice','hit','new') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` bigint unsigned NOT NULL DEFAULT '0',
  `is_novelty` tinyint(1) NOT NULL DEFAULT '0',
  `order` bigint unsigned DEFAULT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `type` enum('flower','bouquet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'flower',
  `products_quantities` json DEFAULT NULL,
  `opt_price` decimal(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (100,1,'Букет красивый 1','Букет красивый 1',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',0.00,'0000001','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 19:56:58',0,1,NULL,1,'flower','[]',50.00),(101,1,'Букет красивый 2','Букет красивый 2',120.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',0.00,'0000002','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 19:56:58',0,1,NULL,1,'flower','[]',50.00),(102,1,'Букет красивый 3','Букет красивый 3',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',0.00,'0000003','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 19:56:58',0,1,NULL,1,'flower','[]',50.00),(103,1,'Букет красивый 4','Букет красивый 4',90.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',0.00,'0000004','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 20:02:23',0,1,NULL,1,'flower','[]',50.00),(104,1,'Букет красивый 5','Букет красивый 5',60.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',5.00,'0000005','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 20:31:31',0,1,NULL,1,'flower','[]',50.00),(105,1,'Букет красивый 6','Букет красивый 6',90.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',7.00,'0000006','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 20:31:31',0,0,NULL,1,'flower','[]',50.00),(106,1,'Букет красивый 7','Букет красивый 7',130.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000007','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(107,1,'Букет красивый 8','Букет красивый 8',75.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000008','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(108,1,'Букет красивый 9','Букет красивый 9',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000009','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(109,1,'Букет красивый 10','Букет красивый 10',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000010','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(110,1,'Букет красивый 11','Букет красивый 11',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000011','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(111,1,'Букет красивый 12','Букет красивый 12',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000012','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(112,1,'Букет красивый 13','Букет красивый 13',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000013','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(113,1,'Букет красивый 14','Букет красивый 14',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000014','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(114,1,'Букет красивый 15','Букет красивый 15',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000015','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(115,1,'Букет красивый 16','Букет красивый 16',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000016','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00),(116,1,'Букет красивый 17','Букет красивый 17',100.00,'<p>Букет 1Букет 1Букет 1Букет 1</p>','<p>Букет 1Букет 1Букет 1Букет 1</p>',10.00,'0000017','public/wolhtcJUjxG16GMb_1718296468.jpg',NULL,'2024-06-13 16:34:28','2024-06-13 16:34:28',0,0,NULL,1,'flower','[]',50.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,1,'Для нее','длянее','2024-06-13 16:32:18','2024-06-13 16:32:18');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_uk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ru` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'Квіти у коробці','Цветы в коробке','2024-06-13 16:32:44','2024-06-13 16:32:44');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favorite_products`
--

DROP TABLE IF EXISTS `user_favorite_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_favorite_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_favorite_products_user_id_foreign` (`user_id`),
  KEY `user_favorite_products_product_id_foreign` (`product_id`),
  CONSTRAINT `user_favorite_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `user_favorite_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favorite_products`
--

LOCK TABLES `user_favorite_products` WRITE;
/*!40000 ALTER TABLE `user_favorite_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_favorite_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` smallint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6245,NULL,NULL,NULL,NULL,'0935464969',0.00,NULL,NULL,NULL,'$2y$12$Zn20hrC7fgleLykhjeKjJemFXfvvaLqBWMAAaHLehLoKCTgDxsQcy',2,NULL,'2024-06-13 16:26:46','2024-06-13 16:26:46');
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

-- Dump completed on 2024-06-15  7:53:14
