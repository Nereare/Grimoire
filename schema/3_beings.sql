CREATE TABLE IF NOT EXISTS `animals` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author`        INT UNSIGNED NOT NULL,
  `published`     DATE NOT NULL,
  `edited`        DATE,
  `title`         VARCHAR(100) NOT NULL,
  -- Linnaean classification - begin
  `domain`        VARCHAR(32),
  `kingdom`       VARCHAR(32),
  `phylum`        VARCHAR(32),
  `class`         VARCHAR(32),
  `order`         VARCHAR(32),
  `suborder`      VARCHAR(32),
  `family`        VARCHAR(32),
  `subfamily`     VARCHAR(32),
  `genus`         VARCHAR(32),
  `species`       VARCHAR(32),
  `subspecies`    VARCHAR(32),
  -- Linnaean classification - end
  `feeding`       ENUM("autotroph", "heterotroph"),
  -- Size - begin
  `size_type`     VARCHAR(64),
  `size_unit`     VARCHAR(4),
  `size_min`      SMALLINT UNSIGNED,
  `size_max`      SMALLINT UNSIGNED,
  `weight_unit`   VARCHAR(4),
  `weight_min`    SMALLINT UNSIGNED,
  `weight_max`    SMALLINT UNSIGNED,
  -- Size - end
  `habitat`       VARCHAR(64),
  `home_plane`    VARCHAR(64),
  `iucn`          ENUM("EX", "EW", "CR", "EN", "VU", "NT", "LC", "DD", "NE"),
  `domestic`      BOOLEAN NOT NULL DEFAULT FALSE,
  `notes`         VARCHAR(256),
  -- Page content / description / et coetera
  `body`          MEDIUMTEXT NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `iucn` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(32) NOT NULL UNIQUE,
  `abbr`          CHAR(2) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
