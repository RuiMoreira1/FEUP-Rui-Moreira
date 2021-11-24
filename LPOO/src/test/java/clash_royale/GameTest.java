package clash_royale;

import clash_royale.model.gameover.GameOver;
import clash_royale.states.GameOverState;
import clash_royale.states.MenuState;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.awt.*;
import java.io.IOException;
import java.net.URISyntaxException;

public class GameTest {

    Game game;

    @BeforeEach
    public void setUp() throws FontFormatException, IOException, URISyntaxException {
        game = new Game();
    }

    @Test
    public void testInitState() {
        Assertions.assertTrue(game.getState() instanceof MenuState);
    }

    @Test
    public void setState() {
        game.setState(new GameOverState(new GameOver()));

        Assertions.assertTrue(game.getState() instanceof GameOverState);
    }


}
