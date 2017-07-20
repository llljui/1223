<?php
// +----------------------------------------------------------------------
// | 邦邦理财
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.bangbanglicai.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 华少（273017814@qq.com）
// +----------------------------------------------------------------------
// todo 现只用chuanglan接口

class sms_sender
{
	var $sms;
	
	public function __construct()
    { 	
		//$sms_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."sms where is_effect = 1");
		//if($sms_info)
		//{
		//	$sms_info['config'] = unserialize($sms_info['config']);
		//	
		//	require_once APP_ROOT_PATH."system/sms/".$sms_info['class_name']."_sms.php";
		//	
		//	$sms_class = $sms_info['class_name']."_sms";
		//	$this->sms = new $sms_class($sms_info);
		//}

        //require_once APP_ROOT_PATH."system/sms/ChuanglanSms.php";
        //$this->sms = new ChuanglanSms();
    }


    public function sendSms($mobiles,$content,$is_ali=1)
    {
        if ($is_ali) {
            require_once APP_ROOT_PATH."system/sms/AliSDK/hy_config.php";
            require_once APP_ROOT_PATH."system/sms/AliSDK/TopSdk.php";
            date_default_timezone_set('Asia/Hangzhou');
            $c = new TopClient;
            $c->appkey = $hy_appkey;
            $c->secretKey = $hy_secretkey;
            $req = new AlibabaAliqinFcSmsNumSendRequest;
            $req->setExtend("123456");
            $req->setSmsType("normal");
            $req->setSmsFreeSignName($sign);   //短信签名
            $req->setSmsParam($content[1]);          //短信内容
            $req->setRecNum($mobiles);          //接收短信手机号
            $req->setSmsTemplateCode($content[0]);   //模板编号
            $resp = $c->execute($req);
            $result = $resp->result->success;

            if (!$result) {
                logger::write('发送失败:' . $resp->sub_msg);
            }

        } else {

            if(!is_array($mobiles))
                $mobiles = preg_split("/[ ,]/i",$mobiles);

            if(count($mobiles) > 0 )
            {
                if(!$this->sms)
                {
                    $result['status'] = 0;
                }
                else
                {
                    $count = 0;
                    foreach ($mobiles AS $k=>$v) {
                        $result = $this->sms->sendSms($v,$content);
                        $result && ++$count;
                    } 
                    if ($count > 0) {
                        $result = true;
                    } else {
                        $result = false;
                    }
                }
            }
            else
            {
                $result['status'] = 0;
                $result['msg'] = "没有发送的手机号";
            }
        }
		
        logger::write('sms:'.json_encode($result));
		return $result;
	}
}
?>
