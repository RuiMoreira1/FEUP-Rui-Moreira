import { CGFobject, CGFappearance, CGFtexture, CGFshader } from "../lib/CGF.js";
import { MyPlane } from "./MyPlane.js";

export class MySand extends CGFobject {
    constructor(scene) {
        super(scene);
        
        this.text = new CGFtexture(this.scene,'./images/sand3.png');
        this.textmap = new CGFtexture(this.scene,'./images/sandmap3.png');
        this.sandShader = new CGFshader(this.scene.gl,"./shaders/sand.vert","./shaders/sand.frag");
        this.sandShader.setUniformsValues({uSampler2: 1});
        
        this.initBuffers();
    }
    initBuffers() {
        this.plane = new MyPlane(this.scene,30);
    }
      
    
    display() {
        this.textmap.bind(0);
        this.text.bind(1);

        this.scene.pushMatrix();
        this.scene.setActiveShader(this.sandShader);
        this.scene.translate(0,-1.7,0);
        this.scene.scale(50,50,50);
        this.scene.rotate(-Math.PI/2,1,0,0)
        this.plane.display();
        this.scene.setActiveShader(this.scene.defaultShader);
        this.scene.popMatrix();
    }
}