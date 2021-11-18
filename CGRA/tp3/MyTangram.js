import {CGFobject, CGFappearance} from '../lib/CGF.js';


export class MyTangram extends CGFobject {
     scene;
	constructor(scene1) {
		super(scene1);
        this.scene= scene1;
        this.material4 = new CGFappearance(this.scene);
        this.material4.setAmbient(0,0,0, 1.0);
        //this.material4.setDiffuse(0.424, 0.184, 0, 1.0);
        this.material4.setSpecular(1, 1, 1, 1.0);
        this.material4.setShininess(10.0);
		/*this.scene.diamond = new MyDiamond(this.scene);
        this.scene.triangle = new MyTriangle(this.scene);
        this.scene.par = new MyParallelogram(scene);
        scene.STriangle = new MyTriangleSmall(scene);
        scene.BTriangle = new MyTriangleBig(scene);*/
	}
    display(){
    this.scene.pushMatrix();
    var m1 = [1,0,0,0,
      0,1,0,0,
      0,0,1,0,
      0,1,0,1
      ]
    this.scene.multMatrix(m1);
    this.material4.setDiffuse(0.224, 1, 0.078, 1.0);
    this.material4.apply();
    this.scene.diamond.display();  
    this.scene.popMatrix();
    // ---- BEGIN Primitive drawing section

    this.scene.pushMatrix();
    this.scene.translate(1.4,1.4,0);
    this.scene.rotate(-3*Math.PI / 4,0,0,1);
    this.material4.setDiffuse(0, 0.492, 0.863, 1.0);
    this.material4.apply();
     this.scene.BTriangle.display();
    this.scene.popMatrix();

    this.scene.pushMatrix();
    this.scene.rotate(Math.PI,0,0,1);
    this.scene.translate(-1,-2,0);
    this.material4.setDiffuse(0.303, 0.02, 0.47, 1.0);
    this.material4.apply();
     this.scene.STriangle.display();
    this.scene.popMatrix();

    this.scene.pushMatrix();
    this.scene.rotate(-Math.PI/2,0,0,1);
    this.scene.translate(-2,-1,0);
    this.material4.setDiffuse(1, 0, 0, 1.0);
    this.material4.apply();
     this.scene.STriangle.display();
    this.scene.popMatrix();

    this.scene.pushMatrix();
    this.scene.translate(4.225,1.4,0);
    this.scene.rotate(Math.PI / 4,0,0,1);
    this.material4.setDiffuse(1, 0.6, 0, 1.0);
    this.material4.apply();
     this.scene.BTriangle.display();
    this.scene.popMatrix();

    this.scene.pushMatrix();

    this.scene.rotate(Math.PI ,1,0,0);
    this.scene.rotate(-Math.PI/4 ,0,0,1);
    this.scene.translate(2,2,0);
    this.material4.setDiffuse(1, 0.9, 0, 1.0);
    this.material4.apply();
     this.scene.par.display();
    this.scene.popMatrix();

    this.scene.pushMatrix();
    this.scene.rotate(Math.PI/4,0,0,1)
    this.scene.translate(2.4,3,0);
    this.material4.setDiffuse(0.9, 0.63, 0.69, 1.0);
    this.material4.apply();
    this.scene.triangle.display();
    this.scene.popMatrix();
    }
}