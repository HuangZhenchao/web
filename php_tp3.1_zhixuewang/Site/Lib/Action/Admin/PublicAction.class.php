<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action
{
	
	/*子站点选择
	 */
	public function siteselect(){
		import("@.include.SubSite");
	 	$subsite=new SubSite();
		$recordjson=$subsite->subsitegetlist($jsonfield, 0,0);//获取记录
		$subsitelist=json_decode($recordjson,true);
		
		$this->assign("subsitelist",$subsitelist);
		$this->display();
	}
	//验证码获取
	public function loginverify(){
		import('ORG.Util.Image');
	 	Image::buildImageVerify(4,1,"png","",22,"employee_user_verify");
	}
	//构造机构树状结构
	private function get_siteselect_tree($recorddata,$pid){
		$html="";
		$nodehtml='';
		$childhtml="";
		foreach($recorddata as $group){
			if($group["pid"]==$pid){
				$nodehtml.='<li id="'.$group["id"].'">';
				$nodehtml.='<a href="javascript:void(0)" onclick="sitepage(\''.$group["id"].'\')">'.$group['groupname'].'</a>';
				$nodehtml.='</li>';
				$childhtml=$this->get_siteselect_tree($recorddata, $group["id"]);
				if($childhtml!=""){
					$nodehtml.='<ul show="true">'.$childhtml.'</ul>';
				}
			}
		}
		$html.=$nodehtml;
		return $html;
	}
	
	//跳转错误界面
	public function error(){
		$this->display();
	}	
	
    // 检查用户是否登录    
    protected function checkUser()
    {
        /*if (!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->assign('jumpUrl', 'Public/login');
            $this->error('没有登录');
        }*/
    }
    
    // 顶部页面
    public function top()
    {
        C('SHOW_RUN_TIME', false); // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $model = M("Group");
        $list  = $model->where('status=1')->getField('id,title');
        $this->assign('nodeGroupList', $list);
        $this->display();
    }
    // 尾部页面
    public function footer()
    {
        C('SHOW_RUN_TIME', false); // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
    
    public function login(){
		$this->display();
	}	
    // 菜单页面
    public function menu()
    {
        $this->checkUser();
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu = array();
            if (isset($_SESSION['menu' . $_SESSION[C('USER_AUTH_KEY')]])) {
                //如果已经缓存，直接读取缓存
                $menu = $_SESSION['menu' . $_SESSION[C('USER_AUTH_KEY')]];
            } else {
                //读取数据库模块列表生成菜单项
                $node            = M("Node");
                $id              = $node->getField("id");
                $where['level']  = 2;
                $where['status'] = 1;
                $where['pid']    = $id;
                $list            = $node->where($where)->field('id,name,group_id,title')->order('sort asc')->select();
                $accessList      = $_SESSION['_ACCESS_LIST'];
                foreach ($list as $key => $module) {
                    if (isset($accessList[strtoupper(APP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {
                        //设置模块访问权限
                        $module['access'] = 1;
                        $menu[$key]       = $module;
                    }
                }
                //缓存菜单访问
                $_SESSION['menu' . $_SESSION[C('USER_AUTH_KEY')]] = $menu;
            }
            if (!empty($_GET['tag'])) {
                $this->assign('menuTag', $_GET['tag']);
            }
            //dump($menu);
            $this->assign('menu', $menu);
        }
        C('SHOW_RUN_TIME', false); // 运行时间显示
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
        
    // 后台首页 查看系统信息
    public function main()
    {
        $info = array(
            '操作系统' => PHP_OS,
            '运行环境' => $_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式' => php_sapi_name(),
            'ThinkPHP版本' => THINK_VERSION . ' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . '秒',
            '服务器时间' => date("Y年n月j日 H:i:s"),
            '北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600),
            '服务器域名/IP' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
            'register_globals' => get_cfg_var("register_globals") == "1" ? "ON" : "OFF",
            'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? 'YES' : 'NO',
            'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? 'YES' : 'NO'
        );
        $this->assign('info', $info);
        $this->display();
    }
        
    public function welcome()
    {
        //如果通过认证跳转到首页
//        redirect('Public/welcome');
			 $this->display();
    }
    
    public function index()
    {
        //如果通过认证跳转到首页
        redirect(__APP__/Admin);
    }
    
    // 用户登出
    public function logout()
    {
        if (isset($_SESSION['employee_userid'])) {
            unset($_SESSION['employee_userid']);
            unset($_SESSION);
            session_destroy();
            $this->redirect('__APP__/Admin/Public/siteselect');
            //$this->success('登出成功！');
        } else {
            $this->error('已经登出！');
        }
    }
    
    // 更换密码
    public function changePwd()
    {
        $this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
        if (md5($_POST['verify']) != $_SESSION['verify']) {
            $this->error('验证码错误！');
        }
        $map             = array();
        $map['password'] = pwdHash($_POST['oldpassword']);
        if (isset($_POST['account'])) {
            $map['account'] = $_POST['account'];
        } elseif (isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id'] = $_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User = M("User");
        if (!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        } else {
            $User->password = pwdHash($_POST['password']);
            $User->save();
            $this->success('密码修改成功！');
        }
    }
    public function profile()
    {
        $this->checkUser();
        $User = M("User");
        $vo   = $User->getById($_SESSION[C('USER_AUTH_KEY')]);
        $this->assign('vo', $vo);
        $this->display();
    }
    public function verify()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : 'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4, 1, $type);
    }
    // 修改资料
    public function change()
    {
        $this->checkUser();
        $User = D("User");
        if (!$User->create()) {
            $this->error($User->getError());
        }
        $result = $User->save();
        if (false !== $result) {
            $this->success('资料修改成功！');
        } else {
            $this->error('资料修改失败!');
        }
    }
    
    //修改密码初始化
    public function password(){
    	import("@.include.UserEmployee");
    	$useremployee=new UserEmployee();
    	
    	$data["id"]=$_REQUEST["id"];
    	$jsonfield=json_encode($data);
    	$datalist=$useremployee->useremployeegetlist($jsonfield, 0, 0);
    	$returndata=json_decode($datalist,true);
    	$this->info=$returndata[0];
    	$this->display();
    }
    
    //修改密码
    public function changepsd(){
    	import("@.include.UserEmployee");
    	$useremployee=new UserEmployee();
    	if($_POST["psd"]== md5($_POST["oldpassword"])){
    	$data["id"]=$_REQUEST["userid"];
	 	$data["password"]=md5($_POST["password"]);
	 	$jsonfield=json_encode($data);
	 	$returnflag=$useremployee->user_edit($jsonfield);
	 	if($returnflag==1){
	    		echo '{"statusCode":"1", "message":"密码修改成功"}';
	    	}
	    	else{
	    		echo '{"statusCode":"0", "message":"密码修改失败"}';
	    	}
    	}
    	else{
    		echo '{"statusCode":"0", "message":"旧密码错误！"}';
    	}
    }
    
}
?>