<?php
class IndexAction extends CommonAction{
	public function index(){					
		import("@.include.Module");
		$Module=New Module();
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		//父模块ID
		$pmoduleid=$pmodulelist[0]['id'];
		//若参数中没传递子模块ID则从数据库中获取			
		if(!isset($_REQUEST['moduleid'])){				
			$recordjson=$Module->getlist_relemodule($pmoduleid);			
			$modulearray=json_decode($recordjson,true);
			$moduleid=$modulearray[0]['id'];
			$recordjson=$Module->getlist_module($pmoduleid);			
			$modulelist=json_decode($recordjson,true);			
		}
		$ctype=1;
		if($_REQUEST['ctype']){
			$ctype=$_REQUEST['ctype'];			
		}
		$this->assign('ctype',$ctype);
		
		//首页获取博文列表
		$bloglist=$this->getlist_blog('',$ctype);	
		$this->assign('bloglist',$bloglist);
		//首页获取分类列表
		$classifylist=$this->getlist_classify('','');
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag('','');		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace('','');		
		$this->assign('datelist',$datelist);
			
		
		
		$this->assign('pmodulelist',$pmodulelist);
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
