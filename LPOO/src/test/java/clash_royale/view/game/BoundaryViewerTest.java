package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.Boundary;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

public class BoundaryViewerTest {

    BoundaryViewer viewer = new BoundaryViewer();
    GUI gui = Mockito.mock(GUI.class);

    @Test
    public void drawElement() {
        viewer.drawElement(new Boundary(2,2,1), gui);
        Mockito.verify(gui, Mockito.times(1)).drawBoundaries(new Position(2,2));
    }
}
