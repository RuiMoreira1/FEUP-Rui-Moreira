package clash_royale.model.game.elemets.tower;


import clash_royale.model.game.TowerObserver;
import clash_royale.model.game.elemets.GameElement;

public abstract class Tower extends GameElement {
    private boolean state;
    private int health;
    private final int towerHitDamage;
    private final double range;
    private TowerObserver towerObserver;

    Tower(int x, int y, int id, int towerHitDamage, double range, int health){
        super(x,y,id);
        this.towerHitDamage = towerHitDamage;
        this.range = range;
        this.health = health;
        state = true;
    }

    public boolean getState() { return state; }

    public final int getHealth() { return health; }

    public final int getTowerHitDamage() { return towerHitDamage; }

    public final double getRange() { return range; }

    public void killTower() { state = false; }

    public void decreaseHealth( int damageTaken ) {
        if (health > damageTaken)
            health -= damageTaken;
        else {
            health = 0;
            killTower();
        }
        towerObserver.healthChanged(this);
    }

    public void setTowerObserver(TowerObserver towerObserver) {
        this.towerObserver = towerObserver;
    }

}


