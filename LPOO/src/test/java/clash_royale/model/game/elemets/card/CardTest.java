package clash_royale.model.game.elemets.card;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class CardTest {

    TroopCard troopCard = new TroopCard("Musketeer", 4, 164, 598, 6,6,6,'-');;
    SpellCard spellCard = new SpellCard("The Log", 2, 200,'-');

    @Test
    public void equals() {
        Assertions.assertEquals(troopCard, troopCard);
        Assertions.assertNotEquals(troopCard, spellCard);
    }
}
