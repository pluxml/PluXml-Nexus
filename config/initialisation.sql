-- plxnexus.categories definition

CREATE TABLE `categories`
(
    `id`   int(11)      NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `icon` varchar(100) NOT NULL DEFAULT 'icon-leaf',
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_UN` (`name`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8;

INSERT INTO categories (name, icon)
VALUES ('SEO', 'icon-globe'),
       ('Social', 'icon-chat'),
       ('Security', 'icon-lock'),
       ('Administration', 'icon-window'),
       ('Miscellaneous', 'icon-leaf'),
       ('Content management', 'icon-pencil'),
       ('Statistics and logs', 'icon-chart-pie');

-- plxnexus.users definition

CREATE TABLE `users`
(
    `id`          int(11)      NOT NULL AUTO_INCREMENT,
    `username`    varchar(100) NOT NULL,
    `password`    varchar(100) NOT NULL,
    `email`       varchar(100) NOT NULL,
    `website`     varchar(100) DEFAULT NULL,
    `role`        varchar(100) DEFAULT NULL,
    `token`       varchar(100) DEFAULT NULL,
    `tokenexpire` datetime     DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8;

-- plxnexus.plugins definition

CREATE TABLE `plugins`
(
    `id`            int(11)      NOT NULL AUTO_INCREMENT,
    `name`          varchar(100) NOT NULL,
    `description`   varchar(1000) DEFAULT NULL,
    `author`        int(11)      NOT NULL,
    `date`          date         NOT NULL,
    `versionplugin` varchar(100)  DEFAULT NULL,
    `versionpluxml` varchar(100)  DEFAULT NULL,
    `file`          varchar(255) NOT NULL,
    `link`          varchar(100)  DEFAULT NULL,
    `category`      int(11)      NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `plugins_UN` (`name`),
    KEY `plugins_FK` (`author`),
    KEY `plugins_FK_1` (`category`),
    CONSTRAINT `plugins_FK` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
    CONSTRAINT `plugins_FK_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8;

-- plxnexus.themes definition

CREATE TABLE `themes`
(
    `id`            int(11)      NOT NULL AUTO_INCREMENT,
    `name`          varchar(100) NOT NULL,
    `description`   varchar(250) DEFAULT NULL,
    `author`        int(11)      NOT NULL,
    `date`          date         NOT NULL,
    `versiontheme`  varchar(100) DEFAULT NULL,
    `versionpluxml` varchar(100) DEFAULT NULL,
    `file`          varchar(250) NOT NULL,
    `link`          varchar(100) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `themes_FK` (`author`),
    CONSTRAINT `themes_FK` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8;