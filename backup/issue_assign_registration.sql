-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2024 at 07:56 AM
-- Server version: 8.3.0
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `issue_assign_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Conor Zemlak', '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(2, 'Miss Kacie Gutkowski MD', '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(3, 'Jordon Runolfsdottir', '2024-06-14 02:46:33', '2024-06-14 02:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` bigint UNSIGNED NOT NULL,
  `findings` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criteria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additonal_data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_time` timestamp NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `resolution_description` text COLLATE utf8mb4_unicode_ci,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_by` bigint UNSIGNED DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `findings`, `criteria`, `additonal_data`, `target_time`, `department_id`, `status`, `resolution_description`, `file_url`, `submitted_by`, `submitted_at`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Quis dolorem quam.', 'Soluta impedit voluptas ipsam soluta non dolor. Incidunt debitis explicabo quisquam perspiciatis. Laborum quasi ut consequatur omnis eos voluptatem est.', 'Fuga commodi modi est qui amet voluptate. Et corporis ab amet id omnis. Aspernatur sint sint ipsa. Voluptatibus suscipit omnis esse quis rerum aut.', '2023-05-28 06:23:48', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(2, 'Nulla aut quo.', 'Tempore sint accusamus assumenda. Nihil eaque numquam eos adipisci. Dolor ipsam placeat facilis ut.', 'Praesentium culpa quaerat rerum eligendi voluptatem dolor eum. Labore fugiat consectetur minus est rem optio. Ipsa sed incidunt porro sed accusantium consectetur. Neque praesentium in debitis.', '1989-09-28 08:19:19', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(3, 'Eaque soluta culpa.', 'Quaerat repellat voluptatem est consequatur id et. Enim laboriosam odio in ea qui sit.', 'Laborum vero et voluptatem omnis. Corrupti vel ut velit voluptatem nam et rerum consequatur. Nihil nobis sint est illo.', '2012-07-22 04:41:09', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(4, 'Quisquam non.', 'Reprehenderit quis ullam ipsum eius. Ut iure dolorem maxime cum asperiores necessitatibus. Recusandae incidunt rerum soluta tempora.', 'Voluptas molestiae recusandae vero ut qui. Laudantium cum aut nostrum quia magnam. Sequi natus sit eos alias ea libero.', '1970-09-28 21:49:35', 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(5, 'Est quam dolorum.', 'Rerum quo pariatur impedit. Eaque sunt vel illo. Voluptates ipsum impedit porro ipsam.', 'Modi dolores dolorum soluta quod ipsam quis veritatis. Nemo explicabo omnis harum et adipisci at.', '1993-12-12 15:03:54', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(6, 'Culpa nisi.', 'Error dolorem sed distinctio et eum molestiae autem. Provident sunt consequatur non numquam dolore. Quis non architecto non est.', 'Temporibus illo consequuntur consequuntur itaque. Id dolorum aut aut tempora vitae. Eveniet autem officia nihil eaque qui dignissimos non. Fuga sed natus aut animi.', '2006-11-17 07:40:37', 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(7, 'Laboriosam quam.', 'Illo nihil illum quis facilis eum sit. In sint adipisci numquam quasi omnis. Sint fugit ratione optio voluptatem debitis. Animi accusantium nulla inventore corporis rem et tenetur.', 'Nesciunt qui aperiam voluptatem quas distinctio. Illum ab veritatis repellendus eum. Veniam quos ut sint nesciunt magni architecto est.', '2014-12-20 15:43:39', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(8, 'Repellendus eos.', 'Ratione qui alias atque sequi accusamus eos animi. Ut sed officiis rerum eaque sunt. Distinctio cum dolor quaerat maxime magnam qui ea. Tempore consequuntur modi dolor sint quibusdam et.', 'Possimus nam aspernatur tempore reiciendis facilis totam. Dolorum est et mollitia vel neque necessitatibus. Et omnis porro distinctio. Et sit maxime non voluptatem.', '1981-01-14 20:20:27', 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(9, 'Magni officia nam.', 'Voluptas eum delectus itaque molestias nisi ea. Voluptatum id sint et et ut hic dolorem non. Eum voluptates quia et ut dolor. Quae hic omnis et labore commodi delectus ratione.', 'Accusamus ut voluptatem rerum deleniti dolorem. Deleniti repellendus dignissimos et libero. Consequatur quia aut dicta est praesentium natus assumenda. Nulla ipsam fuga et labore.', '1978-01-23 21:35:12', 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(10, 'Deserunt magni.', 'Nostrum quis quia earum enim laborum doloribus praesentium sed. Ut tempora nesciunt occaecati. Tenetur corporis nobis quia aperiam. Sed quia sint ut odit vel debitis sapiente.', 'Esse dolore accusamus non atque autem accusamus magni. Ut eos quo maxime quis corporis at. Sequi beatae aliquid dolores eos possimus nam quam error. Neque quis itaque et.', '2009-04-01 22:09:00', 3, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:46:33', '2024-06-14 02:46:33'),
