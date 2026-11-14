-- AIGUL ASQAR платформасы: базаның құрылымы (Aru Academy базасынан көшірілген, деректерсіз)
-- Импорт реті: 001_schema.sql → 002_site_data.sql → 003_demo_seed.sql

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `c_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name_kz` varchar(255) NOT NULL,
  `open` int(11) DEFAULT 1,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `block_cours_id` (`pack_id`),
  KEY `block_cours_id_2` (`cours_id`),
  CONSTRAINT `block_cours_id_2` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `block_pack_id` FOREIGN KEY (`pack_id`) REFERENCES `c_pack` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_bookmark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmark_cours_id` (`cours_id`),
  KEY `bookmark_user_id` (`user_id`),
  CONSTRAINT `bookmark_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `bookmark_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_buy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `off` int(11) DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `end_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_sub_cours_id` (`pack_id`),
  KEY `cours_sub_user_id` (`user_id`),
  KEY `pack_sub_cours_id` (`cours_id`),
  CONSTRAINT `pack_sub_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pack_sub_pack_id` FOREIGN KEY (`pack_id`) REFERENCES `c_pack` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `pack_sub_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_buy_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_buy_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `lesson_view` int(11) DEFAULT NULL,
  `lesson_stage` int(11) DEFAULT NULL,
  `lesson_end` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_info_item_id` (`lesson_id`),
  KEY `item_info_user_id` (`user_id`),
  CONSTRAINT `cours_sub_info_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `c_lesson` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `cours_sub_info_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `block_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name_kz` varchar(255) NOT NULL,
  `open` int(11) DEFAULT NULL,
  `arh` int(11) DEFAULT NULL,
  `home_work` int(11) DEFAULT NULL,
  `ques` int(11) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_block_id` (`block_id`),
  KEY `item_cours_id` (`cours_id`),
  KEY `item_pack_id` (`pack_id`),
  CONSTRAINT `item_block_id` FOREIGN KEY (`block_id`) REFERENCES `c_block` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `item_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `item_pack_id` FOREIGN KEY (`pack_id`) REFERENCES `c_pack` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_lesson_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_lesson_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `video` int(11) DEFAULT NULL,
  `video_time` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `to_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_lesson_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_lesson_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `type_video` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `cours_item_info_item_id` (`lesson_id`),
  KEY `item_info_test_id` (`test_id`),
  CONSTRAINT `item_info_item_id` FOREIGN KEY (`lesson_id`) REFERENCES `c_lesson` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `item_info_test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_pack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sole` int(11) DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT 60,
  `home_work` int(11) DEFAULT NULL,
  `offer` text DEFAULT NULL,
  `private_link` varchar(255) DEFAULT NULL,
  `open_type` int(11) DEFAULT NULL,
  `open_start` int(11) DEFAULT NULL,
  `open_days` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pack_cours_id` (`cours_id`),
  CONSTRAINT `pack_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_pack_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_pack_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pack_id` int(11) DEFAULT NULL,
  `installment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_pack_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_pack_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `txt` varchar(255) DEFAULT NULL,
  `none` int(11) DEFAULT NULL,
  `plus` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_pack_info_id` (`pack_id`),
  KEY `cours_pack_info_cours_id` (`cours_id`),
  CONSTRAINT `cours_pack_info_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `cours_pack_info_id` FOREIGN KEY (`pack_id`) REFERENCES `c_pack` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_kz` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sole` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `start_dt` datetime DEFAULT NULL,
  `offer_kz` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sub_buy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sub_buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `off` int(11) DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `end_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_id` (`sub_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `c_sub_buy_ibfk_1` FOREIGN KEY (`sub_id`) REFERENCES `c_sub` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `c_sub_buy_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sub_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sub_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `sub_open` int(11) DEFAULT NULL,
  `sub_soon` int(11) DEFAULT NULL,
  `sub_new` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `start_dt` datetime DEFAULT NULL,
  `start_txt_kz` varchar(255) DEFAULT NULL,
  `format_txt_kz` varchar(255) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  `title` text DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_id` (`cours_id`),
  KEY `c_sub_item_ibfk_2` (`sub_id`),
  KEY `autor_id` (`autor_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `c_sub_item_ibfk_1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `c_sub_item_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `c_sub` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `c_sub_item_ibfk_3` FOREIGN KEY (`autor_id`) REFERENCES `user_autor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `c_sub_item_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `c_sub_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_sub_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `item_titile` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_id` (`sub_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  `name_kz` varchar(255) NOT NULL,
  `add_name_kz` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sole` int(11) DEFAULT NULL,
  `access` int(11) NOT NULL DEFAULT 60,
  `new` int(11) DEFAULT NULL,
  `soon` int(11) DEFAULT NULL,
  `arh` int(11) DEFAULT NULL,
  `ques` int(11) DEFAULT NULL,
  `setting` int(11) DEFAULT NULL,
  `open_type` int(11) DEFAULT NULL,
  `open_start` int(11) DEFAULT NULL,
  `open_days` int(11) DEFAULT NULL,
  `private` int(11) DEFAULT NULL,
  `private_link` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `selling` int(11) DEFAULT NULL,
  `offer` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_category_id` (`category_id`),
  CONSTRAINT `cours_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cours_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cours_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `name_ru` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `item_titile` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_id` (`cours_id`),
  CONSTRAINT `cours_data_ibfk_1` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cours_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cours_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `assig` int(11) DEFAULT NULL,
  `time_s` varchar(255) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `time` text DEFAULT NULL,
  `offer_kz` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_info` (`cours_id`),
  CONSTRAINT `cours_info_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cours_word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cours_word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `txt2` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cours_word_id` (`cours_id`),
  CONSTRAINT `cours_word_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `h_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  `arh` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `home_work_user_id` (`user_id`),
  CONSTRAINT `h_chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `h_chat_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_chat_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_id` (`chat_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `h_chat_item_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `h_chat` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `h_chat_item_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `home_work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `ubd_dt` datetime DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `accept` int(11) DEFAULT NULL,
  `refusal` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `view_a` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `home_work_user_id` (`user_id`),
  KEY `home_work_cours_id` (`cours_id`),
  KEY `home_work_pack_id` (`pack_id`),
  KEY `home_work_lesson_id` (`lesson_id`),
  CONSTRAINT `home_work_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `home_work_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `c_lesson` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `home_work_pack_id` FOREIGN KEY (`pack_id`) REFERENCES `c_pack` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `home_work_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `home_work_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_work_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `view` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `home_work_item_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `home_work` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `home_work_item_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `lide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_user_id` (`user_id`),
  KEY `quiz_cours_id` (`cours_id`),
  KEY `quiz_quiz_id` (`quiz_id`),
  CONSTRAINT `quiz_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `quiz_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `ques` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `quiz_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cours_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `star` int(1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `c_sub_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `review_user_id` (`user_id`),
  KEY `review_cours_id` (`cours_id`),
  KEY `c_sub_item_id` (`c_sub_item_id`),
  KEY `review_id` (`review_id`),
  CONSTRAINT `review_cours_id` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`c_sub_item_id`) REFERENCES `c_sub_item` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `review_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_view` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `whatsapp_view` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tik-tok` varchar(255) DEFAULT NULL,
  `metrika` varchar(255) DEFAULT NULL,
  `analitics` varchar(255) DEFAULT NULL,
  `pixel` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `site_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `href` varchar(255) NOT NULL,
  `icon` text DEFAULT NULL,
  `rights` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `title_kz` text DEFAULT NULL,
  `disc_kz` text DEFAULT NULL,
  `keyw_kz` text DEFAULT NULL,
  `title_ru` text DEFAULT NULL,
  `disc_ru` text DEFAULT NULL,
  `keyw_ru` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pod_menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `txt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name_kz` varchar(255) DEFAULT NULL,
  `n` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  `age1` int(11) DEFAULT NULL,
  `age2` int(11) DEFAULT NULL,
  `answer1` int(11) DEFAULT NULL,
  `answer2` int(11) DEFAULT NULL,
  `result1` text DEFAULT NULL,
  `result2` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `test_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `tk_test_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `name` int(11) DEFAULT NULL,
  `n` int(11) DEFAULT NULL,
  `ball` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  `end_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_answer_itest_id` (`test_id`),
  KEY `test_answer_user_id` (`user_id`),
  KEY `test_answer_lesson_id` (`lesson_id`),
  KEY `tk_test_answer_id` (`tk_test_id`),
  CONSTRAINT `test_answer_itest_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `test_answer_lesson_id` FOREIGN KEY (`lesson_id`) REFERENCES `c_lesson` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `test_answer_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `tk_test_answer_id` FOREIGN KEY (`tk_test_id`) REFERENCES `tk_test_b` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `test_answer_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_answer_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_item_id` int(11) DEFAULT NULL,
  `test_answer_id` int(11) DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  `v` varchar(255) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_answer_id` (`test_answer_id`),
  KEY `test_item_id` (`test_item_id`),
  CONSTRAINT `test_answer_id` FOREIGN KEY (`test_answer_id`) REFERENCES `test_answer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `test_item_id` FOREIGN KEY (`test_item_id`) REFERENCES `test_item` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `test_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `v1` text DEFAULT NULL,
  `v2` text DEFAULT NULL,
  `v3` text DEFAULT NULL,
  `v4` text DEFAULT NULL,
  `answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`),
  CONSTRAINT `test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `tk_test_b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tk_test_b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `child_age` int(11) DEFAULT NULL,
  `n` int(11) DEFAULT NULL,
  `ball` int(11) DEFAULT NULL,
  `ins_dt` datetime DEFAULT NULL,
  `ubd_dt` datetime DEFAULT NULL,
  `end_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` bigint(15) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `code` int(4) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Қолданушы',
  `surname` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT 2,
  `locked` int(11) DEFAULT NULL,
  `right` int(1) DEFAULT NULL,
  `super_right` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  `upd_dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_autor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `bio_kz` text DEFAULT NULL,
  `specialist_kz` varchar(255) DEFAULT NULL,
  `bag` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_autor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_autor_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_autor_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `txt` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autor_info_user_id` (`user_id`),
  KEY `autor_id` (`autor_id`),
  CONSTRAINT `autor_info_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `user_autor_info_ibfk_1` FOREIGN KEY (`autor_id`) REFERENCES `user_autor` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `user_sms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sms` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ins_dt` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_sms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `word`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt` varchar(255) DEFAULT NULL,
  `txt_kz` varchar(255) DEFAULT NULL,
  `txt_ru` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `word_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `word_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `txt_kz` text DEFAULT NULL,
  `txt_ru` text DEFAULT NULL,
  `txt2_kz` text DEFAULT NULL,
  `txt2_ru` text DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

