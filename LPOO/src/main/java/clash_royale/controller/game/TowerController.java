package clash_royale.controller.game;

import clash_royale.model.Player;
import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.TroopCharacter;
import clash_royale.model.game.elemets.tower.Tower;

public class TowerController extends GameController{
    public TowerController(Arena arena){
        super(arena);
    }

    public void attack(Tower tower, Player player) {
        for(Character character : player.getCharacters()) {
            if(tower.getPosition().distanceTo(character.getPosition()) <= tower.getRange())
                if (character instanceof TroopCharacter)
                    ((TroopCharacter) character).decreaseHealth(tower.getTowerHitDamage());
        }
    }
}
