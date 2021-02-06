$(document).ready(function(){
var title=$(".navUI li a[class='curNav']").text();
if(title.longth>0)
	$(document).attr('title',title);
//导航条点击事件
$(".navUI li a").click(function(){
	var pmoduleid=$(this).attr("value");
	var urlstr='/zhixuewang/Site/Home/ModulePage/modulepage/pmoduleid/'+pmoduleid;		
	window.open(urlstr,'_blank');
});
//竖目录点击页面切换，传递父模块ID与模块ID
$(".nav_vertical a").click(function(){
	var pmoduleid=$(".navUI li a[class='curNav']").attr("value");
	var moduleid=$(this).attr("value");
	var urlstr='/zhixuewang/Site/Home/ModulePage/modulepage/pmoduleid/'+pmoduleid+'/moduleid/'+moduleid;		
	window.open(urlstr,'_self');
});
//搜索
$("#btn_search").click(function(){
	var text=$(this).text();
	if(text=="搜博文"){
		var pmoduleid=1;
		var searchstr=$(".ipt_search").val();
		var urlstr='/zhixuewang/Site/Home/ModulePage/modulepage/pmoduleid/'+pmoduleid+"/searchstr/"+searchstr;		
		window.open(urlstr,'_self');
	}
	if(text=="搜博友"){
		var searchstr=$(".ipt_search").val();
		var urlstr='/zhixuewang/Site/Home/ListPage/list_bloger/searchstr/'+searchstr;		
		window.open(urlstr,'_self');
	}
	
});

//
// function setUrlParam(url, param, value)
// {
// 	var re = new RegExp("(///?|&)" + param + "=([^&]+)(&|$)", "i");
// 	var m = url.match(re);
// 	if (m){
// 		return (url.replace(re, function($0, $1, $2) { return ($0.replace($2, value)); } ));
// 	}else{
// 		if (url.indexOf('?') == -1)
// 			return (url + '?' + param + '=' + value);
// 		else
// 			return (url + '&' + param + '=' + value);
// 	}
// }
function getUrl(ctype,blogstage,orderflag){
	var pmoduleid=$("#pmoduleid").attr("value");
	var moduleid=$("#moduleid").attr("value");

	var urlstring=window.location.href;	
	var re = new RegExp("PersonPage", "i");
	var m=urlstring.match(re);
	
	if (m){
		var person_userid=$("#person_userid").attr("value");
		var url="/zhixuewang/Site/Home/PersonPage/person_list_blog/person_userid/"+person_userid+"/ctype/"+ctype+"/blogstage/"+blogstage+"/orderflag/"+orderflag;
		
		
	}else{
		var url="/zhixuewang/Site/Home/ModulePage/modulepage/pmoduleid/"+pmoduleid+"/moduleid/"+moduleid+"/ctype/"+ctype+"/blogstage/"+blogstage+"/orderflag/"+orderflag;
	}
	return url;
}
//博文列表，排序点击事件
$(".blog_panel .selectOrder").click(function(){	
	var ctype=$("#ctype").attr("value");
	var blogstage=$(".tabNav a[class='btn btn_tab curTab']").attr("value");
	var orderflag=$(this).attr("value");
	var urlstr=getUrl(ctype,blogstage,orderflag);
	if($(".classfiyselected").length>0){		
		var classify=$(".classfiyselected").attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}
	if($(".tagselected").length>0){		
		var tag=$(".tagselected").attr("value");
		urlstr=urlstr+"/tag/"+tag;
	}
	if($(".dateplaceselected").length>0){		
		var dateplace=$(".dateplaceselected").attr("value");
		urlstr=urlstr+"/dateplace/"+dateplace;
	}
	if($("#searchstr").attr("value")){	
			
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});

//博文列表，切换到话题
$(".display_topic").click(function(){	
	var ctype=2;
	var blogstage=0;
	var orderflag=$(".curOrder").attr("value");
	var urlstr=getUrl(ctype,blogstage,orderflag);
	if($(".classfiyselected").length>0){		
		var classify=$(".classfiyselected").attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}
	if($(".tagselected").length>0){		
		var tag=$(".tagselected").attr("value");
		urlstr=urlstr+"/tag/"+tag;
	}
	if($(".dateplaceselected").length>0){		
		var dateplace=$(".dateplaceselected").attr("value");
		urlstr=urlstr+"/dateplace/"+dateplace;
	}
	if($("#searchstr").attr("value")){	
			
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});
//博文列表，切换到博文
$(".display_blog").click(function(){	
	var ctype=1;
	var blogstage=0;
	var orderflag=$(".curOrder").attr("value");
	var urlstr=getUrl(ctype,blogstage,orderflag);
	if($(".classfiyselected").length>0){		
		var classify=$(".classfiyselected").attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}
	if($(".tagselected").length>0){		
		var tag=$(".tagselected").attr("value");
		urlstr=urlstr+"/tag/"+tag;
	}
	if($(".dateplaceselected").length>0){		
		var dateplace=$(".dateplaceselected").attr("value");
		urlstr=urlstr+"/dateplace/"+dateplace;
	}
	if($("#searchstr").attr("value")){	
			
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});
//博文列表，选项卡点击事件
$(".blog_panel .btn_tab").click(function(){	
	var ctype=$("#ctype").attr("value");
	var blogstage=$(this).attr("value");
	var orderflag=$(".curOrder").attr("value");
	var urlstr=getUrl(ctype,blogstage,orderflag);
	if($(".classfiyselected").length>0){		
		var classify=$(".classfiyselected").attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}
	if($(".tagselected").length>0){		
		var tag=$(".tagselected").attr("value");
		urlstr=urlstr+"/tag/"+tag;
	}
	if($(".dateplaceselected").length>0){		
		var dateplace=$(".dateplaceselected").attr("value");
		urlstr=urlstr+"/dateplace/"+dateplace;
	}
	if($("#searchstr").attr("value")){	
			
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});
//分类点击事件
$(".classfiy").click(function(){
	var ctype=1;	
	if($("#ctype").length>0){		
		ctype=$("#ctype").attr("value");
	}
	var blogstage=0;	
	if($(".tabNav a[class='btn btn_tab curTab']").length>0){		
		blogstage=$(".tabNav a[class='btn btn_tab curTab']").attr("value");
	}
	var orderflag="time";	
	if($(".curOrder").length>0){		
		orderflag=$(".curOrder").attr("value");
	}
	var urlstr=getUrl(ctype,blogstage,orderflag);	
	
	if($(this).attr("class")=="classfiy classfiyselected"){
		urlstr=urlstr;
	}else{
		var classify=$(this).attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}
	if($("#searchstr").attr("value")){				
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});
//标签点击事件
$(".tag ").click(function(){

	var ctype=$("#ctype").attr("value");
	var blogstage=$(".tabNav a[class='btn btn_tab curTab']").attr("value");
	var orderflag=$(".curOrder").attr("value");
	urlstr=getUrl(ctype,blogstage,orderflag);
	if($(".classfiyselected").length>0){		
		var classify=$(".classfiyselected").attr("value");
		urlstr=urlstr+"/classify/"+classify;
	}	
	if($(this).attr("class")=="tag  tagselected"){
		urlstr=urlstr;
	}else{
		var tag=$(this).attr("value");
		urlstr=urlstr+"/tag/"+tag;
	}
	if($("#searchstr").attr("value")){	
			
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});
//日期归档点击事件
$(".left_dateplacepanel .dateplace").click(function(){
	var ctype=$("#ctype").attr("value");
	var blogstage=$(".tabNav a[class='btn btn_tab curTab']").attr("value");
	var orderflag=$(".curOrder").attr("value");
	urlstr=getUrl(ctype,blogstage,orderflag);	
	if($(this).attr("class")=="dateplace  dateplaceselected"){
		//要注意class间间隔
		urlstr=urlstr;
	}else{
		var dateplace=$(this).attr("value");
		urlstr=urlstr+"/dateplace/"+dateplace;
	}
	if($("#searchstr").attr("value")){	
		var searchstr=$("#searchstr").attr("value");
		urlstr=urlstr+"/searchstr/"+searchstr;
	}
	window.open(urlstr,'_self');
});


//博文列表，标题点击事件
$(".blog_panel .item_title").click(function(){
	var blog_id=$(this).attr("value");
	var urlstr='/zhixuewang/Site/Home/PersonPage/person_content_blog/blog_id/'+blog_id;		
	window.open(urlstr,'_self');
});
//博文列表，作者点击事件
$(".blog_panel .item_info_author").click(function(){
	var person_userid=$(this).attr("value");
	var ctype=$("#ctype").attr("value");
	if(ctype==1)
		var urlstr='/zhixuewang/Site/Home/PersonPage/person_list_blog/person_userid/'+person_userid+'/ctype/'+ctype;		
	if(ctype==2)
		var urlstr='/zhixuewang/Site/Home/PersonPage/person_list_topic/person_userid/'+person_userid+'/ctype/'+ctype;
	window.open(urlstr,'_self');
});


$(document).on("click","#subLogin",function(){
//$("#subLogin").click(function(){	
	var username=$("#login_username").val();
	var password=$("#login_password").val();
	var postdata='';

	if(username){
		postdata+='&username='+username;
	}else{
		$("#login_username").css('border','1px solid red');
		alert('请输入用户名');
		return;
	}
	if(password){
		postdata+='&password='+password;
	}else{
		$("#login_password").css('border','1px solid red');
		alert('请输入密码');
		return;
	}
	$.ajax({ 
		type: "post", 
		url:'/zhixuewang/Site/Home/UserCenter/checkLogin/',
		data: postdata,
		success: function(msg){			
			var res = eval("(" + msg + ")");
			if(res.statusCode == '1') {		
				alert(res.message);	
				var urlstr=window.location.href;
				var urlarr=urlstr.split('#');
				var url=urlarr[0];				
				window.open(url,'_self');
			}else {				
				alert(res.message);									
			}			
		} //操作成功后的操作！msg是后台传过来的值 			 
	});
})
//});
function getoverlay(){
	if($('#overlay').length == 0){
		var overlay = document.createElement('div');
		overlay.id = 'overlay';
		overlay.setAttribute('class','overlay');
		var oin='<div class="lo-frame" id="lo-frame">'
					+'<a href="javascript:;" class="close" id="memclose"></a>'
					+'<span class="lo-logo"><img src="http://static.allsexbox.com/images/logo.jpg" height="70px"></span>'
						+'<div class="sign-up overbox" id="sign-up" style="display: none">'
							+'<div class="with-line">新用戶註冊</div>'
							+'<form action="" method="post" class="signform">'
							+'<input class="clear-input reg-in" name="username" placeholder="用戶名" type="text">'
							+'<span class="clear-tips c-tops"><p>請輸入4-12英文或數字的用戶名</p></span>'
							+'<input class="clear-input reg-in" name="nickname" placeholder="昵稱" type="text">'
							+'<span class="clear-tips  c-tops"><p>昵稱長度4-20個字符、漢字2-10個字</p></span>'
							+'<input class="clear-input reg-in" name="password" placeholder="密碼" type="password">'
							+'<input class="clear-input reg-in" name="password2" placeholder="確認密碼" type="password">'
							+'<span class="clear-tips  c-tops"><p>請輸入6-18位密碼</p></span>'
							+'<input class="clear-input reg-in" name="superpasswd" placeholder="超級密碼" type="text">'
							+'<span class="clear-tips"><p>請留下壹串4-20位數字作為找回密碼使用</p><font color="#ff0000">建議使用QQ號碼,生日等妳不容易忘記的數字</font></span>'
							+'<a href="javascript:;" class="btn btn-red btn18" id="subReg"><span class="text">註冊</span></a>'
							+'</form>'
							+'<div class="clear-right">'
							+'<span class="clear-text">已有帳號? </span><a href="javascript:;" class="clear-link res">直接登錄&raquo;</a>'
							+'</div>'
						+'</div>'
						+'<div class="login overbox" id="login" style="display: none">'
							+'<div class="with-line">用戶登錄</div>'
							+'<form>'
							+'<input class="clear-input cin-in" id="login_username" placeholder="用戶名" type="text">'
							+'<input class="clear-input cin-in" id="login_password" placeholder="密碼" type="password">'
							+'<a href="javascript:;" class="btn btn-red btn18" id="subLogin"><span class="text">登錄</span></a>'
							+'</form>'
							+'<div class="clear-holder">'
							+'<a href="javascript:;" class="c-link repwd">忘記密碼&raquo;</a><span class="clear-text">沒有帳號?</span><a href="javascript:;" class="c-link res">點擊註冊&raquo;</a>'
							+'</div>'
						+'</div>'
						+'<div class="reset overbox" id="reset" style="display: none">'
							+'<div class="with-line">找回密碼</div>'
							+'<form action="" method="post" class="signform">'
							+'<input class="clear-input cin-in" name="username" placeholder="您要找回的賬戶" type="text">'
							+'<input class="clear-input cin-in" name="superpasswd" placeholder="請輸入您預留的超級密碼" type="text">'
							+'<a href="javascript:;" class="btn btn-red btn18" id="subForget"><span class="text">重置</span></a>'
							+'</form>'
							+'<div class="clear-holder">'
							+'<a href="javascript:;" class="c-link relogin">想起來了&raquo;</a><span class="clear-text">沒有帳號?</span><a href="javascript:;" class="c-link res">點擊註冊&raquo;</a>'
							+'</div>'
						+'</div>'
				+'</div>';
			$(overlay).append(oin);
			$("body").append(overlay);
	}
}
$(".confirm_login").click(function(){
	var r=confirm("请先登录");
	if (r==true){
		getoverlay();
		$("#login").css("display","block ");
	}
});
$("#btn_login").click(function(){	
	getoverlay();
	$("#login").css("display","block ");	
});
$("#btn_register").click(function(){	
	getoverlay();
	$("#sign-up").css("display","block ");	
});

$(".panel_display").click(function(){	
	if($(this).text()=="个人信息"){
		$(".person_info").css("display","block ");	
		$(".panel_display a").text("收起");
	}else{
		$(".person_info").css("display","none ");	
		$(".panel_display a").text("个人信息");
	}
});
$(".comment_info a").click(function(){	

	if($('#recomment').length > 0){
		$('#recomment').remove();
	}
	var pid=$(this).parent().parent().attr("value");
	var recomment = document.createElement('div');
	recomment.id = 'recomment';
	recomment.setAttribute('class','comment_item2');
	recomment.setAttribute('value',pid);
	var divstr='<textarea></textarea><br>';
	divstr+='<a href="javascript:;" class="btn" id="submit_recomment">发送</a>';
	divstr+='<a href="javascript:;" class="btn" id="cancel">取消</a>';
	divstr+='<br style="clear:both;" />';
	$(recomment).append(divstr);
	$(this).parent().parent().after(recomment);
	
	
});
$(document).on("click","#submit_comment",function(){
	var pid='0';
	var content=$(".comment_input textarea").val();
	var blog_id=$(".content_title").attr("value");
	var postdata='';
	if(content){
		postdata+='&content='+content;
	}else{		
		alert('评论内容不能为空');
		return;
	}
	if(blog_id){
		postdata+='&blog_id='+blog_id;
	}
	if(pid){
		postdata+='&pid='+pid;
	}
	$.ajax({ 
		type: "post", 
		url:'/zhixuewang/Site/Home/ContentPage/comment_add',
		data: postdata,
		success: function(msg){			
			alert(msg);
			var res = eval("(" + msg + ")");
			if(res.statusCode == '1') {		
				alert(res.message);				
				window.open(window.location.href,'_self');
				$(this).parent().remove();
			}else {				
				alert(res.message);									
			}			
		} //操作成功后的操作！msg是后台传过来的值 			 
	});
});
$(document).on("click","#submit_recomment",function(){
	var pid=$(this).parent().attr("value");
	var content=$("#recomment textarea").val();

	var blog_id=$(".content_title").attr("value");
	var postdata='';
	if(content){
		postdata+='&content='+content;
	}else{		
		alert('评论内容不能为空');
		return;
	}
	if(blog_id){
		postdata+='&blog_id='+blog_id;
	}
	if(pid){
		postdata+='&pid='+pid;
	}
	$.ajax({ 
		type: "post", 
		url:'/zhixuewang/Site/Home/ContentPage/comment_add',
		data: postdata,
		success: function(msg){			
			var res = eval("(" + msg + ")");
			if(res.statusCode == '1') {							
				$("#recomment").remove();		
				var urlstr=window.location.href;
				var urlarr=urlstr.split('#');
				var url=urlarr[0];							
				window.open(url,'_self');
				
			}else {				
				alert(1);									
			}			
		} //操作成功后的操作！msg是后台传过来的值 			 
	});
});
$(document).on("click","#cancel",function(){
	$(this).parent().remove();
});
});