#ifdef GL_ES
precision highp float;
#endif

varying vec2 vTextureCoord;

uniform sampler2D uSampler2;
uniform sampler2D uSampler;

uniform float timeFactor;

void main() {

    vec2 offset = vec2(0.0 ,0.0) ;
    vec4 map = texture2D(uSampler2,vTextureCoord + timeFactor * 0.1 );

    
    offset = vTextureCoord  + vec2(map.r -0.5, map.g -0.5) ;
    

    if( offset.s > 0.999){
        offset.s = 0.999;
    }

    else if( offset.s < 0.001){
        offset.s = 0.001;
    }

    if( offset.t > 0.999){
        offset.t = 0.999;
    }

    else if( offset.t < 0.001){
        offset.t = 0.001;
    }
    vec4 color = texture2D(uSampler, offset );

    

    gl_FragColor = color;
}