import {CGFobject, CGFappearance, CGFtexture} from '../lib/CGF.js';

export class MyRock extends CGFobject {
  /**
   * @method constructor
   * @param  {CGFscene} scene - MyScene object
   * @param  {integer} slices - number of slices around Y axis
   * @param  {integer} stacks - number of stacks along Y axis, from the center to the poles (half of sphere)
   */
  constructor(scene, slices, stacks) {
    super(scene);
    this.latDivs = stacks * 2;
    this.longDivs = slices;
    this.TransX = Math.floor(Math.random() * 40 ) -20;
    this.TransY = 0;
    this.TransZ = Math.floor(Math.random() * 40 ) -20;
    this.trans = [this.TransX,this.TransY,this.TransZ];
    this.ScaleX = Math.floor(Math.random() * 3)*0.1 +0.1;
    this.ScaleY = Math.floor(Math.random() * 3)*0.1 + 0.1;
    this.ScaleZ = Math.floor(Math.random() * 3)*0.1 + 0.1 ;
    this.createMaterial();
    this.initBuffers();
  }
  createMaterial() {
    //Material to use the texture with
    this.Material = new CGFappearance(this.scene);
    this.Material.setAmbient(0.0, 0.0, 0.0, 0.0);
    this.Material.setDiffuse(0.0, 0.0, 0.0, 0.0);
    this.Material.setSpecular(0.2, 0.2, 0.2, 1.0);
    this.Material.setEmission(0.2, 0.2, 0.2, 1.0);
    this.Material.setShininess(10.0);
    this.Material.setTexture(this.texture);
  }
  /**
   * @method initBuffers
   * Initializes the sphere buffers
   * TODO: DEFINE TEXTURE COORDINATES
   */
  initBuffers() {
    this.vertices = [];
    this.indices = [];
    this.normals = [];
    this.texCoords = [];

    var phi = 0;
    var theta = 0;
    var phiInc = Math.PI / this.latDivs;
    var thetaInc = (2 * Math.PI) / this.longDivs;
    var latVertices = this.longDivs + 1;

    // build an all-around stack at a time, starting on "north pole" and proceeding "south"
    for (let latitude = 0; latitude <= this.latDivs; latitude++) {
      var sinPhi = Math.sin(phi);
      var cosPhi = Math.cos(phi);

      // in each stack, build all the slices around, starting on longitude 0
      theta = 0;
      for (let longitude = 0; longitude <= this.longDivs; longitude++) {
        //--- Vertices coordinates
        var rand = (Math.floor(Math.random() * 8) + 1) * 0.02 +0.5;

        var x = Math.cos(theta) * sinPhi * rand;
        var y = cosPhi * rand;
        var z = Math.sin(-theta) * sinPhi * rand;
        this.vertices.push(x, y, z) ;

        //--- Indices
        if (latitude < this.latDivs && longitude < this.longDivs) {
          var current = latitude * latVertices + longitude;
          var next = current + latVertices;
          // pushing two triangles using indices from this round (current, current+1)
          // and the ones directly south (next, next+1)
          // (i.e. one full round of slices ahead)
          
          this.indices.push( current + 1, current, next);
          this.indices.push( current + 1, next, next +1);
        }

        //--- Normals
        // at each vertex, the direction of the normal is equal to 
        // the vector from the center of the sphere to the vertex.
        // in a sphere of radius equal to one, the vector length is one.
        // therefore, the value of the normal is equal to the position vectro
        this.normals.push(x, y, z);
        theta += thetaInc;

        //--- Texture Coordinates
        // To be done... 
        // May need some additional code also in the beginning of the function.
        this.texCoords.push(longitude/this.longDivs, latitude/this.latDivs)
        
      }
      phi += phiInc;
    }


    this.primitiveType = this.scene.gl.TRIANGLES;
    this.initGLBuffers();
  }
  display() {
    this.scene.pushMatrix();
    
    this.scene.translate(this.trans[0],this.trans[1],this.trans[2]);
    
    
    this.scene.rotate(-Math.PI/2,0,0,1);
    this.scene.scale(this.ScaleX ,this.ScaleY,this.ScaleZ );
    this.Material.apply();
    super.display();
    this.scene.popMatrix();
  }

  getCoords(){
    return [this.TransX,this.TransY,this.TransZ];
  }


}
