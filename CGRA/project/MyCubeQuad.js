import { CGFobject, CGFappearance, CGFtexture } from "../lib/CGF.js";
import { MyQuad } from "./MyQuad.js";

export class MyCubeMap extends CGFobject {
    constructor(scene, back, front, left, right, bottom, head) {
        super(scene);
        this.initBuffers();

        this.back = new CGFtexture(this.scene,back);
        this.front = new CGFtexture(this.scene,front);
        this.left = new CGFtexture(this.scene,left);
        this.right = new CGFtexture(this.scene,right);
        this.bottom = new CGFtexture(this.scene,bottom);
        this.head = new CGFtexture(this.scene,head);

        this.mat = new CGFappearance(this.scene);
        this.mat.setAmbient(0.0, 0.0, 0.0, 0.0);
        this.mat.setDiffuse(0.0, 0.0, 0.0, 0.0);
        this.mat.setSpecular(0.0, 0.0, 0.0, 0.0);
        this.mat.setEmission(1.0, 1.0, 1.0, 1.0);
        this.mat.setShininess(10.0);
    }
    initBuffers() {
        this.quad = new MyQuad(this.scene);
    }
    
    display() {

        this.scene.pushMatrix();
        this.scene.translate(this.scene.camera.position[0], this.scene.camera.position[1], this.scene.camera.position[2]);
        this.scene.scale(500,500,500);
        //this.scene.popMatrix();


        

        //back
        this.scene.pushMatrix();
        this.mat.setTexture(this.back);
        this.mat.apply();
        this.scene.rotate(Math.PI,0,1,0);
        this.scene.translate(0.0, 0.0, -0.5);
        this.quad.display();
        this.scene.popMatrix();

        //front
        this.scene.pushMatrix();
        this.mat.setTexture(this.front);
        this.mat.apply();
        this.scene.translate(0.0, 0.0, -0.5);
        this.quad.display();
        this.scene.popMatrix();

        //left
        this.scene.pushMatrix();
        this.mat.setTexture(this.left);
        this.mat.apply();
        this.scene.translate(-0.5,0.0,0);
        this.scene.rotate(Math.PI/2,0,1,0);
        this.quad.display();
        this.scene.popMatrix();

        //right
        this.scene.pushMatrix();
        this.mat.setTexture(this.right);
        this.mat.apply();
        this.scene.translate(0.5,0.0,0);
        this.scene.rotate(Math.PI/2,0,-1,0);
        this.quad.display();
        this.scene.popMatrix();

        //bottom
        this.scene.pushMatrix();
        this.mat.setTexture(this.bottom);
        this.mat.apply();
        this.scene.translate(0,-0.5,0);
        this.scene.rotate(Math.PI/2,-1,0,0);
        this.quad.display();
        this.scene.popMatrix();

        //head
        this.scene.pushMatrix();
        this.mat.setTexture(this.head);
        this.mat.apply();
        this.scene.translate(0,0.5,0);
        this.scene.rotate(Math.PI/2,1,0,0);
        this.quad.display();
        this.scene.popMatrix();

        this.scene.popMatrix();

    }
    changeTexture( back, front, left, right, bottom, head){
        this.back = new CGFtexture(this.scene,back);
        this.front = new CGFtexture(this.scene,front);
        this.left = new CGFtexture(this.scene,left);
        this.right = new CGFtexture(this.scene,right);
        this.bottom = new CGFtexture(this.scene,bottom);
        this.head = new CGFtexture(this.scene,head);
    }
}