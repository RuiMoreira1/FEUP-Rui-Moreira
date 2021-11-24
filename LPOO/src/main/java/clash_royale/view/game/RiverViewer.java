package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.River;

public class RiverViewer implements ElementViewer<River> {

    @Override
    public void drawElement(River river, GUI gui) {
        gui.drawRectangle(river.getPosition(), river.getWidth(), river.getHeight(),"#89CFF0");
    }
}
