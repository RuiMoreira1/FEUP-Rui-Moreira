package clash_royale.model.game.elemets.character;

import clash_royale.model.Position;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.character.strategy.AttackStrategy;
import clash_royale.model.game.elemets.character.strategy.MoveStrategy;
import clash_royale.model.game.elemets.tower.Tower;

import java.util.LinkedList;
import java.util.Queue;

public class SpellCharacter extends Character {

    private final Position initialPosition;
    private boolean dead;

    public SpellCharacter(int x, int y, int id, SpellCard card, MoveStrategy moveStrategy, AttackStrategy attackStrategy) {
        super(x,y, card,id, moveStrategy, attackStrategy);
        this.initialPosition = getPosition();
        this.dead = false;
    }

    public Position getInitialPosition() {
        return initialPosition;
    }

    public boolean isDead() {
        return dead;
    }

    public void setDead(boolean d) {
        this.dead = d;
    }
}

