<?php
class yanhuoAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','yanhuo');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
