-- -------------------------------------------------------------
-- TablePlus 5.3.8(500)
--
-- https://tableplus.com/
--
-- Database: dinsos-kab-semarang
-- Generation Time: 2023-10-16 8:55:36.5080 PM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `aduan`;
CREATE TABLE `aduan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_aduan` int DEFAULT NULL,
  `id_user` int NOT NULL,
  `id_subkategori` int NOT NULL,
  `id_status` int NOT NULL,
  `id_role` int NOT NULL,
  `aduan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` text COLLATE utf8mb4_unicode_ci,
  `response` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_publish` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `artikel`;
CREATE TABLE `artikel` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE `carousel` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
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

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pelayanan`;
CREATE TABLE `pelayanan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_subkategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
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

DROP TABLE IF EXISTS `response_aduan_token`;
CREATE TABLE `response_aduan_token` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `subkategori`;
CREATE TABLE `subkategori` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int NOT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_or_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_no_wa_unique` (`no_wa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `carousel` (`id`, `url`, `created_at`, `updated_at`) VALUES
(1, '1.jpeg', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(2, '2.jpeg', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(3, '3.jpeg', '2023-10-16 20:47:22', '2023-10-16 20:47:22');

INSERT INTO `kategori` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'PPSKS', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(2, 'PPMKS', '2023-10-16 20:47:21', '2023-10-16 20:47:21');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_09_15_130309_create_sessions_table', 1),
(7, '2023_09_19_031116_create_role_table', 1),
(8, '2023_09_19_031126_create_status_table', 1),
(9, '2023_09_19_031132_create_aduan_table', 1),
(10, '2023_09_19_080407_create_carousel_table', 1),
(11, '2023_09_23_014530_create_kategori_table', 1),
(12, '2023_09_23_014552_create_artikel_table', 1),
(13, '2023_09_23_014601_create_berita_table', 1),
(14, '2023_09_23_025408_create_subkategori_table', 1),
(15, '2023_10_04_204008_create_response_aduan_token_table', 1),
(16, '2023_10_09_212754_create_pelayanan_table', 1);

INSERT INTO `pelayanan` (`id`, `id_subkategori`, `image`, `url`, `created_at`, `updated_at`) VALUES
(1, '1', '1.jpeg', 'https://www.instagram.com/stories/highlights/18001809232887975/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(2, '2', '2.jpeg', 'https://www.instagram.com/stories/highlights/17999752918908886/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(3, '3', '3.jpeg', 'https://www.instagram.com/stories/highlights/17992213355488244/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(4, '4', '4.jpeg', 'https://www.instagram.com/stories/highlights/18381730159001996/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(5, '5', '5.jpeg', 'https://www.instagram.com/stories/highlights/17998270802301997/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(6, '6', '6.jpeg', 'https://www.instagram.com/stories/highlights/18225447511216436/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(7, '7', '7.jpeg', 'https://www.instagram.com/stories/highlights/17919487343699865/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(8, '8', '8.jpeg', 'https://www.instagram.com/stories/highlights/18001892165002704/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(9, '9', '9.jpeg', 'https://www.instagram.com/stories/highlights/18005853031946679/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(10, '10', '10.jpeg', 'https://www.instagram.com/stories/highlights/17984869541370664/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(11, '11', '11.jpeg', 'https://www.instagram.com/stories/highlights/17979129683411514/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(12, '12', '12.jpeg', 'https://www.instagram.com/stories/highlights/18008168554788323/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(13, '13', '13.jpeg', 'https://www.instagram.com/stories/highlights/17881459520932089/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(14, '14', '14.jpeg', 'https://www.instagram.com/stories/highlights/17972043797371703/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(15, '15', '15.jpeg', 'https://www.instagram.com/stories/highlights/17862192657005402/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(16, '16', '16.jpeg', 'https://www.instagram.com/stories/highlights/18264469285083576/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(17, '17', '17.jpeg', 'https://www.instagram.com/stories/highlights/17876325899901256/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(18, '18', '18.jpeg', 'https://www.instagram.com/stories/highlights/17996043746165259/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(19, '19', '19.jpeg', 'https://www.instagram.com/stories/highlights/18232842763232421/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(20, '20', '20.jpeg', 'https://www.instagram.com/stories/highlights/18346873315076279/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(21, '21', '21.jpeg', 'https://www.instagram.com/stories/highlights/17883419633923542/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(22, '22', '22.jpeg', 'https://www.instagram.com/stories/highlights/18025422604563081/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(23, '23', '23.jpeg', 'https://www.instagram.com/stories/highlights/18038741539530397/', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(24, '24', '24.jpeg', 'https://www.instagram.com/stories/highlights/18203626645264882/', '2023-10-16 20:47:22', '2023-10-16 20:47:22');

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(2, 'kadin', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(3, 'admin1', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(4, 'admin2', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(5, 'member', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(6, 'sekretaris2', '2023-10-16 20:47:21', '2023-10-16 20:47:21');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4CQUhOJeuESgbfY7XgAdSBtHZPFT42shzXkwSvJV', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUVnUnJuc1hBbXhBeWF6MXdWbDdvZ0poaTFna2NvWVU5WEs1Zjk5WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1697464117);

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Submit', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(2, 'Verifikasi', '2023-10-16 20:47:21', '2023-10-16 20:47:21');

INSERT INTO `subkategori` (`id`, `id_kategori`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'DATA TERPADU KESEJAHTERAAN SOSIAL (DTKS)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(2, 1, 'REKOMENDASI KARTU INDONESIA PINTAR (KIP)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(3, 1, 'REKOMENDASI REAKTIVASI KARTU INDONESIA SEHAT (KIS)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(4, 1, 'REKOMENDASI ADOPSI ANAK', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(5, 1, 'PENDIRIAN PANTI LKS/LKSA', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(6, 1, 'PERPANJANGAN STD PANTI LKS/LKSA/LKSLU', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(7, 1, 'PEMBINAAN LKS/LKSA/LKSLU', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(8, 1, 'REKOMENDASI BANTUAN SATU ORANG SATU HARI (SOSH)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(9, 1, 'REKOMENDASI KERINGANAN BIAYA PAJAK KENDARAAN BERMOTOR YANG DIGUNAKAN UNTUK KEGIATAN SOSIAL', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(10, 1, 'FASILITASI BANTUAN HUKUM UNTUK MASYARAKAT MISKIN YANG BERMASALAH DENGAN HUKUM', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(11, 1, 'REKOMENDASI AKREDITASI LKS/LKSA/LKSLU', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(12, 2, 'FASILITASI BANTUAN SOSIAL PENANGGULANGAN PROGRAM KEMISKINAN (PKH)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(13, 2, 'FASILITASI BANTUAN SOSIAL PENANGGULANGAN PROGRAM KEMISKINAN (PROGRAM SEMBAKO)', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(14, 2, 'BANTUAN SOSIAL PERAWATAN DI RUMAH SAKIT', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(15, 2, 'LAYANAN BANTUAN SOSIAL RTLH WILAYAH KELURAHAN', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(16, 2, 'LAYANAN ALAT BANTU DISABILITAS', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(17, 2, 'PENINGKATAN KETERAMPILAN KEPADA PENYANDANG DISABILITAS', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(18, 2, 'LAYANAN KEPADA ORANG TERLANTAR', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(19, 2, 'REKOMENDASI LAYANAN LANSIA TERLANTAR', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(20, 2, 'REKOMENDASI KE PANTI REHABILIATSI UNTUK PENYANDANG DISABILITAS', '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(21, 2, 'LAYANAN KELOMPOK RENTAN KESEJAHTERAAN SOSIAL', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(22, 2, 'REKOMENDASI ANAK TERLANTAR', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(23, 2, 'REKOMENDASI PENDAMPINGAN ANAK DENGAN HUKUM', '2023-10-16 20:47:22', '2023-10-16 20:47:22'),
(24, 2, 'REKOMENDASI ANAK KORBAN TINDAKAN KEKERASAN', '2023-10-16 20:47:22', '2023-10-16 20:47:22');

INSERT INTO `users` (`id`, `id_role`, `profile_photo_path`, `email`, `no_wa`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `name`, `address`, `job_or_position`, `age`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'admin@gmail.com', NULL, NULL, '$2y$10$88fbnSH9kNytkbPIjOxrMO0QpJ.VQjoKbxRUV6qYM46IXsWx8SXca', NULL, NULL, NULL, 'admin', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(2, 2, NULL, 'kadin@gmail.com', NULL, NULL, '$2y$10$n8.bdn8IrEp3RcB2HkHqEOdXF2OUMLcYcsbuSvHruvI4kzQW70DV6', NULL, NULL, NULL, 'kadin', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(3, 2, NULL, 'sekretaris1@gmail.com', NULL, NULL, '$2y$10$DcypvcaMpZvikbF61R6iZejboFlrEK1CZj85SLjbQXoNjqA8M7qs.', NULL, NULL, NULL, 'Sekretaris 1', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(4, 3, NULL, 'ppsks@gmail.com', NULL, NULL, '$2y$10$aejUS1g63DEvgZf.qa0I8eXoj93psmcIlcbH3X73GFfn8njajfkgG', NULL, NULL, NULL, 'PPSKS', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(5, 4, NULL, 'ppmks@gmail.com', NULL, NULL, '$2y$10$adwsJQlnjQRO82WEzn98Wegov7m1xXVYqWE8iqXKzLSOIK5iauSYC', NULL, NULL, NULL, 'PPMKS', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(6, 5, NULL, 'member@gmail.com', NULL, NULL, '$2y$10$1q3ss4/opi5Kr0t7OFfspemBZz.RucpBREZrA/OsxZCcDegts43me', NULL, NULL, NULL, 'member', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21'),
(7, 6, NULL, 'sekretaris2@gmail.com', NULL, NULL, '$2y$10$UUaYsE9P6C1jwMJ.ey5nI.FeDMOGPtEDrqMWJt3VD/BTsVItRHK0S', NULL, NULL, NULL, 'Sekretaris 2', NULL, NULL, NULL, 1, NULL, '2023-10-16 20:47:21', '2023-10-16 20:47:21');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;