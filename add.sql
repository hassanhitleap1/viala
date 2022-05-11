ALTER TABLE `vaila` ADD `entry_hour` TIME NULL DEFAULT NULL AFTER `insurance_amount`, ADD `out_hour` TIME NULL DEFAULT NULL AFTER `entry_hour`, ADD `price_weddings` DOUBLE NULL DEFAULT NULL AFTER `out_hour`, ADD `retainer` DOUBLE NOT NULL DEFAULT '0' AFTER `price_weddings`;
ALTER TABLE `vaila` ADD `code` VARCHAR(250) NULL AFTER `retainer`;
ALTER TABLE `vaila` ADD `weddings` SMALLINT NOT NULL DEFAULT '0' AFTER `code`;

ALTER TABLE `vaila` CHANGE `title_he` `title_he` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `desc_he` `desc_he` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

ALTER TABLE `orders` ADD `status` ENUM('pending','success','','') NOT NULL DEFAULT 'pending' AFTER `payment_type`;
ALTER TABLE `governorate` CHANGE `name_he` `name_he` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `services` CHANGE `name_he` `name_he` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

CREATE TABLE `payments` ( `id` INT NOT NULL AUTO_INCREMENT , `amount` DOUBLE NOT NULL , `order_id` INT NOT NULL , `type` ENUM('cash','card') NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `orders` CHANGE `payment_type` `payment_type` ENUM('visa','cash','mix') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;