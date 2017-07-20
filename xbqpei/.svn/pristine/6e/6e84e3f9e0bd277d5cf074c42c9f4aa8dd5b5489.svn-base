<?php
//输出接口数据
function output($data)
{
    logger::write('result code :' . $data['response_code']);
    logger::write('result err :' . $data['show_err']);
	header("Content-Type:text/html; charset=utf-8");
	$r_type = intval($_REQUEST['r_type']);//返回数据格式类型; 0:base64;1;json_encode;2:array
	$data['act'] = ACT;
	$data['act_2'] = ACT_2;
	ob_start();
    ob_end_clean();
    echo base64_encode(json_encode($data));
    exit;
}


/**
* 过滤SQL查询串中的注释。该方法只过滤SQL文件中独占一行或一块的那些注释。
*
* @access  public
* @param   string      $sql        SQL查询串
* @return  string      返回已过滤掉注释的SQL查询串。
*/
function remove_comment($sql)
{
	/* 删除SQL行注释，行注释不匹配换行符 */
	$sql = preg_replace('/^\s*(?:--|#).*/m', '', $sql);

	/* 删除SQL块注释，匹配换行符，且为非贪婪匹配 */
	//$sql = preg_replace('/^\s*\/\*(?:.|\n)*\*\//m', '', $sql);
	$sql = preg_replace('/^\s*\/\*.*?\*\//ms', '', $sql);

	return $sql;
}

function emptyTag($string)
{
		if(empty($string))
			return "";

		$string = strip_tags(trim($string));
		$string = preg_replace("|&.+?;|",'',$string);

		return $string;
}

//function get_abs_img_root($content)
//{
//	return str_replace ( "./public/", get_domain () . APP_ROOT . "/../public/", $content );
//	// return str_replace('/mapi/','/',$str);
//}
////
//function get_abs_img_root_wap($content)
//{
//	return str_replace ( "./public/", get_domain () . APP_ROOT . "/public/", $content );
//	// return str_replace('/mapi/','/',$str);
//}

function get_abs_img_root($content)
{	

	return str_replace("./public/",SITE_DOMAIN.APP_ROOT."/../public/",$content);
	//return str_replace('/mapi/','/',$str);
}
function get_abs_url_root($content)
{
	$content = str_replace("./",SITE_DOMAIN.APP_ROOT."/../",$content);	
	return $content;
}

function get_abs_wap_url_root($content)
{
	return str_replace("/mapi/../public","/public",$content);

}

function get_abs_wap_avatar_url_root($content)
{
	return str_replace("/mapi/public","/public",$content);

}

function get_baseroot(){
	$root['qipei_open'] = 1;
    return $root;   
}

?>
