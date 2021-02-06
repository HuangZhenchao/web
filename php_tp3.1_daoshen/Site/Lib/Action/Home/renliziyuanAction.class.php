<?php
class renliziyuanAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','renliziyuan');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
