package clash_royale.controller.game;

import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.arena.ArenaLoader;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.net.URISyntaxException;

public class PlayerControllerTest {

    Arena arena;
    PlayerController playerController;

    @BeforeEach
    private void setUp() throws URISyntaxException {

        arena = new ArenaLoader().createArena();
        playerController = new PlayerController(arena);
    }

    @Test
    public void getArena() {
        Assertions.assertEquals(arena, playerController.getArena());
    }

    @Test
    public void playCard() {

    }
}
