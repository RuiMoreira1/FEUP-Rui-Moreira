package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.Bridge;

public class BridgeViewer implements ElementViewer<Bridge>{

    @Override
    public void drawElement(Bridge bridge, GUI gui) {
        gui.drawRectangle(bridge.getPosition(), bridge.getWidth(), bridge.getHeight(),"#9B7653");
    }
}
