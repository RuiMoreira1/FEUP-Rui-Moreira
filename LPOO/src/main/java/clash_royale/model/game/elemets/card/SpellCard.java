package clash_royale.model.game.elemets.card;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.strategy.SpellAttackStrategy;
import clash_royale.model.game.elemets.character.strategy.SpellMoveStrategy;
import clash_royale.model.game.elemets.character.SpellCharacter;

public class SpellCard extends Card {

    public SpellCard(String name, int elixirCost, int damage, char cardChar) {
        super(name, elixirCost, damage, 0.0, cardChar);
    }

    @Override
    public Character createCharacter(int x, int y, int id) {
        return new SpellCharacter(x, y, id, this, new SpellMoveStrategy(), new SpellAttackStrategy());
    }
}
