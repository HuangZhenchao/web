<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>治学网</title>
	 <link rel="stylesheet" type="text/css" href="__PUBLIC__/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ui/css/style.css">
	<script type="text/javascript" src="__PUBLIC__/ui/js/jquery-1.11.3.js"></script>	
	<script type="text/javascript" src="__PUBLIC__/ui/js/main.js"></script>
	<script type="text/javascript">
	var url=window.location.href;
	var re = new RegExp("/p/", "i");
    var m = url.match(re);
	if (m){	
		window.location.hash="#comment";
	}
	</script>
</head>
<body>
	<input id="person_userid" value="<?php echo ($person_userid); ?>" style="display: none;">
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
		<?php if($_SESSION['ZHIXUEWANG_USERID']==$person_userid){ ?>		
			<a href="__APP__/Home/PersonPage/person_list_blog/person_userid/<?php echo ($person_userid); ?>/ctype/1">博文话题</a>			
			<a href="__APP__/Home/PersonPage/person_list_book/person_userid/<?php echo ($person_userid); ?>">我的书架</a>
			<a href="__APP__/Home/PersonPage/person_list_fav/person_userid/<?php echo ($person_userid); ?>">我喜欢的</a>
			<a href="__APP__/Home/PersonPage/person_list_comment/person_userid/<?php echo ($person_userid); ?>">我评论的</a>
			<a class="curNav">博文内容</a>
		<?php }else{ ?>
			<a href="__APP__/Home/PersonPage/person_list_blog/person_userid/<?php echo ($person_userid); ?>/ctype/1">博文话题</a>
			<a href="__APP__/Home/PersonPage/person_list_book/person_userid/<?php echo ($person_userid); ?>">他的书架</a>
			<a href="__APP__/Home/PersonPage/person_list_fav/person_userid/<?php echo ($person_userid); ?>">他喜欢的</a>
			<a href="__APP__/Home/PersonPage/person_list_comment/person_userid/<?php echo ($person_userid); ?>">他评论的</a>
			<a class="curNav">博文内容</a>
		<?php } ?>
	</div>
	<div class="left">
		<div class="person_panel">
			<h2 class="title"><a href="">个人资料</a></h2>
			<div style="margin:0 20px;padding: 10px 0; border-bottom: 1px solid #E3E3E3; ">
				<img style="width:50px;height: 50px;float: left;" class="user_pic" src="<?php echo ($userinfoarray['picture']); ?>">
				<span style="font-size:16px;line-height:50px;float: left;"><?php echo ($userinfoarray['username']); ?></span>		
				<!-- <a style="float:right;line-height:50px;">+关注</a> -->		
				<br style="clear:both;" />
			</div>			
			<div>
				<div class="person_count">
					<dl><dt>博文</dt><dd><?php echo ($userinfoarray['blogcount']); ?></dd></dl>
					<dl><dt>话题</dt><dd><?php echo ($userinfoarray['topiccount']); ?></dd></dl>
					<dl><dt>评论</dt><dd><?php echo ($userinfoarray['commentcount']); ?></dd></dl>
					<dl><dt>喜欢</dt><dd><?php echo ($userinfoarray['favcount']); ?></dd></dl>
				</div>
				<div class="person_count"  style="border-bottom: 1px solid #E3E3E3; ">
					<dl><dt>浏览</dt><dd><?php echo ($userinfoarray['totalbrowse']); ?></dd></dl>
					<dl><dt>被评论</dt><dd><?php echo ($userinfoarray['totalcomment']); ?></dd></dl>
					<dl><dt>被喜欢</dt><dd><?php echo ($userinfoarray['totalfav']); ?></dd></dl>
					
				</div>
			</div>
			<div class="person_info" style="display: none;">
			<table><tbody>
			<tr><th>国籍:</th><td><?php echo ($userinfoarray['nation']); ?></td></tr>
			<tr><th>地区:</th><td><?php echo ($userinfoarray['city']); ?></td></tr>
			
			<tr><th>性别:</th><td><?php if($userinfoarray['sex']==0){echo "女";}else{echo "男";}?></td></tr>
			<tr><th>年龄:</th><td><?php echo date("Y-m-d h:i:s",time())-$userinfoarray['birthday']; ?></td></tr>
			<tr><th>姓名:</th><td><?php echo ($userinfoarray['name']); ?></td></tr>
			<tr><th>QQ:</th><td><?php echo ($userinfoarray['qq']); ?></td></tr>
			<tr><th>微信:</th><td><?php echo ($userinfoarray['weichat']); ?></td></tr>
			<tr><th>邮箱:</th><td><?php echo ($userinfoarray['email']); ?></td></tr>
			<tr><th>职业:</th><td><?php echo ($userinfoarray['vocational']); ?></td></tr>
			<tr><th>兴趣:</th><td><?php echo ($userinfoarray['interest']); ?></td></tr>
			<tr><th>简介:</th><td><p><?php echo ($userinfoarray['detail']); ?></p><td></tr>
			</tbody></table></div>
			<div  class="panel_display"><a href="javascript:;">个人信息</a></div>

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
		<br style="clear:both;" />
	</div><div class="right content" >
		<div class="content_title" value="<?php echo ($blogarray['id']); ?>"><h1><?php echo ($blogarray['title']); ?></h1></div>

		<div class="content_info">
			<div class="item_info">
					<a class="item_info_author" href="">
						<img class="user_pic" src="<?php echo ($blogarray['picture']); ?>"><span class="author_username"><?php echo ($blogarray['author']); ?></span>
					</a>
					<span class="item_info_navicon">
						<i class="fa fa-navicon" style="color: #999999;"></i>
						<a href="__APP__/Home/ModulePage/modulepage/pmoduleid/<?php echo ($blogarray["pmoduleid"]); ?>"><?php echo ($blogarray["pmodulename"]); ?></a> ▪ <a href="__APP__/Home/ModulePage/modulepage/pmoduleid/<?php echo ($blogarray["pmoduleid"]); ?>/classify/<?php echo ($blogarray["classify"]); ?>"><?php echo ($blogarray["classifyname"]); ?></a>
					</span>
					<span class="item_info_time">
						<i class="fa fa-clock-o" style="color: #999999;"></i><span class="text_time"><?php echo ($blogarray['dt']); ?></span>
					</span>
					<span class="item_info_browseCount">
						<i class="fa fa-eye" style="color: #999999;"></i><span class="text_browseCount"><?php echo ($blogarray['browsenum']); ?>浏览</span>
					</span>
					<span class="item_info_commentCount">
						<i class="fa fa-comments" style="color: #999999;"></i><span class="text_commentCount"><?php echo ($blogarray['commentnum']); ?>评论</span>
					</span>
					<span class="item_info_favCount">
						<i class="fa fa-heart-o" style="color: #999999;"></i><span class="text_favCount"><?php echo ($blogarray['favnum']); ?>喜欢</span>
					</span>
				</div>
		</div>
		<div class="content_content">
			<?php echo ($blogarray['content']); ?>
		</div>
		<div class="div_item_tag">
					<?php if(!$blogarray['tag1']==''){ ?>
					<a  href="__APP__/Home/ModulePage/modulepage/pmoduleid/1/tag/<?php echo ($blogarray["tag1"]); ?>" class="btn btn_tiny btn_bg_orange item_tag"><?php echo ($blogarray["tag1"]); ?></a>
					<?php } if(!$blogarray['tag2']==''){ ?>
					<a  href="__APP__/Home/ModulePage/modulepage/pmoduleid/1/tag/<?php echo ($blogarray["tag2"]); ?>" class="btn btn_tiny btn_bg_orange item_tag"><?php echo ($blogarray["tag2"]); ?></a>
					<?php } ?>
		</div>
		<div class="content_operate">
			<a class="content_favrite"><span class="icon_fav"></span><span class="text">喜欢 | <?php echo ($blogarray['favnum']); ?></span></a>
			<a href="" class="content_tip">举报文章</a>
		</div>
		<div class="splitdiv"></div>
		<a name="comment"></a>
		<div class="comment_form">
			<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
			<div class="comment_input">
				<textarea placeholder="写下你的评论..."></textarea>
			</div>
			<a href="" class="btn btn_semi" id="submit_comment">发送</a>
		</div>
		<div class="comment_list" id="comment_list">
			<h2><?php echo ($blogarray['commentnum']); ?>条评论</h2>
			<?php echo ($commentstr); ?>
			<!-- <div class="comment_item">
				<div class="comment_item1">
					<a class="commenter">
						<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
						<span class="">治学网</span>
					</a>		
					<div class="comment_content">
						网站很不错，可以让网友在这里进行思想的碰撞！
					</div>	
					<div class="comment_info">
						<span>1楼</span> | <span>2018-6-11 20:00:00</span>
						<span class="icon_fav"></span><span>22赞</span>
						<span class="icon_fav"></span><span>回复</span>
					</div>
				</div>
				<div class="comment_item2">
					<div class="comment_item2_div">
						<div class="comment_content">
							<a href="" class="commenter">zhixuewang</a>：赞同！	
						</div>	
						<div class="comment_info">
							<span>2018-6-11 20:00:00</span>
							<span class="icon_fav"></span><span>22赞</span>
							<span class="icon_fav"></span><span>回复</span>
						</div>
					</div>
					<div class="comment_item2_div">
						<div class="comment_content">
							<a href="" class="commenter">zhixuewang</a>：赞同！	
						</div>	
						<div class="comment_info">
							<span>2018-6-11 20:00:00</span>
							<span class="icon_fav"></span><span>22赞</span>
							<span class="icon_fav"></span><span>回复</span>
						</div>
					</div>
					<div class="comment_item2">
						<div class="comment_item2_div">
							<div class="comment_content">
								<a href="" class="commenter">zhixuewang</a>：赞同！	
							</div>	
							<div class="comment_info">
								<span>2018-6-11 20:00:00</span>
								<span class="icon_fav"></span><span>22赞</span>
								<span class="icon_fav"></span><span>回复</span>
							</div>
						</div>
						
					</div>
				</div>
				<div class="comment_item1">
					<a class="commenter">
						<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
						<span class="">治学网</span>
					</a>		
					<div class="comment_content">
						网站很不错，可以让网友在这里进行思想的碰撞！
					</div>	
					<div class="comment_info">
						<span>1楼</span> | <span>2018-6-11 20:00:00</span>
						<span class="icon_fav"></span><span>22赞</span>
						<span class="icon_fav"></span><span>回复</span>
					</div>
				</div>
				<div class="comment_item2">
					<div class="comment_item2_div">
						<div class="comment_content">
							<a href="" class="commenter">zhixuewang</a>：赞同！	
						</div>	
						<div class="comment_info">
							<span>2018-6-11 20:00:00</span>
							<span class="icon_fav"></span><span>22赞</span>
							<span class="icon_fav"></span><span>回复</span>
						</div>
					</div>
					<div class="comment_item2">
						<div class="comment_item2_div">
							<div class="comment_content">
								<a href="" class="commenter">zhixuewang</a>：赞同！	
							</div>	
							<div class="comment_info">
								<span>2018-6-11 20:00:00</span>
								<span class="icon_fav"></span><span>22赞</span>
								<span class="icon_fav"></span><span>回复</span>
							</div>
						</div>
						
					</div>
				</div>
				</div> -->
				<div id="thinkphp_page">
        			<?php echo ($page); ?>
        		</div>
			</div>						
		</div>

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