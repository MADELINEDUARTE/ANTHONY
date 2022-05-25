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

 Date: 25/05/2022 18:35:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog_authors
-- ----------------------------
DROP TABLE IF EXISTS `blog_authors`;
CREATE TABLE `blog_authors`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bio` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `github_handle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `twitter_handle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `blog_authors_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_authors
-- ----------------------------

-- ----------------------------
-- Table structure for blog_categories
-- ----------------------------
DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE `blog_categories`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 0,
  `seo_title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `seo_description` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `blog_categories_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_categories
-- ----------------------------

-- ----------------------------
-- Table structure for blog_posts
-- ----------------------------
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_author_id` bigint UNSIGNED NULL DEFAULT NULL,
  `blog_category_id` bigint UNSIGNED NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` date NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `blog_posts_slug_unique`(`slug`) USING BTREE,
  INDEX `blog_posts_blog_author_id_foreign`(`blog_author_id`) USING BTREE,
  INDEX `blog_posts_blog_category_id_foreign`(`blog_category_id`) USING BTREE,
  CONSTRAINT `blog_posts_blog_author_id_foreign` FOREIGN KEY (`blog_author_id`) REFERENCES `blog_authors` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `blog_posts_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blog_posts
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blogs
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES (1, 'USA', '2022-03-17 19:42:10', '2022-03-17 19:42:10', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercise_logs
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercise_videos
-- ----------------------------

-- ----------------------------
-- Table structure for exercises
-- ----------------------------
DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exercises
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of frequently_asked_questions
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of genders
-- ----------------------------
INSERT INTO `genders` VALUES (1, 'Femenino', '2022-03-17 19:42:10', '2022-03-17 19:42:10', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `migrations` VALUES (9, '2022_01_18_164208_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (10, '2022_01_20_145219_create_program_categories_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_01_20_145335_create_statuses_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_01_20_145435_create_packages_table', 1);
INSERT INTO `migrations` VALUES (13, '2022_01_20_170309_create_programs_table', 1);
INSERT INTO `migrations` VALUES (14, '2022_01_20_191831_create_subscriptions_table', 1);
INSERT INTO `migrations` VALUES (15, '2022_01_20_192531_create_subscription_programs_table', 1);
INSERT INTO `migrations` VALUES (16, '2022_01_20_194123_create_program_days_table', 1);
INSERT INTO `migrations` VALUES (17, '2022_01_20_194850_create_suscription_program_days_routines_table', 1);
INSERT INTO `migrations` VALUES (18, '2022_01_20_204558_create_routine_logs_table', 1);
INSERT INTO `migrations` VALUES (19, '2022_01_21_133913_create_comments_table', 1);
INSERT INTO `migrations` VALUES (20, '2022_01_21_134831_create_payment_histories_table', 1);
INSERT INTO `migrations` VALUES (21, '2022_01_21_135756_create_blogs_table', 1);
INSERT INTO `migrations` VALUES (22, '2022_01_21_140453_create_frequently_asked_questions_table', 1);
INSERT INTO `migrations` VALUES (23, '2022_01_21_141253_create_user_cards_table', 1);
INSERT INTO `migrations` VALUES (24, '2022_01_21_142515_create_exercises_table', 1);
INSERT INTO `migrations` VALUES (25, '2022_01_21_143417_create_exercise_logs_table', 1);
INSERT INTO `migrations` VALUES (26, '2022_01_21_144324_create_exercise_videos_table', 1);
INSERT INTO `migrations` VALUES (27, '2022_01_21_144908_create_program_day_routines_table', 1);
INSERT INTO `migrations` VALUES (28, '2022_03_09_150637_create_filament_blog_tables', 1);
INSERT INTO `migrations` VALUES (29, '2022_03_09_150637_create_tag_tables', 1);

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
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `packages_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `packages_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `packages_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `packages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of packages
-- ----------------------------
INSERT INTO `packages` VALUES (1, 'Gold', 'Puro Oro', 3, 7.00, 1, 1, '2022-03-17 19:42:11', '2022-03-17 19:42:11', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_histories
-- ----------------------------

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
INSERT INTO `permissions` VALUES (1, 'admin.home', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (2, 'admin.category.index', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (3, 'admin.category.create', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (4, 'admin.category.edit', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (5, 'admin.category.delete', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (6, 'admin.product.index', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (7, 'admin.product.create', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (8, 'admin.product.edit', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (9, 'admin.product.delete', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `permissions` VALUES (10, 'admin.slider.index', 'web', '2022-03-17 19:42:12', '2022-03-17 19:42:12');
INSERT INTO `permissions` VALUES (11, 'admin.slider.create', 'web', '2022-03-17 19:42:12', '2022-03-17 19:42:12');
INSERT INTO `permissions` VALUES (12, 'admin.slider.edit', 'web', '2022-03-17 19:42:12', '2022-03-17 19:42:12');
INSERT INTO `permissions` VALUES (13, 'admin.slider.delete', 'web', '2022-03-17 19:42:12', '2022-03-17 19:42:12');

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
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (1, 'App\\Models\\User', 9, 'authtoken', '0a5734a24cc2f25ad6dc5cb9fa1cb0edc15eb9ea0225d5187be5d4debd5defd5', '[\"*\"]', NULL, '2022-05-25 19:29:02', '2022-05-25 19:29:02');
INSERT INTO `personal_access_tokens` VALUES (2, 'App\\Models\\User', 3, 'authtoken', 'e0a2453145394220f9c6b98e9fd4af688da6d683a2ab287b3b9b6ec50f09b6c4', '[\"*\"]', NULL, '2022-05-25 19:32:17', '2022-05-25 19:32:17');
INSERT INTO `personal_access_tokens` VALUES (3, 'App\\Models\\User', 3, 'authtoken', '653c27c8f6c8dfcc1dd2f52083f4191c3a7f88c14f51ac35445e6b5ec9e3abde', '[\"*\"]', NULL, '2022-05-25 19:32:45', '2022-05-25 19:32:45');
INSERT INTO `personal_access_tokens` VALUES (4, 'App\\Models\\User', 3, 'authtoken', '021ae94592e241ac2ca4cc7976495403e44227e40ddc096aa74a2eda991f7b85', '[\"*\"]', NULL, '2022-05-25 19:36:29', '2022-05-25 19:36:29');
INSERT INTO `personal_access_tokens` VALUES (5, 'App\\Models\\User', 3, 'authtoken', 'ad03ce6ec1274588fba08258b7f7638602723f1dd47f8439fd137a2034699d15', '[\"*\"]', NULL, '2022-05-25 19:43:03', '2022-05-25 19:43:03');
INSERT INTO `personal_access_tokens` VALUES (6, 'App\\Models\\User', 3, 'authtoken', '9052636d71aa74e9265be1ace601b8d141be85475e25d76363278ec8038c7aab', '[\"*\"]', NULL, '2022-05-25 19:44:38', '2022-05-25 19:44:38');
INSERT INTO `personal_access_tokens` VALUES (7, 'App\\Models\\User', 10, 'authtoken', '6d8f4e665100a7e288440529edb92688296afd4f111d0bcf06c710e28b93f60e', '[\"*\"]', NULL, '2022-05-25 19:48:04', '2022-05-25 19:48:04');
INSERT INTO `personal_access_tokens` VALUES (8, 'App\\Models\\User', 3, 'authtoken', '488e74070c88832f21a2a6978381a27118da58c43be39133afeb46d48b2eda2d', '[\"*\"]', NULL, '2022-05-25 19:51:34', '2022-05-25 19:51:34');
INSERT INTO `personal_access_tokens` VALUES (9, 'App\\Models\\User', 3, 'authtoken', '9dd358c5fed057fa694495abe7c4df0ecbc46b54696544ff45fe6e5d5da28469', '[\"*\"]', NULL, '2022-05-25 19:52:12', '2022-05-25 19:52:12');
INSERT INTO `personal_access_tokens` VALUES (10, 'App\\Models\\User', 3, 'authtoken', '452c8a6581b014bf0c9d8f17465da105edb7ce9e822918aab1370225a55c43c3', '[\"*\"]', NULL, '2022-05-25 19:53:02', '2022-05-25 19:53:02');
INSERT INTO `personal_access_tokens` VALUES (11, 'App\\Models\\User', 3, 'authtoken', '417a7373fdb7af98853b099b4fd6ea2f7d088c994d24e6ffaca64c952965674f', '[\"*\"]', NULL, '2022-05-25 19:54:39', '2022-05-25 19:54:39');
INSERT INTO `personal_access_tokens` VALUES (12, 'App\\Models\\User', 3, 'authtoken', '73547569d11c0c8435aa9fafd406c6001121e6ca7b4b7e0fc85fe0ddc680cb78', '[\"*\"]', NULL, '2022-05-25 19:54:50', '2022-05-25 19:54:50');
INSERT INTO `personal_access_tokens` VALUES (13, 'App\\Models\\User', 3, 'authtoken', '3d2c5e3f65607343822f0556c4685a2f2bb213b7b60839515ab174a1434f0eb1', '[\"*\"]', NULL, '2022-05-25 19:55:30', '2022-05-25 19:55:30');
INSERT INTO `personal_access_tokens` VALUES (14, 'App\\Models\\User', 3, 'authtoken', 'd34580176d04d4cb62103504fd64f04c517b034b322e6c8d33ee9a8b99008229', '[\"*\"]', NULL, '2022-05-25 19:56:19', '2022-05-25 19:56:19');
INSERT INTO `personal_access_tokens` VALUES (15, 'App\\Models\\User', 3, 'authtoken', '698fcf2202079df1c9ac5b67c13f64c7552c7efca95267156fcfc261839229a9', '[\"*\"]', NULL, '2022-05-25 19:56:53', '2022-05-25 19:56:53');
INSERT INTO `personal_access_tokens` VALUES (16, 'App\\Models\\User', 3, 'authtoken', '750651430b95248f99bcb5ba53a3c2a0c773674be91a96991be1ba13a786b86f', '[\"*\"]', NULL, '2022-05-25 19:58:18', '2022-05-25 19:58:18');
INSERT INTO `personal_access_tokens` VALUES (17, 'App\\Models\\User', 3, 'authtoken', '717ee5597f4b813295113ee12d364880fc2f8570d77b175208fc01bc5e79e0f1', '[\"*\"]', NULL, '2022-05-25 19:59:33', '2022-05-25 19:59:33');
INSERT INTO `personal_access_tokens` VALUES (18, 'App\\Models\\User', 3, 'authtoken', '888aa479ede5ee1e38b4eadf64a8e4bb5e8a66379d286108a41778d77ee099ba', '[\"*\"]', NULL, '2022-05-25 19:59:45', '2022-05-25 19:59:45');
INSERT INTO `personal_access_tokens` VALUES (19, 'App\\Models\\User', 3, 'authtoken', '66d3fecb68b2efc68ce2f1d96af3fdb780643c3ca54ae02b51b158e070b306b5', '[\"*\"]', NULL, '2022-05-25 20:02:02', '2022-05-25 20:02:02');
INSERT INTO `personal_access_tokens` VALUES (20, 'App\\Models\\User', 11, 'authtoken', '20e9bea70bc41f52dd1606341aae9d63c59f8fc6a0474b21bee3364db5a869f1', '[\"*\"]', NULL, '2022-05-25 20:02:09', '2022-05-25 20:02:09');
INSERT INTO `personal_access_tokens` VALUES (21, 'App\\Models\\User', 3, 'authtoken', '21b0e6f9270f4957e066431d34b2723596cffbd496b381a69af5f78b0ce7c4e7', '[\"*\"]', NULL, '2022-05-25 20:14:41', '2022-05-25 20:14:41');
INSERT INTO `personal_access_tokens` VALUES (22, 'App\\Models\\User', 12, 'authtoken', 'fe63e7a9709cae171696d6265ac33c5ece51fb263ef8ed464ed68a45f0768e63', '[\"*\"]', NULL, '2022-05-25 20:14:50', '2022-05-25 20:14:50');
INSERT INTO `personal_access_tokens` VALUES (23, 'App\\Models\\User', 13, 'authtoken', '7d02a81126a5fceebe9603e967ba69e886166306ad867d1509a0eacf33896768', '[\"*\"]', NULL, '2022-05-25 20:17:20', '2022-05-25 20:17:20');
INSERT INTO `personal_access_tokens` VALUES (24, 'App\\Models\\User', 3, 'authtoken', 'f85d57fa76711080c7452e321c23eb9053b26eb619589d27e3dfa3b14db296a2', '[\"*\"]', NULL, '2022-05-25 20:17:58', '2022-05-25 20:17:58');
INSERT INTO `personal_access_tokens` VALUES (25, 'App\\Models\\User', 3, 'authtoken', 'b76b1c56e9ac69ab01ab279487a9e263c2ce5a98bc4a5ed3bddd78b3f8d58b94', '[\"*\"]', NULL, '2022-05-25 20:19:04', '2022-05-25 20:19:04');
INSERT INTO `personal_access_tokens` VALUES (26, 'App\\Models\\User', 3, 'authtoken', '84560c72cf75c35f61089f84216565331ca8fbb51ceef816615fc384de2a3593', '[\"*\"]', NULL, '2022-05-25 20:35:19', '2022-05-25 20:35:19');
INSERT INTO `personal_access_tokens` VALUES (27, 'App\\Models\\User', 14, 'authtoken', 'c5f043f8af1bb08a3e44ca4d99719d7a5bd0b098f56e38296d53d3bc617bebc4', '[\"*\"]', NULL, '2022-05-25 20:35:31', '2022-05-25 20:35:31');
INSERT INTO `personal_access_tokens` VALUES (28, 'App\\Models\\User', 3, 'authtoken', '8114f6e04a5a6b4d9088a50551e7426506eb69b9071c8e0c61e9fa0dafbe224e', '[\"*\"]', NULL, '2022-05-25 20:49:59', '2022-05-25 20:49:59');
INSERT INTO `personal_access_tokens` VALUES (29, 'App\\Models\\User', 7, 'authtoken', '80268e1793006797d55123285ab92af346c0c488aff7cb89cc08895857ebc335', '[\"*\"]', NULL, '2022-05-25 20:50:22', '2022-05-25 20:50:22');
INSERT INTO `personal_access_tokens` VALUES (32, 'App\\Models\\User', 15, 'authtoken', '642a674e68530f1f6e8f579671329cfb969724d1906e64531287869e66457f6e', '[\"*\"]', NULL, '2022-05-25 20:55:18', '2022-05-25 20:55:18');
INSERT INTO `personal_access_tokens` VALUES (33, 'App\\Models\\User', 15, 'authtoken', 'be8914800178b4ce0b904d0b6ddc266865ef468b5578b7e75bb77099dbc2fe21', '[\"*\"]', NULL, '2022-05-25 21:02:50', '2022-05-25 21:02:50');
INSERT INTO `personal_access_tokens` VALUES (34, 'App\\Models\\User', 15, 'authtoken', 'cb745f44ef6fd8abd0a6e46260ee83e1eb3e31f6ec133ccf33865b5cb68632db', '[\"*\"]', NULL, '2022-05-25 21:07:25', '2022-05-25 21:07:25');
INSERT INTO `personal_access_tokens` VALUES (35, 'App\\Models\\User', 16, 'authtoken', '40d52ecffcba755fb29cd833496a32d7575ef4209dd3c0d52029124764d8e293', '[\"*\"]', NULL, '2022-05-25 21:07:48', '2022-05-25 21:07:48');
INSERT INTO `personal_access_tokens` VALUES (36, 'App\\Models\\User', 17, 'authtoken', 'b9774769d28c8e7afdb2669f69867bd04e94b1ef0be8812fa043ec950774a12d', '[\"*\"]', NULL, '2022-05-25 21:11:12', '2022-05-25 21:11:12');
INSERT INTO `personal_access_tokens` VALUES (37, 'App\\Models\\User', 18, 'authtoken', '4c93f86da0ebe88e349df2153c0019f704047a830a26f5d265ef70f8c949ae0f', '[\"*\"]', NULL, '2022-05-25 21:14:49', '2022-05-25 21:14:49');
INSERT INTO `personal_access_tokens` VALUES (38, 'App\\Models\\User', 19, 'authtoken', '3ca00410b7e904a96ae28d298e16850293b26e67027362f4db63d8072bd9f7cf', '[\"*\"]', NULL, '2022-05-25 21:17:38', '2022-05-25 21:17:38');
INSERT INTO `personal_access_tokens` VALUES (39, 'App\\Models\\User', 15, 'authtoken', 'ec65cce0e4518c42b99438400985cfbe233da340e050b9ed369eccf75a89aaf8', '[\"*\"]', NULL, '2022-05-25 21:21:06', '2022-05-25 21:21:06');
INSERT INTO `personal_access_tokens` VALUES (40, 'App\\Models\\User', 15, 'authtoken', '7aa2ffe9848345d3c27a54d4f33b955ee9f788229585a0fa13b24a5e5ba2eea7', '[\"*\"]', NULL, '2022-05-25 21:23:07', '2022-05-25 21:23:07');
INSERT INTO `personal_access_tokens` VALUES (41, 'App\\Models\\User', 15, 'authtoken', '07708eb46ed04c3f99f91b84cd617483da569e07e463754af8e18da6c61ea88c', '[\"*\"]', '2022-05-25 21:25:49', '2022-05-25 21:24:08', '2022-05-25 21:25:49');
INSERT INTO `personal_access_tokens` VALUES (42, 'App\\Models\\User', 15, 'authtoken', '3acc50a0938cb8f1873cae49f4161e88a9ae681fe32f196ad9e07495384bbd3c', '[\"*\"]', '2022-05-25 21:34:02', '2022-05-25 21:27:02', '2022-05-25 21:34:02');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_categories
-- ----------------------------
INSERT INTO `program_categories` VALUES (1, 'Legs', '2022-03-17 19:42:11', '2022-03-17 19:42:11', NULL);

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
  `program_id` int NOT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_day_routines
-- ----------------------------
INSERT INTO `program_day_routines` VALUES (1, '120', 'programs/day/routine/video/blob', 120, 200, 4, 1, 1, 1, NULL, '2022-05-13 16:06:33', '2022-05-13 16:06:33');

-- ----------------------------
-- Table structure for program_days
-- ----------------------------
DROP TABLE IF EXISTS `program_days`;
CREATE TABLE `program_days`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `program_days` VALUES (1, 4, 'test', '<p>500</p>', 100, 1, '2022-05-13 16:06:09', '2022-05-13 16:06:09', NULL);

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
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `programs_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `programs_program_category_id_foreign`(`program_category_id`) USING BTREE,
  INDEX `programs_status_id_foreign`(`status_id`) USING BTREE,
  CONSTRAINT `programs_program_category_id_foreign` FOREIGN KEY (`program_category_id`) REFERENCES `program_categories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `programs_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `programs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES (1, '1', '<p>1</p>', 1, 'programs/video/blob', 1, 'programs/images/e4xJmRjybGeXtmssE8WR6LoOPUOmbp-metaYmxvYg==-.jpg', 1, 1, 1, 1, '2022-03-17 21:54:45', '2022-03-17 21:55:46', NULL);
INSERT INTO `programs` VALUES (2, '2', '<p>2</p>', 1, 'programs/video/TF5JWLNqKxhQYXmRaIdVqjghD8MhbZ-metaYmxvYg==-.png', 2, 'programs/images/HuTfLL3U7WjlGu6otITXrauRZqwfTn-metaYmxvYg==-.png', 1, 1, 1, 1, '2022-03-17 21:56:34', '2022-03-17 22:17:19', NULL);
INSERT INTO `programs` VALUES (3, 'test', '<p>prueba</p>', 1, 'programs/video/WyNe0EPCbVy2KrdNwl4s6hXJ1RfPsu-metaYmxvYg==-.jpg', 100, 'programs/images/t8pCHrKF0rP2KzHWuBVJZUGVXcl1oi-metaYmxvYg==-.jpg', 1, 1, 1, 1, '2022-03-23 16:35:56', '2022-03-23 16:35:56', NULL);
INSERT INTO `programs` VALUES (4, 'Becky G', '<p>Esta es una prueba</p>', 1, 'programs/video/o79wVtchLbBV3WHBchpSkzUcPYfyvA-metaeTJtYXRlLmNvbSAtIEZsYXdsZXNzXzcyMHBfVHJpbS5tcDQ=-.mp4', 100, 'programs/images/Th89pu93ndSYoEBaq6ertTounsqnRg-metaYmxvYg==-.jpg', 1, 1, 1, 1, '2022-05-13 16:05:52', '2022-05-13 16:05:52', NULL);

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
INSERT INTO `roles` VALUES (1, 'Admin', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');
INSERT INTO `roles` VALUES (2, 'Marketing', 'web', '2022-03-17 19:42:11', '2022-03-17 19:42:11');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of routine_logs
-- ----------------------------

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
INSERT INTO `sessions` VALUES ('3EyHTtjwHmCc4yYCixvr2PUWp0USyaVPDXHrCZ0r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMnlScW5YdHp5dHlMdlQ1cEZpcDlrOHd3TWdpMnZZaEdHaWJrRjZERSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9maWxhbWVudC9hc3NldHMvYXBwLmNzcz9pZD02YTVkNDcwNzcxZjg5MjdhNGMxYjA4NzNhODFkOGQ5MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653509950);
INSERT INTO `sessions` VALUES ('745DkZMNZRcz42udIRben69p7btWbCwm0FNOB16y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNGl5UzNaQTBLY0NQOEhpdFdzN1hobFA1N3hvVVM4aWVGNUhmbFVibSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653509949);
INSERT INTO `sessions` VALUES ('7JBjMWPHqTda6qOjwGWftJYjhSzbp8sfMUerKsSZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiS2VvVm03Q0hTbEhGa3prcTdJWXp1YnZzYnNBU0FBT1ZlSGkweUlXYSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vcGFja2FnZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkanFBaE9VbnRseVJzbEZNVFpNVnRwLlZjNFJxNk5TcUxLaFhaL3VvS3BwYVZCbUpIOUhQajIiO3M6MTc6InByb2dyYW1faWRfaGlkZGVuIjtpOjE7fQ==', 1653498604);
INSERT INTO `sessions` VALUES ('GuT6RykAtlAB8GHGolMHlpt3AAmz5lz9HW4g9gZd', NULL, '127.0.0.1', 'PostmanRuntime/7.29.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekF5cEx4TkM1ODhwbWpSd2dJMWJnWlNBWlR5ZUNWYnV5UXJBcENkdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653514377);
INSERT INTO `sessions` VALUES ('RdrIzqDxxnnEK4ovD3jBLodGHImwS3b7P5ZXj2je', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUltT3RpaWs5ZGZ5YWdObnJEb1NoUkxNRFo3ZUxRRHFFWk90ak81QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9maWxhbWVudC9hc3NldHMvYXBwLmNzcz9pZD02YTVkNDcwNzcxZjg5MjdhNGMxYjA4NzNhODFkOGQ5MSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653498206);
INSERT INTO `sessions` VALUES ('Th1kwNShEaKAbhV7qYZ7OwcZdMghZtcNUbqFckiA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGVTU21LVUlnOUFMWkNRYXNxd3pyeHZGWktZeTVka2lNVDdJR1RRbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653509950);
INSERT INTO `sessions` VALUES ('tUANboja04ysuBNnkT6Lw2wS0eKbEFxDAmhmM4mt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEdyTlVLcUg0cWVOaDhNUzBMQlk5QjgzY3RRR3JxMENRdmdZSmVhWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1653498206);
INSERT INTO `sessions` VALUES ('WQdpQrRakQa8CG8ekYa4tzpePi1G0TDqYUEmgcAv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTVPcnRDek1KM09MSHNhQmRNWXk4NkRjWVZ2cnJtWmNPak9wMjVlYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9maWxhbWVudC9hc3NldHMvYXBwLmpzP2lkPTYzZjllMTZjNWUyYWQ4MzQ0ZDBiOWJkNzE3NGYyYjU4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1653509951);
INSERT INTO `sessions` VALUES ('WvV4M8gSBW93Asv82EIjfdRQomA9H5yjKPdWnDxf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGdTb0p5QnZNMXprMnpKRFRNZndnd1M2MHdYN0I5T1FlcGN3aHpEZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9maWxhbWVudC9hc3NldHMvYXBwLmpzP2lkPTYzZjllMTZjNWUyYWQ4MzQ0ZDBiOWJkNzE3NGYyYjU4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1653498207);
INSERT INTO `sessions` VALUES ('YXInqcUDMO9Jq2NLSxYbBN0gbtS7RzsWIZkQqCGc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSTNjNXBvUnlPUERCc1R0NTQ0YU9XTWpyQkN1NDdSa1owOUN1bjRnbSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIzNjoiaHR0cDovL2xvY2FsaG9zdDo4MDAwLz9lbWFpbF92ZXJpZnlfdXJsPWh0dHAlM0ElMkYlMkZsb2NhbGhvc3QlM0E4MDAwJTJGYXBpJTJGdmVyaWZ5LWVtYWlsJTJGMTUlMkZiOGVlNWQ3MmM3YWMyYTUzMWUxYTk1NTMxNzVlNjA1ZWFjYWIyMDc1JTNGZXhwaXJlcyUzRDE2NTM1MTc4MTMmc2lnbmF0dXJlPTVmZjAwYTE0ZGFiZmE4NDViNmI0MTRhYzJjMzEwMmRjMjUwMzg3OThhNDRlNjVmZTFmYmQ0YjhhMGVhNzNjZjQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkanFBaE9VbnRseVJzbEZNVFpNVnRwLlZjNFJxNk5TcUxLaFhaL3VvS3BwYVZCbUpIOUhQajIiO30=', 1653514268);

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES (1, 'Activo', 1, '2022-03-17 19:42:11', '2022-03-17 19:42:11', NULL);

-- ----------------------------
-- Table structure for subscription_program_day_routines
-- ----------------------------
DROP TABLE IF EXISTS `subscription_program_day_routines`;
CREATE TABLE `subscription_program_day_routines`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `subscription_programs_id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NULL DEFAULT NULL,
  `program_day_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NULL DEFAULT NULL,
  `is_complete` tinyint(1) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `spd1_routine_foreign`(`subscription_programs_id`) USING BTREE,
  INDEX `spd2_routine_foreign`(`program_day_id`) USING BTREE,
  INDEX `subscription_program_day_routines_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `spd1_routine_foreign` FOREIGN KEY (`subscription_programs_id`) REFERENCES `subscription_programs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `spd2_routine_foreign` FOREIGN KEY (`program_day_id`) REFERENCES `program_days` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `subscription_program_day_routines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscription_program_day_routines
