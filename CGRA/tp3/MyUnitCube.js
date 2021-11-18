import {CGFobject} from '../lib/CGF.js';
/**
 * MyUnitCube
 * @constructor
 * @param scene - Reference to MyScene object
 */
export class MyUnitCube extends CGFobject {
	constructor(scene) {
		super(scene);
		this.initBuffers();
	}
	
	initBuffers() {
		this.vertices = [
			-0.5,-0.5,-0.5,
            0.5,-0.5,-0.5,
            -0.5,0.5,-0.5,
            0.5,0.5,-0.5,
            -0.5,-0.5,0.5,
            0.5,-0.5,0.5,
            -0.5,0.5,0.5,
            0.5,0.5,0.5,
			-0.5,-0.5,-0.5,
            0.5,-0.5,-0.5,
            -0.5,0.5,-0.5,
            0.5,0.5,-0.5,
            -0.5,-0.5,0.5,
            0.5,-0.5,0.5,
            -0.5,0.5,0.5,
            0.5,0.5,0.5,
			-0.5,-0.5,-0.5,
            0.5,-0.5,-0.5,
            -0.5,0.5,-0.5,
            0.5,0.5,-0.5,
            -0.5,-0.5,0.5,
            0.5,-0.5,0.5,
            -0.5,0.5,0.5,
            0.5,0.5,0.5
        ];

		//Counter-clockwise reference of vertices
		this.indices = [
			0,2,1, //face 1
            3,1,2,
            0,1,5, // face 2
            5,4,0,
			7,5,1, // face 3
			1,3,7,
			6,7,3, // face 4
			3,2,6,
			4,6,2,
			2,0,4,
			4,5,7,
			7,6,4
		];

		this.normals = [
			0,0,-1,
			0,0,-1,
			0,0,-1,
			0,0,-1,
			0,0,1,
			0,0,1,
			0,0,1,
			0,0,1,
			0,-1,0,
			0,-1,0,
			0,1,0,
			0,1,0,
			0,-1,0,
			0,-1,0,
			0,1,0,
			0,1,0,
			-1,0,0,
			1,0,0,
			-1,0,0,
			1,0,0,
			-1,0,0,
			1,0,0,
			-1,0,0,
			1,0,0
		];
		
		

		//The defined indices (and corresponding vertices)
		//will be read in groups of three to draw triangles
		this.primitiveType = this.scene.gl.TRIANGLES;

		this.initGLBuffers();
	}
}

