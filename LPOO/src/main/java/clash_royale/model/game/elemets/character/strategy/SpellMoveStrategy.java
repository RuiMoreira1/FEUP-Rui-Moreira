package clash_royale.model.game.elemets.character.strategy;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.tower.Tower;

public class SpellMoveStrategy implements MoveStrategy{

    @Override
    public void move(Character character, Tower target) {
        if (target == null) return;
        character.setPosition(character.getPosition().getUp());
    }

}
