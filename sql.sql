/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.52-0ubuntu0.14.04.1 : Database - casino10
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`casino10` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `casino10`;

/*Table structure for table `auth_assignment` */

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_assignment` */

insert  into `auth_assignment`(`item_name`,`user_id`,`created_at`) values ('admin','1',1478614467),('admin','2',1478614588),('catalogManager','2',1478614467),('catalogManager','3',1478614589);

/*Table structure for table `auth_item` */

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item` */

insert  into `auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('admin',1,NULL,NULL,NULL,1478614467,1478614467),('catalogManager',1,NULL,NULL,NULL,1478614467,1478614467),('createCatalog',2,'Create a catalog',NULL,NULL,1478614467,1478614467),('updateCatalog',2,'Update catalog',NULL,NULL,1478614467,1478614467),('updateUser',2,'Update user',NULL,NULL,1478614467,1478614467);

/*Table structure for table `auth_item_child` */

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_item_child` */

insert  into `auth_item_child`(`parent`,`child`) values ('admin','catalogManager'),('catalogManager','createCatalog'),('catalogManager','updateCatalog'),('admin','updateUser');

/*Table structure for table `auth_rule` */

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auth_rule` */

/*Table structure for table `cate_comp` */

DROP TABLE IF EXISTS `cate_comp`;

CREATE TABLE `cate_comp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-catecomp-category_id-category-id` (`category_id`),
  KEY `fk-catecomp-company_id-company-id` (`company_id`),
  CONSTRAINT `fk-catecomp-category_id-category-id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-catecomp-company_id-company-id` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cate_comp` */

insert  into `cate_comp`(`id`,`category_id`,`company_id`,`created_at`,`updated_at`) values (2,4,1,1478803367,1478803367),(3,4,2,1478866963,1478866963);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `short_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `category` */

insert  into `category`(`id`,`title`,`short_title`,`description`,`short_description`,`image_url`,`slug`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'NONE',NULL,'none','test',NULL,'NONE','NONE','NONE',1000000,1000000),(4,'Test1','stet',NULL,'test','fyacal2qtqh7rbig4zwd','test1','test','test',1478803357,1478803357);

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `logo_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `review` text COLLATE utf8_unicode_ci,
  `bonus_offer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `software` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_games` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `support` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currencies` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `languages` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feature_mobile` tinyint(1) NOT NULL DEFAULT '1',
  `feature_instant_play` tinyint(1) NOT NULL DEFAULT '1',
  `feature_download` tinyint(1) NOT NULL DEFAULT '1',
  `feature_live_casino` tinyint(1) NOT NULL DEFAULT '1',
  `feature_vip_program` tinyint(1) NOT NULL DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `company` */

insert  into `company`(`id`,`category_id`,`title`,`description`,`logo_url`,`image_url`,`website_url`,`rating`,`review`,`bonus_offer`,`software`,`type_of_games`,`support`,`currencies`,`languages`,`feature_mobile`,`feature_instant_play`,`feature_download`,`feature_live_casino`,`feature_vip_program`,`slug`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,0,'test1','**Quality** Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n**Price** Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','kpux3k0fdpqojgfxnsfg','bms1ybh60ronzjlgk7ae','https://google.com',4,'**Quality** Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\n**Price** Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','$600 for every $1500','ate','ate','ate','ate','ate',1,0,1,0,1,'test1','ate','atete',1478802818,1478882982),(2,0,'test2','afeafaewf','yqsemyffpr2ucvxr4lnf','oj3csgdotsbls8gcmoax','https://yahoo.com',4,'aefafaewfaefaw','$200 for every $1500','afeafe','aefaf','afeaef','afaef','afeafe',1,1,1,1,1,'test2','aeafeawf','afeaefa',1478866940,1478882996);

/*Table structure for table `guide` */

DROP TABLE IF EXISTS `guide`;

CREATE TABLE `guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `guide` */

insert  into `guide`(`id`,`title`,`author`,`slug`,`description`,`image_url`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'How to organize test','Jone Doe','how-to-organize-test','afeafaefaefeaf','zxejpcyu2yezmadnosk7','afeafa','afeafaefaefaefaefaef',1478882326,1478882326);

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values ('m000000_000000_base',1478614396),('m130524_201442_init',1478614399),('m140506_102106_rbac_init',1478614435),('m161108_142834_create_company_table',1478802508),('m161109_180719_create_category_table',1478802508),('m161109_190347_create_cate_comp_table',1478802508),('m161110_170051_create_guide_table',1478802508),('m161110_172805_create_page_table',1478802508),('m161110_175240_create_theme_table',1478874280);

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `page` */

insert  into `page`(`id`,`page_id`,`title`,`slug`,`description`,`meta_description`,`meta_keywords`,`created_at`,`updated_at`) values (1,'about','About','about','about','about','keywords',1476880763,1476880763),(2,'home','Home1','home','Home','about234234234234','home1',1476880763,1477498675),(3,'contact','Contact','contact','Contact','about','about',1476880763,1476880763),(4,'tos','Tos','tos','**ateataewwe**','meta','keywords',1476880763,1477498722),(5,'privacy','Privacy','privacy','Privacy\r\n','meta','meta',1476880763,1476880763),(6,'disclaimer','Disclaimer','disclaimer','Disclaimer','meta','meta',1476880788,1476880788),(8,'categories','categories','categories','afeaefe','categories','categories',1476880788,1476880788),(9,'compare','Compare','compare','**Quality** Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\nPrice Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.','compare','compare',1484353345,1478881020),(10,'guides','Guides','guide','guide','guide','guide',1484353346,1484353346);

/*Table structure for table `theme` */

DROP TABLE IF EXISTS `theme`;

CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_heading` text COLLATE utf8_unicode_ci,
  `banner_subheading` text COLLATE utf8_unicode_ci,
  `how_to_find_best` text COLLATE utf8_unicode_ci,
  `hwork_title1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_title2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_title3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_title4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_description1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_description2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_description3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hwork_description4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `theme` */

insert  into `theme`(`id`,`category_id`,`banner_image`,`banner_heading`,`banner_subheading`,`how_to_find_best`,`hwork_title1`,`hwork_title2`,`hwork_title3`,`hwork_title4`,`hwork_description1`,`hwork_description2`,`hwork_description3`,`hwork_description4`,`created_at`,`updated_at`,`contact_email`,`contact_phone`,`contact_address`) values (1,'4',NULL,'afeafe','aaefaef','afeafa','afe','abe','befe','afe','afe','afe','afefe','afeafe',14141414,1478874353,'test@test.com','123456789','random address');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values (2,'admin','Yf-o2mMa1kvDaH12Gv9ZzCrRzQM2IlOf','$2y$13$de.zBrS.yG7rYUA1Q5Qp0.e1rE5.DbpgDSOmFfZ6HGZIIKFiHhXA6',NULL,'admin@kitchenrating.com',10,1478614588,1478614588),(3,'support','087HOunXey9yXcHWt8UkvhUO_s7lm5_6','$2y$13$fqRPYM7KRInlWqGgv//LneQEn4F202FlBaf9v7JK1y/rm9QuVhfOS',NULL,'support@kitchenrating.com',10,1478614589,1478614589);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
