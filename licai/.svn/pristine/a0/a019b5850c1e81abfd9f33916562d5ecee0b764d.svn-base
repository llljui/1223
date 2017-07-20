<?php

//验证签名
function check_sign($data)
{
    include dirname(__FILE__) . '/config.php';

    ksort($data);

    $sign = '';
    foreach ($data as $key => $val) {
        if ($val != '' && $key != 'sign') {
            $sign .= "&$key=$val";
        }
    }

    logger::write('key:' .$private_key);
    logger::write('new sign:' .md5(substr($sign,1).$private_key));

    if ($data['sign'] == md5(substr($sign,1).$private_key)) {
        return true;
    }

    return false;
}
