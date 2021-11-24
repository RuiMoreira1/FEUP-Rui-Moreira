package clash_royale.states.game;

import clash_royale.controller.game.ArenaController;
import clash_royale.model.game.arena.Arena;
import clash_royale.states.GameState;
import clash_royale.view.game.GameViewer;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

import java.net.URISyntaxException;

public class GameStateTest {
    Arena arena;
    GameState gameState;

    @BeforeEach
    private void setUp() throws URISyntaxException {
        arena = Mockito.mock(Arena.class);
        gameState = new GameState(arena);
    }

    @Test
    public void getModel() {
        Assertions.assertEquals(gameState.getModel(), arena);
    }

    public class StateChild extends GameState {

        public StateChild(Arena model) {
            super(model);
        }

        @Test
        public void initController() {
            Assertions.assertTrue(getController() instanceof ArenaController);
        }

        @Test
        public void initViewer() {
            Assertions.assertTrue(getViewer() instanceof GameViewer);
        }
    }

    @Test
    public void initController() {
        StateChild stateChild = new StateChild(arena);
        stateChild.initController();
    }

    @Test
    public void initViewer() {
        StateChild stateChild = new StateChild(arena);
        stateChild.initViewer();
    }
}
