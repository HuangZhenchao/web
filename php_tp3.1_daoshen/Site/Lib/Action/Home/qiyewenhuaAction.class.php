<?php
class qiyewenhuaAction extends CommonAction{
	public function index(){					
		
		$this->assign('modulename','qiyewenhua');
		$this->assign('modulelist',$modulelist);
		$this->assign('pmoduleid',$pmoduleid);
		$this->assign('moduleid',$moduleid);
		$this->display();
	}

}
?>
