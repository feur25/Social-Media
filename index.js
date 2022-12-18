// var express = require('express');
// var app = express();
// var http = require('http').createServer(app);
// var io = require('socket.io')(http);
// var count = 0;


// io.on(
//     'connection', 
//     function(socket) {
//         console.log('a user connected');
//         count++;
//         io.emit('usercnt' , count);

//         socket.on('disconnect', function(){
//             console.log('a user disconnected');
//             count--;
//             io.emit('usercnt' , count);
//         })
//         socket.on("sendmsg", function(msg){
//             io.emit("sendmsg", msg);
//         })
//     }
// )


// app.get(
//     "/", 
//     function(request, response){
//         response.sendfile(__dirname + "/index.php");
//     }
// );
// http.listen(
//     4000, function(){
//     console.log("listening on 4000 port");
// })
var server = require('http').createServer(),
    io = require('socket.io')(server),
    logger = require('winston'),
    port = 1337;

// Logger config
logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, { colorize: true, timestamp: true });
logger.info('SocketIO > listening on port ' + port);

io.on('connection', function (socket){
    var nb = 0;

    logger.info('SocketIO > Connected socket ' + socket.id);

    socket.on('broadcast', function (message) {
        ++nb;
        logger.info('ElephantIO broadcast > ' + JSON.stringify(message));

        // send to all connected clients
        io.sockets.emit("broadcast", message);
    });

    socket.on('disconnect', function () {
        logger.info('SocketIO : Received ' + nb + ' messages');
        logger.info('SocketIO > Disconnected socket ' + socket.id);
    });
});

server.listen(port);