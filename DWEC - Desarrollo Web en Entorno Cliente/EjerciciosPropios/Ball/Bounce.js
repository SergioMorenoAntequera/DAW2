
var canvas = document.getElementById("c");
var ctx = canvas.getContext("2d");

//ctx.beginPath();
//ctx.arc(95,50,40,0,2*Math.PI);
//ctx.stroke();

var ball = new Ball(50, 50, 5, ctx);
ball.draw();