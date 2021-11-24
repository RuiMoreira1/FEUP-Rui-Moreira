package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.River;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

public class RiverViewerTest {

    RiverViewer viewer = new RiverViewer();
    GUI gui = Mockito.mock(GUI.class);

    @Test
    public void drawElement() {
        viewer.drawElement(new River(2,2,21, 2, 1), gui);
        Mockito.verify(gui, Mockito.times(1)).drawRectangle(new Position(2,2), 21, 2, "#89CFF0");
    }
}
