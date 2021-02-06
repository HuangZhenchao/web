<?php
class IndexAction extends CommonAction{
	public function index(){					
		
		
		$this->assign('modulename','Index');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
