ALTER TABLE ecs_goods ADD column `exclusive` varchar(255) NOT NULL DEFAULT '-1' COMMENT '手机价';
ALTER TABLE ecs_goods ADD column  `ghost_count` int(11) NOT NULL DEFAULT '0';

/***date 2017-03-15***/
ALTER TABLE ecs_goods ADD column `year` int(5) NOT NULL DEFAULT '0';
ALTER TABLE ecs_goods ADD column `output` tinyint(10) NOT NULL DEFAULT '0';
ALTER TABLE ecs_goods ADD column `is_original` tinyint(2) NOT NULL DEFAULT '0';

ALTER TABLE ecs_goods ADD column `system_cat_id` int(8) NOT NULL DEFAULT '0';
CREATE TABLE `ecs_car_system_category` (
      `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
      `cat_name` varchar(90) NOT NULL DEFAULT '',
      `keywords` varchar(255) NOT NULL DEFAULT '',
      `cat_desc` varchar(255) NOT NULL DEFAULT '',
      `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
      `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
      `template_file` varchar(50) NOT NULL DEFAULT '',
      `measure_unit` varchar(15) NOT NULL DEFAULT '',
      `show_in_nav` tinyint(1) NOT NULL DEFAULT '0',
      `style` varchar(150) NOT NULL,
      `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
      `grade` tinyint(4) NOT NULL DEFAULT '0',
      `filter_attr` varchar(255) NOT NULL DEFAULT '0',
      `category_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `category_index_dwt` tinyint(1) NOT NULL DEFAULT '0',
      `index_dwt_file` varchar(150) DEFAULT NULL,
      `show_in_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
      `cat_index_rightad` varchar(255) NOT NULL,
      `cat_adimg_1` varchar(255) NOT NULL,
      `cat_adurl_1` varchar(255) NOT NULL,
      `cat_adimg_2` varchar(255) NOT NULL,
      `cat_adurl_2` varchar(255) NOT NULL,
      `cat_nameimg` varchar(255) NOT NULL,
      `brand_qq` varchar(255) NOT NULL DEFAULT '',
      `attr_wwwecshop68com` varchar(255) NOT NULL DEFAULT '',
      `path_name` varchar(100) NOT NULL DEFAULT '',
      `is_virtual` int(11) NOT NULL DEFAULT '0',
      `type_img` varchar(100) NOT NULL COMMENT '微信商城分类图标',
      PRIMARY KEY (`cat_id`),
      KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=358 DEFAULT CHARSET=utf8;

CREATE TABLE `ecs_car_system_cat_recommend` (
      `cat_id` smallint(5) NOT NULL,
      `recommend_type` tinyint(1) NOT NULL,
      PRIMARY KEY (`cat_id`,`recommend_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/**是否在首页显示****/
ALTER TABLE ecs_category ADD column `show_in_index_cat` tinyint(2) NOT NULL DEFAULT '1';
ALTER TABLE ecs_car_system_category ADD column `show_in_index_cat` tinyint(2) NOT NULL DEFAULT '1';


/**2017-3-24**/
CREATE TABLE `ecs_dept` (
      `dept_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
      `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户表id',
      `dept_name` varchar(255) NOT NULL COMMENT '供货商名称',
      `rank_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '店铺等级',
      `type_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '店铺类型',
      `company_name` varchar(255) NOT NULL COMMENT '公司名称',
      `country` smallint(5) unsigned NOT NULL COMMENT '公司所在地(国家)',
      `province` smallint(5) unsigned NOT NULL COMMENT '公司所在地(省)',
      `city` smallint(5) unsigned NOT NULL COMMENT '公司所在地(市)',
      `district` smallint(5) unsigned NOT NULL COMMENT '公司所在地(县/区)',
      `address` varchar(255) NOT NULL DEFAULT '' COMMENT '公司详细地址',
      `tel` varchar(50) NOT NULL COMMENT '公司电话',
      `email` varchar(100) NOT NULL COMMENT '电子邮件',
      `dept_remark` varchar(255) NOT NULL DEFAULT '',
      `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
      `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
      `lng` varchar(50) NOT NULL DEFAULT '' COMMENT '经度',
      `lat` varchar(50) NOT NULL DEFAULT '' COMMENT '纬度',
      PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE `ecs_depts` (
      `depts_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
      `depts_name` varchar(255) DEFAULT NULL,
      `depts_desc` mediumtext,
      `is_check` tinyint(1) unsigned NOT NULL DEFAULT '1',
      PRIMARY KEY (`depts_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ecs_dept_admin_user` (
      `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
      `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '存放users表中的user_id',
      `user_name` varchar(60) NOT NULL DEFAULT '',
      `email` varchar(60) NOT NULL DEFAULT '',
      `mobile_phone` varchar(20) NOT NULL,
      `password` varchar(32) NOT NULL DEFAULT '',
      `ec_salt` varchar(10) DEFAULT NULL,
      `add_time` int(11) NOT NULL DEFAULT '0',
      `last_login` int(11) NOT NULL DEFAULT '0',
      `last_ip` varchar(15) NOT NULL DEFAULT '',
      `action_list` text NOT NULL,
      `nav_list` text NOT NULL,
      `lang_type` varchar(50) NOT NULL DEFAULT '',
      `agency_id` smallint(5) unsigned NOT NULL,
      `dept_id` int(10) unsigned DEFAULT '0',
      `todolist` longtext,
      `role_id` smallint(5) DEFAULT NULL,
      `checked` tinyint(2) NOT NULL DEFAULT '0' COMMENT '-1:审核未通过,0:未审核,1审核通过',
      PRIMARY KEY (`user_id`),
      KEY `user_name` (`user_name`),
      KEY `agency_id` (`agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

CREATE TABLE `ecs_dept_config` (
      `id` int(10) unsigned NOT NULL DEFAULT '0',
      `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
      `code` varchar(30) NOT NULL DEFAULT '',
      `type` varchar(10) NOT NULL DEFAULT '',
      `store_range` varchar(255) NOT NULL DEFAULT '',
      `store_dir` varchar(255) NOT NULL DEFAULT '',
      `value` text NOT NULL,
      `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '1',
      `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
      PRIMARY KEY (`id`,`dept_id`),
      KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE ecs_order_info ADD column `dept_id` int(8) NOT NULL DEFAULT '0';
ALTER TABLE ecs_back_order ADD column `dept_id` int(8) NOT NULL DEFAULT '0';
ALTER TABLE ecs_goods ADD column `dept_ids` varchar(32) NOT NULL DEFAULT '';

ALTER TABLE ecs_user_address ADD column `lng` varchar(30) NOT NULL DEFAULT '' COMMENT '经度';
ALTER TABLE ecs_user_address ADD column `lat` varchar(30) NOT NULL DEFAULT '' COMMENT '纬度';


/** 添加临时表**/
CREATE TABLE `ecs_goods_desc_temp` (
      `goods_desc_temp_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
      `content` longtext NOT NULL,
      PRIMARY KEY (`goods_desc_temp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/**商品表增加商品原地址的地方**/
ALTER TABLE ecs_goods ADD column `original_url` varchar(128) NOT NULL DEFAULT '' COMMENT '商品原地址';

ALTER TABLE ecs_goods CHANGE column `goods_number` `goods_number` int(8) unsigned NOT NULL DEFAULT '0';

/**add config**/
INSERT INTO ecs_shop_config (parent_id, code, type, value, sort_order) value (2, 'add_discount', 'text', 10, 1);
INSERT INTO ecs_shop_config (parent_id, code, type, value, sort_order) value (2, 'market_add_discount', 'text', 5, 1);

/**add discount date 2017-04-28**/
ALTER TABLE ecs_goods ADD COLUMN `add_discount` FLOAT(5, 2) NOT NULL DEFAULT 10.00;
ALTER TABLE ecs_goods ADD COLUMN `original_price` FLOAT(10, 2) NOT NULL DEFAULT 0.00; 
ALTER TABLE ecs_goods_attr ADD COLUMN `original_price` FLOAT(10, 2) NOT NULL DEFAULT 0.00;


/**2017-6-02**/
/*ALTER TABLE ecs_users ADD column `jr_user_id` int(11) NOT NULL DEFAULT '0'      COMMENT '小滨金融同步user_id';*/

CREATE TABLE `ecs_syn_api_log` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `act` varchar(30) NOT NULL,
      `api` text NOT NULL,
      PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1550 DEFAULT CHARSET=utf8;

/**2017-6-14**/
ALTER TABLE ecs_goods ADD column `unit` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '单位';
