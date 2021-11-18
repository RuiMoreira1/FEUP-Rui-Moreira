import {CGFinterface, dat} from '../lib/CGF.js';
import { MyDiamond } from "./MyDiamond.js";
/**
* MyInterface
* @constructor
*/
export class MyInterface extends CGFinterface {
    constructor() {
        super();
    }

    init(application) {
        // call CGFinterface init
        super.init(application);
        
        // init GUI. For more information on the methods, check:
        // https://github.com/dataarts/dat.gui/blob/master/API.md
        this.gui = new dat.GUI();

        //Checkbox element in GUI
        this.gui.add(this.scene, 'displayAxis').name('Display Axis');
        this.gui.add(this.scene, 'displaytangram').name('Display Tangram');
        this.gui.add(this.scene, 'displayMyCube').name('Display MyCube');
        

        //Slider element in GUI
        this.gui.add(this.scene, 'scaleFactor', 0.1, 5).name('Scale Factor');

        
        



        return true;
    }
}