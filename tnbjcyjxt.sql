DROP TABLE IF EXISTS `t_userinfo`;
CREATE TABLE `t_userinfo` (
  `userid` int(4) auto_increment primary key comment '用户id',
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

DROP TABLE IF EXISTS `t_healthinfo`;
CREATE TABLE `t_healthinfo` (
	`id` int(4) auto_increment primary key comment 'id',
	`userid` int(4) comment '用户id',
	`height` float comment '身高',
	`weight` float comment '体重',
	`BMI` float comment 'BMI指数',
	`smokeyears` int(4) comment '烟龄',
	`SBP` int(4) comment '收缩压',
	`age` int(4) comment '年龄',
	`drinking` int(4) comment '饮酒史',
	`examtime` datetime comment '检查时间',
	`result` float default 1 comment '结果',
	`status` INT(1) default 0 comment '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
	`fromuserid` int(4) comment '用户id',
    `touserid` int(4) comment '用户id',
	`sendtime` datetime comment '检查时间',
	`content` TEXT comment '内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `t_article`;
CREATE TABLE `t_article` (
	`id` int(4) auto_increment primary key comment '用户id',
    `title` char(255) comment '文章标题',
	`author` char(255) comment '作者',
	`tag` char(20) comment 'tag',
	`summary` TEXT comment '简要',
	`content` TEXT comment '内容',
	`time` datetime comment '检查时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;