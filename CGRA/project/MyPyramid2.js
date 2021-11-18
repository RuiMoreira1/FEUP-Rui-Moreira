import {CGFobject,CGFappearance,CGFshader} from '../lib/CGF.js';
/**
* MyPyramid
* @constructor
 * @param scene - Reference to MyScene object
 * @param slices - number of divisions around the Y axis
 * @param stacks - number of divisions along the Y axis
*/
export class MyPyramid2 extends CGFobject {
    constructor(scene, slices, stacks) {
        super(scene);
        this.slices = slices;
        this.stacks = stacks;
        this.stackdiff = 1;
        this.height = 0;
        this.initBuffers();
        this.Material = new CGFappearance(this.scene);
        this.r = (Math.floor(Math.random() * 10 )  ) * 0.1;
        this.g = (Math.floor(Math.random() * 10 )  ) * 0.1;
        this.g = (Math.floor(Math.random() * 10 )  ) * 0.1;
        this.rgb = [this.r,this.g,this.b];
        
        this.TransX = Math.floor(Math.random() * 40 ) -20;
        this.TransY = Math.floor(Math.random() * 40 ) -20;
    }
    initBuffers() {
        this.vertices = [];
        this.indices = [];
        this.normals = [];

        var ang = 0;
        var alphaAng = 2*Math.PI/this.slices;

        for(var i = 0;i <= this.stacks; i++){

            for(var j = 0; j < this.slices; j++){
                // All vertices have to be declared for a given face
                // even if they are shared with others, as the normals 
                // in each face will be different

                var sa=Math.sin(ang) ;
                var saa=Math.sin(ang+alphaAng);
                var ca=Math.cos(ang);
                var caa=Math.cos(ang+alphaAng);

                
                this.vertices.push(ca * this.stackdiff , this.height, -sa * this.stackdiff);
                this.vertices.push(caa * this.stackdiff, this.height, -saa * this.stackdiff);

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

                if(i!= 0){
                    this.indices.push(2*j+2*this.slices*i, 2*j+2*this.slices*(i-1),2*j+2*this.slices*(i-1) +1);
                    this.indices.push(2*j+2*this.slices*i, 2*j+2*this.slices*(i-1) +1,2*j+2*this.slices*i +1);
                }


                //this.indices.push(3*i, (3*i+1) , (3*i+2) );

                ang+=alphaAng;
            }

            

            this.stackdiff -= 1/this.stacks;
            this.height += 1/this.stacks;

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

        this.scene.pushMatrix();
        this.scene.translate(this.TransX,0,this.TransY);
        this.scene.scale(0.1,1,0.1);
        //
        
        
        super.display();
        
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.translate(this.TransX,0,this.TransY);
        this.scene.translate(0.2,0,0.1);
        this.scene.scale(0.1,0.6,0.1);
        
        super.display();
        
        this.scene.popMatrix();

        this.scene.pushMatrix();
        this.scene.translate(this.TransX,0,this.TransY);
        this.scene.translate(0.0,0,0.3);
        this.scene.scale(0.1,0.6,0.1);
        
        super.display();
        
        this.scene.popMatrix();


    }
}


