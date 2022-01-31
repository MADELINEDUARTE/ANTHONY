/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : sport_app

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 31/01/2022 12:31:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blogs
-- ----------------------------
DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `blogs_status_id_foreign`(`status_id`) USING BTREE,
  INDEX `blogs_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `blogs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blogs
-- ----------------------------
INSERT INTO `blogs` VALUES (1, 'Mariah.', 'Carey..', '1643381927.jpg', 'Forever...', 1, 1, NULL, '2022-01-28 14:49:13', '2022-01-28 14:58:47');
INSERT INTO `blogs` VALUES (2, 'Mariah', 'Carey', '1643563187.jpg', '1643563187.mp4', 1, 1, NULL, '2022-01-30 17:19:47', '2022-01-30 17:19:47');
INSERT INTO `blogs` VALUES (3, 'Mariah1', 'Carey1', '1643563319.jpg', '1643563319.mp4', 1, 1, NULL, '2022-01-30 17:21:14', '2022-01-30 17:21:59');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comments_subscription_id_foreign`(`subscription_id`) USING BTREE,
  INDEX `comments_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `comments_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (1, 'Abriendo', 'Puertas.', '1', 1, 1, NULL, '2022-01-28 13:50:13', '2022-01-28 13:51:09');

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, 'Venezuela', NULL, '2022-01-20 15:59:57', NULL);
INSERT INTO `countries` VALUES (2, 'Argentina', NULL, '2022-01-20 16:00:06', NULL);
INSERT INTO `countries` VALUES (3, 'España', '2022-01-20 15:59:37', '2022-01-20 15:59:37', NULL);

-- ----------------------------
-- Table structure for exercise_logs
-- ----------------------------
DROP TABLE IF EXISTS `exercise_logs`;
CREATE TABLE `exercise_logs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `exercise_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exercise_logs_exercise_id_foreign`(`exercise_id`) USING BTREE,
  INDEX `exercise_logs_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `exercise_logs_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `exercise_logs_exercise_id_foreign` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exercise_logs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exercise_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercise_logs
-- ----------------------------
INSERT INTO `exercise_logs` VALUES (1, '1011', '2022-01-28', '2022-01-29', 1, 1, 1, NULL, '2022-01-28 14:13:27', '2022-01-28 14:14:46');

-- ----------------------------
-- Table structure for exercise_videos
-- ----------------------------
DROP TABLE IF EXISTS `exercise_videos`;
CREATE TABLE `exercise_videos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exercise_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exercise_videos_exercise_id_foreign`(`exercise_id`) USING BTREE,
  INDEX `exercise_videos_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `exercise_videos_exercise_id_foreign` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exercise_videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercise_videos
-- ----------------------------
INSERT INTO `exercise_videos` VALUES (1, '1234', 1, 1, NULL, '2022-01-28 14:20:24', '2022-01-28 14:21:09');
INSERT INTO `exercise_videos` VALUES (2, '1643642240.mp4', 1, 1, NULL, '2022-01-31 15:09:11', '2022-01-31 15:17:20');

-- ----------------------------
-- Table structure for exercises
-- ----------------------------
DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `exercises_program_id_foreign`(`program_id`) USING BTREE,
  INDEX `exercises_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `exercises_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `exercises_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercises
