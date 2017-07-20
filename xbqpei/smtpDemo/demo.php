<?php
//语言设置
$GLOBALS['cfg_soft_lang'] ='utf8';
//smtp发信服务器
 $cfg_smtp_server="smtp.163.com";//必须支持SMTP协议
//smtp发信端口
 $cfg_smtp_port="25";//请保持默认
//smtp发信邮箱
 $cfg_smtp_usermail="wuzeguo888@163.com";//请填写你用来发信的邮箱
//smtp发信邮箱密码
 $cfg_smtp_password="wzg1991923";//请填写你用来发信的邮箱的密码
 //载入mail类
 require_once('mail.class.php');
 //初始化
     $smtp = new smtp($cfg_smtp_server,$cfg_smtp_port,true,$cfg_smtp_usermail,$cfg_smtp_password);
     //关闭调试
     $smtp->debug = false;
     //测试发送
		  if(!$smtp->smtp_sockopen($cfg_smtp_server)){		  
	    exit('邮件发送失败,请联系管理员');
		 }
      //文本内容
      $mailbody ='莫莫(31008555),给你发一封 ';
      //以TXT形式发送 tesr@qq.com 为收信EMAIL
      $resut = $smtp->sendmail('1723877247@qq.com', '晓风',$cfg_smtp_usermail, '测试发送信息', $mailbody,'TXT');
      if(!$resut){
        echo '发送失败';
      
      }else{
        echo '返回值:'.$resut;     //返回1成功 
      }
	    
