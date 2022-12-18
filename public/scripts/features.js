console.log("tg");


var socket = io();
socket.on(
    'usercnt', 
    function(msg){
        document.getElementById("count").innerHTML = msg;
    }
);
socket.on("sendmsg", function(msg){
    document.getElementById("messages").innerHTML += msg + "<br>" ;
})
function sendmsg(){
    socket.emit("sendmsg", document.getElementById("message").value);
}