-- ----------------------------
INSERT INTO `subscription_program_day_routines` VALUES (1, 1, 4, 1, 1, 1, NULL, '2022-05-13 16:06:54', '2022-05-13 16:06:54', NULL);

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
  `is_active` tinyint(1) NULL DEFAULT NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subscription_programs
-- ----------------------------
INSERT INTO `subscription_programs` VALUES (1, 1, 4, 1, 1, 1, '2022-05-13 16:06:43', '2022-05-13 16:06:43', NULL);
INSERT INTO `subscription_programs` VALUES (2, 1, 1, 1, 1, 1, '2022-05-25 16:31:22', '2022-05-25 16:31:22', NULL);
INSERT INTO `subscription_programs` VALUES (3, 1, 1, 1, 1, 1, '2022-05-25 16:40:46', '2022-05-25 16:40:46', NULL);
INSERT INTO `subscription_programs` VALUES (4, 1, 1, 1, 1, 1, '2022-05-25 17:13:25', '2022-05-25 17:13:25', NULL);
INSERT INTO `subscription_programs` VALUES (5, 1, 1, 1, 1, 1, '2022-05-25 17:39:29', '2022-05-25 17:39:29', NULL);
INSERT INTO `subscription_programs` VALUES (6, 1, 1, 1, 1, 1, '2022-05-25 18:56:36', '2022-05-25 18:56:36', NULL);
INSERT INTO `subscription_programs` VALUES (7, 1, 1, 1, 1, 1, '2022-05-25 20:15:08', '2022-05-25 20:15:08', NULL);
INSERT INTO `subscription_programs` VALUES (8, 1, 1, 1, 1, 1, '2022-05-25 20:35:54', '2022-05-25 20:35:54', NULL);

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
INSERT INTO `subscriptions` VALUES (1, 1, 1, 1, '2022-03-17 19:42:11', '2022-03-17 19:42:11', NULL);

