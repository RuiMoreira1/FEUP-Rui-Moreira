package clash_royale.controller.menu;

import clash_royale.Game;
import clash_royale.controller.Controller;
import clash_royale.gui.GUI;
import clash_royale.model.game.arena.ArenaLoader;
import clash_royale.model.menu.Menu;
import clash_royale.states.GameState;

import java.io.IOException;
import java.net.URISyntaxException;

public class MenuController extends Controller<Menu> {
    public MenuController(Menu model) {
        super(model);
    }

    @Override
    public void step(Game game, GUI.ACTION action, long time, int id) throws IOException, URISyntaxException {
        switch (action) {
            case UP:
                getModel().previousEntry();
                break;
            case DOWN:
                getModel().nextEntry();
                break;
            case SELECT:
                if (getModel().isSelectedExit()) game.setState(null);
                if (getModel().isSelectedStart()) game.setState(new GameState(new ArenaLoader().createArena()));
        }
    }
}
