<!DOCTYPE html>
<html>
  <head>
    <title>Simple Private Chat </title>
    <style>
         { margin: 0; padding: 0; box-sizing: border-box; }
        body { font: 13px Helvetica, Arial; }
        form { background: #fff; padding: 3px; position: fixed; bottom: 0; width: 100%; border-color: #000; border-top-style: solid; border-top-width: 1px;}
        form input { border-style: solid; border-width: 1px; padding: 10px; width: 85%; margin-right: .5%; }
        form button { width: 9%; background: rgb(255, 225, 255); border: none; padding: 10px; margin-left: 2%; }
        #messages { list-style-type: none; margin: 0; padding: 0; }
        #messages li { padding: 5px 10px; }
        #messages li:nth-child(odd) { background: #eee; }
    </style>
<script src="js/jquery.js"></script>
<script src="js/socket.io.js"></script>
<script>
  var io = io("http://localhost:8080");
 
  var receiver = "";
  var sender = "";
 
</script>
  </head>
  <body>
    <ul id="messages"></ul>
    <form action="/" method="POST" id="chatForm">
      <input id="txt" autocomplete="off" autofocus="on" oninput="isTyping()" placeholder="type your message here..." /><button>Send</button>
    </form>
    <script>
            var socket = io.connect('http://localhost:8080');
            $('form').submit(function(e){
                e.preventDefault();
                socket.emit('chat_message', $('#txt').val());
                $('#txt').val('');
                return false;
            });
            socket.on('chat_message', function(msg){
                $('#messages').append($('<li>').html(msg));
            });
            socket.on('is_online', function(username) {
                $('#messages').append($('<li>').html(username));
            });
            var username = prompt('Please tell me your name');
            socket.emit('username', username);
    </script>
  </body>
</html>