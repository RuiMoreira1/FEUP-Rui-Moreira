package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.tower.MainTower;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

public class TowerViewerTest {
    TowerViewer viewer = new TowerViewer();
    GUI gui = Mockito.mock(GUI.class);

    @Test
    public void drawElement() {
        viewer.drawElement(new MainTower(2,2,1, 200, 5, 2000), gui);
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(2,2));
    }
}
