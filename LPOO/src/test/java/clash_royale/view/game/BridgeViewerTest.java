package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.Bridge;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

public class BridgeViewerTest {

    BridgeViewer viewer = new BridgeViewer();
    GUI gui = Mockito.mock(GUI.class);

    @Test
    public void drawElement() {
        viewer.drawElement(new Bridge(2,2,1, 2, 3), gui);
        Mockito.verify(gui, Mockito.times(1)).drawRectangle(new Position(2,2), 2, 3, "#9B7653");
    }
}
