<?php
// database host
$db_host   = "localhost:3306";

// database name
$db_name   = "xbqp";

// database username
$db_user   = "root";

// database password
$db_pass   = "";

// HongYuJD-V7.2 bbs.hongyuvip.com
$prefix    = "ecs_";

$timezone    = "PRC";

$cookie_path    = "/";

$cookie_domain    = "";

$session = "1440";

define('EC_CHARSET','utf-8');

if(!defined('ADMIN_PATH'));
{
define('ADMIN_PATH','admin');
}
if(!defined('ADMIN_PATH_M'));
{
define('ADMIN_PATH_M','admin');
}
define('AUTH_KEY', 'this is a key');

define('OLD_AUTH_KEY', '');

define('API_TIME', '2017-05-25 17:03:01');

//调试模式下产生缓存
define('DEBUG_MODE', false);
?>