package clash_royale.states.gameover;

import clash_royale.controller.gameover.GameOverController;
import clash_royale.model.gameover.GameOver;
import clash_royale.states.GameOverState;
import clash_royale.view.gameover.GameOverViewer;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class GameOverStateTest {

    GameOver gameOver = new GameOver();
    GameOverState gameOverState = new GameOverState(gameOver);

    @Test
    public void getModel() {
        Assertions.assertEquals(gameOverState.getModel(), gameOver);
    }

    public class StateChild extends GameOverState {

        public StateChild(GameOver model) {
            super(model);
        }

        @Test
        public void initController() {
            Assertions.assertTrue(getController() instanceof GameOverController);
        }

        @Test
        public void initViewer() {
            Assertions.assertTrue(getViewer() instanceof GameOverViewer);
        }
    }

    StateChild stateChild = new StateChild(gameOver);

    @Test
    public void initController() {
        stateChild.initController();
    }

    @Test
    public void initViewer() {
        stateChild.initViewer();
    }
}
