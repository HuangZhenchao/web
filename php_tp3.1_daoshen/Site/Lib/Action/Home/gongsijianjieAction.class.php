<?php
class gongsijianjieAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','gongsijianjie');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