(11, 'asd', 'asda', 'sd', '2024-06-14 02:53:15', 1, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 02:59:04', '2024-06-14 02:59:04'),
(12, 'adasd', 'asdad', 'asdad', '2024-06-14 02:59:56', 1, 'submitted', 'sdssdsdsdsdsdsdsdsdsdsd', '[\"issue_resolutions\\/1718338285_2024-02-26-0003.jpg\"]', 5, '2024-06-14 04:11:25', NULL, '2024-06-14 03:00:02', '2024-06-14 04:11:25'),
(13, 'sdsds', 'dsds', 'dsdsds', '2024-06-21 04:12:46', 1, 'submitted', 'reere', '[\"issue_resolutions\\/1718338523_2024-02-26-0003.jpg\"]', 5, '2024-06-14 04:15:23', NULL, '2024-06-14 04:13:00', '2024-06-14 04:15:23'),
(14, 'tes123', 'critical', 'tes123', '2024-06-14 07:53:04', 2, 'pending', NULL, NULL, NULL, NULL, NULL, '2024-06-14 07:50:08', '2024-06-14 07:50:08'),
(15, 'abc', 'critical', 'abc123', '2024-06-20 07:51:00', 1, 'resolved', 'ini datanya', '[\"issue_resolutions\\/1718351553_2024-02-26-0002.jpg\"]', 5, '2024-06-14 07:52:33', 'oke', '2024-06-14 07:51:37', '2024-06-14 07:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_05_26_150035_create_departments_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_26_145856_create_issues_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) DEFAULT '0',
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `is_verified`, `department_id`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', 1, 1, NULL, '$2y$12$zQPj9ipuivuTYAZGYmsWC.h11x.zQafFYGjj9HMuPCuUlNJUwmPgS', '7vDPNrACkvc27EWKmlphpZHrVAxko9IzdwyIfKs65schIMTMLi0T4Rt3RaQr', '2024-06-14 02:46:34', '2024-06-14 02:46:34'),
(2, 'user', 'user@user.com', 0, 1, 1, '$2y$12$hZFfAlxNkUVDQTQ0fkdK/.S//WMLV4e3HiNTw5xYKWEA1nOFhiUsS', 'AvYKDKK8lH9Kith5SHhJPjJJaSzJgYj482mVCaVk7qAVEHjBV1LK5ftUnI8r', '2024-06-14 02:46:34', '2024-06-14 02:46:34'),
(3, 'user2', 'user2@user.com', 0, 1, 1, '$2y$12$XLML8EQ6nHDay2oMZkEoEeShrJC8JxICr.C32VX5b88VvsHhxvROi', 'mLIMLfxY37', '2024-06-14 02:46:34', '2024-06-14 02:46:34'),
(4, 'user3', 'user3@user.com', 0, 1, 2, '$2y$12$8FGCCcikmuv4ok3.tHFxvevXA1EiTYBGmUTw4we4s5QFSE4qKTFbq', 'kakrqJnoQN', '2024-06-14 02:46:35', '2024-06-14 02:46:35'),
(5, 'alfin', 'apinkstrong@gmail.com', 0, 1, 1, '$2y$12$UeAGx2jDGAGlfMKdZA9W.eJzaFnnhUyBDiB5fkKT.0au8tA59wjMS', NULL, '2024-06-14 03:58:01', '2024-06-14 04:05:26'),
(6, 'testing', 'testing@gmail.com', 0, 1, 1, '$2y$12$2sVfKwrzW/1gH2WC9CLYYu9tNoHvXR.FmGY4NAM4mEnc6HoCBNwSi', NULL, '2024-06-14 06:11:07', '2024-06-14 06:11:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `issues_department_id_foreign` (`department_id`),
  ADD KEY `issues_submitted_by_foreign` (`submitted_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issues_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
