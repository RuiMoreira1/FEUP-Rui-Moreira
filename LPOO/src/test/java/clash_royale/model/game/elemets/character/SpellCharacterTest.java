package clash_royale.model.game.elemets.character;

import clash_royale.model.Position;
import clash_royale.model.game.TowerObserver;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

public class SpellCharacterTest {

    Position initialPosition;
    Position finalPosition;
    SpellCard spellCard;
    SpellCharacter spellCharacter;

    @BeforeEach
    private void helper() {
        initialPosition = new Position(9,29);
        finalPosition = new Position(4, 7);
        spellCard = new SpellCard("The Log", 2, 200,'-');
        spellCharacter = (SpellCharacter) spellCard.createCharacter(9, 29, 1);
    }

    @Test
    public void getRange() {
        Assertions.assertEquals(0.0, spellCharacter.getRange());
    }

    @Test
    public void getCard() {
        Assertions.assertEquals(spellCard, spellCharacter.getCard());
    }

    @Test
    public void getInitialPosition() {
        Assertions.assertEquals(initialPosition, spellCharacter.getInitialPosition());
    }

    @Test
    public void move() {

    }

    @Test
    public void attack() {
        Tower tower1 = new SubTower(9, 30, 2, 300, 4, 4000);
        spellCharacter.attack(tower1);
        Assertions.assertEquals(tower1.getHealth(), 4000);

        Tower tower2 = new SubTower(9, 29, 2, 300, 4, 4000);
        tower2.setTowerObserver(new TowerObserver() {
            @Override
            public void healthChanged(Tower tower) {

            }
        });
        spellCharacter.attack(tower2);
        Assertions.assertEquals(tower2.getHealth(), 3800);
    }

}
