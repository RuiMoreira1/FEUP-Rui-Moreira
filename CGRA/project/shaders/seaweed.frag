#ifdef GL_ES
precision highp float;
#endif

varying vec2 vTextureCoord;

uniform float timeFactor;
uniform vec3 color;

void main() {
    gl_FragColor = vec4(color,1.0);
}