<?php
use Workerman\Worker;
use Workerman\Connection\TcpConnection;

require_once __DIR__ . '/vendor/autoload.php';

Worker::$logFile = '/workerman.log'; //日志保存设置

$http_worker = new Worker("websocket://0.0.0.0:2345");
// 启动4个进程，同时监听8484端口，以websocket协议提供服务
$http_worker->count = 4;

$http_worker->name ='my process';

//->onConnect 一样 监听   当有连接 $connection过来是触发 $data为接受到得
$http_worker->onMessage = function (TcpConnection $connection, $data){
      var_dump($data);
      $connection->send('我已经接受到你发送过来得消息了');

};


$http_worker::runAll();