<?php

// +----------------------------------------------------------------------
// | 邦邦理财
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: jobin.lin(jobin.lin@gmail.com)
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | 国付报 直连银行支付
// +----------------------------------------------------------------------

$payment_lang = array(
	'name'	=>	'国付宝WAP支付',
	'merchant_id'	=>	'合作者身份ID',
	'virCardNoIn'	=>	'国付宝账户',
	'VerficationCode'		=>	'商户识别码',
);

$config = array(
    'merchant_id' => '', //商户ID
    'virCardNoIn' => '', //国付宝账户
    'VerficationCode'=>'',  //商户识别码
);
/* 模块的基本信息 */
if (isset($read_modules) && $read_modules == true){
    
    /* 会员数据整合插件的代码必须和文件名保持一致 */
    $module['class_name']    = 'Gfbwap';

    /* 被整合的第三方程序的名称 */
    $module['name'] = $payment_lang['name'];
    
    /* 支付方式：1：在线支付；0：线下支付 */
    $module['online_pay'] = '2';
	
	 /* 配送 */
    $module['config'] = $config;
    
    $module['lang'] = $payment_lang;
	
    $module['reg_url'] = 'https://www.gopay.com.cn';
    
    return $module;
}

// 国付宝模型
require_once(APP_ROOT_PATH.'system/libs/payment.php');
class Gfbwap_payment implements payment {

	public function get_payment_code($payment_notice_id) {
		
        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = ".$payment_notice_id);
    
        $url = SITE_DOMAIN.APP_ROOT.'/callback/pay/gfbwap_pay.php?payment_notice_id='.$payment_notice_id;
        $url = str_replace(array("/mapi","/callback/pay/callback/pay/"), array("","/callback/pay/"), $url);
        $pay = array();
        $pay['subject'] = $payment_notice['notice_sn'];
        $pay['body'] = '会员充值';
        $pay['total_fee'] = round($payment_notice['money'],2);
        $pay['total_fee_format'] = format_price($pay['total_fee']);
        $pay['out_trade_no'] = $payment_notice['notice_sn'];
        $pay['notify_url'] = $url;
        
        $pay['is_wap'] = 1;//
        $pay['pay_code'] = 'gfbwap';
        
        return $pay;
    }

