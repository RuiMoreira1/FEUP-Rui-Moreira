package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.tower.Tower;

public class TowerViewer implements ElementViewer<Tower> {

    @Override
    public void drawElement(Tower tower, GUI gui){
        if(!tower.getState()) return;
        gui.drawTower(tower.getPosition());
    }

}
