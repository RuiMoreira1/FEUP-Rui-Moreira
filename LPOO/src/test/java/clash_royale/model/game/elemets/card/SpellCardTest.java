package clash_royale.model.game.elemets.card;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.SpellCharacter;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class SpellCardTest {

    SpellCard spellCard = new SpellCard("The Log", 2, 200,'-');

    @Test
    public void getName() {
        Assertions.assertEquals("The Log", spellCard.getName());
    }

    @Test
    public void getElixirCost() {
        Assertions.assertEquals(2, spellCard.getElixirCost());
    }

    @Test
    public void getDamage() {
        Assertions.assertEquals(200, spellCard.getDamage());
    }

    @Test
    public void getRange() {
        Assertions.assertEquals(0, spellCard.getRange());
    }

    @Test
    public void getChar() {
        Assertions.assertEquals('-', spellCard.getChar());
    }

    @Test
    public void createCharacter() {
        Character character1 = spellCard.createCharacter(2, 2, 1);

        Assertions.assertTrue(character1 instanceof SpellCharacter);
        Assertions.assertEquals(character1.getCard(), spellCard);
        Assertions.assertEquals(character1.getCardChar(), spellCard.getChar());
        Assertions.assertEquals(character1.getDamage(), spellCard.getDamage());
        Assertions.assertEquals(character1.getElixirCost(), spellCard.getElixirCost());
        Assertions.assertEquals(character1.getRange(), spellCard.getRange());
    }
}
