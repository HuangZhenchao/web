<?php
class shenhepeixunAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','shenhepeixun');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
