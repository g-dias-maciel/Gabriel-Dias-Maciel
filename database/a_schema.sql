

USE bookstore;

CREATE TABLE  if not exists `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE if not exists `books` (
  `book_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `book` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `author` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `book_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE if not exists `sales` (
  `sales_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sale_date` datetime  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` bigint(20) unsigned NOT NULL,
  `book_id` bigint(20) unsigned NOT NULL,
  `sale_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


