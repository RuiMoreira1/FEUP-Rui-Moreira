import {CGFobject} from '../lib/CGF.js';

export class MyTangram extends CGFobject {
	constructor(scene) {
		super(scene);
		/*scene.diamond = new MyDiamond(scene);
        scene.triangle = new MyTriangle(scene);
        scene.par = new MyParallelogram(scene);
        scene.STriangle = new MyTriangleSmall(scene);
        scene.BTriangle = new MyTriangleBig(scene);*/
	}
    display(scene){
        scene.pushMatrix();
    var m1 = [1,0,0,0,
      0,1,0,0,
      0,0,1,0,
      0,1,0,1
      ]
    scene.multMatrix(m1);
     scene.diamond.display();  
    scene.popMatrix();
    // ---- BEGIN Primitive drawing section

    scene.pushMatrix();
    scene.translate(1.4,1.4,0);
    scene.rotate(-3*Math.PI / 4,0,0,1);
    
     scene.BTriangle.display();
    scene.popMatrix();

    scene.pushMatrix();
    scene.rotate(Math.PI,0,0,1);
    scene.translate(-1,-2,0);
     scene.STriangle.display();
    scene.popMatrix();

    scene.pushMatrix();
    scene.rotate(-Math.PI/2,0,0,1);
    scene.translate(-2,-1,0);
     scene.STriangle.display();
    scene.popMatrix();

    scene.pushMatrix();
    scene.translate(4.225,1.4,0);
    scene.rotate(Math.PI / 4,0,0,1);
    
     scene.BTriangle.display();
    scene.popMatrix();

    scene.pushMatrix();

    scene.rotate(Math.PI ,1,0,0);
    scene.rotate(-Math.PI/4 ,0,0,1);
    scene.translate(2,2,0);
    
     scene.par.display();
    scene.popMatrix();

    scene.pushMatrix();
    scene.rotate(Math.PI/4,0,0,1)
    scene.translate(2.4,3,0);
    scene.triangle.display();
    scene.popMatrix();
    }
}