<?php
/**
 *
 *站点用户认证类
 *
 */
class SiteSecurityAction extends CommonAction {
	public function _initialize(){
		
	}
	
	/**
	 *
	 *密码认证
	 *
	 */
	public function checkLogin() {
		import("@.include.UserInfo" );
		$UserInfo=new UserInfo();
		
		$username=$_POST['username'];
		if($_SESSION['employee_user_verify'] != md5($_POST['verify'])) {
			echo '{"statusCode":"0", "message":"验证码错误！"}';
			//$this->syslogadd($username,'', "10","2","",'验证码错误');
			return;
		}
		session_unset();
		
		$password=md5($_POST['password']);
		$recordjson=$UserInfo->loginin($username, $password);
		$userinfo=json_decode($recordjson,true);
		if($userinfo==-1) {
			echo '{"statusCode":"0", "message":"登录名非法！"}';
			//$this->syslogadd($nickname,'', "10","2","",'登录名"'.$nickname.'"不存在');
			return;
		}
		elseif($userinfo==0) {			
			echo '{"statusCode":"0", "message":"密码错误"}';
			//$this->syslogadd($nickname,'', "10","2","",'密码错误');
			return;
		}
		elseif($userinfo==-2) {			
			echo '{"statusCode":"0", "message":"此用户已注销！"}';
			//$this->syslogadd($nickname,'', "10","2","",'此用户已注销！');
			return;
		}
		else{
			$_SESSION['LOGIN_IN_CJAGRI_SITE'] = "CJAGRI";			
			$_SESSION['LOGIN_IN_CJAGRI_SITE_USERNAME'] = $userinfo['username'];
			$_SESSION['LOGIN_IN_CJAGRI_SITE_USERID']=$userinfo['id'];
			$_SESSION['LOGIN_IN_CJAGRI_SITE_ROLE']=$userinfo['role'];
			echo '{"statusCode":"1", "message":"登录成功"}';
			//$this->syslogadd($nickname,'', "10","1","",'登录成功');
		}
	}

	/**
	 *
	 *用户退出
	 *
	 */
	public function logout() {
		$this->syslogadd($_SESSION['LOGIN_IN_CJAGRI_SITE_NICKNAME'],'', "11","1","",'退出系统成功');
		if (isset($_SESSION['LOGIN_IN_CJAGRI_SITE'])){
			unset($_SESSION['LOGIN_IN_CJAGRI_SITE']);
			unset($_SESSION);
			session_destroy();
			$this->redirect('Public/login');
		} else {
			$this->redirect('Public/login');
		}
	}
}
?>