<?php
/**
 * 提交实名认证
 */

class submit_real_info
{
    public function index(){

        $root = get_baseroot();

		$user = $GLOBALS['request'];

        $xbqp_user_id = intval($user['xbqp_user_id']);
        $user_id = $GLOBALS['db']->table('user')->where('xbqp_user_id = ' . $xbqp_user_id)->getField('id');

        if (!intval($xbqp_user_id) || !$user_id) {
            $root['response_code'] = 0;
            $root['show_err'] = '未找到相关信息';
            output($root);
        }

        if ($user_id >0){
            $root['user_login_status'] = 1;

            $type = "credit_identificationscanning";
            $credit_type= load_auto_cache("credit_type");

            $field_array = array(
                "credit_identificationscanning"=>"idcardpassed",
            );
            $u_c_data[$field_array[$type]] = 0;
            //身份认证
            if($type == "credit_identificationscanning"){
                $u_c_data['real_name_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['real_name'])."','".AES_DECRYPT_KEY."')";
                $u_c_data['idno_encrypt'] = "AES_ENCRYPT('".strim($GLOBALS['request']['idno'])."','".AES_DECRYPT_KEY."')";
                $u_c_data['byear'] = substr($GLOBALS['request']['idno'],6,4);
                $u_c_data['bmonth'] = substr($GLOBALS['request']['idno'],10,2);
                $u_c_data['bday'] = substr($GLOBALS['request']['idno'],12,2);
                $u_c_data['idno'] = $GLOBALS['request']['idno'];
                if(getIDCardInfo(strim($GLOBALS['request']['idno']))==0){
                    $root['show_err'] = "提交失败,身份证号码错误！"; 
                    $root['status'] = 0; 
                    output($root);
                }
                if(get_user_info("count(*)","idno_encrypt = ".$u_c_data['idno_encrypt']." and id <> ".intval($user_id),"ONE")>0){
                    $root['show_err'] = "提交失败,身份证号码已使用！"; 
                    $root['status'] = 0; 
                    output($root);
                }

            }


            $GLOBALS['db']->autoExecute(DB_PREFIX."user",$u_c_data,"UPDATE","id=".$user_id);

            $mode = "INSERT";
            $condition = "";

            $temp_info = $GLOBALS['db']->getRow("SELECT user_id,`type`,`file` FROM ".DB_PREFIX."user_credit_file WHERE user_id=".$user_id." AND type='".$type."'");
            if($temp_info){
                $file_list = unserialize($temp_info['file']);
                //认证是否过期
                $time = TIME_UTC;
                $expire_time = $credit_type['list'][$type]['expire']*30*24*3600;

                $mode = "UPDATE";
                $condition = "user_id=".$user_id." AND type='".$type."'";
            }
            $root['temp_info'] = $temp_info;
            $file = array();
            $file[] = $GLOBALS['request']['face_card'];
            $file[] = $GLOBALS['request']['back_card'];

            $data['user_id'] = $user_id;
            $data['type'] = $type;
            $data['status'] = 0;
            $data['file'] = serialize($file);
            $data['create_time'] = TIME_UTC;
            $data['passed'] = 0;

            $GLOBALS['db']->autoExecute(DB_PREFIX."user_credit_file",$data,$mode,$condition);
            $root['response_code'] = 1;
            $root['status'] = 1;
            $root['show_err'] ="身份验证已提交，待审核";

        }else{
            $root['response_code'] = 0;
            $root['show_err'] ="未登录";
            $root['user_login_status'] = 0;
        }
        $root['program_title'] = "身份认证保存";
        output($root);		
    }}
