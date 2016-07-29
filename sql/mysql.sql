
-- Orpheus Tools SQL file
-- 
-- @Created on: June 23, 2012
-- @Author Charalampos Mavidis


CREATE TABLE IF NOT EXISTS `orph_todo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `deadline` timestamp NOT NULL,
  `details` text,
  `created_on` timestamp NOT NULL DEFAULT '0',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `done` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `orph_categories` (
	`catid` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`cname` VARCHAR(50) NOT NULL,
	`details` TEXT
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `orph_users` (
	`uid` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	`ugroud_id` INT UNSIGNED NOT NULL,
	`username` VARCHAR(40) NOT NULL UNIQUE,
	`password` VARCHAR(32) NOT NULL,
	`first_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`birth_date` DATE DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8

CREATE TABLE IF NOT EXISTS `orph_usergroups` (
	`ugid` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`group_name` VARCHAR(50) NOT NULL,
	`previleges` VARCHAR(120)
) ENGINE=MyISAM DEFAULT CHARSET=utf8