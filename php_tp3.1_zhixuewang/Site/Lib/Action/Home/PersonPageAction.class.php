<?php
class PersonPageAction extends CommonAction{
	public function blogadd(){				
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);		
		$person_userid=$_SESSION['ZHIXUEWANG_USERID'];
		//获取作者的用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//获取所有标签
		$taglist=$this->getlist_tag('','','');		
		$this->assign('alltag',$taglist);
		$_REQUEST['person_userid']=$person_userid;
		//获取用户分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		
		//获取用户标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//获取用户归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);			
		$this->display();
	}
	public function blogedit(){				
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);		
		$person_userid=$_SESSION['ZHIXUEWANG_USERID'];
		//获取作者的用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//获取所有标签
		$taglist=$this->getlist_tag('','','');		
		$this->assign('alltag',$taglist);
		$_REQUEST['person_userid']=$person_userid;
		//获取用户分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		
		//获取用户标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//获取用户归档
		$datelist=$this->getlist_dateplace('','');	

		import("@.include.Blog" );
		$Blog=new Blog();		
		$fielddata=array();
		$fielddata['id']=$_REQUEST['blog_id'];
		$returnjson=$Blog->getlist_blog($fieldjson);
		$bloglist=json_decode($returnjson,true);
		$blogarray=$bloglist[0];
		$this->assign('blogarray',$blogarray);
		
		$this->assign('datelist',$datelist);
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);			
		$this->display();
	}
	public function person_content_blog(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		//获取一篇博文
		import("@.include.Blog" );
		$Blog=new Blog();
		$fielddata=array();
		if($_REQUEST['blog_id']){
			$fielddata['id']=$_REQUEST['blog_id'];
			$blog_id=$_REQUEST['blog_id'];
		}
		$fieldjson=json_encode($fielddata);
		$returnjson=$Blog->getlist_blog($fieldjson);
		$bloglist=json_decode($returnjson,true);
		$blogarray=$bloglist[0];
		//获取作者id
		$person_userid=$bloglist[0]['userid'];
		//获取作者的用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		$_REQUEST['person_userid']=$person_userid;
		//获取用户分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		//获取用户标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//获取用户归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
						
		//判断是否已添加到喜欢
		import("@.include.Favorite" );
		$Favorite=new Favorite();		
		$fielddata['userid']=$_SESSION['ZHIXUEWANG_USERID'];
		$fieldjson=json_encode($fielddata);
		$ret=$Favorite->isexisted($fieldjson);
		if($ret>0)
			$isfav=1;
		else 
			$isfav=0;			
		$this->assign('isfav',$isfav);
		//获取评论
		import("@.include.Comment" );
		$Comment=new Comment();	
		$fielddata=array();
		$fielddata['blog_id']=$_REQUEST['blog_id'];
		$fielddata['pid']='0';
		$fieldjson=json_encode($fielddata);
		import('@.ORG.Util.Page');// 导入分页类    	
		$count=$Comment->getlistcount_comment($fieldjson);
		$Page= new Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数	
		$recordjson=$Comment->getlist_comment($fieldjson,$Page->firstRow,$Page->listRows);	
		$commentlist=json_decode($recordjson,true);
		//构建评论树
		$commentstr='<div class="comment_item">';		
		foreach ($commentlist as $value){
			$commentstr.='<div class="comment_item1" value="'.$value['id'].'">
					<a class="commenter" value="'.$value['userid'].'">
						<img class="user_pic" src="__PUBLIC__/ui/images/C_15.png">
						<span class="">'.$value['commenter'].'</span>
					</a>		
					<div class="comment_content">'
						.$value['content'].'
					</div>	
					<div class="comment_info">
						<span>1楼</span> | <span>'.$value['dt'].'</span>
						<span class="icon_fav"></span><span>22赞</span>
						<a href="javascript:;">回复</a>
					</div>
				</div>';
			$childstr=$this->getchild($value[id]);
			$commentstr.=$childstr;
		}
		$commentstr.='</div>';
		$this->assign("commentstr",$commentstr);
		
    	$show= $Page->show();// 分页显示输出    	
		$this->assign('page',$show);// 赋值分页输出
		
		$this->assign('blogarray',$blogarray);
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}
	public function getchild($pid){
		import("@.include.Comment" );
		$Comment=new Comment();	
		$fielddata=array();
		$fielddata['blog_id']=$_REQUEST['blog_id'];
		$fielddata['pid']=$pid;
		$fieldjson=json_encode($fielddata);
		$recordjson=$Comment->getlist_comment($fieldjson);
		$commentlist=json_decode($recordjson,true);
		if(count($commentlist)>0){
			$commentstr='<div class="comment_item2">';
			foreach ($commentlist as $value){
				$commentstr.='<div class="comment_item2_div" value="'.$value['id'].'">
							<div class="comment_content">
								<a href="" class="commenter">'.$value['commenter'].'</a>：'.$value['content'].'	
							</div>	
							<div class="comment_info">
								<span>'.$value['dt'].'</span>
								<span class="icon_fav"></span><span>22赞</span>
								<a href="javascript:;">回复</a>
							</div>
						</div>';
				$childstr=$this->getchild($value[id]);
				$commentstr.=$childstr;				
			}
			$commentstr.='</div>';
		}
		return $commentstr;
	}
	public function person_list_blog(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		if($_REQUEST['person_userid'])
			$person_userid=$_REQUEST['person_userid'];
		else 
			$person_userid=$_SESSION['ZHIXUEWANG_USERID'];
		//获取用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//列表页，ctype为1是博文列表
		$ctype=1;
		if($_REQUEST['ctype']){
			$ctype=$_REQUEST['ctype'];			
		}
		$this->assign('ctype',$ctype);
		
		//首页获取博文列表
		$bloglist=$this->getlist_blog('',$ctype);	
		$this->assign('bloglist',$bloglist);
		//首页获取分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);

		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}
	/*public function person_list_topic(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		$person_userid=$_REQUEST['person_userid'];
		//获取博文列表
		$this->getlist_blog('');	
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}*/
	public function person_list_book(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		$person_userid=$_REQUEST['person_userid'];
		//获取用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//首页获取分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
		
		
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}
	public function person_list_fav(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		$person_userid=$_REQUEST['person_userid'];
		//获取用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//首页获取分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
		
		
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}
public function person_list_comment(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		$person_userid=$_REQUEST['person_userid'];
		//获取用户信息
		$userinfoarray=$this->getarray_userinfo($person_userid);
		$this->assign('userinfoarray',$userinfoarray);
		//首页获取分类列表
		$classifylist=$this->getlist_classify('','',30);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag('','',30);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
		
		
		$this->assign('person_userid',$person_userid);
		$this->assign('pmodulelist',$pmodulelist);
		$this->display();
	}
	public function fav_add(){
		import("@.include.Favorite" );
		$Favorite=new Favorite();		
		$fielddata=array();
		$fielddata['blog_id']=$_POST['blog_id'];
		$fielddata['userid']=$_SESSION['ZHIXUEWANG_USERID'];
		$fielddata['dt']=date("y-m-d h:i:s",time());
		
		$ret=$Favorite->favpro($fieldjson,1);
		if($ret>0)
			echo '{"statusCode":"1", "message":"添加成功"}'; 
		else
			echo '{"statusCode":"0", "message":"添加失败"}';
	}
	public function comment_add(){
		import("@.include.Comment" );
		$Comment=new Comment();		
		$fielddata=array();
		$fielddata['blog_id']=$_POST['blog_id'];
		$fielddata['userid']=$_SESSION['ZHIXUEWANG_USERID'];
		$fielddata['commenter']=$_SESSION['ZHIXUEWANG_USERNAME'];
		$fielddata['dt']=date("y-m-d h:i:s",time());
		
		$ret=$Comment->commentpro($fieldjson,1);
		if($ret>0)
			echo '{"statusCode":"1", "message":"添加成功"}'; 
		else
			echo '{"statusCode":"0", "message":"添加失败"}';
	}
}
?>
