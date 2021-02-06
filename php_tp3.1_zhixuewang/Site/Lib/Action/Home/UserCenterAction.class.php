<?php
class UserCenterAction extends CommonAction{
	public function checkLogin(){
			
		$username=$_POST['username'];
		$password=md5($_POST['password']);
	
		$returnflag=$this->login($username,$password);

		switch ($returnflag){
			case 1:
				echo '{"statusCode":"1", "message":"登录成功"}';
				break;
			case 0:
				echo '{"statusCode":"0", "message":"密码错误"}';
				break;
			case -1:
				echo '{"statusCode":"0", "message":"登录名非法！"}';
				break;
			case -2:
				echo '{"statusCode":"0", "message":"此用户已注销！"}';
				break;
		}		
	}		
	public function accountedit(){
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		$this->assign('pmodulelist',$pmodulelist);	
		
		//获取用户信息
		$userinfoarray=$this->getarray_userinfo($_SESSION['ZHIXUEWANG_USERID']);
		$this->assign('userinfoarray',$userinfoarray);
		$this->display();		
	}
	public function account_edit(){
			
				
	}
}
?>
