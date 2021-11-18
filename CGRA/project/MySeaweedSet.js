import { CGFobject, CGFappearance, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MyPyramid } from "./MyPyramid.js";
import { MyPyramid2 } from "./MyPyramid2.js";


export class MySweeWeedSet extends CGFobject {
    constructor(scene,number) {
        super(scene);
        
        this.number = number;

        this.Seaweeds = [];

        this.swShader = new CGFshader(this.scene.gl,"./shaders/seaweed.vert","./shaders/seaweed.frag");
        this.swShader.setUniformsValues({timeFactor : 0.0, color : this.rgb});
        
        this.initBuffers();
    }
    initBuffers() {
        for(var i=0; i<this.number;i++){
            this.Seaweeds.push( new MyPyramid2(this.scene,4,3));
        }
    }
    
    display() {
        this.scene.pushMatrix();

        this.scene.setActiveShader(this.swShader);

        for(var i=0; i<this.number;i++){
            this.swShader.setUniformsValues({color : this.Seaweeds[i].rgb });
            this.scene.pushMatrix();
            this.scene.translate(0,0.8,0);
            this.Seaweeds[i].display();
        this.scene.popMatrix();
        }
      
        this.scene.setActiveShader(this.scene.defaultShader);

        this.swShader.setUniformsValues({timeFactor : Math.sin( this.scene.t/500 % 100)});

        this.scene.popMatrix();

    }
}