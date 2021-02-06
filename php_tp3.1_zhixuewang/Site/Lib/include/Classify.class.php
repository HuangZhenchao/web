<?php
class Classify{
	/* 
	 * 模块列表
	 */
	public function getlist_classify($fieldjson){
		$data=json_decode($fieldjson);
		$fieldstr="1=1";	
		if(isset($data->id)){
				$tmpstr=$data->id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.id='".$tmpstr."'";
		}		
		if(isset($data->name)){
				$tmpstr=$data->name;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.name like '%".$tmpstr."%'";
		}
		if(isset($data->pmoduleid)){
				$tmpstr=$data->pmoduleid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.pmoduleid='".$tmpstr."'";
		}
		//搜索关键词
		if(isset($data->searchstr)){
			$tmpstr=$data->searchstr;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
			$fieldstr=$fieldstr." and  a.name like '%".$tmpstr."%'";
		}
		if(isset($data->ctype)){
				$tmpstr=$data->ctype;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and b.ctype='".$tmpstr."'";
		}
		else{
				$fieldstr=$fieldstr." and (b.ctype=1 or b.ctype=2) "; 
			}
		if(isset($data->userid)){			
				$tmpstr=$data->userid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and b.userid='".$tmpstr."'";
			
		}
		$sqlstr="select a.*,count(b.id) as classify_blog_count from classify a left join blog b on a.id=b.classify where ".$fieldstr." GROUP BY a.id order by a.pmoduleid,a.id";				
		if(isset($data->limitnum)){
				$tmpstr=$data->limitnum;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$sqlstr=$sqlstr." limit 0,".$tmpstr;
		}	

		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist); 	
	}

	/* 
	 * 模块编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 
	 * 返回：>0-成功 -1：失败
	 * */
	public function classifypro($fieldjson,$proflag){
		$data=json_decode($fieldjson);
		$tablename='classify';
		$fieldstr="";
		$returnflag='';
		if($proflag==1){//添加
			//添加模块
			$fielddata=Array();
			$fielddata['name'] = $data->name;			
			$fielddata['orderflag'] = $data->orderflag;
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
