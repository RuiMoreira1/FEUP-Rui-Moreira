package clash_royale.states;

import clash_royale.controller.Controller;
import clash_royale.controller.gameover.GameOverController;
import clash_royale.model.gameover.GameOver;
import clash_royale.view.gameover.GameOverViewer;
import clash_royale.view.Viewer;

public class GameOverState extends State<GameOver> {
    public GameOverState(GameOver model) {
        super(model);
    }

    @Override
    protected Controller<GameOver> getController() {
        return new GameOverController(getModel());
    }

    @Override
    protected Viewer<GameOver> getViewer() {
        return new GameOverViewer(getModel());
    }
}
