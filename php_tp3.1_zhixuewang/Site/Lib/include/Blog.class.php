<?php
class Blog{
	/* 
	 * 模块列表
	 */
	public function getlist_blog($fieldjson,$firstRow,$listRows){
		$data=json_decode($fieldjson,true);
		$fieldstr="1=1";
		if(isset($data['id'])){
			$fieldstr=$fieldstr." and a.id='".$data['id']."'";
		}		
		if(isset($data['title'])){
			$fieldstr=$fieldstr." and a.title like '%".$data['title']."%'";
		}
		if(isset($data['author'])){
			$fieldstr=$fieldstr." and a.author like '%".$data['author']."%'";
		}
		if(isset($data['summary'])){
			$fieldstr=$fieldstr." and a.summary like '%".$data['summary']."%'";
		}
		if(isset($data['content'])){
			$fieldstr=$fieldstr." and a.content like '%".$data['content']."%'";
		}
		//搜索关键词
		if(isset($data['searchstr'])){
			$fieldstr=$fieldstr." and (a.title like '%".$data['searchstr']."%' or a.summary like '%".$data['searchstr']."%' or a.content like '%".$data['searchstr']."%')";
		}
		if(isset($data['userid'])){
			$fieldstr=$fieldstr." and a.userid='".$data['userid']."'";
		}
		if(isset($data['pmoduleid'])){
			$fieldstr=$fieldstr." and a.pmoduleid='".$data['pmoduleid']."'";
		}
		if(isset($data['classify'])){
			$fieldstr=$fieldstr." and a.classify='".$data['classify']."'";
		}
		
		if(isset($data['ctype'])){
			$fieldstr=$fieldstr." and a.ctype='".$data['ctype']."'";
		}
		if(isset($data['stage'])){
			$fieldstr=$fieldstr." and a.stage='".$data['stage']."'";
		}
		if(isset($data['tag'])){
			$fieldstr=$fieldstr." and (a.tag1='".$data['tag']."' or a.tag2='".$data['tag']."')";
		}
		if(isset($data['dateplace'])){
			$fieldstr=$fieldstr." and date_format(a.dt,'%Y年%m月')='".$data['dateplace']."'";
		}
		if(isset($data['state'])){
			$fieldstr=$fieldstr." and a.state='".$data['state']."'";
		}else{
			$fieldstr=$fieldstr." and a.state=1";
		}
		if(isset($data['orderflag'])){
			if($data['orderflag']=='time'){
				$orderstr=" order by a.dt";
			}
			if($data['orderflag']=='hot'){
				$orderstr=" order by d.browsenum";
			}			
		}
		$sqlstr="select
					a.*,d.browsenum,g.commentnum,j.favnum,k.picture,l.name as pmodulename,m.name as classifyname
				from
					blog a 					
					LEFT JOIN (select b.id,count(c.id) as browsenum from blog b LEFT JOIN browse c on b.id=c.blog_id GROUP BY b.id) as d on a.id=d.id
					LEFT JOIN (select e.id,count(f.id) as commentnum from blog e LEFT JOIN comment f on e.id=f.blog_id GROUP BY e.id) as g on a.id=g.id
					LEFT JOIN (select h.id,count(i.id) as favnum from blog h LEFT JOIN favorite i on h.id=i.blog_id GROUP BY h.id) as j on a.id=j.id
					left JOIN sys_user_info k on a.userid=k.userid
					left JOIN sys_module l on a.pmoduleid=l.id
					left JOIN classify m on a.classify=m.id 
				where ".$fieldstr." GROUP BY a.id".$orderstr;	
		if($listRows>0)
			$sqlstr.=" limit ".$firstRow.",".$listRows;
		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist);
    	
	}
	public function getlistcount_blog($fieldjson){
		$data=json_decode($fieldjson,true);
		$fieldstr="1=1";
		if(isset($data['id'])){
			$fieldstr=$fieldstr." and a.id='".$data['id']."'";
		}		
		if(isset($data['title'])){
			$fieldstr=$fieldstr." and a.title like '%".$data['title']."%'";
		}
		if(isset($data['author'])){
			$fieldstr=$fieldstr." and a.author like '%".$data['author']."%'";
		}
		if(isset($data['summary'])){
			$fieldstr=$fieldstr." and a.summary like '%".$data['summary']."%'";
		}
		if(isset($data['content'])){
			$fieldstr=$fieldstr." and a.content like '%".$data['content']."%'";
		}
		//搜索关键词
		if(isset($data['searchstr'])){
			$fieldstr=$fieldstr." and (a.title like '%".$data['searchstr']."%' or a.summary like '%".$data['searchstr']."%' or a.content like '%".$data['searchstr']."%')";
		}
		if(isset($data['userid'])){
			$fieldstr=$fieldstr." and a.userid='".$data['userid']."'";
		}
		if(isset($data['pmoduleid'])){
			$fieldstr=$fieldstr." and a.pmoduleid='".$data['pmoduleid']."'";
		}
		if(isset($data['classify'])){
			$fieldstr=$fieldstr." and a.classify='".$data['classify']."'";
		}
		
		if(isset($data['ctype'])){
			$fieldstr=$fieldstr." and a.ctype='".$data['ctype']."'";
		}
		if(isset($data['stage'])){
			$fieldstr=$fieldstr." and a.stage='".$data['stage']."'";
		}
		if(isset($data['tag'])){
			$fieldstr=$fieldstr." and (a.tag1='".$data['tag']."' or a.tag2='".$data['tag']."')";
		}
		if(isset($data['dateplace'])){
			$fieldstr=$fieldstr." and date_format(a.dt,'%Y年%m月')='".$data['dateplace']."'";
		}
		if(isset($data['state'])){
			$fieldstr=$fieldstr." and a.state='".$data['state']."'";
		}else{
			$fieldstr=$fieldstr." and a.state=1";
		}
		if(isset($data['orderflag'])){
			if($data['orderflag']=='time'){
				$orderstr=" order by a.dt";
			}
			if($data['orderflag']=='hot'){
				$orderstr=" order by d.browsenum";
			}			
		}
		$sqlstr="select count(l.id) as num from (select
					a.*,d.browsenum,g.commentnum,j.favnum,k.picture
				from
					blog a 					
					LEFT JOIN (select b.id,count(c.id) as browsenum from blog b LEFT JOIN browse c on b.id=c.blog_id GROUP BY b.id) as d on a.id=d.id
					LEFT JOIN (select e.id,count(f.id) as commentnum from blog e LEFT JOIN comment f on e.id=f.blog_id GROUP BY e.id) as g on a.id=g.id
					LEFT JOIN (select h.id,count(i.id) as favnum from blog h LEFT JOIN favorite i on h.id=i.blog_id GROUP BY h.id) as j on a.id=j.id
					left JOIN sys_user_info k on a.userid=k.userid 
				where ".$fieldstr." GROUP BY a.id".$orderstr.") as l";	
		$recordlist=M()->query($sqlstr);
    	return $recordlist[0]['num'];
    	
	}
	public function getlist_dateplace($fieldjson){
		$data=json_decode($fieldjson,true);
		$fieldstr="1=1";			
		if(isset($data['pmoduleid'])){
			$fieldstr=$fieldstr." and a.pmoduleid='".$data['pmoduleid']."'";
		}
		if(isset($data['ctype'])){
			$fieldstr=$fieldstr." and a.ctype='".$data['ctype']."'";
		}
		//搜索关键词
		if(isset($data['searchstr'])){
			$fieldstr=$fieldstr." and (a.title like '%".$data['searchstr']."%' or a.summary like '%".$data['searchstr']."%' or a.content like '%".$data['searchstr']."%')";
		}
		if(isset($data['userid'])){
			$fieldstr=$fieldstr." and a.userid='".$data['userid']."'";
		}
		$sqlstr = "SELECT date_format(a.dt,'%Y年%m月') as dateplace,count(a.id) as dateplace_blog_count FROM blog a WHERE a.state =1 and ".$fieldstr." GROUP BY dateplace;";  

		$recordlist=M()->query($sqlstr);
    	return json_encode($recordlist);
    	
	}
	/* 
	 * 模块编辑
	 * $jsonfield 所有参数以JSON结构传递
	 * $proflag 操作标识 1-添加 
	 * 返回：>0-成功 -1：失败
	 * */
	public function blogpro($fieldjson,$proflag){
		$data=json_decode($fieldjson,true);
		$tablename='blog';
		$fieldstr="";
		$returnflag='';
		if($proflag==1){//添加
			//添加模块
			$fielddata=Array();
			$fielddata=$data;
			$rd = M($tablename);
			$returnflag = $rd->add($fielddata);			
		}
		elseif ($proflag==2){//修改
			//date('YmdHis',time()).rand(1000,9999);
			$fielddata=Array();		
			$wherearray['id']=$data['id'];
			unset($data['id']);
			$fielddata=$data;
			$returnflag=M('blog')->where($wherearray)->save($fielddata);	
			
		}
		elseif ($proflag==3){//删除,更改状态，不是真正删除
			$fielddata=Array();	
			$fielddata['state'] = '-1';					
			$wherearray['id']=$data['id'];
			$returnflag=M('blog')->where($wherearray)->save($fielddata);	
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
