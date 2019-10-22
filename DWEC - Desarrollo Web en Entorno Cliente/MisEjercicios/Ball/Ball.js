class Ball {

    constructor(x, y, radio, ctx){
        this.x = x;
        this.y = y;
        this.radio = radio;
        this.ctx = ctx;
    }

    draw(){
        this.ctx.beginPath();
        this.ctx.arc(this.x, this.y, this.radio, 0, 2 * Math.PI);
        this.ctx.stroke();

        this.update();
    }

    update(){
        //requestAnimationFrame(this.draw);
        if(this.y > 0){
            this.y--;
        } else {
            this.y++;
        }

        //this.draw();
    }

} // End of the class