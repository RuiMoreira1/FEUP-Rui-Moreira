uniform mat4 uMVMatrix;
uniform mat4 uPMatrix;
uniform mat4 uNMatrix;

attribute vec3 aVertexPosition;
attribute vec3 aVertexNormal;

uniform float timeFactor;
varying vec2 vTextureCoord;
varying vec4 coord;



void main() {
   

    
        

        
      float   offset =timeFactor * 0.5 ;
    
    

    if(aVertexPosition.y < 0.1){
        gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition.x ,aVertexPosition.y,aVertexPosition.z, 1.0);
        
    }
    else if(aVertexPosition.y > 0.5){
        gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition.x - offset,aVertexPosition.y,aVertexPosition.z, 1.0);
    }
    else{
        gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition.x + offset,aVertexPosition.y,aVertexPosition.z, 1.0);

    }
    


}