import { CGFobject, CGFappearance, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MybodySphere } from "./MybodySphere.js";
import { MySphere } from "./MySphere.js";
import { MyTriangle } from "./MyTriangle.js";
import { MyTriangleSmall } from "./MyTriangleSmall.js";

export class Myfish extends CGFobject {
    constructor(scene, body,eye,color) {
        super(scene);
        
        this.Bodytext = body;
        this.Bodytext1 = new CGFtexture(this.scene,body);
        this.Eyetext = eye
        this.velocity = 1;
        this.val = 0;
        this.mat = new CGFappearance(this.scene);
        this.mat.setAmbient(0.0, 0.0, 0.0, 0.0);
        this.mat.setDiffuse(0.0, 0.0, 0.0, 0.0);
        this.mat.setSpecular(0.0, 0.0, 0.0, 0.0);
        this.mat.setEmission(color[0],color[1],color[2], 1.0);
        this.mat.setShininess(10.0);
        this.fishShader = new CGFshader(this.scene.gl,"./shaders/fish.vert","./shaders/fish.frag");
        this.fishShader.setUniformsValues({scaleSampler : 0, rgb: color});
        
        this.initBuffers();
    }
    initBuffers() {
        this.body = new MybodySphere(this.scene,16,16,this.Bodytext,1.3,1,0.75);
        this.leftFin = new MyTriangleSmall(this.scene);
        this.RightFin = new MyTriangleSmall(this.scene);
        this.BackFin = new MyTriangleSmall(this.scene);
        this.UpperFin = new MyTriangleSmall(this.scene);
        this.LeftEye = new MySphere(this.scene,30,30,this.Eyetext);
        this.RightEye = new MySphere(this.scene,30,30,this.Eyetext);
    }
    
    display() {
        this.scene.pushMatrix();
        this.scene.translate(0,0,0);
        this.scene.scale(0.4,0.4,0.4);

        this.Bodytext1.bind(0);

        this.scene.pushMatrix();
        this.scene.setActiveShader(this.fishShader);
        this.scene.rotate(-Math.PI/2,0,1,0);
        this.body.display();
        this.scene.setActiveShader(this.scene.defaultShader);
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.scale(0.4,0.4,0.4);
        this.scene.translate(2,0,0);
        this.scene.translate(0,0,-1.2);
        this.scene.rotate(Math.PI/4,0,0,1);
        this.scene.translate(0,0,1);
        this.scene.rotate(Math.PI/2,0,1,0);
        if(this.val != 1){
          this.scene.rotate(-Math.sin(this.scene.time / 100 % 1000) / 3.0, 1, 0, 0);  
        }
        
        this.scene.translate(0,-1.2,0);
        this.scene.rotate(Math.PI*3/4,0,0,1);
        this.scene.translate(0,-1,0);
        this.mat.apply(); 
        this.RightFin.display();
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.scale(0.4,0.4,0.4);
        this.scene.translate(-2,0,0);
        this.scene.translate(0,0,-1.2);
        this.scene.rotate(-Math.PI/4,0,0,1);
        this.scene.translate(0,0,1);
        this.scene.rotate(Math.PI/2,0,1,0);
        if(this.val != -1){
          this.scene.rotate(Math.sin(this.scene.time / 100 % 1000) / 3.0, 1, 0, 0);  
        }
        
        this.scene.translate(0,-1.2,0);
        this.scene.rotate(Math.PI*3/4,0,0,1);
        this.scene.translate(0,-1,0);
        this.RightFin.display();
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.scale(0.4,0.4,0.4);
        this.scene.translate(0,0,-0.6);
        this.scene.translate(0,2.45,0);
        this.scene.rotate(Math.PI/2,0,-1,0);
        this.scene.rotate(Math.PI*3/4,0,0,1);
        this.scene.translate(0,-1,0);
        this.UpperFin.display();
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.scale(0.8,0.8,0.8);
        this.scene.translate(0,0,-1.6);
        this.scene.rotate(-Math.sin(this.scene.time / (50/(this.velocity*10)) % 1000) / 3.0, 0, 1, 0);
        this.scene.translate(0,0,-1);
        this.scene.rotate(Math.PI/2,1,0,0);
        this.scene.rotate(Math.PI/2,0,1,0);
        this.BackFin.display();
        this.scene.popMatrix();

        this.scene.pushMatrix();
        //
        this.scene.translate(-0.5,0.2,0);
        this.scene.translate(0,0,0.8);
        this.scene.rotate(2*Math.PI/6,0,1,0);
        this.scene.scale(0.2,0.2,0.2);
        this.LeftEye.display();
        this.scene.popMatrix();

        this.scene.pushMatrix();
        //
        this.scene.translate(0.5,0.2,0);
        this.scene.translate(0,0,0.8);
        this.scene.rotate(4*Math.PI/6,0,1,0);
        this.scene.scale(0.2,0.2,0.2);
        this.LeftEye.display();
        this.scene.popMatrix();

        this.scene.popMatrix();
       

    }

    updateVelocity(velocity){
        this.velocity = velocity +0.1;
    }


    turn(val){
        this.val = val;
    }
}