<?php
class Comment{
	/* 
	 * 模块列表
	 */
	public function getlist_comment($fieldjson,$firstRow,$listRows){
		$data=json_decode($fieldjson);
		$fieldstr="1=1";	
		if(isset($data->id)){
				$tmpstr=$data->id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.id='".$tmpstr."'";
		}		
		if(isset($data->blog_id)){
				$tmpstr=$data->blog_id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.blog_id='".$tmpstr."'";
		}
		if(isset($data->pid)){
				$tmpstr=$data->pid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.pid='".$tmpstr."'";
		}
		if(isset($data->userid)){
				$tmpstr=$data->userid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.userid='".$tmpstr."'";
		}
		if(isset($data->state)){
				$tmpstr=$data->state;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.state='".$tmpstr."'";
		}else{
			$fieldstr=$fieldstr." and a.state=1";
		}
		$sqlstr="select a.* from comment a where ".$fieldstr;	
		if($listRows>0)			
			$sqlstr.=" limit ".$firstRow.",".$listRows;	
		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist); 	
	}
public function getlistcount_comment($fieldjson){
		$data=json_decode($fieldjson);
		$fieldstr="1=1";	
		if(isset($data->id)){
				$tmpstr=$data->id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.id='".$tmpstr."'";
		}		
		if(isset($data->blog_id)){
				$tmpstr=$data->blog_id;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.blog_id='".$tmpstr."'";
		}
		if(isset($data->pid)){
				$tmpstr=$data->pid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.pid='".$tmpstr."'";
		}
		if(isset($data->userid)){
				$tmpstr=$data->userid;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.userid='".$tmpstr."'";
		}
		if(isset($data->state)){
				$tmpstr=$data->state;
				$tmpstr=(!get_magic_quotes_gpc())?addslashes($tmpstr):$tmpstr;				
				$fieldstr=$fieldstr." and a.state='".$tmpstr."'";
		}else{
			$fieldstr=$fieldstr." and a.state=1";
		}
		$sqlstr="select count(a.id) as num from comment a where ".$fieldstr;
	
		$recordlist=M()->query($sqlstr);
    	return $recordlist[0]['num']; 	
	}
	/* 
	 * 模块编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 
	 * 返回：>0-成功 -1：失败
	 * */
	public function commentpro($fieldjson,$proflag){
		$data=json_decode($fieldjson);
		$tablename='comment';
		$fieldstr="";
		$returnflag='';
		if($proflag==1){//添加
			//添加模块
			$fielddata=Array();
			$fielddata= json_decode($fieldjson,true);					
			$returnflag = M("comment")->add($fielddata);		
				
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
