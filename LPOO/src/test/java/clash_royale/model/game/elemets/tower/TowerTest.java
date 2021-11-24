package clash_royale.model.game.elemets.tower;

import clash_royale.model.game.TowerObserver;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class TowerTest {

    MainTower tower = new MainTower(8, 28, 1,50, 7,2400);

    @Test
    public void getState() {
        Assertions.assertTrue(tower.getState());
    }

    @Test
    public void getHealth() {
        Assertions.assertEquals(2400, tower.getHealth());
    }

    @Test
    public void getTowerHitDamage() {
        Assertions.assertEquals(50, tower.getTowerHitDamage());
    }

    @Test
    public void getRange() {
        Assertions.assertEquals(7, tower.getRange());
    }

    @Test
    public void decreaseHealth() {

        tower.setTowerObserver(new TowerObserver() {
            @Override
            public void healthChanged(Tower tower) {

            }
        });

        tower.decreaseHealth(1000);
        Assertions.assertEquals(1400, tower.getHealth());

        tower.decreaseHealth(1400);
        Assertions.assertEquals(0, tower.getHealth());
        Assertions.assertFalse(tower.getState());
    }

}
