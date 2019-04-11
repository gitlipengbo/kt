<?php
require_once('wjsqlin.php');
$conf['debug']['level']=5;

/*		数据库配置		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=caipiaopindao';
$conf['db']['user']='root';
$conf['db']['password']='78963.';
$conf['db']['charset']='utf8';
$conf['db']['prename']='wj5ssc_';

$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache/';

$conf['url_modal']=2;

$conf['action']['template']='wjinc/';
$conf['action']['modals']='wjaction/';

$conf['member']['sessionTime']=15*60;	// 用户有效时长



//$conf['web']['title']='－万金娱乐平台';

error_reporting(E_ERROR & ~E_NOTICE);
//error_reporting(0);
ini_set('date.timezone', 'asia/shanghai');
//ini_set('session.cookie_domain', '.wanjinyule.com');
ini_set('display_errors', 'Off');

//$GLOBALS['SUPER-ADMIN-UID']=1;		// 超级管理员
//默认时间
//global $fromTime, $toTime;
if(strtotime(date('Y-m-d H:i:s',time()))>strtotime(date('Y-m-d',time()).' 03:00:00')){
	
	$GLOBALS['fromTime']=strtotime(date('Y-m-d').' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',strtotime("+1 day")).' 03:00:00');
}else{
	$GLOBALS['fromTime']=strtotime(date('Y-m-d',strtotime("-1 day")).' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',time()).' 03:00:00');
}
//主域名
$GLOBALS['siteUrl']='http://sh01.sohuoa.top';

//判断手机登陆
function is_mobile(){   
    $user_agent = $_SERVER['HTTP_USER_AGENT'];   
    $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");   
    $is_mobile = false;   
    foreach ($mobile_agents as $device) {   
        if (stristr($user_agent, $device)) {   
            $is_mobile = true;   
            break;   
        }   
    }   
    return $is_mobile;   
}

