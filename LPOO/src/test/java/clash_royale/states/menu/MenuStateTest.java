package clash_royale.states.menu;

import clash_royale.controller.menu.MenuController;
import clash_royale.model.menu.Menu;
import clash_royale.states.MenuState;
import clash_royale.states.game.GameStateTest;
import clash_royale.view.menu.MenuViewer;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class MenuStateTest {

    Menu menu = new Menu();
    MenuState menuState = new MenuState(menu);

    @Test
    public void getModel() {
        Assertions.assertEquals(menuState.getModel(), menu);
    }

    public class StateChild extends MenuState {

        public StateChild(Menu model) {
            super(model);
        }

        @Test
        public void initController() {
            Assertions.assertTrue(getController() instanceof MenuController);
        }

        @Test
        public void initViewer() {
            Assertions.assertTrue(getViewer() instanceof MenuViewer);
        }

    }

    StateChild stateChild = new StateChild(menu);

    @Test
    public void initController() {
        stateChild.initController();
    }

    @Test
    public void initViewer() {
        stateChild.initViewer();
    }

}
