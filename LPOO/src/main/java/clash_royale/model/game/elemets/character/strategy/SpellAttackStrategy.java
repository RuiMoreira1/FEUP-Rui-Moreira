package clash_royale.model.game.elemets.character.strategy;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.SpellCharacter;
import clash_royale.model.game.elemets.tower.Tower;

public class SpellAttackStrategy implements AttackStrategy {
    @Override
    public void attack(Character character, Tower target) {

        if (target == null) return;

        if(character.getPosition().equals(target.getPosition())) {
            target.decreaseHealth(character.getDamage());
            ((SpellCharacter)character).setDead(true);
        }
    }
}
