<?php
class Flag{
	/* 
	 * 模块列表
	 */
	public function modelgetlist($jsonfield){
		$data=json_decode($jsonfield,true);
		$fieldstr="1=1";
		if(isset($data['GUID'])){
			$fieldstr=$fieldstr." and a.GUID='".$data['GUID']."'";
		}		

		$sqlstr="select a.*,b.name as pname from sys_model a left join sys_model b on b.GUID=a.pid where a.state=1 and ".$fieldstr." order by a.orderflag;";				
		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist);
    	
	}

	/* 
	 * 模块编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 
	 * 返回：>0-成功 -1：失败
	 * */
	public function modelpro($jsonfield,$proflag){
		$data=json_decode($jsonfield);
		$tablename='t_model';
		$fieldstr="";
		$returnflag='';
		if($proflag==1){//添加
			//添加模块
			$fielddata=Array();
			$fielddata['GUID'] = $data->GUID;
			$fielddata['name'] = $data->name;
			$fielddata['pid'] = $data->pid;
			$fielddata['state'] = $data->state;
			$fielddata['ctype'] = $data->ctype;
			$fielddata['ds'] = $data->ds;
			$fielddata['mtype'] = $data->mtype;
			$fielddata['orderflag'] = $data->orderflag;
			$rd = M($tablename);
			$returnflag = $rd->add($fielddata);
			//为模块添加页面
			$modelpage=array('7004e608-3194-4395-8564-ffd8eb18','4978ac07-0c1b-41a9-b6d3-29af829a','51098dd7-b56a-43f9-bd8e-03cf76b0','eb6af88f-76ec-47d5-badd-c76c2cd6');
			$index='';
			if($data->ctype>0 & isset($data->pid)){
				for ($index=0;$index<count($modelpage);$index++){
					$field['GUID']=$data->GUID;
					$field['code']=$modelpage[$index];
					$returnflag = M('t_model_page')->add($field);
				}				
			}
		}
		elseif ($proflag==2){//修改
			//date('YmdHis',time()).rand(1000,9999);
			$fielddata=Array();
				
			if(isset($data->name)){
				$tmpstr=$data->name;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['name'] = $tmpstr;
			}
			if(isset($data->pid)){
				$tmpstr=$data->pid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['pid'] = $tmpstr;
			}
			if(isset($data->ctype)){
				$tmpstr=$data->ctype;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['ctype'] = $tmpstr;
			}
			if(isset($data->orderflag)){
				$tmpstr=$data->orderflag;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['orderflag'] = $tmpstr;
			}
			$tmpstr=$data->GUID;
			$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
			$wherearray['GUID']=array('EQ',$tmpstr);
			$returnflag=M('t_model')->where($wherearray)->save($fielddata);	
			
			if($data->ctype=='0'){
				$delreturn=M('t_model_page')->where($wherearray)->delete();
			}
			if($data->ctype>0){
				$delreturn=M('t_model_page')->where($wherearray)->delete();
				//为模块添加页面
				$modelpage=array('7004e608-3194-4395-8564-ffd8eb18','4978ac07-0c1b-41a9-b6d3-29af829a','51098dd7-b56a-43f9-bd8e-03cf76b0','eb6af88f-76ec-47d5-badd-c76c2cd6');
				$index='';
				if(isset($data->pid)){
					for ($index=0;$index<count($modelpage);$index++){
						$field['GUID']=$data->GUID;
						$field['code']=$modelpage[$index];
						$delreturnflag = M('t_model_page')->add($field);
					}				
				}
			}
		}
		elseif ($proflag==3){//删除,更改状态，不是真正删除
			$fielddata=Array();	
			$fielddata['state'] = '-1';			
			$tmpstr=$data->GUID;
			$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
			$wherearray['GUID']=array('EQ',$tmpstr);
			$returnflag=M('t_model')->where($wherearray)->save($fielddata);	
		}
		if($returnflag==false){
			return -1;
		}
		else{
			return $returnflag;
		}
	}
}
?>
