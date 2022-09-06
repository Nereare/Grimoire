CREATE TABLE IF NOT EXISTS `posts` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author`        INT UNSIGNED NOT NULL,
  `published`     DATE NOT NULL,
  `edited`        DATE,
  `title`         VARCHAR(100) NOT NULL,
  `tags`          VARCHAR(255),
  `categories`    VARCHAR(255),
  `body`          TEXT NOT NULL,
  PRIMARY KEY (`id`)
);
