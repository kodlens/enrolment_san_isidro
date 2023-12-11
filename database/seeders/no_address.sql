/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.4.24-MariaDB : Database - ensys_isidro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ensys_isidro` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ensys_isidro`;

/*Table structure for table `academic_years` */

DROP TABLE IF EXISTS `academic_years`;

CREATE TABLE `academic_years` (
  `academic_year_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`academic_year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `academic_years` */

insert  into `academic_years`(`academic_year_id`,`academic_year_code`,`academic_year_desc`,`is_active`,`created_at`,`updated_at`) values 
(1,'2021-1','1ST SEMESTER AY 2020-2021',0,NULL,NULL),
(2,'2021-2','2ND SEMESTER AY 2020-2021',0,NULL,NULL),
(3,'2223-1','1ST SEMESTER AY 2022-2023',0,NULL,NULL),
(4,'2223-2','2ND SEMESTER AY 2022-2023',0,NULL,NULL),
(5,'2324-1','1ST SEMESTER AY 2023-2024',1,NULL,NULL),
(6,'2324-2','2ND SEMESTER AY 2023-2024',0,NULL,NULL);

/*Table structure for table `billing_payments` */

DROP TABLE IF EXISTS `billing_payments`;

CREATE TABLE `billing_payments` (
  `billing_payment_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` bigint(20) unsigned NOT NULL,
  `academic_year_id` bigint(20) unsigned NOT NULL,
  `enroll_id` bigint(20) unsigned NOT NULL,
  `learner_id` bigint(20) unsigned NOT NULL,
  `date_paid` date DEFAULT NULL,
  `current_balance` double DEFAULT 0,
  `payment` double NOT NULL DEFAULT 0,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`billing_payment_id`),
  KEY `billing_payments_billing_id_foreign` (`billing_id`),
  KEY `billing_payments_academic_year_id_foreign` (`academic_year_id`),
  KEY `billing_payments_enroll_id_foreign` (`enroll_id`),
  KEY `learner_id` (`learner_id`),
  CONSTRAINT `billing_payments_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `billing_payments_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`billing_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `billing_payments_enroll_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `enrolls` (`enroll_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `billing_payments_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`learner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `billing_payments` */

insert  into `billing_payments`(`billing_payment_id`,`billing_id`,`academic_year_id`,`enroll_id`,`learner_id`,`date_paid`,`current_balance`,`payment`,`remarks`,`created_at`,`updated_at`) values 
(4,20,5,4,2,'2023-12-03',1650,300,NULL,'2023-12-03 19:51:58','2023-12-03 19:51:58'),
(5,20,5,4,2,'2023-12-03',1350,100,NULL,'2023-12-03 19:54:47','2023-12-03 19:54:47'),
(6,20,5,4,2,'2023-12-03',1250,250,NULL,'2023-12-03 19:55:24','2023-12-03 19:55:24'),
(7,20,5,4,2,'2023-12-03',1000,100,NULL,'2023-12-03 19:55:34','2023-12-03 19:55:34'),
(8,21,5,5,1,'2023-12-03',2350,100,NULL,'2023-12-03 20:59:11','2023-12-03 20:59:11'),
(9,21,5,5,1,'2023-12-03',2250,500,NULL,'2023-12-03 20:59:17','2023-12-03 20:59:17'),
(10,21,5,5,1,'2023-12-03',1750,500,NULL,'2023-12-03 20:59:22','2023-12-03 20:59:22'),
(11,21,5,5,1,'2023-12-03',1250,700,NULL,'2023-12-03 20:59:30','2023-12-03 20:59:30');

/*Table structure for table `billings` */

DROP TABLE IF EXISTS `billings`;

CREATE TABLE `billings` (
  `billing_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year_id` bigint(20) unsigned NOT NULL,
  `enroll_id` bigint(20) unsigned NOT NULL,
  `learner_id` bigint(20) unsigned NOT NULL,
  `date_bill` date DEFAULT NULL,
  `fee_balance` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`billing_id`),
  KEY `billings_academic_year_id_foreign` (`academic_year_id`),
  KEY `billings_enroll_id_foreign` (`enroll_id`),
  KEY `learner_id` (`learner_id`),
  CONSTRAINT `billings_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `billings_enroll_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `enrolls` (`enroll_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `billings_ibfk_1` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`learner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `billings` */

insert  into `billings`(`billing_id`,`academic_year_id`,`enroll_id`,`learner_id`,`date_bill`,`fee_balance`,`created_at`,`updated_at`) values 
(19,5,3,3,'2023-12-03',2000,'2023-12-03 15:15:35','2023-12-03 15:15:35'),
(20,5,4,2,'2023-12-03',900,'2023-12-03 17:26:30','2023-12-03 19:55:34'),
(21,5,5,1,'2023-12-03',550,'2023-12-03 20:58:57','2023-12-03 20:59:30');

/*Table structure for table `blocks` */

DROP TABLE IF EXISTS `blocks`;

CREATE TABLE `blocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blocks` */

/*Table structure for table `enroll_subjects` */

DROP TABLE IF EXISTS `enroll_subjects`;

CREATE TABLE `enroll_subjects` (
  `enroll_subject_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `enroll_id` bigint(20) unsigned NOT NULL,
  `subject_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enroll_subject_id`),
  KEY `enroll_subjects_enroll_id_foreign` (`enroll_id`),
  KEY `enroll_subjects_subject_id_foreign` (`subject_id`),
  CONSTRAINT `enroll_subjects_enroll_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `enrolls` (`enroll_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enroll_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `enroll_subjects` */

insert  into `enroll_subjects`(`enroll_subject_id`,`enroll_id`,`subject_id`,`created_at`,`updated_at`) values 
(11,3,28,NULL,NULL),
(12,3,27,NULL,NULL),
(13,3,26,NULL,NULL),
(14,3,25,NULL,NULL),
(15,4,25,NULL,NULL),
(16,5,28,NULL,NULL),
(17,5,27,NULL,NULL),
(18,5,26,NULL,NULL),
(19,5,25,NULL,NULL),
(20,5,24,NULL,NULL),
(21,5,23,NULL,NULL),
(22,5,22,NULL,NULL);

/*Table structure for table `enrolls` */

DROP TABLE IF EXISTS `enrolls`;

CREATE TABLE `enrolls` (
  `enroll_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year_id` bigint(20) unsigned NOT NULL,
  `grade_level` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learner_status` tinyint(4) NOT NULL DEFAULT 0,
  `learner_id` bigint(20) unsigned NOT NULL,
  `semester_id` bigint(20) unsigned DEFAULT 0,
  `track_id` bigint(20) unsigned DEFAULT 0,
  `strand_id` bigint(20) unsigned DEFAULT 0,
  `section_id` bigint(20) unsigned DEFAULT 0,
  `date_admission` date DEFAULT NULL,
  `date_enrolled` date DEFAULT NULL,
  `is_enrolled` tinyint(4) DEFAULT 0,
  `administer_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enroll_id`),
  KEY `enrolls_academic_year_id_foreign` (`academic_year_id`),
  KEY `enrolls_learner_id_foreign` (`learner_id`),
  CONSTRAINT `enrolls_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `enrolls_learner_id_foreign` FOREIGN KEY (`learner_id`) REFERENCES `learners` (`learner_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `enrolls` */

insert  into `enrolls`(`enroll_id`,`academic_year_id`,`grade_level`,`learner_status`,`learner_id`,`semester_id`,`track_id`,`strand_id`,`section_id`,`date_admission`,`date_enrolled`,`is_enrolled`,`administer_by`,`created_at`,`updated_at`) values 
(3,5,'GRADE 8',1,3,NULL,0,0,5,'2023-12-03','2023-12-03',1,NULL,'2023-12-03 14:37:24','2023-12-03 15:13:14'),
(4,5,'GRADE 7',1,2,NULL,0,0,13,'2023-12-03','2023-12-03',1,NULL,'2023-12-03 17:26:02','2023-12-03 17:26:30'),
(5,5,'GRADE 11',1,1,1,1,1,4,'2023-12-03','2023-12-03',1,NULL,'2023-12-03 20:58:45','2023-12-03 20:58:57');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `grade_levels` */

DROP TABLE IF EXISTS `grade_levels`;

CREATE TABLE `grade_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grade_level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `grade_levels` */

insert  into `grade_levels`(`id`,`grade_level`,`active`,`created_at`,`updated_at`) values 
(1,'GRADE 1',1,NULL,NULL),
(2,'GRADE 2',1,NULL,NULL),
(3,'GRADE 3',1,NULL,NULL),
(4,'GRADE 4',1,NULL,NULL),
(5,'GRADE 5',1,NULL,NULL),
(6,'GRADE 6',1,NULL,NULL),
(7,'GRADE 7',1,NULL,NULL),
(8,'GRADE 8',1,NULL,NULL),
(9,'GRADE 9',1,NULL,NULL),
(10,'GRADE 10',1,NULL,NULL),
(11,'GRADE 11',1,NULL,NULL),
(12,'GRADE 12',1,NULL,NULL);

/*Table structure for table `learners` */

DROP TABLE IF EXISTS `learners`;

CREATE TABLE `learners` (
  `learner_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `academic_year_id` bigint(20) unsigned NOT NULL,
  `student_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade_level` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `learner_status` tinyint(4) NOT NULL,
  `lrn` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_school_attended` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_barangay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_extension` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_contact_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_religion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_education` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_maiden_lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_maiden_fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_maiden_mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_maiden_contact_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_religion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_education` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_extension` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_contact_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester_id` bigint(20) unsigned DEFAULT 0,
  `senior_high_school_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `strand_id` bigint(20) unsigned NOT NULL DEFAULT 0,
  `administer_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`learner_id`),
  KEY `learners_academic_year_id_foreign` (`academic_year_id`),
  CONSTRAINT `learners_academic_year_id_foreign` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `learners` */

insert  into `learners`(`learner_id`,`academic_year_id`,`student_id`,`grade_level`,`learner_status`,`lrn`,`school_id`,`lname`,`fname`,`mname`,`extension`,`sex`,`birthdate`,`birthplace`,`age`,`last_school_attended`,`current_country`,`current_province`,`current_city`,`current_barangay`,`current_street`,`current_zipcode`,`contact_no`,`religion`,`father_lname`,`father_fname`,`father_mname`,`father_extension`,`father_contact_no`,`father_religion`,`father_education`,`mother_maiden_lname`,`mother_maiden_fname`,`mother_maiden_mname`,`mother_maiden_contact_no`,`mother_religion`,`mother_education`,`guardian_lname`,`guardian_fname`,`guardian_mname`,`guardian_extension`,`guardian_contact_no`,`semester_id`,`senior_high_school_id`,`track_id`,`strand_id`,`administer_by`,`created_at`,`updated_at`) values 
(1,5,'2023-000001','GRADE 11',1,'20221123231',NULL,'LABAJO','MAYESEL','','','FEMALE','1988-08-08','BAROY LANAO DEL NORTE','20','TCNHS',NULL,'0604','060408','060408005','JUAN LUNA ST.','9210',NULL,NULL,'FATHERLNAME','FATHERFNAME','FATHERMNAME','','09161234567','','','MAIDENLAST','MAIDENFIRST','MAIDENTEST','09161234567','','','GLASTNAME','GFNAME','GMNAME','GMNAME','09161234567',1,'200222',1,1,NULL,'2023-12-03 12:56:50','2023-12-03 12:56:50'),
(2,5,'2023-000002','GRADE 7',1,'20221123231',NULL,'ABAPO','JADE MARK','','','FEMALE','1988-08-08','BAROY LANAO DEL NORTE','20','TCNHS',NULL,'0606','060610','060610013','JUAN LUNA ST.','9210',NULL,NULL,'FATHERLNAME','FATHERFNAME','FATHERMNAME','','09161234567','','','MAIDENLAST','MAIDENFIRST','MAIDENTEST','09161234567','','','GLASTNAME','GFNAME','GMNAME','GMNAME','09161234567',0,'',0,0,NULL,'2023-12-03 12:57:14','2023-12-03 12:57:14'),
(3,5,'2023-000003','GRADE 8',1,'20221123231',NULL,'DELA CRUZ','JUAN','','','FEMALE','1988-08-08','BAROY LANAO DEL NORTE','20','TCNHS',NULL,'0209','020903','020903003','JUAN LUNA ST.','9210',NULL,NULL,'FATHERLNAME','FATHERFNAME','FATHERMNAME','','09161234567','','','MAIDENLAST','MAIDENFIRST','MAIDENTEST','09161234567','','','GLASTNAME','GFNAME','GMNAME','GMNAME','09161234567',0,'',0,0,NULL,'2023-12-03 13:11:06','2023-12-03 13:11:06');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=530 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(271,'2023_10_02_173854_create_subject_fees_table',1),
(441,'2023_02_09_193438_create_enrols_table',2),
(512,'2014_10_12_000000_create_users_table',3),
(513,'2014_10_12_100000_create_password_resets_table',3),
(514,'2019_08_19_000000_create_failed_jobs_table',3),
(515,'2019_12_14_000001_create_personal_access_tokens_table',3),
(516,'2023_02_09_191803_create_academic_years_table',3),
(517,'2023_02_09_191804_create_learners_table',3),
(518,'2023_02_09_191929_create_tracks_table',3),
(519,'2023_02_09_191943_create_strands_table',3),
(520,'2023_02_09_192001_create_sections_table',3),
(521,'2023_02_09_193438_create_enrolls_table',3),
(522,'2023_07_29_233531_create_semesters_table',3),
(523,'2023_08_13_092937_create_grade_levels_table',3),
(524,'2023_09_30_182757_create_religions_table',3),
(525,'2023_10_02_173738_create_subjects_table',3),
(526,'2023_10_15_191800_create_blocks_table',3),
(527,'2023_11_27_185136_create_enroll_subjects_table',3),
(528,'2023_12_03_122546_create_billings_table',3),
(529,'2023_12_03_122906_create_billing_payments_table',3);

/*Table structure for table `miscellaneous` */

DROP TABLE IF EXISTS `miscellaneous`;

CREATE TABLE `miscellaneous` (
  `misc_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `amount` double DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`misc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `miscellaneous` */

insert  into `miscellaneous`(`misc_id`,`description`,`amount`,`created_at`,`updated_at`) values 
(1,'INTERNET FEE',500,NULL,NULL),
(2,'SCHOOL MAINTENANCE',400,NULL,NULL),
(3,'OTHERS',500,NULL,NULL),
(4,'PUBLICATION',150,NULL,NULL);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `religions` */

DROP TABLE IF EXISTS `religions`;

CREATE TABLE `religions` (
  `religion_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`religion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `religions` */

insert  into `religions`(`religion_id`,`religion`,`created_at`,`updated_at`) values 
(1,'ROMAN CATHOLIC',NULL,NULL),
(2,'7TH DAY ADVENTIST',NULL,NULL);

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `section_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `max` int(11) NOT NULL DEFAULT 0,
  `section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sections` */

insert  into `sections`(`section_id`,`max`,`section`,`created_at`,`updated_at`) values 
(1,45,'CHARITY',NULL,NULL),
(2,45,'COURAGE',NULL,NULL),
(3,45,'COURTESY',NULL,NULL),
(4,45,'FAITH',NULL,NULL),
(5,45,'ALS',NULL,NULL),
(6,45,'OHSP',NULL,NULL),
(7,45,'LOYALTY',NULL,NULL),
(8,45,'STEM 1',NULL,NULL),
(9,45,'HONESTY',NULL,NULL),
(10,45,'HUMILITY',NULL,NULL),
(11,45,'INTEGRITY',NULL,NULL),
(12,45,'PERSEVERANCE',NULL,NULL),
(13,45,'OBEDIENCE',NULL,NULL),
(14,45,'PATIENCE',NULL,NULL),
(15,45,'SIMPLICITY',NULL,NULL),
(16,45,'SINCERITY',NULL,NULL),
(17,45,'AMETHYST',NULL,NULL),
(18,45,'RHODONITE',NULL,NULL),
(19,45,'GARNET',NULL,NULL),
(20,45,'OHSP - GRADE 12',NULL,NULL),
(21,45,'PEARL',NULL,NULL),
(22,45,'JADE',NULL,NULL),
(23,45,'ONYX',NULL,NULL),
(24,45,'OPAL',NULL,NULL),
(25,45,'AMBER',NULL,NULL),
(26,45,'RUBY',NULL,NULL),
(27,45,'SAPPHIRE',NULL,NULL),
(28,45,'TOPAZ',NULL,NULL),
(29,45,'QUARTZ',NULL,NULL);

/*Table structure for table `semesters` */

DROP TABLE IF EXISTS `semesters`;

CREATE TABLE `semesters` (
  `semester_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `semesters` */

insert  into `semesters`(`semester_id`,`semester`,`active`,`created_at`,`updated_at`) values 
(1,'1ST SEMESTER',0,NULL,NULL),
(2,'2ND SEMESTER',0,NULL,NULL);

/*Table structure for table `strands` */

DROP TABLE IF EXISTS `strands`;

CREATE TABLE `strands` (
  `strand_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `track_id` bigint(20) unsigned NOT NULL,
  `strand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strand_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`strand_id`),
  KEY `strands_track_id_foreign` (`track_id`),
  CONSTRAINT `strands_track_id_foreign` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `strands` */

insert  into `strands`(`strand_id`,`track_id`,`strand`,`strand_desc`,`created_at`,`updated_at`) values 
(1,1,'STEM','Science Technology Engineering and Mathematics',NULL,NULL),
(2,1,'HUMSS','Humanities and Social Sciences',NULL,NULL),
(3,1,'GAS','General Academic Strand',NULL,NULL),
(4,1,'ABM','Accountancy Business and Management',NULL,NULL),
(5,2,'ICT - ANIMATION NC II','Information and Communications Technology - Animation NC II',NULL,NULL),
(6,2,'ICT - COMPUTER PROGRAMMING NC III','Information and Communications Technology - Computer Programming NC III',NULL,NULL),
(7,2,'IA - ELECTRICAL INSTALLATION AND MAINTENANCE','Industrial Arts - Electrical Installation and Maintencance',NULL,NULL),
(8,2,'HE - TOURISM','Home Economics - Tourism',NULL,NULL),
(9,2,'HE - COOKERY','Home Economics - Cookery',NULL,NULL);

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `subject_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `units` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subjects` */

insert  into `subjects`(`subject_id`,`subject_code`,`subject_description`,`units`,`class`,`fee`,`created_at`,`updated_at`) values 
(1,'EP','EDUKASYON SA PAGKATAO','3','LEC',150,NULL,NULL),
(2,'FIL','FILIPINO','3','LEC',100,NULL,NULL),
(3,'ENGL','ENGLISH','3','LEC',200,NULL,NULL),
(4,'MATH','MATHEMATICS','3','LEC',100,NULL,NULL),
(5,'SCIENCE','SCIENCE','3','LEC',100,NULL,NULL),
(6,'ARALPAN','ARALING PANLIPUNAN','3','LEC',120,NULL,NULL),
(7,'TLE','TECHNOLOGY AND LIVELIHOOD EDUCATION / COMPUTER','3','LEC',100,NULL,NULL),
(8,'SALV HIST','SALVATION HISTORY','3','LEC',150,NULL,NULL),
(9,'ORAL COMM','ORAL COMMUNICATION','3','LEC',100,NULL,NULL),
(10,'KOMPAN','KOMUNIKASYON AT PANANALIKSIK SA WIKA AT KULTURANG PILIPINO','3','LEC',110,NULL,NULL),
(11,'GEN MATH','GENERAL MATHEMATICS','3','LEC',100,NULL,NULL),
(12,'EARTH SCIE','EARTH AND LIFE SCIENCE','3','LEC',100,NULL,NULL),
(13,'LIT 1','21st CENTURY LITERATURE FROM THE PHILIPPINES AND THE WORLD','3','LEC',130,NULL,NULL),
(14,'PE 1','PHYSICAL EDUCATION 1','3','LEC',100,NULL,NULL),
(15,'ETECH','EMPOWERMENT TECHNOLOGIES','3','LEC',120,NULL,NULL),
(16,'REL 1','INTRODUCTION TO WORLD RELIGIONS AND BELIEF SYSTEMS','3','LEC',100,NULL,NULL),
(17,'SOC SCIE','DESCIPLINE AND IDEAS IN SOCIAL SCIENCES','3','LEC',100,NULL,NULL),
(18,'CHRIST 1','CHRISTOLOGY','3','LEC',100,NULL,NULL),
(19,'ENGL 2','READING AND WRITING','3','LEC',110,NULL,NULL),
(20,'PANANALIKSIK','PAGBASA AT PAGSUSURI NG IBAT IBANG TEKSTO TUNGO SA PANANALIKSIK','3','LEC',100,NULL,NULL),
(21,'STAT','STATISTICS AND PROBABILITY','3','LEC',120,NULL,NULL),
(22,'PHYSICS','PHYSICAL SCIENCE','3','LEC',100,NULL,NULL),
(23,'PHILO','INTRODUCTION TO PHILOSOPHY OF THE HUMAN PERSON','3','LEC',150,NULL,NULL),
(24,'PE 2','PHYSICAL EDUCATION 2','3','LEC',100,NULL,NULL),
(25,'RESEARCH 1','PRACTICAL RESEARCH 1','3','LEC',100,NULL,NULL),
(26,'WRITING','CREATIVE WRITING','3','LEC',100,NULL,NULL),
(27,'PAGSULAT','MALIKHAING PAGSUSULAT','3','LEC',100,NULL,NULL),
(28,'SOC SCIE 2','DISCIPLINES AND IDEAS IN THE APPLIED SOCIAL SCIENCES','3','LEC',150,NULL,NULL);

/*Table structure for table `tracks` */

DROP TABLE IF EXISTS `tracks`;

CREATE TABLE `tracks` (
  `track_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `track` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tracks` */

insert  into `tracks`(`track_id`,`track`,`created_at`,`updated_at`) values 
(1,'ACADEMIC TRACK',NULL,NULL),
(2,'TVL TRACK',NULL,NULL),
(3,'ARTS AND DESIGN TRACK',NULL,NULL),
(4,'SPORTS TRACK',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`,`lname`,`fname`,`mname`,`extension`,`sex`,`role`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','$2y$10$bQylXMAeFI/9LLh/4XJk9OGUoLxkbFV0bKJYdQ3GGotBES3q/CIly','LABAJO','MAYISEL','P',NULL,'FEMALE','ADMINISTRATOR',NULL,NULL,NULL),
(2,'ana','$2y$10$EAZisqNb3qGm1cvaF8/CBOhbcxRjpx1J.CVd.3LdKIyqAPPqs.TmW','TALO','ANA MARIE','P',NULL,'FEMALE','REGISTRAR',NULL,NULL,NULL),
(3,'angele','$2y$10$J7xS/OP5RMYg5aT1dpfInuAU0LPiPXSVjardlVjOkmqd7WrozG1ae','MUTIA','ANGELE','P',NULL,'FEMALE','CASHIER',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
