<?php
	//文件读取
	function FileRead($filepath){
		$fp = fopen($filepath, "r");
		$content="";
		if($fp){ 
			for($i=1;! feof($fp);$i++){ 
				$content=$content.fgets($fp); 
			} 
		} 
		else 
		{ 
			$content=""; 
		} 
		fclose($fp);
		return $content;
	}
	//文件重写，返回写入字符数
	//调用样例FileReWrite(dirname(__FILE__)."debug.txt", $sqlstr);
	function FileReWrite($filepath,$content){
		$fp = fopen($filepath, "w");//文件被清空后再写入 
		$count=0;
		if($fp){
			$count=fwrite($fp,$content); 
		} 
		else{ 
			$count=-1; 
		} 
		fclose($fp);
		return $count;
	}
	//文件继写
	//调用样例FileReWrite(dirname(__FILE__)."debug.txt", $sqlstr);
	function FileWrite($filepath,$content){
		$fp = fopen($filepath, "a");//文件从尾部写入 
		$count=0;
		if($fp){
			$count=fwrite($fp,$content); 
		} 
		else{ 
			$count=-1; 
		} 
		fclose($fp);
		return $count;
	}
?>