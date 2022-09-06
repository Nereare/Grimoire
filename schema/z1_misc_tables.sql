CREATE TABLE IF NOT EXISTS `meta_licenses` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `abbr` VARCHAR(16),
  `fullname` VARCHAR(128) NOT NULL,
  `link` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abbr` (`abbr`)
);
