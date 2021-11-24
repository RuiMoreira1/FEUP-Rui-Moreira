package clash_royale.model.game.elemets.card;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.TroopCharacter;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class TroopCardTest {

    TroopCard troopCard = new TroopCard("Musketeer", 4, 164, 598, 6,6,6,'-');;

    @Test
    public void getRange() {
        Assertions.assertEquals(6, troopCard.getRange());
    }

    @Test
    public void getHealth() {
        Assertions.assertEquals(598, troopCard.getHealth());
    }

    @Test
    public void createCharacter() {
        Character character2 = troopCard.createCharacter(2, 2, 2);

        Assertions.assertTrue(character2 instanceof TroopCharacter);
        Assertions.assertEquals(character2.getCard(), troopCard);
        Assertions.assertEquals(character2.getCardChar(), troopCard.getChar());
        Assertions.assertEquals(character2.getDamage(), troopCard.getDamage());
        Assertions.assertEquals(character2.getElixirCost(), troopCard.getElixirCost());
        Assertions.assertEquals(character2.getRange(), troopCard.getRange());
    }
}
