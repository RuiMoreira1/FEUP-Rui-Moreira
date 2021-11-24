package clash_royale.model;

import clash_royale.model.game.elemets.GameElement;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.TroopCharacter;
import clash_royale.model.game.elemets.character.strategy.TroopAttackStrategy;
import clash_royale.model.game.elemets.character.strategy.TroopMoveStrategy;
import clash_royale.model.game.elemets.tower.MainTower;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import java.util.ArrayList;
import java.util.List;

public class PlayerTest {

    SpellCard card1  = new SpellCard("The Log", 2, 200,'-');
    SpellCard card2 = new SpellCard("Snowball", 2, 159,'-');
    SpellCard card3 = new SpellCard("Fireball", 4, 572,'-');
    SpellCard card4 = new SpellCard("Rocket", 6, 1232,'-');

    TroopCard card5  = new TroopCard("Musketeer", 4, 164, 598, 6,6,6,'-');
    TroopCard card6  = new TroopCard("Mini-Pekka", 4, 123, 1129, 0.8,6,6,'-');
    TroopCard card7  = new TroopCard("Prince", 5, 232, 1669, 1.6,6,6,'-');
    TroopCard card8  = new TroopCard("Giant", 5, 140, 3275, 1.2,6,6,'-');

    Tower tower1 = new MainTower(8, 28, 1,50, 7,2400);
    Tower tower2 = new SubTower(3, 25, 2, 50, 7.5,1400);
    Tower tower3 = new SubTower(14, 25, 3, 50, 7.5,1400);

    List<Tower> towers = new ArrayList<>();
    List<Card> cards = new ArrayList<>();
    Player player;

    @BeforeEach
    private void helper() {
        towers.add(tower1);
        towers.add(tower2);
        towers.add(tower3);

        cards.add(card1);
        cards.add(card2);
        cards.add(card3);
        cards.add(card4);
        cards.add(card5);
        cards.add(card6);
        cards.add(card7);
        cards.add(card8);

        player = new Player(towers, cards, "#CC0000");
    }

    @Test
    public void getTowers() {
        Assertions.assertEquals(towers, player.getTowers());
    }

    @Test
    public void getCards() {
        Assertions.assertEquals(cards, player.getCards());
    }

    @Test
    public void getCharacters() {
        List<Character> characters = new ArrayList<>();
        Character character = card1.createCharacter(2, 2, 4);
        characters.add(character);
        player.addCharacter(character);
        Assertions.assertEquals(player.getCharacters(), characters);
    }

    @Test
    public void getCardsInGame() {

    }

    @Test
    public void getSubTowers() {
        List<Tower> list = new ArrayList<>();
        list.add(tower2);
        list.add(tower3);

        Assertions.assertEquals(list, player.getSubTowers());
    }

    @Test
    public void getElements() {
        List<GameElement> temp = new ArrayList<>();
        List<Character> characters = new ArrayList<>();
        Character character = card1.createCharacter(2, 2, 4);
        characters.add(character);
        player.addCharacter(character);

        temp.addAll(towers);
        temp.addAll(characters);

        Assertions.assertEquals(player.getElements(), temp);
    }

    @Test
    public void addCharacter() {
        List<Character> characters = new ArrayList<>();
        characters.add(new TroopCharacter(5,5,4, card5, new TroopMoveStrategy(), new TroopAttackStrategy()));

        player.addCharacter(new TroopCharacter(5,5, 4, card5, new TroopMoveStrategy(), new TroopAttackStrategy())); //elixirCost = 4

        Assertions.assertEquals(characters, player.getCharacters());
        Assertions.assertEquals(player.getElixir(), 1);
    }

    @Test
    public void removeCharacter() {
        List<Character> characters = new ArrayList<>();
        characters.add(new TroopCharacter(10,10, 6, card6, new TroopMoveStrategy(), new TroopAttackStrategy()));

        player.addCharacter(new TroopCharacter(5,5, 7, card5, new TroopMoveStrategy(), new TroopAttackStrategy()));
        player.addCharacter(new TroopCharacter(10,10, 6, card6, new TroopMoveStrategy(), new TroopAttackStrategy()));
        player.removeCharacter(new TroopCharacter(5,5, 7, card5, new TroopMoveStrategy(), new TroopAttackStrategy()));

        Assertions.assertEquals(characters, player.getCharacters());
    }

    @Test
    public void increaseElixir() {

        player.increaseElixir(); // 6
        Assertions.assertEquals(6, player.getElixir());

        player.increaseElixir(); // 7
        player.increaseElixir(); // 8
        player.increaseElixir(); // 9
        player.increaseElixir(); // 10
        Assertions.assertEquals(10, player.getElixir());

        player.increaseElixir(); // 10
        Assertions.assertEquals(10, player.getElixir());
    }

    @Test
    public void decreaseElixir() {

        player.decreaseElixir(1);
        Assertions.assertEquals(4, player.getElixir());

        player.decreaseElixir(5);
        Assertions.assertEquals(0, player.getElixir());
    }
}
