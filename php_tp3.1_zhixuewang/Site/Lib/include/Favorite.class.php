<?php
class Favorite{
	/* 
	 * 模块列表
	 */
	public function isexisted($fieldjson){
		$data=json_decode($fieldjson);
		$fieldstr="1=1";	
		if(isset($data->blog_id)){
				$tmpstr=$data->id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.blog_id='".$tmpstr."'";
		}		
		if(isset($data->userid)){
				$tmpstr=$data->userid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.userid='".$tmpstr."'";
		}
		
		$sqlstr="select count(b.id) as num from favorite a where ".$fieldstr;								
		$recordlist=M()->query($sqlstr);
		if($recordlist[0]['num']>0)
			return $recordlist[0]['num'];
    	else 
    		return -1;	
	}

	/* 
	 * 模块编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 
	 * 返回：>0-成功 -1：失败
	 * */
	public function favpro($fieldjson,$proflag){
		$data=json_decode($fieldjson);
		$tablename='favorite';
		$fieldstr="";
		$returnflag='';
		if($proflag==1){//添加
			//添加模块
			$fielddata=Array();
			$fielddata = $data;						
			$rd = M($tablename);
			$returnflag = $rd->add($fielddata);			
		}
		elseif ($proflag==2){//修改
			//date('YmdHis',time()).rand(1000,9999);
			$fielddata=Array();
				
			if(isset($data->name)){
				$tmpstr=$data->name;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['name'] = $tmpstr;
			}
			if(isset($data->orderflag)){
				$tmpstr=$data->orderflag;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
				$fielddata['orderflag'] = $tmpstr;
			}
			$tmpstr=$data->id;
			$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
			$wherearray['id']=array('EQ',$tmpstr);
			$returnflag=M('classify')->where($wherearray)->save($fielddata);	
		}
		elseif ($proflag==3){//删除,更改状态，不是真正删除
			$fielddata=Array();			
			$tmpstr=$data->id;
			$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;
			$wherearray['id']=array('EQ',$tmpstr);
			$returnflag=M('classify')->where($wherearray)->delete();	
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
