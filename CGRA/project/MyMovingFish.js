import {CGFobject} from '../lib/CGF.js';
import { Myfish } from './Myfish.js';

export class MyMovingFish extends CGFobject {
    constructor(scene, body,eye,color) {
        super(scene);
        this.body = body;
        this.eye = eye;
        this.color = color;
        

        this.coordinates = [0.0,3.0,0.0];
        this.angle = 0.0;
        this.velocity = 0.0;
        this.scaleFactor = 1.0;
        this.speedFactor = 1.0;

        this.coordinatesMouth = [0.0,0.0,0.40];

        this.goingDownFlag = 0;
        this.goingUpFlag = 0;
        this.val = 0;


        
        this.initBuffers();
    }
    initBuffers() {
        this.fish = new Myfish(this.scene,this.body,this.eye,this.color);
    }
    

    display(){

        this.update();
        this.fish.turn(this.val);

        this.scene.pushMatrix();
        
        this.scene.scale(this.scaleFactor,this.scaleFactor,this.scaleFactor);
       
        this.scene.translate(this.coordinates[0],this.coordinates[1],this.coordinates[2]);

        

        

        this.scene.rotate(this.angle,0,1,0);


        //this.scene.rotate(Math.PI/2,1,0,0);
        //this.scene.translate(0,-0.5,0);
       

        this.fish.display();
        this.fish.updateVelocity(this.velocity);
        this.val = 0;
        this.scene.popMatrix();
    }

    update(){
        this.coordinates[0] += this.velocity*Math.sin(this.angle)*this.speedFactor;
        this.coordinates[2] += this.velocity*Math.cos(this.angle)*this.speedFactor;
        if(this.goingDownFlag == 1 && this.coordinates[1] > 1.50){
            this.coordinates[1] -= 0.1;
            this.goingUpFlag = 0;
        }
        else if(this.goingUpFlag == 1 && this.coordinates[1] < 3.0){
            this.coordinates[1] += 0.1;
            this.goingDownFlag = 0;
        }
        this.coordinatesMouth = [0.0,0.0,0.50];
        
        this.coordinatesMouth[0] = Math.sin(this.angle ) * 0.3;
        this.coordinatesMouth[2] =Math.cos(this.angle) * 0.3;
        this.coordinatesMouth[0] += this.coordinates[0];
        this.coordinatesMouth[1] += this.coordinates[1] -1.2;
        this.coordinatesMouth[2] += this.coordinates[2];
        
        


    }

    turn(val,side){
        this.angle +=val;
        this.val = side;
        this.angle %= Math.PI*2;
    }

    accelerate(val){
        this.velocity +=val;
    }

    reset(){
        this.coordinates = [0.0,3.0,0.0];
        this.angle = 0.0;
        this.velocity = 0.0;
        this.goingDownFlag = 0;
        this.goingUpFlag = 0;
    }

    changeScaleFactor(factor){
        this.scaleFactor = factor;
    }

    changeSpeedFactor(factor){
        this.speedFactor = factor;
    }

    goingUp(){
        this.goingUpFlag = 1;
    }

    goingDown(){
        this.goingDownFlag = 1;
    }


}


