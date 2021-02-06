<?php
class tixirenzhengAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','tixirenzheng');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
