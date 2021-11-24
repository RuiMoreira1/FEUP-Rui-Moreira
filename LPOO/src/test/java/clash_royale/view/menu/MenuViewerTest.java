package clash_royale.view.menu;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.menu.Menu;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

import java.io.IOException;

public class MenuViewerTest {

    Menu menu;
    MenuViewer viewer;
    GUI gui;

    @BeforeEach
    private void setUp() {
        menu = new Menu();
        viewer = new MenuViewer(menu);
        gui = Mockito.mock(GUI.class);
    }

    @Test
    public void drawElementStart() throws IOException {
        viewer.draw(gui);

        Mockito.verify(gui, Mockito.times(1)).clear();
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 9), "Menu", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 11), "Start", "#CC0000", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 12), "Exit", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).refresh();

    }

    @Test
    public void drawElementExit() throws IOException {

        menu.nextEntry();
        viewer.draw(gui);

        Mockito.verify(gui, Mockito.times(1)).clear();
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 9), "Menu", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 11), "Start", "#FFFFFF", "#000000");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7, 12), "Exit", "#CC0000", "#000000");
        Mockito.verify(gui, Mockito.times(1)).refresh();
    }
}
