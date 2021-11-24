package clash_royale.model.game.elemets.character;

import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.character.strategy.AttackStrategy;
import clash_royale.model.game.elemets.character.strategy.MoveStrategy;

public class TroopCharacter extends Character {

    private int health;

    public TroopCharacter(int x, int y, int id, TroopCard card, MoveStrategy moveStrategy, AttackStrategy attackStrategy) {
        super(x, y, card, id, moveStrategy, attackStrategy);
        this.health = card.getHealth();
    }

    public int getHealth() {
        return health;
    }

    public double getRange() {
        return getCard().getRange();
    }

    public void decreaseHealth(int damage) {
        if (health > damage)
            health -= damage;
        else
            health = 0;
    }
}
