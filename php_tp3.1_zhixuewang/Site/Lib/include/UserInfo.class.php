<?php
/**
*账户数据类
*/
class UserInfo {
	/*获取用户基础信息列表*/
	public function userbasegetlist($jsonfield){
		$data=json_decode($jsonfield);
		$fieldstr="1=1";
		if(isset($data->id)){
			$fieldstr=$fieldstr." and a.id=".$data->id;
		}
		if(isset($data->nickname)){
			$fieldstr=$fieldstr." and a.nickname like '%".$data->nickname."%'";
		}
		if(isset($data->username)){
			$fieldstr=$fieldstr." and a.username like '%".$data->username."%'";
		}
		if(isset($data->idcard)){
			$fieldstr=$fieldstr." and a.idcard = '".$data->idcard."'";
		}
		if(isset($data->state)){
			$fieldstr=$fieldstr." and a.state=".$data->state;
		}
		else{
			$fieldstr=$fieldstr." and a.state<>-1";
		}
		$sqlstr="select a.id,a.nickname,a.username,a.role,a.idcard,a.state,a.detail,a.email,a.tel from t_users_base a where ".$fieldstr." order by a.state desc,a.id";
		
		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist);
	}
	
	/*用户基础信息编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 2-修改 3-删除 
	 * 返回：1-成功 -1：失败
	 * */
	public function userbasepro($fieldjson,$proflag){
		$data=json_decode($fieldjson);
		$tablename='sys_user_base';
		$fieldstr="";
		$returnflag;
		if($proflag==1){//添加
			$fielddata=Array();
			$fielddata['username'] = $data->username;
			$fielddata['role'] = $data->role;
			$fielddata['password'] = $data->password;
			$fielddata['state'] = '1';
			$fielddata['email'] = $data->email;
			$fielddata['tel'] = $data->tel;
			$fielddata['dt'] = $data->dt;
			$rd = M($tablename);
			$returnflag = $rd->add($fielddata);
		}
		elseif ($proflag==2){//修改
			$fielddata=Array();
			if(isset($data->nickname)){
				$fielddata['nickname'] = $data->nickname;
			}
			if(isset($data->username)){
				$fielddata['username'] = $data->username;
			}
			if(isset($data->password)){
				$fielddata['password'] = $data->password;
			}
			if(isset($data->role)){
				$fielddata['role'] = $data->role;
			}
			if(isset($data->state)){
				$fielddata['state'] = $data->state;
			}
			if(isset($data->idcard)){
				$fielddata['idcard'] = $data->idcard;
			}
			if(isset($data->detail)){
				$fielddata['detail'] = $data->detail;
			}
			if(isset($data->email)){
				$fielddata['email'] = $data->email;
			}
			if(isset($data->tel)){
				$fielddata['tel'] = $data->tel;
			}
			$wherearray['id']=array('EQ',$data->id);
			$rd = M($tablename);
			$returnflag=$rd->where($wherearray)->save($fielddata);
		}
		elseif ($proflag==3){//删除
			$sqlstr='update '.$tablename.' set state=-1 where id="'.$data->id.'"';
			$returnflag=M()->execute($sqlstr);
		}
		if($returnflag==false){
			return -1;
		}
		else{
			return 1;
		}
	}
	
	/*用户密码修改
	 * $userid 账户ID
	 * $oldpsd 旧密码
	 * $newpsd 新密码
	 * 返回：0-旧密码错误 -1修改失败  1修改成功 -2没有该账户
	 * */
	public function changepsd($userid,$oldpsd,$newpsd){
		$sqlstr='select a.id,a.password from t_users_base a where a.id='.$userid;
		$recordlist=M()->query($sqlstr);
		if(sizeof($recordlist)>0){//判断是否有对应账户 
			if($recordlist[0]["password"]==$oldpsd){//判断是否旧密码正确
				$sqlstr='update t_users_base set password="'.$newpsd.'" where id='.$userid;
				$returnflag=M()->execute($sqlstr);
				if($returnflag==false){//修改密码失败
					return -1;
				}
				else{
					return 1;
				}
			}
			else{
				return 0;
			}
		}
		else{
			return -2;
		}
	}
	
	/*获取用户资料列表
	 * $jsonfield 查询参数 以数据字典为准
	 * $sindex 查询起始坐标
	 * $pagesize 返回数量
	 * 
	 * 返回json结构数组
	 * */
	public function userinfogetlist($jsonfield,$sindex,$pagesize){
		$data=json_decode($jsonfield);
		$fieldstr="1=1";
		if(isset($data->id)){
			$fieldstr=$fieldstr." and a.id=".$data->id;
		}
		if(isset($data->userid)){
			$fieldstr=$fieldstr." and a.userid=".$data->userid;
		}
		if(isset($data->nickname)){
			$fieldstr=$fieldstr." and b.nickname like '%".$data->nickname."%'";
		}
		if(isset($data->username)){
			$fieldstr=$fieldstr." and b.username like '%".$data->username."%'";
		}
		if(isset($data->idcard)){
			$fieldstr=$fieldstr." and b.idcard='".$data->idcard."'";
		}
		if(isset($data->state)){
			$fieldstr=$fieldstr." and b.state=".$data->state;
		}
		else{
			$fieldstr=$fieldstr." and b.state<>-1";
		}
		if(isset($data->sex)){
			$fieldstr=$fieldstr." and a.sex='".$data->sex."'";
		}
		if(isset($data->tel)){
			$fieldstr=$fieldstr." and b.tel like '%".$data->tel."%'";
		}
		if(isset($data->qq)){
			$fieldstr=$fieldstr." and a.qq like '%".$data->qq."%'";
		}
		if(isset($data->email)){
			$fieldstr=$fieldstr." and b.email like '%".$data->email."%'";
		}
		if(isset($data->vocational)){
			$fieldstr=$fieldstr." and a.vocational like '%".$data->vocational."%'";
		}
		if(isset($data->nation)){
			$fieldstr=$fieldstr." and a.nation like '%".$data->nation."%'";
		}
		//$sqlstr="select a.id,a.userid,a.sex,a.marry,a.birthday,b.tel,b.email,a.qq,a.vocational,a.nation,a.address,a.picture,b.nickname,b.username,b.role,b.state,b.idcard from sys_user_info a, sys_user_base b where a.userid=b.id and ".$fieldstr." order by b.state desc,b.id";
    	$sqlstr="select a.*,b.* from sys_user_info a, sys_user_base b where a.userid=b.id and ".$fieldstr." order by b.state desc,b.id";   	
		if($pagesize>0){
    		$sqlstr=$sqlstr.' limit '.$sindex.','.$pagesize;
    	}

    	
		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist);
	}
	
	/*获取用户资料 数量
	 * $jsonfield 查询参数 以数据字典为准
	 * $sindex 查询起始坐标
	 * $pagesize 返回数量
	 * */
	public function userinfogetlistcount($jsonfield){
		$data=json_decode($jsonfield);
		$fieldstr="1=1";
		if(isset($data->id)){
			$fieldstr=$fieldstr." and a.id=".$data->id;
		}
		if(isset($data->userid)){
			$fieldstr=$fieldstr." and a.userid=".$data->userid;
		}
		if(isset($data->nickname)){
			$fieldstr=$fieldstr." and b.nickname like '%".$data->nickname."%'";
		}
		if(isset($data->username)){
			$fieldstr=$fieldstr." and b.username like '%".$data->username."%'";
		}
		if(isset($data->idcard)){
			$fieldstr=$fieldstr." and b.idcard='".$data->idcard."'";
		}
		if(isset($data->state)){
			$fieldstr=$fieldstr." and b.state=".$data->state;
		}
		else{
			$fieldstr=$fieldstr." and b.state<>-1";
		}
		if(isset($data->sex)){
			$fieldstr=$fieldstr." and a.sex='".$data->sex."'";
		}
		if(isset($data->tel)){
			$fieldstr=$fieldstr." and b.tel like '%".$data->tel."%'";
		}
		if(isset($data->qq)){
			$fieldstr=$fieldstr." and a.qq like '%".$data->qq."%'";
		}
		if(isset($data->email)){
			$fieldstr=$fieldstr." and b.email like '%".$data->email."%'";
		}
		if(isset($data->vocational)){
			$fieldstr=$fieldstr." and a.vocational like '%".$data->vocational."%'";
		}
		if(isset($data->nation)){
			$fieldstr=$fieldstr." and a.nation like '%".$data->nation."%'";
		}
		$sqlstr="select count(*) as recordnum from t_userinfo a, t_users_base b where a.userid=b.id and ".$fieldstr." order by a.id";
		$recordlist=M()->query($sqlstr);
    	return $recordlist[0]["recordnum"];
	}
	
	/*用户资料编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 2-修改 3-删除 
	 * 返回：1-成功 -1：失败
	 * */
	public function userinfopro($fieldjson,$proflag){
		$data=json_decode($fieldjson);
		$tablename='sys_user_info';
		$fieldstr="";
		$returnflag;
		if($proflag==1){//添加
			//添加基础 信息
			$userid=$this->userbasepro($fieldjson, 1);	
			//添加账户资料信息		
			$fielddata=Array();
			$fielddata['userid'] = $userid;
			$fielddata['username'] = $data->username;
			$fielddata['name'] = $data->name;
			$fielddata['sex'] = $data->sex;
			$fielddata['birthday'] = $data->birthday;
			$fielddata['weichat'] = $data->weichat;
			$fielddata['qq'] = $data->qq;
			$fielddata['email'] = $data->email;
			$fielddata['vocational'] = $data->vocational;
			$fielddata['address'] = $data->address;
			$fielddata['picture'] = $data->picture;
			$fielddata['detail'] = $data->detail;
			$rd = M($tablename);
			$returnflag = $rd->add($fielddata);
		}
		elseif ($proflag==2){//修改
			//更新基础表
			$fielddata=$data;
			$fielddata->id= $data->userid;
			$fieldjson=json_encode($fielddata);
			$returnflag=$this->userbasepro($fieldjson, 2);
			//更新资料表
			$fielddata=Array();
			if(isset($data->username)){
				$fielddata['username'] = $data->username;
			}
			if(isset($data->sex)){
				$fielddata['sex'] = $data->sex;
			}
			if(isset($data->marry)){
				$fielddata['marry'] = $data->marry;
			}			
			if(isset($data->birthday)){
				$fielddata['birthday'] = $data->birthday;
			}
			if(isset($data->qq)){
				$fielddata['qq'] = $data->qq;
			}
			if(isset($data->vocational)){
				$fielddata['vocational'] = $data->vocational;
			}
			if(isset($data->nation)){
				$fielddata['nation'] = $data->nation;
			}
			if(isset($data->address)){
				$fielddata['address'] = $data->address;
			}
			if(isset($data->picture)){
				$fielddata['picture'] = $data->picture;
			}
			$wherearray['userid']=array('EQ',$data->userid);
			$rd = M($tablename);
			$returnflag=$rd->where($wherearray)->save($fielddata) || $returnflag;
		}
		elseif ($proflag==3){//删除
			//$sqlstr='delete from '.$tablename.' where userid="'.$data->userid.'"';
			//$returnflag=M()->execute($sqlstr);
		}
		if($returnflag==false){
			return -1;
		}
		else{
			return $returnflag;
		}
	}
	
	/*用户登录判断
	 * $nickname 登录
	 * $password 密码
	 * 返回 ：成功-以JSON对象返回空或ID、登录名、用户名、角色
	 * 失败：-1 没在账户  0 密码错误  -2账户被注销
	 * */
	public function loginin($username,$password){
		$userbase = M("sys_user_base"); // 实例化User对象
		$fieldstr="a.username='".$username."' or a.tel='".$username."' or a.email='".$username."'";
		$sqlstr="select a.* from sys_user_base a where ".$fieldstr." order by a.id";
		$recordlist=M()->query($sqlstr);
		if(sizeof($recordlist)==0){
			return -1;
		}
		else{
			if($recordlist[0]["password"]==$password){//判断是否密码正确
				if($recordlist[0]["state"]=="0"){
					return -2;
				}
				else{
					return json_encode($recordlist[0]);
				}
			}
			else{
				return 0;
			}
		}
	}
	
	/*用户信息是否重复
	 * $jsonfield 参数以数据为准
	 * 存在 返回用户信息
	 * 不存在 返回 0
	 * */
	public function isexistsuserbase($jsonfield){
		$data=json_decode($jsonfield);
		$fieldstr="1=1";
		if(isset($data->username)){
			$fieldstr=$fieldstr." and a.username='".$data->username."'";
		}
		if(isset($data->tel)){
			$fieldstr=$fieldstr." and a.tel='".$data->tel."'";
		}
		if(isset($data->email)){
			$fieldstr=$fieldstr." and a.email='".$data->email."'";
		}
		$sqlstr="select a.id,a.username,a.role,a.state,a.email,a.tel from sys_user_base a where ".$fieldstr." order by a.id";
    	
		$recordlist=M()->query($sqlstr);
		if(sizeof($recordlist)>0){
    		return json_encode($recordlist[0]);
		}
		else{
			return null;
		}
	}
}
?>