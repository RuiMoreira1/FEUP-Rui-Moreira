import { CGFobject, CGFappearance, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MyRock } from "./MyRock.js";


export class MyRockSet extends CGFobject {
    constructor(scene,number) {
        super(scene);
        
        this.number = number;

        this.rocks = [];

        this.nestCoord = [-13.0,0,15.0];

        this.nestRocks = [];

        this.nRockCount = 0;

        this.nestRcoods = [ [-14.0,0,14.0], [-15.0,0,15.0], [-12.0,0,16.0],
        [-13.0,0,14.0], [-13.0,0,15.0]];

        
        
        this.initBuffers();
    }
    
    initBuffers() {
        for(var i=0; i<this.number;i++){
            this.rocks.push( new MyRock(this.scene,10,10));
        }
    }
    
    display() {
        

        for(var i=0; i<this.rocks.length;i++){
            this.scene.pushMatrix();
            this.scene.translate(0,0.8,0);
            this.rocks[i].display();
        this.scene.popMatrix();
        }

        for(var i=0; i<this.nestRocks.length;i++){
            this.scene.pushMatrix();
            this.scene.translate(0,0.35,0);
            this.nestRocks[i].display();
        this.scene.popMatrix();
        }
      
       

    }

    Rockpick(i,trans1){
        
            this.rocks[i].trans = trans1;
        
    }

    CanCatch(x,y,z){

        
        for(var i in this.rocks){
            if(y < 1.2){
                
                //console.log(this.rocks[i].TransZ);
                //console.log(this.rocks[i].TransX);
                if( Math.sqrt(Math.pow(x - this.rocks[i].TransX,2) +Math.pow(z - this.rocks[i].TransZ,2)) < 1){
                    
                    return i;
                }
            }
        }
        return -1;

    }

    canDrop(x,y,z){
        if(y < 1.2){
            if( Math.sqrt(Math.pow(x - this.nestCoord[0],2) +Math.pow(z - this.nestCoord[2],2)) < 3){
                
                return true;
            }
        }
        return false;
    }

    DropRock(i){
        
        this.rocks[i].trans = this.nestRcoods[this.nRockCount];
        this.nestRocks.push(this.rocks[i]);
        this.rocks.splice(i,1);
        this.nRockCount ++;
    }

    ResetRock(i){
        this.rocks[i].trans = this.rocks[i].getCoords();
    }

    


}