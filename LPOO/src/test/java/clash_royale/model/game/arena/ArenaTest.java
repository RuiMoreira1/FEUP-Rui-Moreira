package clash_royale.model.game.arena;

import clash_royale.model.Player;
import clash_royale.model.game.elemets.Boundary;
import clash_royale.model.game.elemets.Bridge;
import clash_royale.model.game.elemets.River;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.tower.MainTower;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.util.ArrayList;
import java.util.List;

public class ArenaTest {

    int width = 18;
    int height = 32;

    SpellCard card1  = new SpellCard("The Log", 2, 200,'-');
    SpellCard card2 = new SpellCard("Snowball", 2, 159,'-');
    SpellCard card3 = new SpellCard("Fireball", 4, 572,'-');
    SpellCard card4 = new SpellCard("Rocket", 6, 1232,'-');

    TroopCard card5  = new TroopCard("Musketeer", 4, 164, 598, 6,6,6,'-');
    TroopCard card6  = new TroopCard("Mini-Pekka", 4, 123, 1129, 0.8,6,6,'-');
    TroopCard card7  = new TroopCard("Prince", 5, 232, 1669, 1.6,6,6,'-');
    TroopCard card8  = new TroopCard("Giant", 5, 140, 3275, 1.2,6,6,'-');

    List<Tower> towers1 = new ArrayList<>();
    List<Tower> towers2 = new ArrayList<>();
    List<Card> cards = new ArrayList<>();

    List<Bridge> bridges = new ArrayList<>();
    River river = new River(0,height/2, width, 1, 125);

    List<Boundary> boundaries = new ArrayList<>();

    Player player1;
    Player player2;

    Arena arena;

    @BeforeEach
    private void setUp() {
        towers1.add(new MainTower(8, 28, 1,50, 7,2400));
        towers1.add(new SubTower(3, 25, 2, 50, 7.5,1400));
        towers1.add(new SubTower(14, 25, 3, 50, 7.5,1400));

        towers2.add(new MainTower(8, 2, 4,50, 7,2400));
        towers2.add(new SubTower(3, 4, 5, 50, 7.5,1400));
        towers2.add(new SubTower(14, 4, 6, 50, 7.5,1400));

        cards.add(card1);
        cards.add(card2);
        cards.add(card3);
        cards.add(card4);
        cards.add(card5);
        cards.add(card6);
        cards.add(card7);
        cards.add(card8);

        bridges.add(new Bridge(2, height/2 - 1, 123, 3, 3));
        bridges.add(new Bridge(width - 2 - 3, height/2 - 1, 124, 3, 3));

        player1 = new Player(towers1, cards, "#CC0000");
        player2 = new Player(towers2, cards, "#0060FF");

        arena = new Arena(18, 32, player1, player2, river, bridges, boundaries);
    }

    @Test
    public void getWidth() {
        Assertions.assertEquals(18, arena.getWidth());
    }

    @Test
    public void getHeight() {
        Assertions.assertEquals(32, arena.getHeight());
    }

    @Test
    public void getPlayer1() {
;       Assertions.assertEquals(player1, arena.getPlayer1());
    }

    @Test
    public void getPlayer2() {
        Assertions.assertEquals(player2, arena.getPlayer2());
    }

    /*@Test
    public void getBoundaries(){

    }*/

    @Test
    public void getBridges() {
        Assertions.assertEquals(bridges, arena.getBridges());
    }

    @Test
    public void getRiver() {
        Assertions.assertEquals(river, arena.getRiver());
    }

    @Test
    public void getPlayerOpponent() {
        Assertions.assertEquals(player2, arena.getOpponent(player1));
        Assertions.assertEquals(player1, arena.getOpponent(player2));
    }

    @Test
    public void getElementPlayer() {
        Assertions.assertEquals(player2, arena.getPlayer(towers2.get(0)));
    }

    @Test
    public void getElementOpponent() {
        Assertions.assertEquals(player1, arena.getOpponent(towers2.get(0)));
    }

    /*@Test
    public void setBoundaries(List<Boundarie> boundaries ){

    }*/

    @Test
    public void getTowerList(){
        List<Tower> list = new ArrayList<>();

        list.addAll(player1.getTowers());
        list.addAll(player2.getTowers());

        Assertions.assertEquals(list, arena.getTowerList());
    }

    @Test
    public void getCharacterList(){
        List<Character> list = new ArrayList<>();

        list.addAll(player1.getCharacters());
        list.addAll(player2.getCharacters());

        Assertions.assertEquals(list, arena.getCharacterList());
    }

    @Test
    public void increaseElixir() {
        Assertions.assertEquals(5, arena.getPlayer1().getElixir());
        Assertions.assertEquals(5, arena.getPlayer2().getElixir());
        arena.increaseElixir();
        Assertions.assertEquals(6, arena.getPlayer1().getElixir());
        Assertions.assertEquals(6, arena.getPlayer2().getElixir());
    }

}
