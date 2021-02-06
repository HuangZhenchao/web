DROP TABLE IF EXISTS `t_userinfo`;
CREATE TABLE `t_userinfo` (
  `userid` CHAR(25) primary key comment '用户标识，ZYFJDCD20200505222010xxxx',
  `username` CHAR(255) NOT NULL DEFAULT '' comment '用户名',
  `passwd` CHAR(255) NOT NULL DEFAULT '' comment '密码',
  `role` INT(4) NOT NULL comment '角色',
  `status` INT(4) DEFAULT 1 comment '状态',
  `regtime` DATETIME NOT NULL comment '注册时间',
  `tel` CHAR(13) comment '手机号',
  `email` CHAR(255) comment '邮箱',
  `name` CHAR(255) comment '姓名',
  `sex` INT(4) DEFAULT 0 comment '性别',
  `detail` TEXT comment '详情，备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_prescription`;
CREATE TABLE `t_prescription` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为方剂ID',
  `name` CHAR(255) NOT NULL comment '方剂名',
  `source` TEXT comment '出处',
  `comprise` TEXT comment '方剂组成',
  `major` TEXT comment '方剂主治',
  `usage` TEXT comment '用法用量',
  `preparation` TEXT comment '方剂制备',
  `effect` TEXT comment '功效',
  `contraindication` TEXT comment '用药禁忌',
  `annotation` TEXT comment '附注',
  `eachexpound` TEXT comment '各家论述',
  `addsubtract` TEXT comment '组方加减'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_comprise`;
CREATE TABLE `t_comprise` (
  `pres_id` INT(4) NOT NULL comment '方剂ID',
  `medname` CHAR(30) comment '组方药物名',
  `processing` CHAR(30) comment '炮制',
  `dosage` CHAR(30) comment '剂量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_note`;
CREATE TABLE `t_note` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为笔记ID',
  `type` INT(4) NOT NULL comment '类型',
  `pres_id` INT(4) NOT NULL NULL comment '方剂ID',
  `field` CHAR(40) NOT NULL comment '字段',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `createtime` DATETIME NOT NULL comment '创建时间',
  `lastedittime` DATETIME NOT NULL NULL comment '最近修改时间',
  `content` TEXT comment '剂量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_feedback_error`;
CREATE TABLE `t_feedback_error` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为ID',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `pres_id` INT(4) comment '方剂ID',
  `status` INT(1) DEFAULT 0 comment '0待处理1已处理2无意义内容',
  `content` TEXT NOT NULL comment '内容',
  `detail` TEXT comment '备注',
  `time` DATETIME NOT NULL comment '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_feedback_lack`;
CREATE TABLE `t_feedback_suggest` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为ID',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `status` INT(1) DEFAULT 0 comment '0待处理1已处理2无意义内容',
  `content` TEXT NOT NULL comment '内容',
  `detail` TEXT comment '备注',
  `time` DATETIME NOT NULL comment '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_feedback_suggest`;
CREATE TABLE `t_feedback_suggest` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为ID',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `status` INT(1) DEFAULT 0 comment '0待处理1已处理2无意义内容',
  `content` TEXT NOT NULL comment '内容',
  `detail` TEXT comment '备注',
  `time` DATETIME NOT NULL comment '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_collect`;
CREATE TABLE `t_collect` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为ID',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `pres_id` INT(4) NOT NULL comment '方剂ID',
  `detail` TEXT comment '收藏说明',
  `time` DATETIME NOT NULL comment '时间' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_browsing`;
CREATE TABLE `t_browsing` (
  `id` INT(4) auto_increment primary key comment '自增序号，作为ID',
  `userid` CHAR(25) NOT NULL comment '用户ID',
  `pres_id` INT(4) NOT NULL NULL comment '方剂ID',
  `time` DATETIME NOT NULL comment '时间' 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
