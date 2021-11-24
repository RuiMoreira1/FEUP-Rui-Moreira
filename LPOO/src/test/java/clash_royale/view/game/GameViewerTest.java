package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Player;
import clash_royale.model.Position;
import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.elemets.Boundary;
import clash_royale.model.game.elemets.Bridge;
import clash_royale.model.game.elemets.River;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.tower.MainTower;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

import java.io.IOException;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;

public class GameViewerTest {

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

    GameViewer viewer;
    GUI gui;

    @BeforeEach
    private void setUp() throws URISyntaxException {
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

        TroopCard card = new TroopCard("RM", 2, 210, 2000, 7, 2, 2, '-');

        player1.addCharacter(card.createCharacter(2,2,1));
        player2.addCharacter(card.createCharacter(5, 5, 2));

        gui = Mockito.mock(GUI.class);
        viewer = new GameViewer(arena);
    }

    @Test
    public void drawElements() throws IOException {
        viewer.drawElements(gui);

        Mockito.verify(gui, Mockito.times(1)).clear();

        Mockito.verify(gui, Mockito.times(1)).drawBackground(18 + 1, 32 - 1, "#4B8B3B");

        Mockito.verify(gui, Mockito.times(1)).drawRectangle(new Position(0,16), 18, 1, "#89CFF0");

        Mockito.verify(gui, Mockito.times(1)).drawRectangle(new Position(2,15), 3, 3, "#9B7653");
        Mockito.verify(gui, Mockito.times(1)).drawRectangle(new Position(13,15), 3, 3, "#9B7653");

        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(8,28));
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(3,25));
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(14,25));
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(8,2));
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(3,4));
        Mockito.verify(gui, Mockito.times(1)).drawTower(new Position(14,4));

        Mockito.verify(gui, Mockito.times(1)).drawCharacter(new Position(2,2), "#CC0000", '-');

        Mockito.verify(gui, Mockito.times(1)).drawCharacter(new Position(5,5), "#0060FF", '-');

        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(0,32), "Elixir1: " + arena.getPlayer1().getElixir(), "#CC0000", "#000000");

        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7,29),"2400", "#FFD700","#4B8B3B");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(2,26),"1400", "#FFD700","#4B8B3B");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(13,26),"1400", "#FFD700","#4B8B3B");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(7,1),"2400", "#FFD700","#4B8B3B");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(2,3),"1400", "#FFD700","#4B8B3B");
        Mockito.verify(gui, Mockito.times(1)).drawText(new Position(13,3),"1400", "#FFD700","#4B8B3B");

        Mockito.verify(gui, Mockito.times(1)).refresh();
    }
}
