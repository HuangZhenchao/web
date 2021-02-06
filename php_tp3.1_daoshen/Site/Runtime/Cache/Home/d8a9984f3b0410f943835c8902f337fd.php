<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>东莞市道深企业管理咨询有限公司</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/base.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/core.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/style.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/header.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/footer.css">
	<script type="text/javascript" src="__PUBLIC__/ui/js/jquery-1.11.3.js"></script>	
	<script type="text/javascript" src="__PUBLIC__/ui/js/main.js"></script>	
</head>
<body>
	<header>
		<div class="logo">
			<img class="logo_img" src="">
			<span class="logo_text">道深咨询</span>
		</div>
		<nav>
			<ul class="navUI">
				
					<li><a href="__APP__/Index" <?php if($modulename=='Index'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">首页</a></li>
					<li><a href="__APP__/kehuyanchang" <?php if($modulename=='kehuyanchang'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">客户验厂咨询</a></li>
					<li><a href="__APP__/tixirenzheng" <?php if($modulename=='tixirenzheng'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">体系认证咨询</a></li>
					<li><a href="__APP__/shenhepeixun" <?php if($modulename=='shenhepeixun'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">审核及培训服务</a></li>
					<li><a href="__APP__/yanhuo" <?php if($modulename=='yanhuo'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">验货服务</a></li>
					<li><a href="__APP__/renliziyuan" <?php if($modulename=='renliziyuan'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">人力资源服务</a></li>
					<li><a href="__APP__/qiyewenhua" <?php if($modulename=='qiyewenhua'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">企业文化建设服务</a></li>
					<li><a href="__APP__/gongsijianjie" <?php if($modulename=='gongsijianjie'){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">公司简介</a></li>
					<li><a href="__APP__/en/Index" style="color: red;">English</a></li>
							
            </ul>
		</nav>
		
	</header>
	<div class="notice">
		<i class="fa fa-volume-up" style="color: #C5D8A0;"></i>
		<div class="notic_text">东莞市道深企业管理咨询有限公司，是一家专业的从事验厂、验货、体系认证及人力资源管理咨询服务的机构!</div>
	</div>
	<img src="__PUBLIC__/ui/images/bg1.jpg" >
	
	<footer class="footer">
		<div class="footer_inner"> 
			道深企业管理咨询有限公司 版权所有&copy;2018<br/>
			<a>关于本站</a>丨<a>站长统计</a>丨<a>联系我们</a>
		</div>
	</footer>
</body>
</html>