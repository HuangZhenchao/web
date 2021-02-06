<?php
//基础类
class ModelManageAction extends CommonAction{
	public function index(){
		
		import("@.include.Module");
		$Module=New Module();
		$fieldjson='';		
		$recordjson=$Module->modelgetlist($fieldjson);

		$modellist=json_decode($recordjson,true);

		$modeltree=$this->getTree_list($modellist, "00");

		$this->goodstypetree=$modeltree;
    	$this->display();
	}
	
	//添加页显示时默认执行
	public function modeladd(){
		if($_REQUEST["pGUID"])
			$this->pGUID=$_REQUEST["pGUID"];
		else 
			$this->pGUID='00';
		if(isset($_REQUEST["pname"]))
			$this->pname=$_REQUEST["pname"];
		else 
			$this->pname='无';
		$this->display();
	}
	
	//编辑页显示时默认执行
	public function modeledit(){
		import("@.include.ModelManage" );
		$ModelManage=New ModelManage();
		$GUID=$_REQUEST["GUID"];
		$fieldjson='{"GUID":"'.$GUID.'"}';
		$recordjson=$ModelManage->modelgetlist($fieldjson);
		$recordlist=json_decode($recordjson,true);

		$this->assign('modellist',$recordlist);
		$this->display();
	}
    //添加模块
    public function model_add(){
    	import("@.include.ModelManage" );
		$ModelManage=New ModelManage();
   	
	    $fielddata=Array();
		$fielddata['GUID'] = date('YmdHis',time()).rand(1000,9999);
		$fielddata['name'] = $_POST["name"];
		$fielddata['pGUID'] = $_POST["pGUID"];		
		$fielddata['mtype'] = $_POST["mtype"];
		$fielddata['releGUID'] ='';
		$fielddata['state'] ='1';
		$fielddata['ds'] = '1';
		$fielddata['orderflag'] = $_POST["orderflag"];
			
		$jsonfield=json_encode($fielddata);	
    	$returnflag=$ModelManage->modelpro($jsonfield,1);
    	if($returnflag>0){
    		echo '{"statusCode":"1", "message":"添加新模块完成"}';
    	}
    	else{
    		echo '{"statusCode":"0", "message":"添加新模块失败"}';
    	} 
    }

    //修改模块
    public function model_edit(){
    	import("@.include.ModelManage" );
		$ModelManage=New ModelManage();
    	$fielddata=Array();
		$fielddata['GUID'] = $_POST["GUID"];
		$fielddata['name'] = $_POST["name"];
		$fielddata['pGUID'] = $_POST["pGUID"];		
		$fielddata['mtype'] = $_POST["mtype"];
		$fielddata['orderflag'] = $_POST["orderflag"];			

		$fieldjson=json_encode($fielddata);	
    	$returnflag=$ModelManage->modelpro($fieldjson,2);
    	if($returnflag>0){
    		echo '{"statusCode":"1", "message":"修改模块完成"}';
    	}
    	else{
    		echo '{"statusCode":"0", "message":"修改模块失败"}';
    	} 
    }
    
    //删除模块
    public function model_del(){
    	import("@.include.ModelManage" );
		$ModelManage=New ModelManage();
    	$GUID=$_POST["GUID"];
	    $jsonfield='{"GUID":"'.$GUID.'"}';
		$returnflag=$ModelManage->modelpro($jsonfield,3);
    	if($returnflag>0){
    		echo '{"statusCode":"1", "message":"删除模块完成"}';
    	}
    	else{
    		echo '{"statusCode":"0", "message":"删除模块失败"}';
    	} 
    }
	
	//模块树状构造
	private function getTree_list($data,$pid){
		$html='';
	    for($i=0;$i<sizeof($data);$i++){
	        if($data[$i]['pid']==$pid){
	        	//根结点
	        	if($pid=="00"){
		            $html=$html."<li>";
		            $html=$html.'<div class="header">';
		            $html=$html.'<span class="arrow up"></span>';
		            $html=$html.'<span class="label">'.$data[$i]["name"].'</span>';
		            $html=$html.'<div class="opre">';
					//$html=$html.'<a title="添加类型" target="dialog" href="__APP__/Admin/GoodsType/goodstypeadd/pGUID/00" rel="newstypeadd" class="btnAdd" width="400" height="140" mask="true" maxable="false" resizable="false" help="false">添加</a>';	
					$html=$html.'<a title="添加子类型" target="dialog" href="__APP__/Admin/ModelManage/modeladd/pGUID/'.$data[$i]["id"].'/pname/'.$data[$i]["name"].'" rel="modeladd" class=btnAdd width="360" height="280" mask="true" maxable="false" resizable="false" help="false">添加</a>';								
					$html=$html.'<a title="编辑类型" target="dialog" href="__APP__/Admin/ModelManage/modeledit/GUID/'.$data[$i]["id"].'" rel="newstypeedit" class="btnEdit" width="360" height="280" mask="true" maxable="false" resizable="false" help="false">编辑</a>';					
					$html=$html.'<a title="关联到模块" target="dialog" href="__APP__/Admin/ModelManage/modelrele/GUID/'.$data[$i]["id"].'/pname/'.$data[$i]["name"].'" rel="modelrele" width="360" height="280" mask="true" maxable="false" resizable="false" help="false"><img style="width:22px;height:20px;" src="__PUBLIC__/Images/add_rele.png"></a>';													
					$html=$html.'<a href="javascript:void()" onclick="modeldel(\''.$data[$i]["id"].'\')" class="btnDel" >删除</a>';
					$html=$html.'</div>';
		            $html=$html.'</div>';	
		            //处理子类型	            
		            $html.= $this->getTree_list($data,$data[$i]['id']);
		            $html=$html.'</li>';
	        	}
	        	else{
	        		$html=$html.'<li>';
					$html=$html.'<span>'.$data[$i]["name"].'</span>';
					$html=$html.'<div class="opre">';									
					$html=$html.'<a title="编辑类型" target="dialog" href="__APP__/Admin/ModelManage/modeledit/id/'.$data[$i]["id"].'" rel="newstypeedit" class="btnEdit" width="360" height="280" mask="true" maxable="false" resizable="false" help="false">编辑</a>';					
					$html=$html.'<a title="关联到模块" target="dialog" href="__APP__/Admin/ModelManage/modelrele/id/'.$data[$i]["id"].'/pname/'.$data[$i]["name"].'" rel="modelrele" width="360" height="280" mask="true" maxable="false" resizable="false" help="false"><img style="width:22px;height:20px;" src="__PUBLIC__/Images/add_rele.png"></a>';													
					$html=$html.'<a href="javascript:void()" onclick="modeldel(\''.$data[$i]["id"].'\')" class="btnDel" >删除</a>';
					$html=$html.'</div>';							
					$html=$html.'</li>';
	        	}
	        }
	    }
		if($pid=="00"){
	        $html = '<ul class="expmenu">'.$html."</ul>";
	    }else{
	    	if($html!=""){
	        	$html = '<ul class="menu" style="display:block;">'.$html."</ul>";
	    	}
		}		
		return $html;
	}
}
?>