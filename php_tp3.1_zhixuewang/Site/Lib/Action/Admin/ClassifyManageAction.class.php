<?php
class ClassifyManageAction extends CommonAction{
	public function index(){
		import("@.include.Classify" );
		$Classify=new Classify();
		/*
		$data=array();
		if(isset($_POST['username']))
			$data['username']=$_POST['username'];
		if(isset($_POST['name']))
			$data['name']=$_POST['name'];
		if(isset($_POST['sex']))
			$data['sex']=$_POST['sex'];
		if(isset($_POST['fromdate']))
			$data['fromdate']=$_POST['fromdate'];
		if(isset($_POST['todate']))
			$data['todate']=$_POST['todate'];			
		$fieldjson=json_encode($data);
		*/
		$fieldjson='';
		$returnjson=$Classify->classifygetlist($fieldjson);
		$returnlist=json_decode($returnjson,true);
		$this->assign('classifylist',$returnlist);
		$this->display();
	}
	public function classifyadd(){
		$this->display();
	}
	public function classifyedit(){
		import("@.include.Classify" );
		$Classify=new Classify();
		if(isset($_REQUEST['id']))
			$data['id']=$_REQUEST['id'];
		$fieldjson=json_encode($data);
		$returnjson=$Classify->classifygetlist($fieldjson);
		$returnlist=json_decode($returnjson,true);
		$this->assign('classifylist',$returnlist);
		$this->display();	
	}	
	public function classify_add(){		
		import("@.include.Classify" );
		$Classify=new Classify();
		$datafield['name']=$_POST['name'];	
		$datafield['orderflag']=$_POST['orderflag'];	
		$fieldjson=json_encode($datafield);
		$ret=$Classify->classifypro($fieldjson,1);
		if($ret>0){
			echo '{"statusCode":"1", "message":"添加成功"}';
		}else{
			echo '{"statusCode":"0", "message":"添加失败"}';			
		}
	}
	public function classify_edit(){
		import("@.include.Classify" );
		$Classify=new Classify();
		$datafield['id']=$_POST['id'];
		$datafield['name']=$_POST['name'];	
		$datafield['orderflag']=$_POST['orderflag'];	
		$fieldjson=json_encode($datafield);
		$ret=$Classify->classifypro($fieldjson,2);
		if($ret>0){
			echo '{"statusCode":"1", "message":"操作成功"}';
		}else{
			echo '{"statusCode":"0", "message":"操作失败"}';
		}
	}
	public function classify_del(){
		import("@.include.Classify" );
		$Classify=new Classify();
		$datafield['id']=$_POST['id'];		
		$fieldjson=json_encode($datafield);
		$ret=$Classify->classifypro($fieldjson,3);
		if($ret>0){
			echo '{"statusCode":"1", "message":"操作成功"}';
		}else{
			echo '{"statusCode":"0", "message":"操作失败"}';
		}
	}
	
}
?>
