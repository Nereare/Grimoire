CREATE TABLE IF NOT EXISTS `posts` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author`        INT UNSIGNED NOT NULL,
  `published`     DATE NOT NULL,
  `edited`        DATE,
  `title`         VARCHAR(100) NOT NULL,
  `tags`          VARCHAR(255),
  `categories`    VARCHAR(255),
  `body`          MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `books` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `chapters` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author`        INT UNSIGNED NOT NULL,
  `book`          INT UNSIGNED NOT NULL,
  `published`     DATE NOT NULL,
  `edited`        DATE,
  `title`         VARCHAR(100) NOT NULL,
  `body`          MEDIUMTEXT NOT NULL,
  `previous`      INT UNSIGNED,
  `next`          INT UNSIGNED,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `pages` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author`        INT UNSIGNED NOT NULL,
  `name`          VARCHAR(100) NOT NULL,
  `published`     DATE NOT NULL,
  `edited`        DATE,
  `title`         VARCHAR(100) NOT NULL,
  `body`          MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);
