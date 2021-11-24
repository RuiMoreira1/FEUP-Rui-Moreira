package clash_royale.model.game.elemets.character;

import clash_royale.model.Position;
import clash_royale.model.game.TowerObserver;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.character.strategy.TroopAttackStrategy;
import clash_royale.model.game.elemets.character.strategy.TroopMoveStrategy;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class TroopCharacterTest {

    TroopCard troopCard = new TroopCard("Musketeer", 4, 164, 598, 6,6,6,'-');
    TroopCharacter troopCharacter = (TroopCharacter) troopCard.createCharacter(7,7, 1);

    @Test
    public void getRange() {
        Assertions.assertEquals(troopCard.getRange(), troopCharacter.getRange());
    }

    @Test
    public void getHealth() {
        Assertions.assertEquals(troopCard.getHealth(), troopCharacter.getHealth());
    }

    @Test
    public void decreaseHealth() {

        troopCharacter.decreaseHealth(100);

        Assertions.assertEquals(498, troopCharacter.getHealth());

        troopCharacter.decreaseHealth(498);

        Assertions.assertEquals(0, troopCharacter.getHealth());

        troopCharacter.decreaseHealth(200);

        Assertions.assertEquals(0, troopCharacter.getHealth());
    }

    @Test
    public void move() {
        troopCharacter.move(new SubTower(6, 7, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(7, 7));

        troopCharacter.move(new SubTower(7, 7, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(7, 7));

        troopCharacter.move(new SubTower(7, 19, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(7, 8));

        troopCharacter.move(new SubTower(19, 8, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(8, 8));

        troopCharacter.move(new SubTower(0, 8, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(7, 8));

        troopCharacter.move(new SubTower(8, 0, 2, 300, 4, 4000));
        Assertions.assertEquals(troopCharacter.getPosition(), new Position(7, 7));
    }

    @Test
    public void attack() {
        Tower tower1 = new SubTower(8, 0, 2, 300, 4, 4000);
        troopCharacter.attack(tower1);
        Assertions.assertEquals(tower1.getHealth(), 4000);

        Tower tower2 = new SubTower(8, 8, 2, 300, 4, 4000);
        tower2.setTowerObserver(new TowerObserver() {
            @Override
            public void healthChanged(Tower tower) {

            }
        });
        troopCharacter.attack(tower2);
        Assertions.assertEquals(tower2.getHealth(), 3836);

    }

    @Test
    public void equals() {

        TroopCharacter equalCharacter = new TroopCharacter(7,7, 1, troopCard, new TroopMoveStrategy(), new TroopAttackStrategy());
        TroopCharacter difPosCharacter = new TroopCharacter(7,3, 3, troopCard, new TroopMoveStrategy(), new TroopAttackStrategy());

        TroopCard difCard = new TroopCard("Giant", 5, 140, 3275, 1.2,6,6,'-');
        TroopCharacter difCardCharacter = new TroopCharacter(7,7, 4, difCard, new TroopMoveStrategy(), new TroopAttackStrategy());

        Assertions.assertTrue(troopCharacter.equals(equalCharacter) && equalCharacter.equals(troopCharacter));
        Assertions.assertEquals(equalCharacter.hashCode(), troopCharacter.hashCode());

        Assertions.assertFalse(troopCharacter.equals(difPosCharacter) && difPosCharacter.equals(troopCharacter));
        Assertions.assertNotEquals(difPosCharacter.hashCode(), troopCharacter.hashCode());

        Assertions.assertFalse(troopCharacter.equals(difCardCharacter) && difCardCharacter.equals(troopCharacter));
        Assertions.assertNotEquals(difCardCharacter.hashCode(), troopCharacter.hashCode());
    }
}
