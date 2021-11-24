package clash_royale.model.game;

import clash_royale.model.game.elemets.tower.Tower;

public interface TowerObserver {

    void healthChanged(Tower tower);
}
