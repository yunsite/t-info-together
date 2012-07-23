#
# t_info_together
# version:
# time:
#


#----------------------------------------创建数据库---------------------------------------------------

#数据库创建
CREATE DATABASE `t_info_together` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

#----------------------------------------End(创建数据库)---------------------------------------------------


#----------------------------------------日志模块---------------------------------------------------

#日志表
DROP TABLE IF EXISTS t_dairy;
CREATE TABLE t_dairy
(
	dry_id		INT		NOT NULL	AUTO_INCREMENT,
	dry_uid		INT		NOT NULL,
	dry_title	VARCHAR(24)	NOT NULL,
	dry_content	TEXT		NULL,
	dry_pubtime	INT		NOT NULL,
	dry_lmoditime	INT		NOT NULL,
	dry_ifcomm	BOOLEAN		NOT NULL	DEFAULT 0,
	dry_private	BIT(2)		NOT NULL	DEFAULT 0,
	PRIMARY KEY(dry_id)
)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM;

#日志表(通过phpMyAdmin手工创建的表转化为的SQL)
CREATE TABLE `t_info_together`.`t_dairy` (
`dry_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`dry_uid` INT NOT NULL ,
`dry_title` VARCHAR( 24 ) NOT NULL ,
`dry_content` TEXT NULL ,
`dry_pubtime` INT NOT NULL ,
`dry_lmoditime` INT NOT NULL ,
`dry_ifcomm` BOOL NOT NULL DEFAULT '0',
`dry_private` BIT( 2 ) NOT NULL DEFAULTb '0'
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

#日志评论表
DROP TABLE IF EXISTS t_drycomm;
CREATE TABLE t_drycomm
(
	drycm_id		INT		NOT NULL	AUTO_INCREMENT,
	drycm_dryid		INT		NOT NULL,
	drycm_uid		INT		NOT NULL,
	drycm_title		VARCHAR(24)	NULL,
	drycm_content		TEXT		NULL,
	drycm_pubtime		INT		NOT NULL,
	drycm_ifcomm		BOOLEAN		NOT NULL	DEFAULT 0,
	drycm_fathercmid	TINYINT		NOT NULL	DEFAULT 0,
	PRIMARY KEY(drycm_id)
)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM;

#----------------------------------------End(日志模块)---------------------------------------------------

#----------------------------------------用户模块---------------------------------------------------

CREATE TABLE t_member
(

	mem_id		INT		NOT NULL	AUTO_INCREMENT,
	mem_name	VARCHAR(10)	NOT NULL,
	mem_pwd		VARCHAR(64)	NOT NULL,
	mem_group	BIT(3)		NOT NULL	DEFAULT 0,
	mem_qq		VARCHAR(12)	NOT NULL	DEFAULT '',
	mem_email	VARCHAR(100)	NOT NULL	DEFAULT '',
	mem_sign	VARCHAR(255)	NOT NULL	DEFAULT '',
	mem_phone	VARCHAR(20)	NOT NULL	DEFAULT '',
	mem_city	VARCHAR(30)	NOT NULL	DEFAULT '',
	mem_area	VARCHAR(100)	NOT NULL	DEFAULT '',
	mem_regtime	INT		NOT NULL,
	mem_llogtime	INT		NOT NULL,
	mem_llogip	VARCHAR(19)	NOT NULL,
	PRIMARY KEY(mem_id)

)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM;



#----------------------------------------End(用户模块)----------------------------------------------


#-----------------------------------------百度官方新闻(Over)---------------------------------------------------------


DROP TABLE IF EXISTS baidu_news;
CREATE TABLE baidu_news (
  id INT(10) unsigned NOT NULL auto_increment,
  title varchar(100) NOT NULL,
  content text,
  publish_time INT(10) NOT NULL,
  #site_from_name varchar(20) NOT NULL DEFAULT '',
  news_from_url varchar(60) NOT NULL DEFAULT '',
  ifread INT(1) NOT NULL,
  comment text DEFAULT '',
  PRIMARY KEY(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
#创建时间	2012年7月6日 13:08:46

#-----------------------------------------End(百度官方新闻)------------------------------------------------------------