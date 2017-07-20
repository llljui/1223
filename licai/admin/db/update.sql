//添加用户数变动 2017-02-24
INSERT INTO bb_conf (name, value, group_id, is_effect, is_conf, sort, tip) VALUES ('VIRTUAL_USER', 1000, 1, 1, 1, 68, '虚拟的注册人数'); 
INSERT INTO bb_conf (name, value, group_id, is_effect, is_conf, sort, tip) VALUES ('VIRTUAL_DEAL_FINISH_NUM', 1000, 1, 1, 1, 68, '虚拟的成交笔数'); 

INSERT INTO bb_conf (name, value, group_id, is_effect, is_conf, sort, tip) VALUES ('VIRTUAL_DEAL_COUNT', 100, 1, 1, 1, 68, '虚拟的累计投资次数'); 


//添加日志
CREATE TABLE `bb_syn_api_log` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `act` varchar(30) NOT NULL,
      `api` text NOT NULL,
      PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1493 DEFAULT CHARSET=utf8;

/**2017-06-01**/
ALTER TABLE bb_user ADD column `xbqp_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '小滨汽配同步user_id';

/**2017-7-04
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_50000_MONEY', 588, 9, 0, '', 1, 1, 68, '累计投资5万返利'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_30000_MONEY', 258, 9, 0, '', 1, 1, 68, '累计投资3万返利'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_10000_MONEY', 88, 9, 0, '', 1, 1, 68, '累计投资1万返利'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_5000_MONEY', 38, 9, 0, '', 1, 1, 68, '累计投资5千返利'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_1000_MONEY', 8, 9, 0, '', 1, 1, 68, '累计投资3千返利'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_BACK_STATUS', 0, 9, 1, '0,1', 1, 1, 67, '是否开启'); **/

INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_START_TIME', '', 9, 10, '', 1, 1, 68, '累计投资开始时间'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_END_TIME', '', 9, 10, '', 1, 1, 68, '累计投资结束时间'); 
INSERT INTO bb_conf (name, value, group_id, input_type, value_scope, is_effect, is_conf, sort, tip) VALUES ('INVEST_CATE', '', 9, 0, '', 1, 1, 68, '只有已添加的贷款分类才会生效,输入贷款分类id，多个用 , 隔开'); 

ALTER TABLE bb_ecv_type ADD column `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '红包类型，主要是投资返红包(1)，与其他(0)';

/**添加投资返红包**/
INSERT INTO bb_ecv_type (name, money, use_limit, begin_time, end_time, gen_count, send_type, exchange_score, exchange_limit, exchange_sn, use_type, type) VALUES ('累计投资50000红包', 328, 1, 1498982400, 0, 0, 4, 0, 0, null, 0, 5); 
INSERT INTO bb_ecv_type (name, money, use_limit, begin_time, end_time, gen_count, send_type, exchange_score, exchange_limit, exchange_sn, use_type, type) VALUES ('累计投资30000红包', 168, 1, 1498982400, 0, 0, 4, 0, 0, null, 0, 4); 
INSERT INTO bb_ecv_type (name, money, use_limit, begin_time, end_time, gen_count, send_type, exchange_score, exchange_limit, exchange_sn, use_type, type) VALUES ('累计投资10000红包', 48, 1, 1498982400, 0, 0, 4, 0, 0, null, 0, 3); 
INSERT INTO bb_ecv_type (name, money, use_limit, begin_time, end_time, gen_count, send_type, exchange_score, exchange_limit, exchange_sn, use_type, type) VALUES ('累计投资5000红包', 28, 1, 1498982400, 0, 0, 4, 0, 0, null, 0, 2); 
INSERT INTO bb_ecv_type (name, money, use_limit, begin_time, end_time, gen_count, send_type, exchange_score, exchange_limit, exchange_sn, use_type, type) VALUES ('累计投资1000红包', 8, 1, 1498982400, 0, 0, 4, 0, 0, null, 0, 1); 


/**2017-7-7**/
INSERT INTO bb_money_type (name, type, class, sort, is_effect) VALUES ('邀请投资返现', 60, 'money', 10, 1); 

/**2017-7-14**/
ALTER TABLE bb_user_money_log ADD column `from_amount_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '累计返现的标识';
