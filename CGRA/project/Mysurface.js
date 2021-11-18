import { CGFobject, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MyPlane } from "./MyPlane.js";

export class MySurface extends CGFobject {
    constructor(scene) {
        super(scene);
        
        this.text = new CGFtexture(this.scene,'./images/pier.jpg');
        this.textmap = new CGFtexture(this.scene,'./images/distortionmap.png');
        this.time = 30.0;
        this.surfaceShader = new CGFshader(this.scene.gl,"./shaders/surface.vert","./shaders/surface.frag");
        
        this.surfaceShader.setUniformsValues({timeFactor : 0.0 , uSampler2: 1});
        
        this.initBuffers();
    }
    initBuffers() {
        this.plane = new MyPlane(this.scene,20);
    }
      
    
    display() {
        this.textmap.bind(1);
        this.text.bind(0);

        this.scene.pushMatrix();
        this.scene.setActiveShader(this.surfaceShader);
        this.scene.translate(0,10,0);
       
        this.scene.rotate(Math.PI/2,1,0,0);
        this.scene.scale(50,50,50);
        this.plane.display();
        this.scene.setActiveShader(this.scene.defaultShader);
        this.scene.popMatrix();
        this.surfaceShader.setUniformsValues({timeFactor : this.scene.t/10000 % 10});
    }
}