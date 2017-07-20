/*
Navicat MySQL Data Transfer

Source Server         : wnmp
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : xblc

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-07-07 16:05:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bb_conf
-- ----------------------------
DROP TABLE IF EXISTS `bb_conf`;
CREATE TABLE `bb_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `input_type` tinyint(1) NOT NULL COMMENT '配置输入的类型 0:文本输入 1:下拉框输入 2:图片上传 3:编辑器',
  `value_scope` text NOT NULL COMMENT '取值范围',
  `is_effect` tinyint(1) NOT NULL,
  `is_conf` tinyint(1) NOT NULL COMMENT '是否可配置 0: 可配置  1:不可配置',
  `sort` int(11) NOT NULL,
  `tip` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of bb_conf
-- ----------------------------
INSERT INTO `bb_conf` VALUES ('1', 'DEFAULT_ADMIN', 'admin', '1', '0', '', '1', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('2', 'URL_MODEL', '0', '1', '1', '0,1', '1', '1', '3', '');
INSERT INTO `bb_conf` VALUES ('3', 'AUTH_KEY', 'fanwedk', '1', '0', '', '1', '1', '4', '');
INSERT INTO `bb_conf` VALUES ('4', 'TIME_ZONE', '8', '1', '1', '0,8', '1', '1', '1', '');
INSERT INTO `bb_conf` VALUES ('5', 'ADMIN_LOG', '1', '1', '1', '0,1', '0', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('6', 'DB_VERSION', '3.6', '0', '0', '', '1', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('7', 'DB_VOL_MAXSIZE', '8000000', '1', '0', '', '1', '1', '11', '');
INSERT INTO `bb_conf` VALUES ('8', 'WATER_MARK', './public/attachment/201705/31/16/592e81d667a63.png', '2', '2', '', '1', '1', '48', '');
INSERT INTO `bb_conf` VALUES ('24', 'CURRENCY_UNIT', '￥', '3', '0', '', '1', '1', '21', '');
INSERT INTO `bb_conf` VALUES ('10', 'BIG_WIDTH', '500', '2', '0', '', '0', '0', '49', '');
INSERT INTO `bb_conf` VALUES ('11', 'BIG_HEIGHT', '500', '2', '0', '', '0', '0', '50', '');
INSERT INTO `bb_conf` VALUES ('12', 'SMALL_WIDTH', '200', '2', '0', '', '0', '0', '51', '');
INSERT INTO `bb_conf` VALUES ('13', 'SMALL_HEIGHT', '200', '2', '0', '', '0', '0', '52', '');
INSERT INTO `bb_conf` VALUES ('14', 'WATER_ALPHA', '75', '2', '0', '', '1', '1', '53', '');
INSERT INTO `bb_conf` VALUES ('15', 'WATER_POSITION', '4', '2', '1', '1,2,3,4,5', '1', '1', '54', '');
INSERT INTO `bb_conf` VALUES ('16', 'MAX_IMAGE_SIZE', '3000000', '2', '0', '', '1', '1', '55', '');
INSERT INTO `bb_conf` VALUES ('17', 'ALLOW_IMAGE_EXT', 'jpg,gif,png', '2', '0', '', '1', '1', '56', '');
INSERT INTO `bb_conf` VALUES ('18', 'MAX_FILE_SIZE', '1', '1', '0', '', '0', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('19', 'ALLOW_FILE_EXT', '1', '1', '0', '', '0', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('20', 'BG_COLOR', '#ffffff', '2', '0', '', '0', '0', '57', '');
INSERT INTO `bb_conf` VALUES ('21', 'IS_WATER_MARK', '1', '2', '1', '0,1', '1', '1', '58', '');
INSERT INTO `bb_conf` VALUES ('22', 'TEMPLATE', 'new', '3', '0', '', '1', '1', '17', '');
INSERT INTO `bb_conf` VALUES ('25', 'SCORE_UNIT', '积分', '3', '0', '', '1', '1', '22', '');
INSERT INTO `bb_conf` VALUES ('26', 'USER_VERIFY', '0', '4', '1', '0,1,2,3,4', '1', '1', '63', '');
INSERT INTO `bb_conf` VALUES ('27', 'SHOP_LOGO', './public/attachment/201705/31/16/592e81eee0784.png', '3', '2', '', '1', '1', '19', '');
INSERT INTO `bb_conf` VALUES ('28', 'SHOP_LANG', 'zh-cn', '3', '1', 'zh-cn,zh-tw,en-us', '1', '1', '18', '');
INSERT INTO `bb_conf` VALUES ('29', 'SHOP_TITLE', '小滨金融', '3', '0', '', '1', '1', '13', '');
INSERT INTO `bb_conf` VALUES ('30', 'SHOP_KEYWORD', '小滨金融、最安全的网络理财平台', '3', '0', '', '1', '1', '15', '');
INSERT INTO `bb_conf` VALUES ('31', 'SHOP_DESCRIPTION', '小滨金融、最安全的网络理财平台', '3', '0', '', '1', '1', '15', '');
INSERT INTO `bb_conf` VALUES ('32', 'SHOP_TEL', '400-003-6006', '3', '0', '', '1', '1', '23', '');
INSERT INTO `bb_conf` VALUES ('35', 'INVITE_REFERRALS', '1', '0', '1', '0,1', '1', '0', '1', '');
INSERT INTO `bb_conf` VALUES ('38', 'ONLINE_QQ', 'a:2:{i:0;a:2:{s:4:\"name\";s:6:\"安琪\";s:2:\"qq\";s:9:\"342726124\";}i:1;a:2:{s:4:\"name\";s:6:\"佳妍\";s:2:\"qq\";s:10:\"1627329419\";}}', '0', '0', '', '1', '0', '25', '');
INSERT INTO `bb_conf` VALUES ('39', 'ONLINE_TIME', '周一至周五（ 9:00-18:00）', '3', '0', '', '1', '1', '26', '');
INSERT INTO `bb_conf` VALUES ('40', 'DEAL_PAGE_SIZE', '10', '3', '0', '', '1', '1', '31', '');
INSERT INTO `bb_conf` VALUES ('41', 'PAGE_SIZE', '20', '3', '0', '', '1', '1', '32', '');
INSERT INTO `bb_conf` VALUES ('42', 'HELP_CATE_LIMIT', '4', '3', '0', '', '1', '1', '34', '');
INSERT INTO `bb_conf` VALUES ('43', 'HELP_ITEM_LIMIT', '4', '3', '0', '', '1', '1', '35', '');
INSERT INTO `bb_conf` VALUES ('44', 'SHOP_FOOTER', '<div style=\"text-align:right;\">\r\n	邮箱：jr@xiaobinqipei.com 杭州啃金投资有限公司&nbsp;\r\n</div>\r\n<div style=\"text-align:right;\">\r\n	&copy; 2017 小滨金融 All rights reserved\r\n	<p style=\"text-align:right;color:#666666;\">\r\n		<a href=\"http://jr.xiaobinqipei.com/\" target=\"_blank\">http://jr.xiaobinqipei.com/</a> \r\n	</p>\r\n</div>', '3', '3', '', '1', '1', '37', '');
INSERT INTO `bb_conf` VALUES ('193', 'CUSTOM_SERVICE', ',', '6', '0', '', '1', '1', '1', '客服会员ID，多个用英文逗号（,）隔开，前台自动回复时使用！');
INSERT INTO `bb_conf` VALUES ('194', 'SMS_SEND_REPAY', '1', '5', '1', '0,1', '1', '1', '80', '');
INSERT INTO `bb_conf` VALUES ('45', 'USER_MESSAGE_AUTO_EFFECT', '1', '4', '1', '0,1', '1', '1', '64', '');
INSERT INTO `bb_conf` VALUES ('50', 'MAIL_SEND_PAYMENT', '1', '5', '1', '0,1', '1', '1', '75', '');
INSERT INTO `bb_conf` VALUES ('51', 'SMS_SEND_PAYMENT', '0', '5', '1', '0,1', '1', '1', '81', '');
INSERT INTO `bb_conf` VALUES ('62', 'REPLY_ADDRESS', 'services@xiaobinqipei.com', '5', '0', '', '1', '1', '77', '');
INSERT INTO `bb_conf` VALUES ('56', 'MAIL_ON', '1', '5', '1', '0,1', '1', '1', '72', '');
INSERT INTO `bb_conf` VALUES ('57', 'SMS_ON', '1', '5', '1', '0,1', '1', '1', '78', '');
INSERT INTO `bb_conf` VALUES ('63', 'BATCH_PAGE_SIZE', '500', '3', '0', '', '1', '1', '33', '');
INSERT INTO `bb_conf` VALUES ('65', 'PUBLIC_DOMAIN_ROOT', '', '2', '0', '', '1', '1', '59', '');
INSERT INTO `bb_conf` VALUES ('70', 'REFERRALS_DELAY', '1', '4', '0', '', '1', '0', '70', '');
INSERT INTO `bb_conf` VALUES ('71', 'SUBMIT_DELAY', '5', '1', '0', '', '1', '1', '13', '');
INSERT INTO `bb_conf` VALUES ('72', 'APP_MSG_SENDER_OPEN', '0', '1', '1', '0,1', '1', '1', '9', '');
INSERT INTO `bb_conf` VALUES ('73', 'ADMIN_MSG_SENDER_OPEN', '0', '1', '1', '0,1', '1', '1', '10', '');
INSERT INTO `bb_conf` VALUES ('74', 'SHOP_OPEN', '1', '3', '1', '0,1', '1', '1', '46', '');
INSERT INTO `bb_conf` VALUES ('75', 'SHOP_CLOSE_HTML', '<span>抱歉，系统升级中...</span>', '3', '3', '', '1', '1', '47', '');
INSERT INTO `bb_conf` VALUES ('76', 'FOOTER_LOGO', './public/attachment/201705/31/16/592e81f7a3c1d.png', '3', '2', '', '1', '1', '20', '');
INSERT INTO `bb_conf` VALUES ('77', 'GZIP_ON', '0', '1', '1', '0,1', '1', '1', '2', '');
INSERT INTO `bb_conf` VALUES ('78', 'INTEGRATE_CODE', '', '0', '0', '', '1', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('79', 'INTEGRATE_CFG', '', '0', '0', '', '1', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('80', 'SHOP_SEO_TITLE', '小滨金融_简单、安全、借得到的理财平台', '3', '0', '', '1', '1', '14', '');
INSERT INTO `bb_conf` VALUES ('67', 'REFERRAL_IP_LIMIT', '0', '0', '1', '0,1', '1', '0', '71', '');
INSERT INTO `bb_conf` VALUES ('81', 'CACHE_ON', '0', '1', '1', '0,1', '1', '1', '7', '');
INSERT INTO `bb_conf` VALUES ('82', 'EXPIRED_TIME', '0', '1', '0', '', '1', '1', '5', '');
INSERT INTO `bb_conf` VALUES ('120', 'FILTER_WORD', '', '1', '0', '', '1', '1', '100', '');
INSERT INTO `bb_conf` VALUES ('84', 'STYLE_OPEN', '0', '3', '1', '0,1', '0', '0', '44', '');
INSERT INTO `bb_conf` VALUES ('85', 'STYLE_DEFAULT', '1', '3', '1', '0,1', '0', '0', '45', '');
INSERT INTO `bb_conf` VALUES ('86', 'TMPL_DOMAIN_ROOT', '', '2', '0', '0', '0', '0', '62', '');
INSERT INTO `bb_conf` VALUES ('245', 'INVITE_REFERRALS_TYPE', '1', '0', '1', '0,1', '1', '0', '5', '');
INSERT INTO `bb_conf` VALUES ('88', 'MEMCACHE_HOST', '127.0.0.1:11211', '1', '0', '', '1', '1', '8', '');
INSERT INTO `bb_conf` VALUES ('90', 'IMAGE_USERNAME', '华少', '2', '0', '', '1', '1', '60', '');
INSERT INTO `bb_conf` VALUES ('91', 'IMAGE_PASSWORD', '654321', '2', '4', '', '1', '1', '61', '');
INSERT INTO `bb_conf` VALUES ('92', 'REGISTER_TYPE', '1', '4', '1', '0,1,2', '1', '1', '66', '');
INSERT INTO `bb_conf` VALUES ('93', 'ATTR_SELECT', '0', '3', '1', '0,1', '0', '0', '43', '');
INSERT INTO `bb_conf` VALUES ('94', 'ICP_LICENSE', '', '3', '0', '', '1', '1', '27', '');
INSERT INTO `bb_conf` VALUES ('95', 'COUNT_CODE', '', '3', '0', '', '1', '1', '28', '');
INSERT INTO `bb_conf` VALUES ('96', 'DEAL_MSG_LOCK', '0', '0', '0', '', '0', '0', '1454867819', '');
INSERT INTO `bb_conf` VALUES ('97', 'PROMOTE_MSG_LOCK', '0', '0', '0', '', '0', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('103', 'SEND_SPAN', '2', '1', '0', '', '1', '1', '85', '');
INSERT INTO `bb_conf` VALUES ('227', 'USER_LOAN_INTEREST_MANAGE_FEE', '0', '6', '0', '', '1', '1', '24', '管理费 = 实际得到的利息×管理费率 0即不收取');
INSERT INTO `bb_conf` VALUES ('228', 'INVESTORS_COMMISSION_RATIO', '10', '4', '0', '', '1', '0', '72', '投资者佣金比例');
INSERT INTO `bb_conf` VALUES ('229', 'BORROWER_COMMISSION_RATIO', '10', '4', '0', '', '1', '0', '72', '借款者佣金比例');
INSERT INTO `bb_conf` VALUES ('230', 'GENERATION_REPAY_FEE', '0', '6', '0', '', '1', '1', '28', '垫付后的罚息 =  垫付总额×垫付罚息费率×垫付天数 0即不收取');
INSERT INTO `bb_conf` VALUES ('232', 'USER_BID_SCORE_FEE', '0', '7', '0', '', '1', '1', '71', '投标返还积分 = 投标金额 ×返还比率');
INSERT INTO `bb_conf` VALUES ('111', 'SHOP_SEARCH_KEYWORD', '贷款,借贷，网贷，投资', '3', '0', '', '1', '1', '15', '');
INSERT INTO `bb_conf` VALUES ('117', 'INDEX_NOTICE_COUNT', '5', '3', '0', '', '1', '1', '35', '');
INSERT INTO `bb_conf` VALUES ('119', 'TMPL_CACHE_ON', '0', '1', '1', '0,1', '1', '1', '6', '');
INSERT INTO `bb_conf` VALUES ('125', 'DOMAIN_ROOT', 'jr.xiaobinqipei.com', '1', '0', '', '1', '1', '10', '');
INSERT INTO `bb_conf` VALUES ('127', 'MAIN_APP', 'shop', '1', '1', 'shop,tuan,youhui', '1', '0', '10', '');
INSERT INTO `bb_conf` VALUES ('128', 'VERIFY_IMAGE', '1', '1', '1', '0,1', '1', '1', '10', '');
INSERT INTO `bb_conf` VALUES ('131', 'APNS_MSG_LOCK', '1', '0', '0', '', '0', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('132', 'PROMOTE_MSG_PAGE', '440180', '0', '0', '', '0', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('133', 'APNS_MSG_PAGE', '0', '0', '0', '', '0', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('216', 'APPLE_DOWLOAD_URL', 'itms-services://?action=download-manifest&url=https://app.fanwe.cn/ios/superp2p/superp2p.plist', '3', '0', '0', '1', '1', '35', '');
INSERT INTO `bb_conf` VALUES ('217', 'ANDROID_DOWLOAD_URL', 'http://jr.xiaobinqipei.com/bb_p2p_wap_1.0.apk', '3', '0', '0', '1', '1', '35', '');
INSERT INTO `bb_conf` VALUES ('215', 'BORROW_AGREEMENT', '11', '6', '0', '0', '1', '1', '1', '帮助类文章编号，在我要借款填写资料处显示');
INSERT INTO `bb_conf` VALUES ('121', 'USER_LOGIN_SCORE', '100', '7', '0', '', '1', '0', '2', '');
INSERT INTO `bb_conf` VALUES ('167', 'COMPANY', '浙江融邦投资管理有限公司', '6', '0', '', '1', '1', '1', '');
INSERT INTO `bb_conf` VALUES ('168', 'COMPANY_ADDRESS', '浙江·杭州·余杭区', '6', '0', '', '1', '1', '2', '');
INSERT INTO `bb_conf` VALUES ('169', 'COMPANY_REG_ADDRESS', '余杭区', '6', '0', '', '1', '1', '3', '');
INSERT INTO `bb_conf` VALUES ('175', 'MANAGE_FEE', '0.3', '6', '0', '', '1', '1', '21', '管理费 = 本金总额×管理费率');
INSERT INTO `bb_conf` VALUES ('176', 'MANAGE_IMPOSE_FEE_DAY1', '0.1', '6', '0', '', '1', '1', '22', '');
INSERT INTO `bb_conf` VALUES ('177', 'MANAGE_IMPOSE_FEE_DAY2', '0.5', '6', '0', '', '1', '1', '23', '逾期管理费总额 = 逾期本息总额×对应逾期管理费率×逾期天数');
INSERT INTO `bb_conf` VALUES ('178', 'IMPOSE_FEE_DAY1', '0', '6', '0', '', '1', '1', '24', '');
INSERT INTO `bb_conf` VALUES ('179', 'IMPOSE_FEE_DAY2', '0.1', '6', '0', '', '1', '1', '25', '罚息总额 = 逾期本息总额×对应罚息利率×逾期天数');
INSERT INTO `bb_conf` VALUES ('180', 'COMPENSATE_FEE', '0', '6', '0', '', '1', '1', '25', '补偿金额 = 剩余本金×补偿利率');
INSERT INTO `bb_conf` VALUES ('181', 'IMPOSE_POINT', '-1', '7', '0', '', '1', '1', '14', '');
INSERT INTO `bb_conf` VALUES ('182', 'YZ_IMPOSE_POINT', '-10', '7', '0', '', '1', '1', '15', '');
INSERT INTO `bb_conf` VALUES ('183', 'YZ_IMPSE_DAY', '31', '6', '0', '', '1', '1', '15', '超过该天数为严重逾期');
INSERT INTO `bb_conf` VALUES ('184', 'REPAY_SUCCESS_POINT', '1', '7', '0', '', '1', '1', '13', '');
INSERT INTO `bb_conf` VALUES ('185', 'REPAY_SUCCESS_DAY', '28', '7', '0', '', '1', '1', '13', '');
INSERT INTO `bb_conf` VALUES ('186', 'REPAY_SUCCESS_LIMIT', '20', '7', '0', '', '1', '1', '13', '');
INSERT INTO `bb_conf` VALUES ('187', 'USER_REGISTER_POINT', '0', '7', '0', '', '1', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('188', 'USER_REGISTER_MONEY', '0', '7', '0', '', '1', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('189', 'USER_REGISTER_SCORE', '0', '7', '0', '', '1', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('192', 'MAX_BORROW_QUOTA', '1000000', '6', '0', '', '1', '1', '27', '');
INSERT INTO `bb_conf` VALUES ('191', 'MIN_BORROW_QUOTA', '3000', '6', '0', '', '1', '1', '26', '');
INSERT INTO `bb_conf` VALUES ('195', 'USER_REPAY_QUOTA', '0', '7', '0', '', '1', '1', '26', '');
INSERT INTO `bb_conf` VALUES ('196', 'USER_LOAN_MANAGE_FEE', '0', '6', '0', '', '1', '1', '24', '管理费 = 投资总额×管理费率 0即不收取');
INSERT INTO `bb_conf` VALUES ('197', 'SMS_REPAY_TOUSER_ON', '0', '5', '1', '0,1', '1', '1', '80', '');
INSERT INTO `bb_conf` VALUES ('200', 'MAIL_SEND_CONTRACT_ON', '1', '5', '1', '0,1', '1', '1', '78', '');
INSERT INTO `bb_conf` VALUES ('201', 'DEAL_BID_MULTIPLE', '50', '6', '0', '', '1', '1', '12', '0为不限制');
INSERT INTO `bb_conf` VALUES ('202', 'USER_LOCK_MONEY', '0', '7', '0', '', '1', '1', '64', '需管理员手动解冻');
INSERT INTO `bb_conf` VALUES ('203', 'USER_BID_REBATE', '0', '7', '0', '', '1', '1', '65', '返利金额=投标金额×返利百分比【需满标】');
INSERT INTO `bb_conf` VALUES ('204', 'AGREEMENT', '1', '4', '0', '', '1', '1', '66', '请输入帮助类文章编号');
INSERT INTO `bb_conf` VALUES ('205', 'PRIVACY', '2', '4', '0', '', '1', '1', '67', '请输入帮助类文章编号');
INSERT INTO `bb_conf` VALUES ('206', 'USER_LOAD_TRANSFER_FEE', '1', '6', '0', '', '1', '1', '24', '管理费 = 转让金额×管理费率');
INSERT INTO `bb_conf` VALUES ('208', 'VIRTUAL_MONEY_1', '11102.88', '1', '0', '', '1', '1', '41', '虚拟的累计成交额');
INSERT INTO `bb_conf` VALUES ('209', 'VIRTUAL_MONEY_2', '66788.32', '1', '0', '', '1', '1', '42', '虚拟的累计创造收益');
INSERT INTO `bb_conf` VALUES ('210', 'VIRTUAL_MONEY_3', '56788.23', '1', '0', '', '1', '1', '43', '虚拟的本息保障金');
INSERT INTO `bb_conf` VALUES ('211', 'OPEN_AUTOBID', '1', '4', '1', '0,1', '1', '1', '68', '开启关闭前台自动投标功能');
INSERT INTO `bb_conf` VALUES ('212', 'OPEN_IPS', '0', '4', '1', '0,1', '1', '0', '69', '开启关闭自己托管功能');
INSERT INTO `bb_conf` VALUES ('213', 'IPS_MERCODE', 'GPhKt7sh4dxQQZZkINGFtefRKNPyAj8S00cgAwtRyy0ufD7alNC28xCBKpa6IU7u54zzWSAv4PqUDKMgpOnM7fucO1wuwMi4RgPAnietmqYIhHXZ3TqTGKNzkxA55qYH', '4', '0', '', '1', '0', '71', '资金托管签约号');
INSERT INTO `bb_conf` VALUES ('214', 'IPS_KEY', '808801', '4', '0', '', '1', '0', '71', '资金托管的KEY');
INSERT INTO `bb_conf` VALUES ('222', 'IPS_3DES_KEY', '2EDxsEfp', '4', '0', '', '1', '0', '71', '');
INSERT INTO `bb_conf` VALUES ('221', 'IPS_3DES_IV', 'ICHuQplJ0YR9l7XeVNKi6FMn', '4', '0', '', '1', '0', '71', '');
INSERT INTO `bb_conf` VALUES ('223', 'IPS_FEE_TYPE', '1', '4', '1', '1,2', '1', '0', '71', '谁付IPS手续费');
INSERT INTO `bb_conf` VALUES ('224', 'INVITE_REFERRALS_MIN', '10', '0', '0', '', '1', '0', '2', '');
INSERT INTO `bb_conf` VALUES ('225', 'INVITE_REFERRALS_MAX', '20', '0', '0', '', '1', '0', '3', '');
INSERT INTO `bb_conf` VALUES ('226', 'INVITE_REFERRALS_RATE', '0.1', '0', '0', '', '1', '0', '4', '');
INSERT INTO `bb_conf` VALUES ('243', 'INVITE_REFERRALS_AUTO', '0', '0', '1', '0,1', '1', '0', '5', '');
INSERT INTO `bb_conf` VALUES ('244', 'INVITE_REFERRALS_DATE', '12', '0', '0', '', '1', '0', '6', '0表示一直有效');
INSERT INTO `bb_conf` VALUES ('122', 'USER_LOGIN_MONEY', '0', '7', '0', '', '1', '0', '1', '');
INSERT INTO `bb_conf` VALUES ('123', 'USER_LOGIN_POINT', '0', '7', '0', '', '1', '0', '8', '');
INSERT INTO `bb_conf` VALUES ('231', 'OPEN_QUOTA', '0', '6', '1', '0,1', '1', '1', '29', '开启授信额度申请');
INSERT INTO `bb_conf` VALUES ('233', 'OPEN_POINT', '0', '6', '1', '0,1', '1', '1', '30', '开启信用额度申请');
INSERT INTO `bb_conf` VALUES ('137', 'USER_LOGIN_KEEP_MONEY', '0', '7', '0', '', '1', '0', '4', '');
INSERT INTO `bb_conf` VALUES ('138', 'USER_LOGIN_KEEP_SCORE', '0', '7', '0', '', '1', '0', '5', '');
INSERT INTO `bb_conf` VALUES ('139', 'USER_LOGIN_KEEP_POINT', '50', '7', '0', '', '1', '0', '6', '');
INSERT INTO `bb_conf` VALUES ('246', 'SMS_SEND_IP_NOALLOW', '', '5', '5', '', '1', '1', '81', '一行一个IP，此列表为不允许发送短信的IP地址');
INSERT INTO `bb_conf` VALUES ('247', 'USER_REGISTER_REDBAG', '0', '7', '0', '', '1', '1', '0', '');
INSERT INTO `bb_conf` VALUES ('248', 'MOBILE_HEAD', '15|18|13|17', '1', '0', '', '1', '1', '101', '');
INSERT INTO `bb_conf` VALUES ('250', 'SHOW_EXPRIE_DEAL', '1', '6', '1', '0,1', '1', '1', '30', '');
INSERT INTO `bb_conf` VALUES ('251', 'SCORE_PAGE_SIZE', '12', '3', '0', '', '1', '1', '31', '');
INSERT INTO `bb_conf` VALUES ('252', 'USER_LOGIN_NMC_MONEY', '0', '7', '0', '', '1', '0', '2', '');
INSERT INTO `bb_conf` VALUES ('253', 'USER_LOGIN_KEEP_NMC_MONEY', '0', '7', '0', '', '1', '0', '10', '');
INSERT INTO `bb_conf` VALUES ('270', 'USER_LOGIN_MONEY_TYPE', '0', '7', '1', '0,1', '1', '0', '0', '');
INSERT INTO `bb_conf` VALUES ('271', 'USER_LOGIN_KEEP_MONEY_TYPE', '0', '7', '1', '0,1', '1', '0', '3', '');
INSERT INTO `bb_conf` VALUES ('272', 'LICAI_OPEN', '0', '3', '1', '0,1', '1', '1', '36', '');
INSERT INTO `bb_conf` VALUES ('274', 'PAY_RADIO', '0.5', '8', '0', '', '1', '0', '1', '');
INSERT INTO `bb_conf` VALUES ('275', 'BUY_PRESEND_POINT_MULTIPLE', '0.3', '8', '0', '', '1', '0', '1', '如0.5、1');
INSERT INTO `bb_conf` VALUES ('276', 'REPAY_MAKE', '0', '8', '0', '', '1', '0', '1', '');
INSERT INTO `bb_conf` VALUES ('277', 'SCORE_TRADE_NUMBER', '20', '8', '0', '', '1', '0', '3', '填10的倍数');
INSERT INTO `bb_conf` VALUES ('278', 'BUY_PRESEND_SCORE_MULTIPLE', '0.1', '8', '0', '', '1', '0', '4', '如0.5、1');
INSERT INTO `bb_conf` VALUES ('279', 'BUY_INVITE_REFERRALS', '0', '8', '0', '', '1', '0', '5', '');
INSERT INTO `bb_conf` VALUES ('280', 'REFERRAL_LIMIT', '1', '8', '0', '', '1', '0', '6', '');
INSERT INTO `bb_conf` VALUES ('281', 'INTERESTRATE_TIME', '1', '6', '0', '', '1', '1', '40', '0为不限制');
INSERT INTO `bb_conf` VALUES ('282', 'WEIXIN_MSG', '1', '1', '1', '0,1', '1', '1', '83', '');
INSERT INTO `bb_conf` VALUES ('283', 'VIRTUAL_USER', '780', '1', '0', '', '1', '1', '68', '虚拟的注册人数');
INSERT INTO `bb_conf` VALUES ('284', 'VIRTUAL_DEAL_FINISH_NUM', '1014', '1', '0', '', '1', '1', '68', '虚拟的成交笔数');
INSERT INTO `bb_conf` VALUES ('285', 'VIRTUAL_DEAL_COUNT', '100', '1', '0', '', '1', '1', '68', '虚拟的累计投资次数');
INSERT INTO `bb_conf` VALUES ('286', 'INVEST_START_TIME', '1499616000', '9', '10', '', '1', '1', '68', '累计投资开始时间');
INSERT INTO `bb_conf` VALUES ('287', 'INVEST_END_TIME', '1501430400', '9', '10', '', '1', '1', '68', '累计投资结束时间');
INSERT INTO `bb_conf` VALUES ('288', 'INVEST_CATE', '1', '9', '0', '', '1', '1', '68', '只有已添加的贷款分类才会生效,输入贷款分类id，多个用 , 隔开');
INSERT INTO `bb_conf` VALUES ('289', 'INVEST_BACK_STATUS', '1', '9', '1', '0,1', '1', '1', '67', '是否开启');
