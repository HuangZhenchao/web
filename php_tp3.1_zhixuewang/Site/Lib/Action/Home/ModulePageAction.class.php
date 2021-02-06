<?php
class ModulePageAction extends CommonAction{
	public function modulepage(){
		import("@.include.Module");
		$Module=New Module();
		//
		$recordjson=$Module->getlist_pmodule();
		$pmodulelist=json_decode($recordjson,true);
		//父模块ID
		$pmoduleid=$_REQUEST['pmoduleid'];
		//
		$recordjson=$Module->getlist_module($pmoduleid);			
		$modulelist=json_decode($recordjson,true);
		//若参数中没传递子模块ID则从数据库中获取			
		if(!isset($_REQUEST['moduleid'])){				
			$recordjson=$Module->getlist_relemodule($pmoduleid);			
			$modulearray=json_decode($recordjson,true);
			$moduleid=$modulearray[0]['id'];	
			$filename=$modulearray[0]['filename'];				
		}else{
			$moduleid=$_REQUEST['moduleid'];
			$filename=$Module->getfilename($moduleid);			
		}
		//已获取页面模板名$filename

		$this->assign('pmodulelist',$pmodulelist);
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);

		if($filename=='index'){
			
			
			$this->display_index($pmodulelist,$modulelist,$pmoduleid,$moduleid);
			
		}	
		if($filename=='module_index1'){
			$this->display_module_index1($pmodulelist,$modulelist,$pmoduleid,$moduleid);					
			
		}
		if($filename=='module_index2'){
			$this->display_module_index2($pmodulelist,$modulelist,$pmoduleid,$moduleid);					
			
		}
		if($filename=='list_bookshelf'){
			$this->display_list_bookshelf($pmodulelist,$modulelist,$pmoduleid,$moduleid);					
			
		}	
		if($filename=='list_blog'){
			$this->display_list_blog($pmodulelist,$modulelist,$pmoduleid,$moduleid);					
			
		}
		if($filename=='list_topic'){
			$this->display_list_topic($pmodulelist,$modulelist,$pmoduleid,$moduleid);					
			
		}
	}
	public function display_index($pmodulelist,$modulelist,$pmoduleid,$moduleid){	
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
					
		$this->display('Index/index');
	}
	public function display_module_index1($pmodulelist,$modulelist,$pmoduleid,$moduleid){		
		$ctype=1;
		if($_REQUEST['ctype']){
			$ctype=$_REQUEST['ctype'];			
		}
		$this->assign('ctype',$ctype);
		
		//首页获取博文列表
		$bloglist=$this->getlist_blog($pmoduleid,$ctype);	
		$this->assign('bloglist',$bloglist);
		//首页获取分类列表
		$classifylist=$this->getlist_classify($pmoduleid,'');
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag($pmoduleid,'');		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace($pmoduleid,'');		
		$this->assign('datelist',$datelist);
		

					
		$this->display('AggregatePage/module_index1');
	}
	public function display_module_index2($pmodulelist,$modulelist,$pmoduleid,$moduleid){		
		
					
		$this->display('AggregatePage/module_index2');
	}
	public function display_list_bookshelf($pmodulelist,$modulelist,$pmoduleid,$moduleid){		
		
					
		$this->display('ListPage/list_bookshelf');
	}
	public function display_list_blog($pmodulelist,$modulelist,$pmoduleid,$moduleid){
		$ctype=1;
		if($_REQUEST['ctype']){
			$ctype=$_REQUEST['ctype'];			
		}
		$this->assign('ctype',$ctype);
		
		//首页获取博文列表
		$bloglist=$this->getlist_blog($pmoduleid,$ctype);	
		$this->assign('bloglist',$bloglist);
		//首页获取分类列表
		$classifylist=$this->getlist_classify($pmoduleid,$ctype);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag($pmoduleid,$ctype);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace($pmoduleid,$ctype);		
		$this->assign('datelist',$datelist);
		

					
		$this->display('ListPage/list_blog');
	}
	public function display_list_topic($pmodulelist,$modulelist,$pmoduleid,$moduleid){		
		$ctype=2;
		if($_REQUEST['ctype']){
			$ctype=$_REQUEST['ctype'];			
		}
		$this->assign('ctype',$ctype);
		
		//首页获取博文列表
		$bloglist=$this->getlist_blog($pmoduleid,$ctype);	
		$this->assign('bloglist',$bloglist);
		//首页获取分类列表
		$classifylist=$this->getlist_classify($pmoduleid,$ctype);
		$this->assign('classifylist',$classifylist);
		//首页获取标签列表
		$taglist=$this->getlist_tag($pmoduleid,$ctype);		
		$this->assign('taglist',$taglist);
		//首页获取归档
		$datelist=$this->getlist_dateplace($pmoduleid,$ctype);		
		$this->assign('datelist',$datelist);
							
		$this->display('ListPage/list_topic');
	}
}
?>
