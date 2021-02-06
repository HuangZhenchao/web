<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	 <link rel="stylesheet" type="text/css" href="__PUBLIC__/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/style.css">
	<script type="text/javascript" src="__PUBLIC__/ui/js/jquery-1.11.3.js"></script>	
	<script type="text/javascript" src="__PUBLIC__/ui/js/main.js"></script>

	
</head>
<body>
	<input id="pmoduleid" value="<?php echo ($pmoduleid); ?>" style="display: none;">
	<input id="moduleid" value="<?php echo ($moduleid); ?>" style="display: none;">
	<input id="ctype" value="<?php echo ($ctype); ?>" style="display: none;">
	<input id="searchstr" value="<?php echo ($searchstr); ?>" style="display: none;">
	<header>
		<div class="logo">
			<img class="logo_img" src="__PUBLIC__/ui/images/C_15.png">
			<span class="logo_text">治学网</span>
		</div>
		<nav>
			<ul class="navUI">
				<?php if(is_array($pmodulelist)): $i = 0; $__LIST__ = $pmodulelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="javascript:;" <?php if($vo['id']==$pmoduleid){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>				
            </ul>
		</nav>
		<div class="searchbar">
			<input type="text" class="ipt_search" value="<?php echo ($searchstr); ?>">
			<a class="btn btn_bg_cyan" id="btn_search">搜博文</a>
			<a class="btn btn_search">搜博友</a>
		</div>
		<?php if(isset($_SESSION['ZHIXUEWANG_USERNAME'])){ ?>	
		<div class="btnbar">
			<a class="btn btn_bg_red" href="__APP__/Home/PersonPage/blogadd">发表博客</a>
			<a class="btn btn_bg_orange" href="__APP__/Home/ContentPage/topicadd">发起话题</a>
			<div class="userCenter">
			<a id="userlogin" href="javascript:;" value="<?php echo (session('userid')); ?>" >
				<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
				<span class="author_username"><?php echo (session('ZHIXUEWANG_USERNAME')); ?></span>
			</a>
			<div class="userControl">
			    <div><a href="__APP__/Home/UserCenter/accountedit" target="_self">帐号设置</a></div>
			    <div><a href="__APP__/Home/PersonPage/person_list_blog/person_userid/<?php echo (session('ZHIXUEWANG_USERID')); ?>" target="_self">内容管理</a></div>
			    <!-- <div><a href="" target="_self">消息(0)</a> </div>
			    <div><a href="" target="_self">反馈</a></div>
			    <div><a href="" target="_self">帮助</a></div> -->
			    <div><a href="">退出</a></div>
			</div>   
			</div>             
			<script type="text/javascript">
				$(".userCenter").mouseover(function() {
					x=$("#userlogin").offset();
					newPos=new Object();
					newPos.left=x.left;
					newPos.top="48";
					$('.userControl').offset(newPos);
  					
					var $dom = $('.userControl');
					if ($dom.is(":animated")) {
						$dom.stop(true, true).fadeIn(200);
					}
					$dom.stop(true, true).fadeIn(200);
				});
				$(".userCenter").mouseout(function() {
					var $dom = $('.userControl');
					if ($dom.is(":animated")) {
						$dom.stop(true, true).fadeIn(200);
					}
					$dom.stop(true, true).fadeOut(300);
				});
			</script>
		</div>	
		<?php }else{ ?>	
		<div class="btnbar2">		
			<a class="btn btn_bg_red confirm_login">发表博客</a>
			<a class="btn btn_bg_orange confirm_login">发起话题</a>
			<a class="btn btn_radius_2" id="btn_login">登录</a>
			<a class="btn btn_radius_2" id="btn_register">注册</a>	
			</div>
		<?php } ?>	
	</header>
	<div class="notice">
		<i class="fa fa-volume-up" style="color: #C5D8A0;"></i>
		<div class="notic_text">治学网是一个致力于国学、医学以及信息化技术研究的网站，欢迎各位道友光临指教！</div>
	</div>
	<div class="nav_vertical">
		<?php if(is_array($modulelist)): $i = 0; $__LIST__ = $modulelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:;" <?php if($vo['id']==$moduleid){echo 'class="curNav"';} ?> value="<?php echo ($vo["id"]); ?>">
				<?php echo ($vo["name"]); ?>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>		
	</div>
	<div class="left">
		<div class="rank_panel">
			<!-- <a class="btn btn_long" id="btn_hot_7day" >7日热门 ></a> -->
			<a class="btn btn_long" id="btn_all_bloger">博友列表 ></a>
			<!-- <a class="btn btn_long" id="btn_all_classify" >全部分类 ></a>
			<a class="btn btn_long" id="btn_all_tag" >全部标签 ></a> -->
			<a class="btn btn_long" id="btn_subject" >专题整理 ></a>
		</div>
		<div class="left_classifypanel">
			<h2 class="title"><a>分类>></a></h2>
			<?php if(is_array($classifylist)): $i = 0; $__LIST__ = $classifylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="classfiy <?php if($vo['id']==$classify){echo 'classfiyselected';} ?>" href="javascript:;" value="<?php echo ($vo["id"]); ?>" >
				<img class="classfiyimg" src="__PUBLIC__/ui/images/C_15.png">
				<div class="classfiyname"><?php echo ($vo["name"]); ?>(<?php echo ($vo["classify_blog_count"]); ?>)</div>
			</a><?php endforeach; endif; else: echo "" ;endif; ?>
			
		</div>
		<div class="left_tagpanel">
			<h2 class="title"><a>标签>></a></h2>
			<?php if(is_array($taglist)): $i = 0; $__LIST__ = $taglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="tag <?php if($vo['name']==$tag){echo ' tagselected';} ?>" href="javascript:;" value="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?>(<?php echo ($vo["tag_blog_count"]); ?>)</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>	
		<div class="left_dateplacepanel">
			<h2 class="title">日期归档</h2>
			<?php if(is_array($datelist)): $i = 0; $__LIST__ = $datelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a class="dateplace <?php if($vo['dateplace']==$dateplace){echo ' dateplaceselected';} ?>" href="javascript:;" value="<?php echo ($vo["dateplace"]); ?>"><?php echo ($vo["dateplace"]); ?>(<?php echo ($vo["dateplace_blog_count"]); ?>)</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>	
		<div class="link_panel">
			<h2 class="title">推荐站点</h2>
			<a class="friend_link" style="background-color: #DAB984;" title="书格，有品格的数字古籍图书馆" href="https://shuge.org" target="_blank">
				书格
			</a>
			<a class="friend_link" style="background-color: #FE7F00;" title="【中医宝典】中医名著古籍大全,中医书籍在线阅读,在线学习中医" href="http://zhongyibaodian.com/" target="_blank">
				中医宝典
			</a>
			<a class="friend_link" style="background-color: #CC0001;" title="CSDN博客-专业IT技术发表平台" href="https://blog.csdn.net/" target="_blank">
				CSDN
			</a>
			<a class="friend_link" style="background-color: #433F3E;" title="博客园 - 开发者的网上家园" href="https://www.cnblogs.com/" target="_blank">
				博客园
			</a>
			<a class="friend_link" style="background-color: #ED705A;" title="简书 - 创作你的创作" href="https://www.jianshu.com/" target="_blank">
				简书
			</a>
		</div>
		<br style="clear:both;" />
	</div><div class="right">
		<div class="bookshelf">
		<h2 class="title"><a href="">国学书架>></a></h2>
		<ul class="shelf">
			<li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            
            
        </ul>
	</div>
	<div class="bookshelf">
		<h2 class="title"><a href="">医学书架>></a></h2>
		<ul class="shelf">
			<li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            <li><div class="shelf_item"><a href=""><img src="__PUBLIC__/ui/images/C_15.png"><h3>论语</h3></a></div></li>
            
            
		</ul>
	</div>
		<script type="text/javascript">
					function blog_delete(blog_id){
						var postdata='';
						postdata+='&id='+blog_id;
						$.ajax({ 
							type: "post", 
							url:'__APP__/Home/ContentPage/blog_delete',
							data: postdata,
							success: function(msg){
								
								var res = eval("(" + msg + ")");
								if(res.statusCode == '1') {		
									alert(res.message);
									window.open(window.location.href,'_self');
								}else {				
									alert(res.message);									
								}			
							} //操作成功后的操作！msg是后台传过来的值 			 
						});	
					}
					</script>
<div class="blog_panel">
		<?php if($ctype==1){ ?>
			<div class="tabNav">
				<a name="blog" value="0" class="btn btn_tab <?php if($blogstage==0){echo curTab; }?>">全部博文
				</a><a value="1" class="btn btn_tab <?php if($blogstage==1){echo curTab; }?>">博学
				</a><a value="2" class="btn btn_tab <?php if($blogstage==2){echo curTab; }?>">审问
				</a><a value="3" class="btn btn_tab <?php if($blogstage==3){echo curTab; }?>">慎思
				</a><a value="4" class="btn btn_tab <?php if($blogstage==4){echo curTab; }?>">明辨
				</a><a value="5" class="btn btn_tab <?php if($blogstage==5){echo curTab; }?>">随笔</a>
				<a href="javascript:;" class="btn display_topic">话题</a>
				<a value="time" <?php if($orderflag=='time'){echo 'class="curOrder"'; }else{ echo 'href="javascript:;" class="selectOrder"';}?>>
					按时间排序↓
				</a>
				<a value="hot" <?php if($orderflag=='time'){echo 'href="javascript:;" class="selectOrder"';}else{echo 'class="curOrder"';}?>>
					按热度排序↓
				</a>
			</div>
			<?php }else{ ?>
				<div class="tabNav">
				<a name="blog" value="0" class="btn btn_tab <?php if($blogstage==0){echo curTab; }?>">全部话题
				</a><a value="1" class="btn btn_tab <?php if($blogstage==1){echo curTab; }?>">问
				</a><a value="2" class="btn btn_tab <?php if($blogstage==2){echo curTab; }?>">论
				</a><a value="3" class="btn btn_tab <?php if($blogstage==3){echo curTab; }?>">评
				</a><a value="4" class="btn btn_tab <?php if($blogstage==4){echo curTab; }?>">辩
				
				<a class="btn display_blog">博文</a>
				<a value="time" <?php if($orderflag=='time'){echo 'class="curOrder"'; }else{ echo 'href="javascript:;" class="selectOrder"';}?>>
					按时间排序↓
				</a>
				<a value="hot" <?php if($orderflag=='time'){echo 'href="javascript:;" class="selectOrder"';}else{echo 'class="curOrder"';}?>>
					按热度排序↓
				</a>
			</div>
			<?php } ?>
			<?php if(is_array($bloglist)): $i = 0; $__LIST__ = $bloglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="listitem" value="<?php echo ($vo["id"]); ?>">
				
				<?php  if($vo['ctype']=='1'){ switch ($vo['stage']){ case 1: $stagename="博学"; break; case 2: $stagename="审问"; break; case 3: $stagename="慎思"; break; case 4: $stagename="明辨"; break; case 5: $stagename="随笔"; break; } } if($vo['ctype']=='2'){ switch ($vo['stage']){ case 1: $stagename="问"; break; case 2: $stagename="论"; break; case 3: $stagename="评"; break; case 4: $stagename="辩"; break; } } ?>
				<h3 class="item_title" value="<?php echo ($vo["id"]); ?>">[<?php echo ($stagename); ?>]<?php echo ($vo["title"]); ?></h3>
				<p class="item_summary"><?php echo ($vo["summary"]); ?></p>
				<div class="div_item_tag">												
					<?php if(!$vo['tag1']==''){ ?>
					<a  href="__APP__/Home/ModulePage/modulepage/pmoduleid/1/tag/<?php echo ($vo["tag1"]); ?>" class="btn btn_tiny btn_bg_orange item_tag"><?php echo ($vo["tag1"]); ?></a>
					<?php } if(!$vo['tag2']==''){ ?>
					<a  href="__APP__/Home/ModulePage/modulepage/pmoduleid/1/tag/<?php echo ($vo["tag2"]); ?>" class="btn btn_tiny btn_bg_orange item_tag"><?php echo ($vo["tag2"]); ?></a>
					<?php } ?>
				</div>
				<div class="item_info">
					<a class="item_info_author" href="javascript:;" value="<?php echo ($vo["userid"]); ?>">
						<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
						<span class="author_username"><?php echo ($vo["author"]); ?></span>
					</a>
					<span class="item_info_navicon">
						<i class="fa fa-navicon" style="color: #999999;"></i>
						<a href="__APP__/Home/ModulePage/modulepage/pmoduleid/<?php echo ($vo["pmoduleid"]); ?>"><?php echo ($vo["pmodulename"]); ?></a> ▪ <a href="__APP__/Home/ModulePage/modulepage/pmoduleid/<?php echo ($vo["pmoduleid"]); ?>/classify/<?php echo ($vo["classify"]); ?>"><?php echo ($vo["classifyname"]); ?></a>
					</span>
					<span class="item_info_time">
						<i class="fa fa-clock-o" style="color: #999999;"></i><span class="text_time"><?php echo ($vo["dt"]); ?></span>
					</span>
					<span class="item_info_browseCount">
						<i class="fa fa-eye" style="color: #999999;"></i><span class="text_browseCount"><?php echo ($vo["browsenum"]); ?>浏览</span>
					</span>
					<span class="item_info_commentCount">
						<i class="fa fa-comments" style="color: #999999;"></i><span class="text_commentCount"><?php echo ($vo["commentnum"]); ?>评论</span>
					</span>
					<span class="item_info_favCount">
						<i class="fa fa-heart-o" style="color: #999999;"></i><span class="text_favCount"><?php echo ($vo["favnum"]); ?>喜欢</span>
					</span>
				</div>
				<?php if($_SESSION['ZHIXUEWANG_USERID']==$vo['userid']){ ?>				
				<div id="opt_<?php echo ($vo["id"]); ?>" style="width:30px;height:20px;float:right;margin-top: -25px;margin-right:-30px;display: none; ">
					<a class='btn btn_tiny btn_bg_red' href="__APP__/Home/PersonPage/blogedit/blog_id/<?php echo ($vo["id"]); ?>" target="_blank">编辑</a>
					<a class='btn btn_tiny btn_bg_black' onclick="blog_delete('<?php echo ($vo["id"]); ?>')">删除</a>
					
				</div>
				<?php } ?>
				<br style="clear:both;" />
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<script type="text/javascript">
				$(".listitem").mouseover(function() {
					$("#opt_"+$(this).attr("value")).css("display","block");
				})
				$(".listitem").mouseout(function() {
					$("#opt_"+$(this).attr("value")).css("display","none");
				})
			</script>
		</div>	
		<div id="thinkphp_page">
        			<?php echo ($page); ?>
        </div>        				
		<br style="clear:both;" />
		<br style="clear:both;" />
	</div>
	<footer class="footer">
		<div class="footer_inner"> 
			治学网 版权所有&copy;2018<br/>
			<a>关于本站</a>丨<a>站长统计</a>丨<a>联系我们</a>
		</div>
	</footer>
</body>
</html>