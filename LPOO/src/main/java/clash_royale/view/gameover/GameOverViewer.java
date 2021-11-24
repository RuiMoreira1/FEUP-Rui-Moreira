package clash_royale.view.gameover;

import clash_royale.gui.GUI;
import clash_royale.model.gameover.GameOver;
import clash_royale.model.Position;
import clash_royale.view.Viewer;

import java.io.IOException;

public class GameOverViewer extends Viewer<GameOver> {
    public GameOverViewer(GameOver model) {
        super(model);
    }

    @Override
    protected void drawElements(GUI gui) throws IOException {
        gui.drawText(new Position(5, 9), "Game Over", "#FFFFFF", "#000000");

        for (int i = 0; i < getModel().getNumberEntries(); i++)
            gui.drawText(
                    new Position(5, 11 + i),
                    getModel().getEntry(i),
                    getModel().isSelected(i) ? "#CC0000" : "#FFFFFF", "#000000");
    }

}
