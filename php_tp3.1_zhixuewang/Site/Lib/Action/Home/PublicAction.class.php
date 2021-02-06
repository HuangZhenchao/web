<?php
class PublicAction extends CommonAction{
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
}
?>
