package clash_royale.model.game.elemets.character.strategy;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.tower.Tower;

public interface AttackStrategy {
    public void attack(Character character, Tower target);
}
