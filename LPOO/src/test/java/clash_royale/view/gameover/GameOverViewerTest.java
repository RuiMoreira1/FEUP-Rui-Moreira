package clash_royale.view.gameover;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.gameover.GameOver;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

import java.io.IOException;

public class GameOverViewerTest {

    GameOver gameOver;
    GameOverViewer viewer;
    GUI gui;

    @BeforeEach
    private void setUp() {
        gameOver = new GameOver();
        viewer = new GameOverViewer(gameOver);
        gui = Mockito.mock(GUI.class);
    }

    @Test
    public void drawElementPlayAgain() throws IOException {
        viewer.draw(gui);

        Mockito.verify(gui, Mockito.times(1)).clear();
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 9), "Game Over", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 11), "Play Again", "#CC0000", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 12), "Exit", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).refresh();

    }

    @Test
    public void drawElementExit() throws IOException {

        gameOver.nextEntry();
        viewer.draw(gui);

        Mockito.verify(gui, Mockito.times(1)).clear();
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 9), "Game Over", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 11), "Play Again", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(5, 12), "Exit", "#CC0000", "#000000");
        Mockito.verify(gui, Mockito.times(1)).refresh();
    }

}