    public function get_payment($payment_notice_id) {
        
        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = ".$payment_notice_id);
		//$order = $GLOBALS['db']->getRow("select order_sn,bank_id from ".DB_PREFIX."deal_order where id = ".$payment_notice['order_id']);
		
					
		$payment_info = $GLOBALS['db']->getRow("select id,config,logo from ".DB_PREFIX."payment where id=".intval($payment_notice['payment_id']));
		$payment_info['config'] = unserialize($payment_info['config']);
       
       // $_Merchant_url =  SITE_DOMAIN.APP_ROOT.'/baofoo_callback.php?act=response';
       // $_Return_url = SITE_DOMAIN.APP_ROOT.'/baofoo_callback.php?act=notify';

        $_BackgroundMerUrl = SITE_DOMAIN.APP_ROOT.'/callback/pay/gfbwap_response.php';
        $_FrontMerUrl = SITE_DOMAIN.APP_ROOT.'/callback/pay/gfbwap_notify.php';
        $_BackgroundMerUrl = str_replace(array("/mapi","/callback/pay/callback/pay/"), array("","/callback/pay/"), $_BackgroundMerUrl);
        $_FrontMerUrl = str_replace(array("/mapi","/callback/pay/callback/pay/"), array("","/callback/pay/"), $_FrontMerUrl);

        //商户代码
        $_MerchantID = $payment_info['config']['merchant_id'];
        //订单号
        $_MerOrderNum = $payment_notice['notice_sn'];
        //交易金额
        $_TranAmt = round($payment_notice['money'],2);
        //交易时间 
        $_TranDateTime = to_date($payment_notice['create_time'], 'YmdHis');
        //账户
        $_VirCardNoIn = $payment_info['config']['virCardNoIn']; 
        //IP
        $_TranIP = CLIENT_IP;
        //商品名称
        $_GoodsName = $payment_notice['notice_sn'];

        $bank_id = $payment_notice['bank_id'];
        if ($bank_id == '0') $bank_id = '';

        //签名
        $version = '2.1';
        $tranCode = '8888';
        $feeAmt = '0.00';
        $verficationCode = $payment_info['config']['VerficationCode'];
        $gopayServerTime = trim(file_get_contents("https://www.gopay.com.cn/PGServer/time"));
        $signValue='version=['.$version.']tranCode=['.$tranCode.']merchantID=['.$_MerchantID.']merOrderNum=['.$_MerOrderNum.']tranAmt=['.$_TranAmt.']feeAmt=['.$feeAmt.']tranDateTime=['.$_TranDateTime.']frontMerUrl=['.$_FrontMerUrl.']backgroundMerUrl=['.$_BackgroundMerUrl.']orderId=[]gopayOutOrderId=[]tranIP=['.$_TranIP.']respCode=[]gopayServerTime=['.$gopayServerTime.']VerficationCode=['.$verficationCode.']';

        $signValue = md5($signValue);


        /*交易参数*/
        $parameter = array(
            'version'=>$version,//版本号
            'charset'=>'2',//字符集1GBK 2UTF-8
            'language'=>'1',//语言种类
            'signType'=>'1',//签名类型
            'tranCode'=> $tranCode, //交易代码
            
            //用户账户信息
            'merchantID'=>$_MerchantID,//商户ID
            'virCardNoIn'=> $_VirCardNoIn,
            
            //订单信息
            'merOrderNum'=>$_MerOrderNum,//订单号
            'tranAmt'=>$_TranAmt,//交易金额
            'currencyType'=> 156,//币种 default
            'tranDateTime'=> $_TranDateTime,//交易时间
            'tranIP'=>$_TranIP,//用户IP
            
            'goodsName'=>$_GoodsName,//商品名称
            'goodsDetail'=>'',//商品描述
            'buyerName'=>'MWEB',//移动支付村记
            'buyerContact'=>'',//买方联系方式
            
            
            //通知配置
            'frontMerUrl'=>$_FrontMerUrl,//前台通知地址
            'backgroundMerUrl'=>$_BackgroundMerUrl,//后台通知地址
            
            //生成信息
            'signValue'=>$signValue,//密文串
            'gopayServerTime'=>  $gopayServerTime ,//服务器时间
            
            //银行直连必填
            'bankCode'=>$bank_id,//银行代码
            'userType'=>1,//用户类型1（为个人支付）；2（为企业支付）

            //可选参数
            'feeAmt'=>$feeAmt,//手续费  
            'isRepeatSubmit'=>'',
            'merRemark1'=>$payment_notice_id,  //系统订单号
            'merRemark2'=>'',
            
        );
        
		if ($payment_info['config']['merchant_id'] == '0000001502'){
            $url = 'https://gatewaymer.gopay.com.cn/Trans/MobileClientAction.do?'.http_build_query($parameter);
		}else{
			$url = 'https://gateway.gopay.com.cn/Trans/MobileClientAction.do?'.http_build_query($parameter);
		}
        
        return $url;

    }

    public function response($request) {
		$return_res = array(
            'info' => '',
            'status' => false,
        );
        logger::write('this is start gfbwap');
		
        /* 取返回参数 */
        $version = $request["version"];
		$charset = $request["charset"];
		$language = $request["language"];
		$signType = $request["signType"];
		$tranCode = $request["tranCode"];
		$merchantID = $request["merchantID"];
		$merOrderNum = $request["merOrderNum"];
		$tranAmt = $request["tranAmt"];
		$feeAmt = $request["feeAmt"];
		$frontMerUrl = $request["frontMerUrl"];
		$backgroundMerUrl = $request["backgroundMerUrl"];
		$tranDateTime = $request["tranDateTime"];
		$tranIP = $request["tranIP"];
		$respCode = $request["respCode"];
		$msgExt = $request["msgExt"];
		$orderId = $request["orderId"];
		$gopayOutOrderId = $request["gopayOutOrderId"];
		$bankCode = $request["bankCode"];
		$tranFinishTime = $request["tranFinishTime"];
		$merRemark1 = $request["merRemark1"];
		$merRemark2 = $request["merRemark2"];
		$signValue = $request["signValue"];

        //参数转换
        $payment_notice_sn = $merRemark1;  //系统订单号
        $total_price = $tranAmt;//总价
	
        /*获取支付信息*/
        $payment = $GLOBALS['db']->getRow("select id,config from ".DB_PREFIX."payment where class_name='Gfbwap'");  
    	$payment['config'] = unserialize($payment['config']);
    	
        $currency_id = $payment['currency'];
		
        /*比对连接加密字符串*/
		$signValue2='version=['.$version.']tranCode=['.$tranCode.']merchantID=['.$merchantID.']merOrderNum=['.$merOrderNum.']tranAmt=['.$tranAmt.']feeAmt=['.$feeAmt.']tranDateTime=['.$tranDateTime.']frontMerUrl=['.$frontMerUrl.']backgroundMerUrl=['.$backgroundMerUrl.']orderId=['.$orderId.']gopayOutOrderId=['.$gopayOutOrderId.']tranIP=['.$tranIP.']respCode=['.$respCode.']gopayServerTime=[]VerficationCode=['.$payment['config']['VerficationCode'].']';

        $signValue2 = md5($signValue2);
        logger::write('sign1'. $signValue);
        logger::write('sign2'. $signValue2);

        if ($signValue != $signValue2 || $respCode != "0000") {
        	echo "RespCode=9999|JumpURL=".SITE_DOMAIN.url("index","payment#pay",array("id"=>$payment_notice_sn)); 
        } else {
	        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = '".$payment_notice_sn."'");
			require_once APP_ROOT_PATH."system/libs/cart.php";
			$rs = payment_paid($payment_notice['id'],$gopayOutOrderId);	
			
			$is_paid = intval($GLOBALS['db']->getOne("select is_paid from ".DB_PREFIX."payment_notice where id = '".intval($payment_notice['id'])."'"));
			if ($is_paid == 1){
				echo "RespCode=0000|JumpURL=".SITE_DOMAIN.url("index","payment#incharge_done",array("id"=>$payment_notice['id'])); //支付成功
			}else{
				echo "RespCode=9999|JumpURL=".SITE_DOMAIN.url("index","payment#pay",array("id"=>$payment_notice['id'])); 
			}									
        }
    }
    
