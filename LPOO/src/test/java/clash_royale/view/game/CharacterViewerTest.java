package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.card.TroopCard;
import org.junit.jupiter.api.Test;
import org.mockito.Mockito;

public class CharacterViewerTest {

    TroopCard card = new TroopCard("RM", 2, 210, 2000, 7, 2, 2, '-');
    CharacterViewer viewer = new CharacterViewer("#CC0000");
    GUI gui = Mockito.mock(GUI.class);

    @Test
    public void drawElement() {
        viewer.drawElement(card.createCharacter(2,2,1), gui);
        Mockito.verify(gui, Mockito.times(1)).drawCharacter(new Position(2,2), "#CC0000", '-');
    }
}
