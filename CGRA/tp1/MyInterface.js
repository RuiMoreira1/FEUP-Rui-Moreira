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
        this.gui.add(this.scene, 'displayDiamond').name('Display_Diamond');
        this.gui.add(this.scene, 'displayTriangle').name('Display Triangle');
        this.gui.add(this.scene, 'displayPar').name('Display_Parallelogram');
        this.gui.add(this.scene, 'displaySmallTriangle').name('Display_SmallTriangle');
        this.gui.add(this.scene, 'displayBigTriangle').name('Display_BigTriangle');

        //Slider element in GUI
        this.gui.add(this.scene, 'scaleFactor', 0.1, 5).name('Scale Factor');

        
        



        return true;
    }
}