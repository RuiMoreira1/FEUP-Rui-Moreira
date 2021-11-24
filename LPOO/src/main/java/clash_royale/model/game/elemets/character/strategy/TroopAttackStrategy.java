package clash_royale.model.game.elemets.character.strategy;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.tower.Tower;

public class TroopAttackStrategy implements AttackStrategy {
    @Override
    public void attack(Character character, Tower target) {

        if (target == null) return;

        if(character.getPosition().distanceTo(target.getPosition()) > character.getRange()) return;

        if(character.getPosition().distanceTo(target.getPosition()) <= character.getRange()) {
            target.decreaseHealth(character.getDamage());
            //((TroopCharacter) character).decreaseHealth(target.getTowerHitDamage());
        }
    }
}