-- ----------------------------
INSERT INTO `exercises` VALUES (1, 'tyuio', 1, 1, NULL, '2022-01-28 14:02:57', '2022-01-28 14:03:54');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for frequently_asked_questions
-- ----------------------------
DROP TABLE IF EXISTS `frequently_asked_questions`;
CREATE TABLE `frequently_asked_questions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `frequently_asked_questions_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `frequently_asked_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of frequently_asked_questions
-- ----------------------------
INSERT INTO `frequently_asked_questions` VALUES (1, 'uuu', 'ooo', 1, NULL, '2022-01-28 13:52:45', '2022-01-28 13:52:45');

-- ----------------------------
-- Table structure for genders
-- ----------------------------
DROP TABLE IF EXISTS `genders`;
CREATE TABLE `genders`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of genders
-- ----------------------------
INSERT INTO `genders` VALUES (1, 'FEMENINOS1', NULL, '2022-01-19 18:33:38', NULL);
INSERT INTO `genders` VALUES (2, 'MASCULINO444', NULL, '2022-01-19 18:34:39', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2013_01_18_162619_create_genders_table', 1);
INSERT INTO `migrations` VALUES (2, '2013_01_18_162646_create_countries_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_01_18_161958_create_sessions_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_01_18_164208_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (10, '2022_01_20_145219_create_program_categories_table', 3);
INSERT INTO `migrations` VALUES (19, '2022_01_20_145335_create_statuses_table', 4);
INSERT INTO `migrations` VALUES (20, '2022_01_20_145435_create_packages_table', 4);
INSERT INTO `migrations` VALUES (21, '2022_01_20_170309_create_programs_table', 5);
INSERT INTO `migrations` VALUES (22, '2022_01_20_191831_create_subscriptions_table', 6);
INSERT INTO `migrations` VALUES (23, '2022_01_20_192531_create_subscription_programs_table', 7);
INSERT INTO `migrations` VALUES (24, '2022_01_20_194123_create_program_days_table', 8);
INSERT INTO `migrations` VALUES (25, '2022_01_20_194850_create_suscription_program_days_routines_table', 9);
INSERT INTO `migrations` VALUES (26, '2022_01_20_204558_create_routine_logs_table', 10);
INSERT INTO `migrations` VALUES (27, '2022_01_21_133913_create_comments_table', 11);
INSERT INTO `migrations` VALUES (28, '2022_01_21_134831_create_payment_histories_table', 12);
INSERT INTO `migrations` VALUES (29, '2022_01_21_135756_create_blogs_table', 13);
INSERT INTO `migrations` VALUES (30, '2022_01_21_140453_create_frequently_asked_questions_table', 14);
INSERT INTO `migrations` VALUES (31, '2022_01_21_141253_create_user_cards_table', 15);
INSERT INTO `migrations` VALUES (32, '2022_01_21_142515_create_exercises_table', 16);
INSERT INTO `migrations` VALUES (33, '2022_01_21_143417_create_exercise_logs_table', 17);
INSERT INTO `migrations` VALUES (34, '2022_01_21_144324_create_exercise_videos_table', 18);
INSERT INTO `migrations` VALUES (35, '2022_01_21_144908_create_program_day_routines_table', 19);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);

-- ----------------------------
-- Table structure for packages
-- ----------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_programs` int NOT NULL,
  `amount` decimal(8, 2) NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `packages_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `packages_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of packages
-- ----------------------------
INSERT INTO `packages` VALUES (1, 'Walk', 'Away', 10, 20.00, 2, '2022-01-27 19:39:50', '2022-01-27 19:59:57', '2022-01-27 19:59:57');
INSERT INTO `packages` VALUES (2, 'Pretty', 'Girls', 333, 111.00, 1, '2022-01-27 19:56:32', '2022-01-27 19:56:32', NULL);
INSERT INTO `packages` VALUES (3, 'Otro', 'Another', 101, 202.00, 1, '2022-01-27 20:19:18', '2022-01-27 20:19:18', NULL);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payment_histories
-- ----------------------------
DROP TABLE IF EXISTS `payment_histories`;
CREATE TABLE `payment_histories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_date` date NOT NULL,
  `amount` decimal(8, 2) NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `payment_histories_status_id_foreign`(`status_id`) USING BTREE,
  INDEX `payment_histories_subscription_id_foreign`(`subscription_id`) USING BTREE,
  INDEX `payment_histories_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `payment_histories_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `payment_histories_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `payment_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_histories
