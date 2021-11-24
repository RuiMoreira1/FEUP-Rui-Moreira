package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.GameElement;

public interface ElementViewer<T extends GameElement> {
    void drawElement(T element, GUI gui);
}
