<?php
require_once('sqlin.php');
$conf['debug']['level']=5;

/*		数据库配置		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=kt';
$conf['db']['user']='root';
$conf['db']['password']='root';
$conf['db']['charset']='utf8';
$conf['db']['prename']='ssc_';

$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache/';

$conf['url_modal']=2;

$conf['action']['template']='wjinc/admin/';
$conf['action']['modals']='wjaction/admin/';

$conf['member']['sessionTime']=15*60;	// 用户有效时长
$conf['node']['access']='http://localhost:8800';	// node访问基本路径

error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');

ini_set('display_errors', 'Off');
