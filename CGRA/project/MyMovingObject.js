import {CGFobject} from '../lib/CGF.js';
/**
* MyPyramid
* @constructor
 * @param scene - Reference to MyScene object
 * @param slices - number of divisions around the Y axis
 * @param stacks - number of divisions along the Y axis
*/
export class MyMovingObject extends CGFobject {
    constructor(scene, slices, stacks) {
        super(scene);
        this.slices = slices;
        this.stacks = stacks;
        

        this.coordinates = [0.0,0.0,0.0];
        this.angle = 0.0;
        this.velocity = 0.0;
        this.scaleFactor = 1.0;
        this.speedFactor = 1.0;
        
        this.initBuffers();
    }
    initBuffers() {
        this.vertices = [];
        this.indices = [];
        this.normals = [];

        var ang = 0;
        var alphaAng = 2*Math.PI/this.slices;

        for(var i = 0; i < this.slices; i++){
            // All vertices have to be declared for a given face
            // even if they are shared with others, as the normals 
            // in each face will be different

            var sa=Math.sin(ang);
            var saa=Math.sin(ang+alphaAng);
            var ca=Math.cos(ang);
            var caa=Math.cos(ang+alphaAng);

            this.vertices.push(0,1,0);
            this.vertices.push(ca, 0, -sa);
            this.vertices.push(caa, 0, -saa);
            
            this.vertices.push(ca, 0, -sa);
            this.vertices.push(caa, 0, -saa);

            // triangle normal computed by cross product of two edges
            var normal= [
                saa-sa,
                ca*saa-sa*caa,
                caa-ca
            ];

            // normalization
            var nsize=Math.sqrt(
                normal[0]*normal[0]+
                normal[1]*normal[1]+
                normal[2]*normal[2]
                );
            normal[0]/=nsize;
            normal[1]/=nsize;
            normal[2]/=nsize;

            // push normal once for each vertex of this triangle
            this.normals.push(...normal);
            this.normals.push(...normal);
            this.normals.push(...normal);

            
            this.normals.push(0.0, -1.0, 0.0);
            this.normals.push(0.0, -1.0, 0.0);

            this.indices.push(5*i, (5*i+1) , (5*i+2) );
            this.indices.push(1, 5*i + 2, 5*i + 1);

            ang+=alphaAng;
        }

        this.primitiveType = this.scene.gl.TRIANGLES;
        this.initGLBuffers();
    }
    /**
     * Called when user interacts with GUI to change object's complexity.
     * @param {integer} complexity - changes number of slices
     */
    updateBuffers(complexity){
        this.slices = 3 + Math.round(9 * complexity); //complexity varies 0-1, so slices varies 3-12

        // reinitialize buffers
        this.initBuffers();
        this.initNormalVizBuffers();
    }

    display(){

        this.update();

        this.scene.pushMatrix();
        
        this.scene.scale(this.scaleFactor,this.scaleFactor,this.scaleFactor);
        this.scene.translate(this.coordinates[0],this.coordinates[1],this.coordinates[2]);
        this.scene.rotate(this.angle,0,1,0);



        this.scene.rotate(Math.PI/2,1,0,0);
        this.scene.translate(0,-0.5,0);
       

        super.display();
        this.scene.popMatrix();
    }

    update(){
        this.coordinates[0] += this.velocity*Math.sin(this.angle)*this.speedFactor;
        this.coordinates[2] += this.velocity*Math.cos(this.angle)*this.speedFactor;
    }

    turn(val){
        this.angle +=val;
        this.angle %= Math.PI*2;
    }

    accelerate(val){
        this.velocity +=val;
    }

    reset(){
        this.coordinates = [0.0,0.0,0.0];
        this.angle = 0.0;
        this.velocity = 0.0;
    }

    changeScaleFactor(factor){
        this.scaleFactor = factor;
    }

    changeSpeedFactor(factor){
        this.speedFactor = factor;
    }


}


