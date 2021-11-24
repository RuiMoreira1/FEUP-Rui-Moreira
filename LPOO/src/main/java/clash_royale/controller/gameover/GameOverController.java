package clash_royale.controller.gameover;

import clash_royale.Game;
import clash_royale.controller.Controller;
import clash_royale.gui.GUI;
import clash_royale.model.gameover.GameOver;
import clash_royale.model.game.arena.ArenaLoader;
import clash_royale.states.GameState;

import java.io.IOException;
import java.net.URISyntaxException;

public class GameOverController extends Controller<GameOver> {
    public GameOverController(GameOver model) {
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
                if (getModel().isSelectedPlayAgain()) game.setState(new GameState(new ArenaLoader().createArena()));
        }
    }
}
