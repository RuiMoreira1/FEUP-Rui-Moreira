#ifdef GL_ES
precision highp float;
#endif

varying vec2 vTextureCoord;
varying vec3 coords;
uniform sampler2D uSampler;
uniform vec3 rgb;

void main() {
    if(coords.x < 0.4)
	gl_FragColor = texture2D(uSampler, vTextureCoord);
    else {
    gl_FragColor= vec4(rgb,1.0);}
    
}