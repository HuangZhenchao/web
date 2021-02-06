<?php
//基础类
class CommonAction extends Action { 
	public function _initialize(){
		//判断 是否登录，跳转页面
		if (!isset($_SESSION['LOGIN_IN_CJAGRI_SITE'])) {
			$this->redirect('Public/login');
			return;
		}		
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