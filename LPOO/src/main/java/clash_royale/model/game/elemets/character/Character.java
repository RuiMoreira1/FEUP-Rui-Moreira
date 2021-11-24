package clash_royale.model.game.elemets.character;

import clash_royale.model.game.elemets.character.strategy.AttackStrategy;
import clash_royale.model.game.elemets.GameElement;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.character.strategy.MoveStrategy;
import clash_royale.model.game.elemets.tower.Tower;

public abstract class Character extends GameElement {
    private final Card card;
    private final MoveStrategy moveStrategy;
    private final AttackStrategy attackStrategy;

    Character(int x, int y, Card card, int id, MoveStrategy moveStrategy, AttackStrategy attackStrategy) {
        super(x,y,id);
        this.card = card;
        this.moveStrategy = moveStrategy;
        this.attackStrategy = attackStrategy;
    }

    public Card getCard() {
        return card;
    }

    public double getRange() {
        return getCard().getRange();
    }

    public int getDamage() {
        return getCard().getDamage();
    }

    public int getElixirCost() {
        return getCard().getElixirCost();
    }

    public void move(Tower target) {
        this.moveStrategy.move(this, target);
    }

    public void attack(Tower target) {
        this.attackStrategy.attack(this, target);
    }

    public char getCardChar() { return  this.card.getChar(); }

}

