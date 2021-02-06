<?php
//基础类
class CommonAction extends Action { 
	public function _initialize(){
		//判断 是否登录，跳转页面		
		if (!isset($_SESSION['LOGIN_IN_SITE'])) {
			//未登录，从cookie获取值用于登录
			//php获取cookie
			if (isset($_COOKIE["zhixuewang_username"])){				
				$username=$_COOKIE["zhixuewang_username"];
				$password=$_COOKIE["zhixuewang_password"];	
				//调用登录函数自动登录
				$this->login($username,$password);
			}			
		}else{
			setcookie("zhixuewang_username",$_SESSION['ZHIXUEWANG_USERNAME'], time()+86400);
			setcookie("zhixuewang_password",$_SESSION['ZHIXUEWANG_PASSWORD'], time()+86400);
			//setCookie前要没有其他输出
		}
	}
	public function login($username,$password){
		import("@.include.UserInfo" );
		$UserInfo=new UserInfo();
		$recordjson=$UserInfo->loginin($username, $password);
		$userinfo=json_decode($recordjson,true);
		if(is_array($userinfo)) {	
			//若返回用户信息数组，则登录成功			
			$_SESSION['LOGIN_IN_SITE'] = "ZHIXUEWANG";			
			$_SESSION['ZHIXUEWANG_USERNAME'] = $userinfo['username'];
			$_SESSION['ZHIXUEWANG_USERID']=$userinfo['id'];
			$_SESSION['ZHIXUEWANG_ROLE']=$userinfo['role'];
			$_SESSION['ZHIXUEWANG_PASSWORD']=$userinfo['password'];
			return 1;
		}else{
			return $userinfo;	
		}				
	}
	//获取博文列表
	//
	public function getlist_blog($pmoduleid,$ctype){			
		import("@.include.Blog" );
		$Blog=new Blog();		
		$fielddata=array();
		
		//调用方法时传参，模块id $pmoduleid
		//门户首页不传$pmoduleid,模块首页及列表页传$pmoduleid
		if(!$pmoduleid==''){
			$fielddata['pmoduleid']=$pmoduleid;
		}
		if(!$ctype==''){
			$fielddata['ctype']=$ctype;
		}
		//个人页URL传userid，获取个人博客列表			
		if($_REQUEST['person_userid']){
			$fielddata['userid']=$_REQUEST['person_userid'];
		}
		
	//有默认值的参数
		//ctype为1时获取博文列表，为2时获取话题列表，URL有带ctype则为该值，否则为1，将ctype传回页面
		/*$fielddata['ctype']=1;
		if($_REQUEST['ctype']){
			$fielddata['ctype']=$_REQUEST['ctype'];
		}
		$ctype=$fielddata['ctype'];
		$this->assign('ctype',$ctype);*/
		
		//博文类型，或者叫做思维阶段，默认为0时显示全部，与ctype联动
		//将$blogstage传回页面
		$blogstage=0;
		if($_REQUEST['blogstage']&&!$_REQUEST['blogstage']==0){
			$blogstage=$_REQUEST['blogstage'];
			$fielddata['stage']=$_REQUEST['blogstage'];
		}
		$this->assign('blogstage',$blogstage);
		//URL有带orderflag参数则取该值，否则默认为“time”时间排序
		if($_REQUEST['orderflag']){
			$fielddata['orderflag']=$_REQUEST['orderflag'];
		}else{
			$fielddata['orderflag']='time';
		}
		$orderflag=$fielddata['orderflag'];
		$this->assign('orderflag',$orderflag);
		
	//无默认值的参数
		//搜索URL传参，将搜索字符串传回页面
		if($_REQUEST['searchstr']&&!$_REQUEST['classify']){			
			$fielddata['searchstr']=$_REQUEST['searchstr'];			
		}
		if($_REQUEST['searchstr']){			
			$searchstr=$_REQUEST['searchstr'];
			$this->assign('searchstr',$searchstr);
		}
		//URL传参，分类，将参数传回界面
		if($_REQUEST['classify']){
			$fielddata['classify']=$_REQUEST['classify'];
			$classify=$_REQUEST['classify'];
			$this->assign('classify',$classify);	
		}
		if($_REQUEST['tag']){
			$fielddata['tag']=$_REQUEST['tag'];
			$tag=$_REQUEST['tag'];
			$this->assign('tag',$tag);	
		}
		if($_REQUEST['dateplace']){
			$fielddata['dateplace']=$_REQUEST['dateplace'];
			$dateplace=$_REQUEST['dateplace'];
			$this->assign('dateplace',$dateplace);	
		}
		//参数json编码
		$fieldjson=json_encode($fielddata);	
		//导入分页
		import('@.ORG.Util.Page');// 导入分页类   
		//得到记录条数,构建page
		$count=$Blog->getlistcount_blog($fieldjson); 	
		$Page= new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数	
			
    	$show= $Page->show();// 分页显示输出    	
		$this->assign('page',$show);// 赋值分页输出
				
		//获取bloglist
		$returnjson=$Blog->getlist_blog($fieldjson,$Page->firstRow,$Page->listRows);
		$returnlist=json_decode($returnjson,true);
		return $returnlist;						
		
		//
	}
//获取分类列表
	//
	public function getlist_classify($pmoduleid,$ctype){			
		import("@.include.Classify" );
		$Classify=new Classify();		
		$fielddata=array();
		//调用方法时传参，模块id $pmoduleid
		//门户首页不传$pmoduleid,模块首页及列表页传$pmoduleid
		if(!$pmoduleid==''){
			$fielddata['pmoduleid']=$pmoduleid;
		}
		if(!$ctype==''){
			$fielddata['ctype']=$ctype;
		}
		/*if(!$limitnum==''){
			$fielddata['limitnum']=$limitnum;
		}*/
		
		if($_REQUEST['person_userid']){
			$fielddata['userid']=$_REQUEST['person_userid'];
		}
		if($_REQUEST['searchstr']){			
			$fielddata['searchstr']=$_REQUEST['searchstr'];			
		}
		
		$fieldjson=json_encode($fielddata);

		$returnjson=$Classify->getlist_classify($fieldjson);
		$returnlist=json_decode($returnjson,true);	
		return 	$returnlist;
		
		//
	}
	public function getlist_tag($pmoduleid,$ctype){
			
		import("@.include.Tag" );
		$Tag=new Tag();		
		$fielddata=array();
		
		if(!$pmoduleid==''){
			$fielddata['pmoduleid']=$pmoduleid;
		}
		if(!$ctype==''){
			$fielddata['ctype']=$ctype;
		}
		/*if(!$limitnum==''){
			$fielddata['limitnum']=$limitnum;
		}*/
		if($_REQUEST['classify']){
			$fielddata['classify']=$_REQUEST['classify'];
		}
		if($_REQUEST['person_userid']){
			$fielddata['userid']=$_REQUEST['person_userid'];
		}
		if($_REQUEST['searchstr']){			
			$fielddata['searchstr']=$_REQUEST['searchstr'];
			
		}
		
		$fieldjson=json_encode($fielddata);

		$returnjson=$Tag->getlist_tag($fieldjson);
		$returnlist=json_decode($returnjson,true);
		return 	$returnlist;
	
		
		//
	}		      
public function getlist_dateplace($pmoduleid,$ctype){
			
		import("@.include.Blog" );
		$Blog=new Blog();		
		$fielddata=array();
		
		if(!$pmoduleid==''){
			$fielddata['pmoduleid']=$pmoduleid;
		}
		if(!$ctype==''){
			$fielddata['ctype']=$ctype;
		}	
		if($_REQUEST['person_userid']){
			$fielddata['userid']=$_REQUEST['person_userid'];
		}	
		if($_REQUEST['searchstr']){			
			$fielddata['searchstr']=$_REQUEST['searchstr'];
			
		}
		$fieldjson=json_encode($fielddata);

		$returnjson=$Blog->getlist_dateplace($fieldjson);
		$returnlist=json_decode($returnjson,true);
		return 	$returnlist;
	
		
		//
	}
public function getarray_userinfo($userid){

		$sqlstr="select
					a.*,d.blogcount,g.topiccount,j.commentcount,m.favcount,d.totalcomment,n.totalfav,o.totalbrowse
				from
					sys_user_info a 					
					LEFT JOIN 
						(select b.userid,count(cc.id) as blogcount,sum(cc.blogcomment) as totalcomment
								from sys_user_info b 
								LEFT JOIN (select aa.*,count(bb.id) as blogcomment from blog aa left join comment bb on aa.id=bb.blog_id GROUP BY aa.id) as cc on b.userid=cc.userid 
								where cc.ctype=1 GROUP BY b.id
						) as d on a.userid=d.userid
					LEFT JOIN 
						(select b.userid,sum(dd.blogfav) as totalfav
								from sys_user_info b 
								LEFT JOIN (select aa.*,count(bb.id) as blogfav from blog aa left join favorite bb on aa.id=bb.blog_id GROUP BY aa.id) as dd on b.userid=dd.userid 
								where dd.ctype=1 GROUP BY b.id
						) as n on a.userid=n.userid
					LEFT JOIN 
						(select b.userid,sum(ee.blogbrowse) as totalbrowse
								from sys_user_info b 
								LEFT JOIN (select aa.*,count(bb.id) as blogbrowse from blog aa left join favorite bb on aa.id=bb.blog_id GROUP BY aa.id) as ee on b.userid=ee.userid 
								where ee.ctype=1 GROUP BY b.id
						) as o on a.userid=n.userid
					LEFT JOIN (select e.userid,count(f.id) as topiccount from sys_user_info e LEFT JOIN blog f on e.userid=f.userid  where f.ctype=2 GROUP BY e.id) as g on a.userid=g.userid
					LEFT JOIN (select h.userid,count(i.id) as commentcount from sys_user_info h LEFT JOIN comment i on h.userid=i.userid GROUP BY h.id) as j on a.userid=j.userid
					LEFT JOIN (select k.userid,count(l.id) as favcount from sys_user_info k LEFT JOIN favorite l on k.userid=l.userid GROUP BY k.id) as m on a.userid=m.userid
					
				where a.userid=".$userid;
		$recordlist=M()->query($sqlstr);
    	return $recordlist[0];			
		//
	}	
	/*添加日志
	 * $username 操作人昵称
	 * $GUID 模块编号  若是登录则为空
	 * $op 操作  10-登录；11-退出；20-添加资讯 21-修改资讯 22-删除资讯
	 * $result 1-成功 2-失败
	 * $sys_info 系统提示信息消息 
	 * $detail 提示消息
	 * */
	public function syslogadd($username,$GUID,$op,$result,$sys_info,$detail){
		import("@.include.Logs" );
		$logdata=new Logs();
		$fielddata=Array();
		$fielddata["userid"]=$_SESSION['LOGIN_IN_CJAGRI_SITE_USERID'];
		$fielddata["nickname"]=$username;//数据库字段是用nickname
		$fielddata["dt"]=date("Y-m-d H:i:s");
		$fielddata["GUID"]=$GUID;
		$fielddata["ip"]=$_SERVER['REMOTE_ADDR'];
		$fielddata["op"]=$op;
		$fielddata["result"]=$result;
		$fielddata["sys_info"]=$sys_info;
		$fielddata["detail"]=$detail;		
		$jsonfield=json_encode($fielddata);
		$logdata->logpro($jsonfield,1);
	}
}
?>