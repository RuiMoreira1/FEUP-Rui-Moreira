package clash_royale.controller.game;

import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.arena.ArenaLoader;
import clash_royale.model.game.elemets.character.TroopCharacter;
import clash_royale.model.game.elemets.tower.MainTower;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.net.URISyntaxException;

public class TowerControllerTest {

    TowerController towerController;
    Arena arena;

    @BeforeEach
    private void setUp() throws URISyntaxException {

        arena = new ArenaLoader().createArena();
        towerController = new TowerController(arena);
    }

    @Test
    public void attack() {

        arena.getPlayer2().getCharacters().add(arena.getPlayer2().getCards().get(0).createCharacter(2, 2, 3)); // 3126 health
        towerController.attack(new MainTower(2, 3, 24, 320, 3, 3000), arena.getPlayer2());
        Assertions.assertEquals(((TroopCharacter) arena.getPlayer2().getCharacters().get(0)).getHealth(), 2806);

        arena.getPlayer2().getCharacters().add(arena.getPlayer2().getCards().get(0).createCharacter(10, 10, 3)); // 3126 health
        towerController.attack(new MainTower(2, 3, 24, 320, 3, 3000), arena.getPlayer2());
        Assertions.assertEquals(((TroopCharacter) arena.getPlayer2().getCharacters().get(1)).getHealth(), 3126);
    }

}
