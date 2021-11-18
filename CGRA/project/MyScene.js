import { CGFscene, CGFcamera, CGFaxis, CGFappearance } from "../lib/CGF.js";
import { MyAutomaticfish } from "./MyAutomaticfish.js";
import { MyCubeMap } from "./myCubeQuad.js";
import { MyCylinder } from "./MyCylinder.js";
import { Myfish } from "./Myfish.js";
import { MyMovingFish } from "./MyMovingFish.js";
import { MyMovingObject } from "./MyMovingObject.js";
import { MyPilarSet } from "./MyPilarSet.js";
import { MyPyramid } from "./MyPyramid.js";
import { MyRockSet } from "./MyRockSet.js";
import { MySand } from "./Mysand.js";
import { MySweeWeedSet } from "./MySeaweedSet.js";
import { MySphere } from "./MySphere.js";
import { MySurface } from "./Mysurface.js";

/**
* MyScene
* @constructor
*/
export class MyScene extends CGFscene {
    constructor() {
        super();
    }
    init(application) {
        super.init(application);
        this.initCameras();
        this.initLights();

        //Background color
        this.gl.clearColor(0.0, 0.0, 0.0, 1.0);

        this.gl.clearDepth(100.0);
        this.gl.enable(this.gl.DEPTH_TEST);
        this.gl.enable(this.gl.CULL_FACE);
        this.gl.depthFunc(this.gl.LEQUAL);

        this.setUpdatePeriod(50);
        
        this.enableTextures(true);

        //Initialize scene objects
        this.axis = new CGFaxis(this);
        //this.movingObject = new MyMovingObject(this,4,1);
        this.movingObject = new MyMovingFish(this,'images/fish_scale.jpg','images/eye.jpg',[1.0,0.0,0.0]);
        
        this.cubeMap = new MyCubeMap(this,'images/underwater_cubemap/back.jpg', 'images/underwater_cubemap/front.jpg',
        'images/underwater_cubemap/left.jpg', 'images/underwater_cubemap/right.jpg', 'images/underwater_cubemap/bottom.jpg', 'images/underwater_cubemap/top.jpg');
        this.cylinder = new MyCylinder(this,16);
        this.sphere = new MySphere(this,16,16,'images/earth.jpg');
        this.fish = new Myfish(this,'images/fish_scale.jpg','images/eye.jpg',[1.0,0.0,0.0]);
        this.sand = new MySand(this);
        this.surface = new MySurface(this);
        this.rock = new MyRockSet(this,10);
        this.pilar = new MyPilarSet(this,8);
        this.SeaWeed = new MySweeWeedSet(this,5);
        this.Autofish = new MyAutomaticfish(this,'images/fish_scale.jpg','images/eye.jpg',3,[0.0,0.0],[0.0,0.0,1.0]);
        

        this.defaultAppearance = new CGFappearance(this);
		this.defaultAppearance.setAmbient(0.2, 0.4, 0.8, 1.0);
        this.defaultAppearance.setDiffuse(0.2, 0.4, 0.8, 1.0);
        this.defaultAppearance.setSpecular(0.2, 0.4, 0.8, 1.0);
        this.defaultAppearance.setEmission(0,0,0,1);
		this.defaultAppearance.setShininess(120);

		this.sphereAppearance = new CGFappearance(this);
		this.sphereAppearance.setAmbient(0.3, 0.3, 0.3, 1);
		this.sphereAppearance.setDiffuse(0.7, 0.7, 0.7, 1);
		this.sphereAppearance.setSpecular(0.0, 0.0, 0.0, 1);
		this.sphereAppearance.setShininess(120);


        //Objects connected to MyInterface
        this.displayAxis = true;
        this.displayMovingObject = true;
        this.displaySphere = false;
        this.displayCubeMap = true;
        this.displayCylinder = false;

        this.CubeMapTextures = {'Test': 0, 'Mountains': 1, 'Water': 2};
        this.CMTexture = -1;

        this.scaleFactor = 1.0;
        this.speedFactor = 1.0;
        this.time = 0;
        this.t = 0;
        this.pick = 0;
        this.Rockpick = -1;
        this.Rockpick1 = -1;
    }
    initLights() {
        this.lights[0].setPosition(15, 2, 5, 1);
        this.lights[0].setDiffuse(1.0, 1.0, 1.0, 1.0);
        this.lights[0].enable();
        this.lights[0].update();
    }
    initCameras() {
        //this.camera = new CGFcamera(0.4, 0.1, 500, vec3.fromValues(15, 15, 15), vec3.fromValues(0, 0, 0));
        this.camera = new CGFcamera(1.7, 0.1, 500, vec3.fromValues(2, 2, 2), vec3.fromValues(0, 2, 0));
    }

