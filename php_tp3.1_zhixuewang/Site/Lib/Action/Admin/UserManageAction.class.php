<?php
class UserManageAction extends CommonAction{
	public function index(){
		import("@.include.UserInfo" );
		$UserInfo=new UserInfo();
		$data=array();
		if(isset($_POST['username']))
			$data['username']=$_POST['username'];
		if(isset($_POST['name']))
			$data['name']=$_POST['name'];
		if(isset($_POST['sex']))
			$data['sex']=$_POST['sex'];
		if(isset($_POST['fromdate']))
			$data['fromdate']=$_POST['fromdate'];
		if(isset($_POST['todate']))
			$data['todate']=$_POST['todate'];			
		$fieldjson=json_encode($data);
		$returnjson=$UserInfo->userinfogetlist($fieldjson);
		$returnlist=json_decode($returnjson,true);
		$this->assign('userlist',$returnlist);
		$this->display();
	}
	public function useradd(){
		$this->display();
	}
	public function useredit(){
		$this->display();	
	}
	public function password(){
		$this->display();
	}
	public function user_add(){		
		import("@.include.UserInfo" );
		$UserInfo=new UserInfo();
		$datafield['username']=$_POST['username'];	
		$fieldjson=json_encode($datafield);
		$ret=$UserInfo->isexistsuserbase($fieldjson,1);
		if($ret){
			echo '{"statusCode":"0", "message":"用户名已存在"}';
		}else{
			$data=array();
			$data=$_POST;	
			//$data['cooper']=$_REQUEST['cooper'];	
			$data['dt']=date('y-m-d h:i:s',time());	
			$data['password']=md5($_POST['password']);
			$fieldjson=json_encode($data);
			$ret=$UserInfo->userinfopro($fieldjson,1);
			if($ret>0){
				echo '{"statusCode":"1", "message":"操作成功"}';
			}else{
				echo '{"statusCode":"0", "message":"操作失败"}';
			}
		}
	}
	public function user_edit(){
		if($ret){
			echo '{"statusCode":"1", "message":"操作成功"}';
		}else{
			echo '{"statusCode":"0", "message":"操作失败"}';
		}
	}
	public function changepassword(){
		if($ret){
			echo '{"statusCode":"1", "message":"操作成功"}';
		}else{
			echo '{"statusCode":"0", "message":"操作失败"}';
		}
	}
}
?>
