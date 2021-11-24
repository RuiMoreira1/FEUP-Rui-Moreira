package clash_royale.view.menu;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.menu.Menu;
import clash_royale.view.Viewer;

public class MenuViewer extends Viewer<Menu> {
    public MenuViewer(Menu menu) {
        super(menu);
    }

    @Override
    public void drawElements(GUI gui) {
        //gui.drawBackground(width,height, "#4B8B3B");
        gui.drawText(new Position(7, 9), "Menu", "#FFFFFF", "#000000");

        for (int i = 0; i < getModel().getNumberEntries(); i++)
            gui.drawText(
                    new Position(7, 11 + i),
                    getModel().getEntry(i),
                    getModel().isSelected(i) ? "#CC0000" : "#FFFFFF", "#000000");
    }
}