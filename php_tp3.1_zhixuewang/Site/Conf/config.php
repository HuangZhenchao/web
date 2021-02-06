<?php
$siteconfig	=	require './siteconfig.inc.php';
$config	= array(
	'APP_GROUP_LIST'=>'Home,Admin',
  	'DEFAULT_GROUP'=>'Home',
	/*
	 * 0:普通模式 (采用传统癿URL参数模式 )
	 * 1:PATHINFO模式(http://<serverName>/appName/module/action/id/1/)
	 * 2:REWRITE模式(PATHINFO模式基础上隐藏index.php)
	 * 3:兼容模式(普通模式和PATHINFO模式, 可以支持任何的运行环境, 如果你的环境不支持PATHINFO 请设置为3)
	 */
    'URL_MODEL'=>2,
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'db_zhixuewang',
	'DB_USER'=>'hzc',
	'DB_PWD'=>'hzc954325',
	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'',

	'SESSION_AUTO_START'=>true
);

return array_merge($config,$siteconfig);
?>