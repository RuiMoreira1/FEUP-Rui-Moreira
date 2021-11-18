import {CGFobject} from '../lib/CGF.js';
import { Myfish } from './Myfish.js';

export class MyAutomaticfish extends CGFobject {
    constructor(scene, body,eye ,dtime,center,color) {
        super(scene);
        this.body = body;
        this.eye = eye;
        this.color = color;
        
        
        this.angV = Math.PI*2/(12*(dtime));
       this.angleval = this.angV ;
        this.velocity = this.angV *5;

        this.coordinates = [center[0] -5 ,3.0,center[1]];
        
         this.angle = this.angleval;


        
        this.initBuffers();
    }
    initBuffers() {
        this.fish = new Myfish(this.scene,this.body,this.eye,this.color);
        this.fish.updateVelocity(this.velocity);
    }
    

    display(){

        this.update();

        this.scene.pushMatrix();
        
        
       
        this.scene.translate(this.coordinates[0],this.coordinates[1],this.coordinates[2]);

        

        

        this.scene.rotate(this.angle,0,1,0);


        //this.scene.rotate(Math.PI/2,1,0,0);
        //this.scene.translate(0,-0.5,0);
       

        this.fish.display();
        this.scene.popMatrix();

        this.angle = (this.angle +this.angleval) ;
    }

    update(){
        this.coordinates[0] += this.velocity*Math.sin(this.angle);
        this.coordinates[2] += this.velocity*Math.cos(this.angle);
        


    }

    


}


