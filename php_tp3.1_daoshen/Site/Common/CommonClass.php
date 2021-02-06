<?php 
	/*调用该文件方法时需要加载文件include("Common.CommonClass.php");*/

    /*
     *字符串16进制加码转化
     *<param name="strEncode">需要加码的字符串</param>   
    */      
    function CMC_EncodeString($strEncode){
    	$strtemp="";
    	if($strEncode==""){//传入为空，则返回空
    		$strtemp="";
    	}
    	else{
    		for ($i=0; $i<strlen($strEncode); $i++){
    			$strtemp = $strtemp.dechex(ord($strEncode[$i]));
    		}
    		$strtemp=strToUpper($strtemp);
    	}
    	return $strtemp;
    }
    
    /*
     *字符串16进制解码转化
     *<param name="strEncode">需要加码的字符串</param>
    */
    function CMC_DecodeString($strDecode){
    	$strtemp="";
    	if($strDecode==""){//传入为空，则返回空
    		$strtemp="";
    	}
    	else{
    		$strtemp="";
    		for ($i=0; $i < strlen($strDecode)-1; $i+=2){
    			$strtemp = $strtemp.chr(hexdec($strDecode[$i].$strDecode[$i+1]));
    	    }
    	}
    	return $strtemp;
    }
    
    /*
     *页面多行编辑框提交文本时会有部分特殊字符导致数据库存储异常，需要转换后再提交数据库
     *从数据库中取出显示时只需要把<bl/>转成\r\n即可
    */
    function CMC_ArticleReplaceForSave($article)
    {
    	if($article!=""){
        	$article=str_replace("\r\n","<bl/>",$article);
        	$article=str_replace("'","\"",$article);
    	}    	
        return $article;
    }
    
    /*
     * 页面多行编辑框提交文本时会有部分特殊字符导致数据库存储异常，需要转换后再提交数据库
     *从数据库中取出显示时只需要把<bl/>转成\r\n即可
    */
    function CMC_ArticleReplaceForShow($article)
    {
    	if($article!=""){
        	$article=str_replace("<bl/>","\r\n",$article);  
    	}      	
        return $article;
    }    
    
    /*
     * 返回经过MD5二次封装加密过的串，一般建议使用系统默认的，先MDS5，再取第四位字符开始16进制转，
    *部分系统可能存在兼容性才使用，也可作为项目系统中统一规范使用
    */
    function CMC_GetMD5Manual($strPwd)
    {
        
    }
    
    /**
	  * 对多位数组进行排序
	 * @param $multi_array 数组
	 * @param $sort_key需要用于比较的的键名
	 * @param $sort排序类型 SORT_ASC/SORT_DESC
	 */
	function multi_array_sort($multi_array, $sort_key, $sort = SORT_DESC) {
		if (is_array($multi_array)) {
			foreach ($multi_array as $row_array) {
				if (is_array($row_array)) {
					$key_array[] = $row_array[$sort_key];
	 			} else {
	 				return FALSE;
	 			}
	 		}
	 	} else {
	 		return FALSE;
	 	}
	 	array_multisort($key_array, $sort, $multi_array);
	 	return $multi_array;
	}
    
	//访问https的调用 方法
	function cur_https($url,$post_data){
		//方法1无法使用
		/*$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);*/
		//方法1无法使用，改用方法2
		$ssl = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
	    $ch = curl_init();
	    $opt = array(
	            CURLOPT_URL     => $url,
	            CURLOPT_POST    => 1,
	            CURLOPT_HEADER  => 0,
	            CURLOPT_POSTFIELDS      => $post_data,
	            CURLOPT_RETURNTRANSFER  => 1,
	            CURLOPT_TIMEOUT         => $timeout,
	            );
	    if ($ssl)
	    {
	        $opt[CURLOPT_SSL_VERIFYHOST] = 1;
	        $opt[CURLOPT_SSL_VERIFYPEER] = FALSE;
	    }
	    curl_setopt_array($ch, $opt);
	    $output = curl_exec($ch);
	    curl_close($ch);
		
		return $output;
	} 
	//访问http的调用 方法
	function cur_http($url,$post_data){
		//方法1无法使用
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		curl_close($ch);
		
		return $output;
	}
	/**
	 * 过滤SQL查询串中的注释。该方法只过滤SQL文件中独占一行或一块的那些注释。
	 *
	 * @access  public
	 * @param   string      $sql        SQL查询串
	 * @return  string      返回已过滤掉注释的SQL查询串。
	 */
	function remove_comment($sql) {
		/* 删除SQL行注释，行注释不匹配换行符 */
		$sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);

		/* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
		//$sql = preg_replace('/^\s*\/\*(?:.|\n)*\*\//m', '', $sql);
		$sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);

		return $sql;
	}
?>