import {CGFobject} from '../lib/CGF.js';

export class MyUnitCubeQuad extends CGFobject {
	constructor(scene) {
		super(scene);
	}
    display(scene){
        scene.quad.display(scene);

        scene.pushMatrix();
        scene.rotate(Math.PI,1,0,0);
        scene.translate(0,0,1);
        scene.quad.display(scene);
        scene.popMatrix();

        scene.pushMatrix();
        scene.rotate(Math.PI/2,1,0,0);
        scene.translate(0,-0.5,0.5);
        scene.quad.display(scene);
        scene.popMatrix();

        scene.pushMatrix();
        scene.rotate(-Math.PI/2,1,0,0);
        scene.translate(0,0.5,0.5);
        scene.quad.display(scene);
        scene.popMatrix();

        scene.pushMatrix();
        scene.rotate(-Math.PI/2,0,1,0);
        scene.translate(-0.5,0,0.5);
        scene.quad.display(scene);
        scene.popMatrix();

        scene.pushMatrix();
        scene.rotate(Math.PI/2,0,1,0);
        scene.translate(0.5,0,0.5);
        scene.quad.display(scene);
        scene.popMatrix();
    }
    
}