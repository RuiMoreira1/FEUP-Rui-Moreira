package clash_royale.model.game.elemets.card;

import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.strategy.TroopAttackStrategy;
import clash_royale.model.game.elemets.character.strategy.TroopMoveStrategy;
import clash_royale.model.game.elemets.character.TroopCharacter;

public class TroopCard extends Card {
    private final int health;
    private final int dps;
    private final double hitSpeed;
    private  TROOPTYPE type;

    public TroopCard(String name, int elixirCost, int damage, int health, double range, double hitSpeed, int dps, char cardChar) {
        super(name, elixirCost, damage, range,cardChar);
        this.health = health;
        this.dps = dps;
        this.hitSpeed = hitSpeed;
    }

    public int getHealth() {
        return health;
    }

    @Override
    public Character createCharacter(int x, int y, int id) {
        return new TroopCharacter(x, y,id, this, new TroopMoveStrategy(), new TroopAttackStrategy());
    }

    enum TROOPTYPE {RANGE, MELEE};

}