-- ----------------------------
INSERT INTO `payment_histories` VALUES (1, '2020-10-10', 10.00, 1, 1, 1, NULL, '2022-01-28 13:56:45', '2022-01-28 13:56:45');

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'admin.home', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (2, 'admin.category.index', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (3, 'admin.category.create', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (4, 'admin.category.edit', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (5, 'admin.category.delete', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (6, 'admin.product.index', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (7, 'admin.product.create', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (8, 'admin.product.edit', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (9, 'admin.product.delete', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (10, 'admin.slider.index', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `permissions` VALUES (11, 'admin.slider.create', 'web', '2022-01-18 16:44:50', '2022-01-18 16:44:50');
INSERT INTO `permissions` VALUES (12, 'admin.slider.edit', 'web', '2022-01-18 16:44:50', '2022-01-18 16:44:50');
INSERT INTO `permissions` VALUES (13, 'admin.slider.delete', 'web', '2022-01-18 16:44:50', '2022-01-18 16:44:50');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for program_categories
-- ----------------------------
DROP TABLE IF EXISTS `program_categories`;
CREATE TABLE `program_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_categories
-- ----------------------------
INSERT INTO `program_categories` VALUES (1, 'Avanzados', '2022-01-20 16:37:50', '2022-01-20 16:38:01', NULL);
INSERT INTO `program_categories` VALUES (2, 'Otra', '2022-01-27 20:38:10', '2022-01-27 20:38:10', NULL);

-- ----------------------------
-- Table structure for program_day_routines
-- ----------------------------
DROP TABLE IF EXISTS `program_day_routines`;
CREATE TABLE `program_day_routines`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sets` int NOT NULL,
  `repetitions` int NOT NULL,
  `program_day_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `program_day_routines_program_day_id_foreign`(`program_day_id`) USING BTREE,
  INDEX `program_day_routines_status_id_foreign`(`status_id`) USING BTREE,
  INDEX `program_day_routines_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `program_day_routines_program_day_id_foreign` FOREIGN KEY (`program_day_id`) REFERENCES `program_days` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `program_day_routines_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `program_day_routines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_day_routines
-- ----------------------------
INSERT INTO `program_day_routines` VALUES (1, 'aint', 'no', 100, 200, 1, 1, 1, NULL, '2022-01-27 20:13:20', '2022-01-27 20:13:20');
INSERT INTO `program_day_routines` VALUES (2, 'Brandy1', '1643640096.mp4', 101, 10001, 1, 2, 1, NULL, '2022-01-31 14:23:00', '2022-01-31 14:41:36');

-- ----------------------------
-- Table structure for program_days
-- ----------------------------
DROP TABLE IF EXISTS `program_days`;
CREATE TABLE `program_days`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `program_days_program_id_foreign`(`program_id`) USING BTREE,
  INDEX `program_days_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `program_days_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `program_days_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_days
-- ----------------------------
INSERT INTO `program_days` VALUES (1, 4, '11', 22, 1, '2022-01-27 20:10:48', '2022-01-27 20:12:05', NULL);

-- ----------------------------
-- Table structure for programs
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_category_id` bigint UNSIGNED NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_days` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `popular` tinyint(1) NULL DEFAULT NULL,
  `recommended` tinyint(1) NULL DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `programs_program_category_id_foreign`(`program_category_id`) USING BTREE,
  INDEX `programs_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `programs_program_category_id_foreign` FOREIGN KEY (`program_category_id`) REFERENCES `program_categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `programs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES (1, 'Uno1', 'OneOne', 1, 'Dos', 3331, '1643130893.png', 1, 1, 2, '2022-01-24 14:02:38', '2022-01-25 17:48:16', NULL);
INSERT INTO `programs` VALUES (2, 'Uno', 'One', 1, 'Dos', 333, '1643033005.jpg', 0, 0, 1, '2022-01-24 14:03:25', '2022-01-24 14:03:25', NULL);
INSERT INTO `programs` VALUES (3, 'hold', 'One', 1, 'Dos', 333, '1643036194.jpg', 0, 0, 1, '2022-01-24 14:56:34', '2022-01-25 17:56:40', '2022-01-25 17:56:40');
INSERT INTO `programs` VALUES (4, 'Britney...', 'Spears...', 1, '111', 777, '1643128582.jpg', 1, 1, 1, '2022-01-25 16:36:22', '2022-01-25 17:23:40', NULL);
INSERT INTO `programs` VALUES (5, 'abc', 'def', 1, 'ghi', 1945, '1643131095.jpg', 1, 0, 1, '2022-01-25 17:18:15', '2022-01-25 17:49:44', '2022-01-25 17:49:44');
INSERT INTO `programs` VALUES (6, 'Uno1', 'One2', 1, 'Dos3', 3334, '1643133630.jpg', 0, 0, 1, '2022-01-25 18:00:05', '2022-01-25 18:00:30', NULL);
INSERT INTO `programs` VALUES (7, 'Uno', 'One', 1, 'Dos', 333, '1643401052.mp4', 0, 0, 1, '2022-01-28 20:17:32', '2022-01-28 20:17:32', NULL);
INSERT INTO `programs` VALUES (8, 'Uno', 'One', 1, '1643467685.mp4', 333, '1643467685.jpg', 0, 0, 1, '2022-01-29 14:48:05', '2022-01-29 14:48:05', NULL);
INSERT INTO `programs` VALUES (9, 'Uno29', 'One29', 2, '1643468847.mp4', 333777, '1643468847.jpg', 1, 1, 1, '2022-01-29 14:49:15', '2022-01-29 15:07:27', NULL);

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (1, 2);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (3, 2);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (4, 2);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (6, 2);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (7, 2);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (8, 2);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (9, 2);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (10, 2);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (11, 2);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (12, 2);
INSERT INTO `role_has_permissions` VALUES (13, 1);
INSERT INTO `role_has_permissions` VALUES (13, 2);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');
INSERT INTO `roles` VALUES (2, 'Marketing', 'web', '2022-01-18 16:44:49', '2022-01-18 16:44:49');

-- ----------------------------
-- Table structure for routine_logs
-- ----------------------------
DROP TABLE IF EXISTS `routine_logs`;
CREATE TABLE `routine_logs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscription_program_day_routine_id` bigint UNSIGNED NOT NULL,
  `repetitions` int UNSIGNED NOT NULL,
  `weight` int UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `spd_routine_foreign`(`subscription_program_day_routine_id`) USING BTREE,
  INDEX `routine_logs_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `routine_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `spd_routine_foreign` FOREIGN KEY (`subscription_program_day_routine_id`) REFERENCES `subscription_program_day_routines` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of routine_logs
-- ----------------------------
INSERT INTO `routine_logs` VALUES (1, 1, 10, 10, 1, NULL, '2022-01-28 13:43:23', '2022-01-28 13:43:23');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('jq705raKB3zNcV86YqVE8ROULts9Ch7aOWnrh081', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUY1dGhNVktxbWVqMkNSa1NMSHE1M3o2dnEwQVlkRFNsTEs0RFFVZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1643639964);
INSERT INTO `sessions` VALUES ('OscfT403YdFSl0rO8f61CrVWnFrSpUqxrhbaeGhG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEhEZFpiQ2R1ZEJEUkloWlY0bzlmV0hBNTk1cHVleWJKZmh4amU1TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1643639815);
INSERT INTO `sessions` VALUES ('wb3zXVBDeWsKDY2FdwPTFWTnxscMgKJi1N5qCwXN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmt3Rm1ZSk8yeVRtc0VGWm9kb09LazRMSFJGS3dLV1VVWGV6Z05jbCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluL3Byb2dyYW1kYXlyb3V0aW5lL2VkaXQvMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vcHJvZ3JhbWRheXJvdXRpbmUvZWRpdC8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1643639814);
INSERT INTO `sessions` VALUES ('YNvSfsetv1VORordbCPU3AMZjnH74PSkYnLIAEoF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:96.0) Gecko/20100101 Firefox/96.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidDRvVkpNT0U0aDl0UFRuWTE5U0RTR2YzcU1tTkRxUWozNU5vbEdmRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9leGVyY2lzZXZpZGVvcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNjQzNjM3NDYyO31zOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDgxTTdnSXh1YmFoeUo0dktKWGpBdk9BV3dlWlQxSE44c0RmZFJCM3phVm9hR3V5Lng4c01XIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCQ4MU03Z0l4dWJhaHlKNHZLSlhqQXZPQVd3ZVpUMUhOOHNEZmRSQjN6YVZvYUd1eS54OHNNVyI7fQ==', 1643642294);

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES (1, 'Activo', '2022-01-20 16:24:05', '2022-01-20 16:24:05', NULL);
INSERT INTO `statuses` VALUES (2, 'Inactivo', '2022-01-20 16:24:13', '2022-01-20 16:24:13', NULL);

-- ----------------------------
-- Table structure for subscription_program_day_routines
-- ----------------------------
DROP TABLE IF EXISTS `subscription_program_day_routines`;
CREATE TABLE `subscription_program_day_routines`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscription_programs_id` bigint UNSIGNED NOT NULL,
  `program_days_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `spd1_routine_foreign`(`subscription_programs_id`) USING BTREE,
  INDEX `spd2_routine_foreign`(`program_days_id`) USING BTREE,
  INDEX `subscription_program_day_routines_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `spd1_routine_foreign` FOREIGN KEY (`subscription_programs_id`) REFERENCES `subscription_programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `spd2_routine_foreign` FOREIGN KEY (`program_days_id`) REFERENCES `program_days` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscription_program_day_routines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscription_program_day_routines
-- ----------------------------
INSERT INTO `subscription_program_day_routines` VALUES (1, 1, 1, 1, '2022-01-27 20:35:56', '2022-01-27 20:35:56', NULL);

-- ----------------------------
-- Table structure for subscription_programs
-- ----------------------------
DROP TABLE IF EXISTS `subscription_programs`;
CREATE TABLE `subscription_programs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subscription_programs_subscription_id_foreign`(`subscription_id`) USING BTREE,
  INDEX `subscription_programs_program_id_foreign`(`program_id`) USING BTREE,
  INDEX `subscription_programs_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `subscription_programs_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `subscription_programs_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscription_programs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscription_programs_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscription_programs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscription_programs
-- ----------------------------
INSERT INTO `subscription_programs` VALUES (1, 1, 2, 1, 1, '2022-01-27 20:28:17', '2022-01-27 20:29:43', NULL);

-- ----------------------------
-- Table structure for subscriptions
-- ----------------------------
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `package_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subscriptions_package_id_foreign`(`package_id`) USING BTREE,
  INDEX `subscriptions_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `subscriptions_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `subscriptions_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscriptions_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscriptions
-- ----------------------------
INSERT INTO `subscriptions` VALUES (1, 2, 1, 2, '2022-01-27 19:41:25', '2022-01-27 19:54:55', NULL);

-- ----------------------------
-- Table structure for user_cards
-- ----------------------------
DROP TABLE IF EXISTS `user_cards`;
CREATE TABLE `user_cards`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cvv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_cards_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `user_cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_cards
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_id` bigint UNSIGNED NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `current_team_id` bigint UNSIGNED NULL DEFAULT NULL,
  `profile_photo_path` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  INDEX `users_country_id_foreign`(`country_id`) USING BTREE,
  INDEX `users_gender_id_foreign`(`gender_id`) USING BTREE,
  CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `users_gender_id_foreign` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Juan.', 'Carlos', 'Guerra', 1, '1983-01-07', 'guerramalavejuancarlos@gmail.com', NULL, '$2y$10$81M7gIxubahyJ4vKJXjAvOAWweZT1HN8sDfdRB3zaVoaGuy.x8sMW', NULL, NULL, NULL, 2, 'PALERMOS1', '+54911357744687', 'WiPMq0u8vb8cAt3vtHqnd0MyvJNrntntj6PXHFvjinpHEzgwJYT5NBhTpsIe', NULL, 'profile-photos/gUmTpBvyHTYwRwq9qHgrSIPp13tq32OJ9hZd6Ia1.jpg', '2022-01-18 16:39:33', '2022-01-28 15:23:59', NULL);
INSERT INTO `users` VALUES (2, 'Ramon', 'Jose', 'Guerra', 1, '1976-07-10', 'ramonguerra1@gmail.com', NULL, '$2y$10$.MyFEXS8euA18/J7pUrr5ue0gT1RHrNfuVNdDZw3Y03JVEO9N9Y9.', NULL, NULL, NULL, 1, 'Caracas - Venezuela', '0412-610-17-95', NULL, NULL, NULL, '2022-01-18 16:46:31', '2022-01-18 16:46:31', NULL);
INSERT INTO `users` VALUES (3, 'Oswaldo Tillman', 'Jose', 'Guerra', 1, '1976-07-10', 'austen08@example.net', '2022-01-18 16:46:31', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, 1, 'Caracas - Venezuela', '0412-610-17-95', 'Pc1ZBH1n2A', NULL, NULL, '2022-01-18 16:46:31', '2022-01-18 16:46:31', NULL);
INSERT INTO `users` VALUES (4, 'Roberto', 'Jose', 'Perez', 2, '1983-01-07', 'robertoperez@gmail.com', NULL, '$2y$10$Q8.QQhCdDcjUnBkH4bRxRezhgZL2/Ypml7khUFUehWLVrXcMuQwUm', NULL, NULL, NULL, 1, 'uio', '1135774468', NULL, NULL, NULL, '2022-01-19 19:03:42', '2022-01-19 19:03:42', NULL);
INSERT INTO `users` VALUES (5, 'Britney', 'Jean', 'Spears', 1, '1982-12-02', 'britneyspears@gmail.com', NULL, '$2y$10$Py6Q6.VP32txegHpwWN5BetAGaX9yN1HKtJNptfsZqxW/0/2nrmfK', NULL, NULL, NULL, 3, 'Los Angeles', '+54911354466', NULL, NULL, NULL, '2022-01-20 16:08:33', '2022-01-20 16:08:33', NULL);

SET FOREIGN_KEY_CHECKS = 1;
