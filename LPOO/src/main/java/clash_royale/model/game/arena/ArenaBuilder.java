package clash_royale.model.game.arena;

import clash_royale.model.Player;
import clash_royale.model.game.elemets.Boundary;
import clash_royale.model.game.elemets.Bridge;
import clash_royale.model.game.elemets.River;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.tower.Tower;

import java.io.File;
import java.util.List;

public abstract class ArenaBuilder {
    public Arena createArena(){
        List<Card> playerCards = createCards();
        List<Tower> towers =  createTowers();
        List<Tower> player1Towers = assignTower(towers,3);
        List<Tower> player2Towers = assignTower(towers,0);
        List<Bridge> bridges = createBridges();
        List<Boundary> boundaries = createBoundariesCards();

        return new Arena(getWidth(), getHeight(),createPlayer1(playerCards,player1Towers),createPlayer2(playerCards,player2Towers), createRiver(), bridges, boundaries);

    }

    protected abstract List<Tower> assignTower(List<Tower> towers, int cap);

    protected abstract List<Tower> createTowers();

    protected abstract List<Bridge> createBridges();

    protected abstract River createRiver();

    protected abstract List<Card> createCards();

    protected abstract TroopCard troopCardLoader(String[] array ) throws NumberFormatException;

    protected abstract SpellCard spellCardLoader(String[] array ) throws NumberFormatException;

    protected abstract List<String> getLines(File myFile);

    protected abstract int getWidth();

    protected abstract int getHeight();

    protected abstract List<Boundary> createBoundariesCards();

    protected abstract Player createPlayer1(List<Card> cards, List<Tower> tower);

    protected abstract Player createPlayer2(List<Card> cards, List<Tower> tower);

}
