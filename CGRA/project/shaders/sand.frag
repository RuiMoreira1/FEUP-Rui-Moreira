#ifdef GL_ES
precision highp float;
#endif

varying vec2 vTextureCoord;

uniform sampler2D uSampler2;
uniform sampler2D uSampler;

void main() {

    vec4 color = texture2D(uSampler2, vTextureCoord);
    vec4 map = texture2D(uSampler ,vTextureCoord);

    if(map.r <0.5){
        color -= vec4(map.rgb *0.2,0.0);
    }

    
    


    

    

    gl_FragColor = color;
}