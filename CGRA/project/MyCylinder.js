import { CGFobject, CGFappearance, CGFtexture } from '../lib/CGF.js';

export class MyCylinder extends CGFobject {
    constructor(scene, slices) {
        super(scene);
        this.slices = slices;
        this.Material = new CGFappearance(this.scene);
        this.Material.setAmbient(0.0, 0.0, 0.0, 0.0);
        this.Material.setDiffuse(0.0, 0.0, 1.0, 1.0);
        this.Material.setSpecular(0.0, 0.0, 1.0, 1.0);
        this.Material.setEmission(0.0, 0.0, 1.0, 1.0);
        this.Material.setShininess(10.0);
        
        this.initBuffers();

    }
    initBuffers() {

        this.vertices = [];
        this.indices = [];
        this.normals = [];
        this.texCoords = [];

        var dangle = Math.PI*2/this.slices;
        var angle = 0;

        

        for(var i =0; i< this.slices; i++){

            var c1 = Math.cos(angle);
            var s1 = Math.sin(angle);
            var c2 = Math.cos(angle + dangle);
            var s2 = Math.sin(angle + dangle);

            this.vertices.push(c1,0.0,s1);
            this.vertices.push(c2,0.0,s2);
            this.vertices.push(c1,5.0,s1);
            this.vertices.push(c2,5.0,s2);

            this.indices.push(4*i,2+ 4*i,1+4*i);
            this.indices.push(1+4*i,2+4*i,3+4*i);
            

            this.normals.push(c1,0.0,s1);
            this.normals.push(c2,0.0,s2);
            this.normals.push(c1,1.0,s1);
            this.normals.push(c2,1.0,s2);

            

            angle += dangle;


        }

        this.primitiveType = this.scene.gl.TRIANGLES;
        this.initGLBuffers();
    }

    

    display() {
        this.Material.apply();
        super.display();
    }
}