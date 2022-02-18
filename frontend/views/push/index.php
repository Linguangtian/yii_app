<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title></title>
</head>

<body>
<h3>WebSocket协议的客户端程序</h3>
<button id="btConnect">连接到WS服务器</button>
<button id="btSendAndReceive">向WS服务器发消息并接收消息</button>
<button id="btClose">断开与WS服务器的连接</button>
<div id="val"></div>
<script type="text/javascript">
    var wsClient=null;
    btConnect.onclick=function(){
        wsClient=new WebSocket('ws://127.0.0.1:1234'); //这个端口号和容器监听的端口号一致
        console.log(wsClient)
        wsClient.onopen = function(){
            var uid = 'uid1';
            // 表名自己是uid1
            wsClient.send(uid);
            console.log('ws客户端已经成功连接到服务器上')
        }
        wsClient.onmessage = function(e){
            console.log('ws客户端收到一个服务器消息：'+e.data);
            val.innerHTML=e.data;
        }
    }
    btSendAndReceive.onclick = function(){
        wsClient.send('Hello Server');
        wsClient.onmessage = function(e){
            console.log('ws客户端收到一个服务器消息：'+e.data);
            val.innerHTML=e.data;
        }
    }
    btClose.onclick = function(){
        wsClient.close();
        wsClient.onclose = function(){
            console.log('到服务器的连接已经断开');
        }
    }
</script>
</body>
</html>