    changeTexture(){
        if(this.CMTexture == 1){
            this.cubeMap.changeTexture('images/demo_cubemap/back.png', 'images/demo_cubemap/front.png',
        'images/demo_cubemap/left.png', 'images/demo_cubemap/right.png', 'images/demo_cubemap/bottom.png', 'images/demo_cubemap/top.png');
        }
        else if(this.CMTexture == 0){
            this.cubeMap.changeTexture('images/test_cubemap/pz.png', 'images/test_cubemap/nz.png',
            'images/test_cubemap/nx.png', 'images/test_cubemap/px.png', 'images/test_cubemap/ny.png', 'images/test_cubemap/py.png');
        }
        else if(this.CMTexture == 2){
            this.cubeMap.changeTexture('images/underwater_cubemap/back.jpg', 'images/underwater_cubemap/front.jpg',
            'images/underwater_cubemap/left.jpg', 'images/underwater_cubemap/right.jpg', 'images/underwater_cubemap/bottom.jpg', 'images/underwater_cubemap/top.jpg');
        }
    }

    changeScaleFactor(){
        this.movingObject.changeScaleFactor(this.scaleFactor);
    }

    changeSpeedFactor(){
        this.movingObject.changeSpeedFactor(this.speedFactor);
    }

    setDefaultAppearance() {
        this.setAmbient(0.2, 0.4, 0.8, 1.0);
        this.setDiffuse(0.2, 0.4, 0.8, 1.0);
        this.setSpecular(0.2, 0.4, 0.8, 1.0);
        this.setEmission(0,0,0,1);
        this.setShininess(10.0);
    }

    checkKeys(){
        //var text ="Keys pressed: ";
        //var keyspressed = false;


        // Check for key codes e.g. in https://keycode.info/
        if (this.gui.isKeyPressed("KeyW"))  //Speed up
            //text += " W ";
            //keyspressed = true;
            this.movingObject.accelerate(0.005);

        if (this.gui.isKeyPressed("KeyS"))  //Speed down
            //text += " S ";
            //keyspressed = true;
            this.movingObject.accelerate(-0.005);

        if (this.gui.isKeyPressed("KeyA"))  //Left seen from the back of the pyramid 
            //text += " A ";
            //keyspressed = true;
            this.movingObject.turn(Math.PI/20,1);

        if (this.gui.isKeyPressed("KeyD"))  //Right seen from the back of the pyramid 
            //text += " D ";
            //keyspressed = true;
            this.movingObject.turn(-Math.PI/20,-1);

        if (this.gui.isKeyPressed("KeyR")){
            this.movingObject.reset();
            if(this.pick == 1){
                this.rock.ResetRock(this.Rockpick);
                this.pick = 0;
            }
        }  //Reset speed, orientation and position
            //text += " R ";
            //keyspressed = true;
            
        if (this.gui.isKeyPressed("KeyP"))  //Reset speed, orientation and position
            //text += " R ";
            //keyspressed = true;
            this.movingObject.goingUp();
        if (this.gui.isKeyPressed("KeyL"))  //Reset speed, orientation and position
            //text += " R ";
            //keyspressed = true;
            this.movingObject.goingDown();
        if (this.gui.isKeyPressed("KeyC")){
            if(this.pick == 0 &&  (this.Rockpick = this.rock.CanCatch(this.movingObject.coordinatesMouth[0],this.movingObject.coordinatesMouth[1],this.movingObject.coordinatesMouth[2])) != -1){
                this.pick = 1
                
            }
            else if(this.pick == 1 &&  (this.rock.canDrop(this.movingObject.coordinatesMouth[0],this.movingObject.coordinatesMouth[1],this.movingObject.coordinatesMouth[2])) ){
                this.pick = 0
                this.rock.DropRock(this.Rockpick);
                
            }
        }  //Reset speed, orientation and position
            //text += " R ";cc
            //keyspressed = true;
            //this.rock.Rockpick(this.movingObject.coordinatesMouth[0],this.movingObject.coordinatesMouth[1],this.movingObject.coordinatesMouth[2]);

        //if(keyspressed) console.log(text);
    }

    // called periodically (as per setUpdatePeriod() in init())
    update(t){
        //To be done...
        this.checkKeys();
        this.t = t;

        

        
    }

    display() {
        // ---- BEGIN Background, camera and axis setup
        // Clear image and depth buffer everytime we update the scene
        this.gl.viewport(0, 0, this.gl.canvas.width, this.gl.canvas.height);
        this.gl.clear(this.gl.COLOR_BUFFER_BIT | this.gl.DEPTH_BUFFER_BIT);
        // Initialize Model-View matrix as identity (no transformation
        this.updateProjectionMatrix();
        this.loadIdentity();
        // Apply transformations corresponding to the camera position relative to the origin
        this.applyViewMatrix();
        
        
        this.defaultAppearance.apply();
        // Draw axis
        if (this.displayAxis)
            this.axis.display();

        this.sphereAppearance.apply();
        // ---- BEGIN Primitive drawing section

        
        if(this.displayMovingObject)this.movingObject.display();

        if(this.displayCubeMap)this.cubeMap.display();

        if(this.displayCylinder)this.cylinder.display();

        if(this.displaySphere)this.sphere.display();

        //this.fish.display();

        this.sand.display();

        

        this.surface.display();

        if(this.pick == 1){
            this.rock.Rockpick(this.Rockpick,this.movingObject.coordinatesMouth);
        }
            this.rock.display();
        

        this.pilar.display();


        this.time += 10;

        this.SeaWeed.display();

        this.Autofish.display();

        // ---- END Primitive drawing section
    }
}