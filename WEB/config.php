<?php
require_once('sqlin.php');
$conf['debug']['level']=5;

/*		���ݿ�����		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=kt;charset=utf8';
$dbname='kt1';
$dbhost='localhost';
$conf['db']['user']='root';
$conf['db']['password']='root';
$conf['db']['charset']='utf8';
$conf['db']['prename']='ssc_';

$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache/';

$conf['url_modal']=2;

$conf['action']['template']='wjinc/default/';
$conf['action']['modals']='wjaction/default/';

$conf['member']['sessionTime']=15*60;	// �û���Чʱ��

error_reporting(E_ERROR & ~E_NOTICE);

ini_set('date.timezone', 'asia/shanghai');

ini_set('display_errors', 'Off');

//$GLOBALS['SUPER-ADMIN-UID']=1;		// ��������Ա
//Ĭ��ʱ��
//global $fromTime, $toTime;
if(strtotime(date('Y-m-d H:i:s',time()))>strtotime(date('Y-m-d',time()).' 03:00:00')){
	
	$GLOBALS['fromTime']=strtotime(date('Y-m-d').' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',strtotime("+1 day")).' 03:00:00');
}else{
	$GLOBALS['fromTime']=strtotime(date('Y-m-d',strtotime("-1 day")).' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',time()).' 03:00:00');
}