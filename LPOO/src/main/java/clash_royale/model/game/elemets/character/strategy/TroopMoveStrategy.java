package clash_royale.model.game.elemets.character.strategy;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.tower.Tower;

public class TroopMoveStrategy implements MoveStrategy{
    @Override
    public void move(Character character, Tower target) {

        if (target == null) return;

        if(character.getPosition().distanceTo(target.getPosition()) < character.getRange()) return;

        if(character.getY() > target.getY())
            character.setPosition(character.getPosition().getUp());
        else if(character.getY() < target.getY())
            character.setPosition(character.getPosition().getDown());
        else if(character.getX() < target.getX())
            character.setPosition(character.getPosition().getRight());
        else if(character.getX() > target.getX())
            character.setPosition(character.getPosition().getLeft());

    }
}
