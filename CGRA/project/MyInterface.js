import {CGFinterface, dat} from '../lib/CGF.js';

/**
* MyInterface
* @constructor
*/
export class MyInterface extends CGFinterface {
    constructor() {
        super();
    }

    initKeys() {
        // create reference from the scene to the GUI
        this.scene.gui = this;

        // disable the processKeyboard function
        this.processKeyboard = function(){};

        // create a named array to store which keys are being pressed
        this.activeKeys = {};
    }


    processKeyDown(event) {
        // called when a key is pressed down
        // mark it as active in the array
        this.activeKeys[event.code] = true;
    };


    processKeyUp(event) {
        // called when a key is released, mark it as inactive in the array
        this.activeKeys[event.code] = false;
    };


    isKeyPressed(keyCode) {
        if( this.activeKeys[keyCode] === true && (keyCode == "keyL" || keyCode == "keyP")) {
            this.activeKeys[keyCode] = false;
            return true;
        }  
        return this.activeKeys[keyCode] || false;
    }


    init(application) {
        // call CGFinterface init
        super.init(application);
        // init GUI. For more information on the methods, check:
        // http://workshop.chromeexperiments.com/examples/gui
        this.gui = new dat.GUI();
        
        var obj = this;

        //Checkbox element in GUI
        this.gui.add(this.scene, 'displayAxis').name('Display Axis');

        var Objects = this.gui.addFolder('Objects');
        Objects.add(this.scene, 'displayMovingObject').name('Moving Object');
        Objects.add(this.scene, 'displaySphere').name('Sphere');
        Objects.add(this.scene, 'displayCubeMap').name('Cube Map');
        Objects.add(this.scene, 'displayCylinder').name('Cylinder');

        this.gui.add(this.scene, 'CMTexture', this.scene.CubeMapTextures).name('Cube Map Texture').onChange(this.scene.changeTexture.bind(this.scene));

        this.gui.add(this.scene, 'scaleFactor',0.5,3).name('Scale Factor').onChange(this.scene.changeScaleFactor.bind(this.scene));

        this.gui.add(this.scene, 'speedFactor',0.1,3).name('Speed Factor').onChange(this.scene.changeSpeedFactor.bind(this.scene));

        //Initialize keys
        this.initKeys();

        return true;
    }
}