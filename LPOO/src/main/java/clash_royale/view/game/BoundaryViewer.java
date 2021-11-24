package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.Boundary;

public class BoundaryViewer implements ElementViewer<Boundary> {

    @Override
    public void drawElement(Boundary boundary, GUI gui){
        gui.drawBoundaries(boundary.getPosition());
    }

}
