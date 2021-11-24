package clash_royale.model.gameover;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

public class GameOverTest {

    GameOver gameOver;

    @BeforeEach
    private void setUp() {
        gameOver = new GameOver();
    }

    @Test
    public void nextEntry() {
        gameOver.nextEntry();
        Assertions.assertTrue(gameOver.isSelectedExit());
        Assertions.assertFalse(gameOver.isSelectedPlayAgain());
        gameOver.nextEntry();
        Assertions.assertFalse(gameOver.isSelectedExit());
        Assertions.assertTrue(gameOver.isSelectedPlayAgain());
    }

    @Test
    public void previousEntry() {
        gameOver.previousEntry();
        gameOver.previousEntry();
        Assertions.assertTrue(gameOver.isSelectedPlayAgain());
    }

    @Test
    public void getEntry() {
        Assertions.assertEquals(gameOver.getEntry(0), "Play Again");
        Assertions.assertEquals(gameOver.getEntry(1), "Exit");
    }

    @Test
    public void getNumberEntries() {
        Assertions.assertEquals(gameOver.getNumberEntries(), 2);
    }
}
