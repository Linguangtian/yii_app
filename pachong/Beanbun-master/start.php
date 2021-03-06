<?php
use Beanbun\Beanbun;
use Beanbun\Lib\Helper;

require_once(__DIR__ . '/vendor/autoload.php');

$beanbun = new Beanbun;
$beanbun->name = 'qiubai';
$beanbun->count = 5;
$beanbun->seed = 'http://vip.book.sina.com.cn/';
$beanbun->max = 30;
$beanbun->logFile = __DIR__ . '/qiubai_access.log';
$beanbun->timeout = 10;
/*
$beanbun->urlFilter = [
  //'/http:\/\/www.qiushibaike.com\/8hr\/page\/(\d*)\?s=(\d*)/'
'http://vip.book.sina.com.cn/weibobook/book/5431515.html?pos=20035'
  
];*/
// 设置队列
$beanbun->setQueue('memory', [
  'host' => '127.0.0.1',
  'port' => '1234'
 ]);
$beanbun->afterDownloadPage = function($beanbun) {
  file_put_contents(__DIR__ . '/' . md5($beanbun->url), $beanbun->page);
};
$beanbun->start();

?>