-- ----------------------------
-- Table structure for taggables
-- ----------------------------
DROP TABLE IF EXISTS `taggables`;
CREATE TABLE `taggables`  (
  `tag_id` bigint UNSIGNED NOT NULL,
  `taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint UNSIGNED NOT NULL,
  UNIQUE INDEX `taggables_tag_id_taggable_id_taggable_type_unique`(`tag_id`, `taggable_id`, `taggable_type`) USING BTREE,
  INDEX `taggables_taggable_type_taggable_id_index`(`taggable_type`, `taggable_id`) USING BTREE,
  CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of taggables
-- ----------------------------

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_column` int NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tags
-- ----------------------------

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_cards
-- ----------------------------
INSERT INTO `user_cards` VALUES (1, '12345', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 16:12:12', '2022-05-25 16:12:12');
INSERT INTO `user_cards` VALUES (2, '12345', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 16:35:32', '2022-05-25 16:35:32');
INSERT INTO `user_cards` VALUES (3, '123456', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 17:39:25', '2022-05-25 17:39:25');
INSERT INTO `user_cards` VALUES (4, '1234567', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 18:56:30', '2022-05-25 18:56:30');
INSERT INTO `user_cards` VALUES (5, '12345678', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 20:02:25', '2022-05-25 20:02:25');
INSERT INTO `user_cards` VALUES (6, '852741963', 'juan guerra', '333', '2025-12-31', 1, NULL, '2022-05-25 20:35:50', '2022-05-25 20:35:50');

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
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin', 'User', 'System', 1, '1976-07-10', 'admin@admin.com', NULL, '$2y$10$jqAhOUntlyRslFMTZMVtp.Vc4Rq6NSqLKhXZ/uoKppaVBmJH9HPj2', NULL, NULL, NULL, 1, 'Buenos Aires - Argentina', '0412-610-17-95', NULL, NULL, NULL, '2022-03-17 19:42:11', '2022-03-17 19:42:11', NULL);
INSERT INTO `users` VALUES (3, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'guerra@gmail.com', NULL, '$2y$10$tmhM1dlEEmMMBbxsl5qeqeXT75g7Uo0OmQbG44Ku8OmSjVjB3slae', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 14:41:39', '2022-05-25 14:41:39', NULL);
INSERT INTO `users` VALUES (4, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'malave@gmail.com', NULL, '$2y$10$8RZJN5JJBo/BQ1DuZNBF7.n2UdF7w5YcUf.gOh6QcIollRbSZij9.', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 16:35:18', '2022-05-25 16:35:18', NULL);
INSERT INTO `users` VALUES (5, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'carlos@gmail.com', NULL, '$2y$10$PeJvDiYN86H18LF9.r4H0.b1T9/qU/e5Hkft.OIk8/s2qKH2v/q/2', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 17:38:55', '2022-05-25 17:38:55', NULL);
INSERT INTO `users` VALUES (6, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'otro@gmail.com', NULL, '$2y$10$ab2OK3TImRKeYFW.w0k.Aeq/778pn/t0uFFxj9zotP4XmTOTfslpi', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 18:17:17', '2022-05-25 18:17:17', NULL);
INSERT INTO `users` VALUES (7, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'guerramalavejuancarlos@gmail.com', NULL, '$2y$10$oCSJt1xQFdMz9Dn979f6fOqgFeseKFA7wGzjFIisqRnlkT1ASKc.S', NULL, NULL, NULL, 1, 'Palermo', '1135774468', 'g4kl6LpJIwhD4qhGB8Tatry2wr2DCAXDTy2WVuRGrspB0sqpjP0NHfrYhz0m', NULL, NULL, '2022-05-25 18:38:46', '2022-05-25 20:49:46', NULL);
INSERT INTO `users` VALUES (8, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'ramon@gmail.com', NULL, '$2y$10$wImjeNllh3srZUHuTeHRzO9/lt0.11imUy9eTInFbkID4bovoan3y', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 18:56:16', '2022-05-25 18:56:16', NULL);
INSERT INTO `users` VALUES (9, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', '111ramon@gmail.com', NULL, '$2y$10$9sdBpQCdG9gByS8fk.U.LuO4XGVoeuMEgloJ3lvGVnj/AeHwyZ.Ia', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 19:29:02', '2022-05-25 19:29:02', NULL);
INSERT INTO `users` VALUES (10, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', '1211ramon@gmail.com', NULL, '$2y$10$fX0m1S.icPYAqhJ9CW0Fs.D1Tv24J0LTKhvfSX2bZhdetxs3kfhz6', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 19:48:04', '2022-05-25 19:48:04', NULL);
INSERT INTO `users` VALUES (11, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', '121221ramon@gmail.com', NULL, '$2y$10$RKGabv2EIrzE33aGYFP0Ku8tBTqC/p6evzkjPMsWed3BkDtDiD6wW', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 20:02:09', '2022-05-25 20:02:09', NULL);
INSERT INTO `users` VALUES (12, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', '121221ram88on@gmail.com', NULL, '$2y$10$48Bw5VCpX8EaTh1w9Ud40eYVsNNDXLneBjTlzfAExwQMa4O3woTwe', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 20:14:50', '2022-05-25 20:14:50', NULL);
INSERT INTO `users` VALUES (13, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', '12125221ram88on@gmail.com', NULL, '$2y$10$V235alEFyLI40lDnjKGDG.ye9crsfO9Wtyq2Knq5SAHfJCSBW3rbW', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 20:17:20', '2022-05-25 20:17:20', NULL);
INSERT INTO `users` VALUES (14, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'maryoftheo@gmail.com', NULL, '$2y$10$ejBJHdJtwrB7pg2Ko3DlYuZHGlK9t49BqFqoiLD6vqTyfgCrwI8KK', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 20:35:31', '2022-05-25 20:35:31', NULL);
INSERT INTO `users` VALUES (15, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'jesus@gmail.com', '2022-05-25 21:34:02', '$2y$10$2YCKhvJwDqhcokfRan8C3.6v1/K/42k1F0sD3cTTLoPqP/WWfJJ0O', NULL, NULL, NULL, 1, 'Palermo', '1135774468', 'r3vSHV5YCQfaoFZxU6ljxoNmv4k23g1DDbPr3dKj60foaBuIy7njcN9WqMyD', NULL, NULL, '2022-05-25 20:53:30', '2022-05-25 21:34:02', NULL);
INSERT INTO `users` VALUES (16, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'jesusluis@gmail.com', NULL, '$2y$10$f05Ep8Pb5woKagEkgN9P/eBHCJr7xvDLVSS7Sewy3/iNDz3jUntGm', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 21:07:45', '2022-05-25 21:07:45', NULL);
INSERT INTO `users` VALUES (17, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'jesusluislopez@gmail.com', NULL, '$2y$10$b0X/lynMQe7X4wFRbmDVH.CteYG696Yio2Pe5lBhAlSxJm8Mp1CMW', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 21:11:09', '2022-05-25 21:11:09', NULL);
INSERT INTO `users` VALUES (18, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'jesusluislopezjuan@gmail.com', NULL, '$2y$10$wtig2MMfYb44ZWMME135fupZh0.Uu.wCtNDYzAgh1lMGaxanpVQR.', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 21:14:46', '2022-05-25 21:14:46', NULL);
INSERT INTO `users` VALUES (19, 'Juan', 'Carlos', 'Guerra', 1, '1983-01-07', 'lola@gmail.com', NULL, '$2y$10$bqF9MTd67h6qSfG5XzkfdefpMFs0u3uKJRN.sY6Fam0cBfAN6xoeu', NULL, NULL, NULL, 1, 'Palermo', '1135774468', NULL, NULL, NULL, '2022-05-25 21:17:35', '2022-05-25 21:17:35', NULL);

SET FOREIGN_KEY_CHECKS = 1;
