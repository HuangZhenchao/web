<?php
class kehuyanchangAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','kehuyanchang');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
