<?php
class ContentPageAction extends CommonAction{
	public function getlist_pmoduleid_classify(){
		$pmoduleid=$_POST['pmoduleid'];		
		$result=$this->getlist_classify($pmoduleid,'');
		$this->ajaxReturn(array('code'=>200,'result'=>$result));		
	}
	public function add(){		
		import("@.include.Blog" );
		$Blog=new Blog();		
		$fielddata=$_POST;
		$fielddata['userid']=$_SESSION['ZHIXUEWANG_USERID'];
		$fielddata['author']=$_SESSION['ZHIXUEWANG_USERNAME'];
		$fielddata['ip']='127.0.0.1';
		$fielddata['state']=1;
		$fielddata['ctype']=1;
		$fielddata['dt']=date("y-m-d h:i:s",time());
		$fielddata['lastdt']=date("y-m-d h:i:s",time());
		$fieldjson=json_encode($fielddata);
		$ret=$Blog->blogpro($fieldjson,1);
	
		if($ret){
			echo '{"statusCode":"1", "message":"发布成功"}';
		}else{
			echo '{"statusCode":"0", "message":"发布失败"}';
		}
				
	}
	public function edit(){		
		import("@.include.Blog" );
		$Blog=new Blog();
		$fielddata=$_POST;
		$fielddata['ip']='127.0.0.1';
		$fielddata['ctype']=1;
		$fielddata['lastdt']=date("y-m-d h:i:s",time());
		$fieldjson=json_encode($fielddata);
		$ret=$Blog->blogpro($fieldjson,2);
	
		if($ret){
			echo '{"statusCode":"1", "message":"发布成功"}';
		}else{
			echo '{"statusCode":"0", "message":"发布失败"}';
		}
				
	}
public function blog_delete(){		
		import("@.include.Blog" );
		$Blog=new Blog();
		$fielddata['id']=$_POST['id'];		
		$fieldjson=json_encode($fielddata);
		$ret=$Blog->blogpro($fieldjson,3);
	
		if($ret){
			echo '{"statusCode":"1", "message":"删除成功"}';
		}else{
			echo '{"statusCode":"0", "message":"删除失败"}';
		}
				
	}
	public function comment_add(){
		
		import("@.include.Comment" );
		$Comment=new Comment();		
		$fielddata=array();
		$fielddata['blog_id']=$_POST['blog_id'];
		$fielddata['pid']=$_POST['pid'];
		$fielddata['userid']=$_SESSION['ZHIXUEWANG_USERID'];
		$fielddata['commenter']=$_SESSION['ZHIXUEWANG_USERNAME'];
		$fielddata['ip']='127.0.0.1';
		$fielddata['content']=$_POST['content'];
		$fielddata['state']=1;
		$fielddata['dt']=date("y-m-d h:i:s",time());
		$fieldjson=json_encode($fielddata);
		$ret=$Comment->commentpro($fieldjson,1);

		if($ret){
			echo '{"statusCode":"1", "message":"发布成功"}';
		}else{
			echo '{"statusCode":"0", "message":"发布失败"}';
		}
				
	}
}
?>
