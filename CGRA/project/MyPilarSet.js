import { CGFobject, CGFappearance, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MyPilar } from "./MyPilar.js";


export class MyPilarSet extends CGFobject {
    constructor(scene,number) {
        super(scene);

        this.number = number;
        this.pilars = [];
        this.dif = 20/((number-2)/2);
        
        
        this.initBuffers();
    }
    initBuffers() {

        for(var i=0; i<this.number;i++){
            this.pilars.push( new MyPilar(this.scene,16,'images/tree.jpg'));
        }
    }
    
    
    display() {

        for(var i=0; i<this.number/2;i++){
            this.scene.pushMatrix();
            this.scene.translate(3 + this.dif*i,0,-3.5);
            this.scene.scale(0.5,2,0.5);
            this.pilars[i].display();
            this.scene.popMatrix();
        }

        var j = 0;
        for(var i=  this.number/2 ; i<this.number;i++){
            
            this.scene.pushMatrix();
            this.scene.translate(3 + this.dif*j,0,-0.5);
            this.scene.scale(0.5,2,0.5);
            this.pilars[i].display();
            this.scene.popMatrix();
            j++;
        }

        
        
      
       

    }
}