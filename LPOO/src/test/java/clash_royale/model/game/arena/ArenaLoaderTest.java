package clash_royale.model.game.arena;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.net.URISyntaxException;

public class ArenaLoaderTest {

    Arena arena;

    @BeforeEach
    private void setUp() throws URISyntaxException {
        arena = (new ArenaLoader()).createArena();
    }

    @Test
    public void getWidth() {
        Assertions.assertEquals(21, arena.getWidth());
    }

    @Test
    public void getHeight() {
        Assertions.assertEquals(25, arena.getHeight());
    }
}