     public function notify($request) {
		$return_res = array(
            'info' => '',
            'status' => false,
        );
		
        /* 取返回参数 */
        $version = $request["version"];
		$charset = $request["charset"];
		$language = $request["language"];
		$signType = $request["signType"];
		$tranCode = $request["tranCode"];
		$merchantID = $request["merchantID"];
		$merOrderNum = $request["merOrderNum"];
		$tranAmt = $request["tranAmt"];
		$feeAmt = $request["feeAmt"];
		$frontMerUrl = $request["frontMerUrl"];
		$backgroundMerUrl = $request["backgroundMerUrl"];
		$tranDateTime = $request["tranDateTime"];
		$tranIP = $request["tranIP"];
		$respCode = $request["respCode"];
		$msgExt = $request["msgExt"];
		$orderId = $request["orderId"];
		$gopayOutOrderId = $request["gopayOutOrderId"];
		$bankCode = $request["bankCode"];
		$tranFinishTime = $request["tranFinishTime"];
		$merRemark1 = $request["merRemark1"];
		$merRemark2 = $request["merRemark2"];
		$signValue = $request["signValue"];

        //参数转换
        $payment_notice_sn = $merRemark1;  //系统订单号
        $total_price = $tranAmt;//总价
	
        /*获取支付信息*/
        $payment = $GLOBALS['db']->getRow("select id,config from ".DB_PREFIX."payment where class_name='Gfbwap'");  
    	$payment['config'] = unserialize($payment['config']);
    	
        $currency_id = $payment['currency'];
		
        /*比对连接加密字符串*/
		$signValue2='version=['.$version.']tranCode=['.$tranCode.']merchantID=['.$merchantID.']merOrderNum=['.$merOrderNum.']tranAmt=['.$tranAmt.']feeAmt=['.$feeAmt.']tranDateTime=['.$tranDateTime.']frontMerUrl=['.$frontMerUrl.']backgroundMerUrl=['.$backgroundMerUrl.']orderId=['.$orderId.']gopayOutOrderId=['.$gopayOutOrderId.']tranIP=['.$tranIP.']respCode=['.$respCode.']gopayServerTime=[]VerficationCode=['.$payment['config']['VerficationCode'].']';

        $signValue2 = md5($signValue2);

        if ($signValue != $signValue2 || $respCode != "0000") {
        	echo "Md5CheckFail";
        } else {
	        $payment_notice = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment_notice where id = '".$payment_notice_sn."'");
			$order_info = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."deal_order where id = ".$payment_notice['order_id']);
			require_once APP_ROOT_PATH."system/libs/cart.php";
			$rs = payment_paid($payment_notice['id'],$gopayOutOrderId);						
			if($rs)
			{
				$rs = order_paid($payment_notice['order_id']);				
				if($rs)
				{
					//开始更新相应的outer_notice_sn					
					//$GLOBALS['db']->query("update ".DB_PREFIX."payment_notice set outer_notice_sn = '".$gopayOutOrderId."' where id = ".$payment_notice['id']);
					#if($order_info['type']==0)
					#	app_redirect(url("index","payment#done",array("id"=>$payment_notice['order_id']))); //支付成功
					#else
					#	app_redirect(url("index","payment#incharge_done",array("id"=>$payment_notice['order_id']))); //支付成功
					echo "OK";
				}
				else 
				{
					echo "OK";
					/*if($order_info['pay_status'] == 2)
					{				
						if($order_info['type']==0)
							app_redirect(url("index","payment#done",array("id"=>$payment_notice['order_id']))); //支付成功
						else
							app_redirect(url("index","payment#incharge_done",array("id"=>$payment_notice['order_id']))); //支付成功
					}
					else
						app_redirect(url("index","payment#pay",array("id"=>$payment_notice['id'])));
                     */
				}
			}
			else
			{
				#app_redirect(url("index","payment#pay",array("id"=>$payment_notice['id'])));
				echo "OrderFail";
			}
        }
    }

    public function get_display_code() {
        return;
        /*$payment_item = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."payment where class_name='Guofubao'");
		if($payment_item)
		{
			$payment_cfg = unserialize($payment_item['config']);

	        $html = "<style type='text/css'>.guofubao_types{float:left; display:block; background:url(".SITE_DOMAIN.APP_ROOT."/system/payment/Guofubao/banklist_hnapay.jpg); font-size:0px; width:150px; height:10px; text-align:left; padding:15px 0px;}";
	        $html .=".gfb_type_0{background-position:15px -908px; }"; //中国建设银行
	        $html .=".gfb_type_CCB{background-position:15px -72px; }"; //中国建设银行
	        $html .=".gfb_type_CMB{background-position:15px -196px; }"; //招商银行
	        $html .=".gfb_type_ICBC{background-position:15px 3px; }"; //中国工商银行
	        $html .=".gfb_type_BOC{background-position:15px -113px; }"; //中国银行
	        $html .=".gfb_type_ABC{background-position:15px -34px; }"; //中国农业银行
	        $html .=".gfb_type_BOCOM{background-position:15px -155px; }"; //交通银行
	        $html .=".gfb_type_CMBC{background-position:15px -230px; }"; //中国民生银行
	        $html .=".gfb_type_HXBC{background-position:15px -358px; }"; //华夏银行
	        $html .=".gfb_type_CIB{background-position:15px -270px; }"; //兴业银行
	        $html .=".gfb_type_SPDB{background-position:15px -312px; }"; //上海浦东发展银行
	        $html .=".gfb_type_GDB{background-position:15px -475px; }"; //广东发展银行
	        $html .=".gfb_type_CITIC{background-position:15px -396px; }"; //中信银行
	        $html .=".gfb_type_CEB{background-position:15px -435px; }"; //光大银行
	        $html .=".gfb_type_PSBC{background-position:15px -513px; }"; //中国邮政储蓄银行
	        $html .=".gfb_type_SDB{background-position:15px -558px; }"; //深圳发展银行
	        $html .=".gfb_type_BOBJ{background-position:15px -697px; }"; //北京银行
			$html .=".gfb_type_PAB{background-position:15px -827px; }"; //平安银行
			$html .=".gfb_type_BOS{background-position:15px -789px; }"; //上海银行
			$html .=".gfb_type_NBCB{background-position:15px -649px; }"; //宁波银行
			$html .=".gfb_type_NJCB{background-position:15px -743px; }"; //南京银行
			$html .=".gfb_type_TCCB{background-position:15px -869px; }"; //天津银行
	        $html .="</style>";
	        $html .="<script type='text/javascript'>function set_bank(bank_id)";
			$html .="{";
			$html .="$(\"input[name='bank_id']\").val(bank_id);";
			$html .="}</script>";
            //$html.= "<h3 class='clearfix tl'><b>国付宝支付</b></h3>";
            $html .= "<div class='blank1'></div><hr />";
	       foreach ($payment_cfg['guofubao_gateway'] AS $key=>$val)
	        {
	            $html  .= "<label class='guofubao_types gfb_type_".$key." ui-radiobox' rel='common_payment'><input type='radio' name='payment' value='".$payment_item['id']."' rel='".$key."' onclick='set_bank(\"".$key."\")' /></label>";
	        }
	        $html .= "<input type='hidden' name='bank_id' /><div class='blank'></div>";
			return $html;
		}
		else{
			return '';
		}
         */
    }
    /**
     * 字符转义
     * @return string
     */
    function fStripslashes($string)
    {
            if(is_array($string))
            {
                    foreach($string as $key => $val)
                    {
                            unset($string[$key]);
                            $string[stripslashes($key)] = fStripslashes($val);
                    }
            }
            else
            {
                    $string = stripslashes($string);
            }

            return $string;
    }

}

?>
