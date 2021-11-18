attribute vec3 aVertexPosition;
attribute vec3 aVertexNormal;
attribute vec2 aTextureCoord;

uniform mat4 uMVMatrix;
uniform mat4 uPMatrix;
uniform mat4 uNMatrix;

uniform sampler2D uSampler2;
uniform sampler2D uSampler;
varying vec2 vTextureCoord;
varying vec4 coord;


void main() {
    vec3 offset = vec3(0.0,0.0,0.0);

    vTextureCoord = aTextureCoord;
    vec4 watermap = texture2D(uSampler, aTextureCoord);
    


    offset = aVertexNormal*watermap.r * 0.1;


    gl_Position = uPMatrix * uMVMatrix * vec4(aVertexPosition+offset, 1.0);

    

}