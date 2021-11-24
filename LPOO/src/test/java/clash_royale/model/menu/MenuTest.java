package clash_royale.model.menu;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class MenuTest {
    Menu menu = new Menu();

    @Test
    public void nextEntry() {
        menu.nextEntry();
        Assertions.assertTrue(menu.isSelectedExit());
        Assertions.assertFalse(menu.isSelectedStart());
        menu.nextEntry();
        Assertions.assertFalse(menu.isSelectedExit());
        Assertions.assertTrue(menu.isSelectedStart());
    }

    @Test
    public void previousEntry() {
        menu.previousEntry();
        menu.previousEntry();
        Assertions.assertTrue(menu.isSelectedStart());
    }

    @Test
    public void getEntry() {
        Assertions.assertEquals(menu.getEntry(0), "Start");
        Assertions.assertEquals(menu.getEntry(1), "Exit");
    }

    @Test
    public void getNumberEntries() {
        Assertions.assertEquals(menu.getNumberEntries(), 2);
    }
}
