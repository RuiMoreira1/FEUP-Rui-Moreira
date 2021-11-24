package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.elemets.card.Card;

public class CardViewer{
    public void drawCard(Card card, GUI gui, int x, int y) { gui.drawCard(new Position(x,y), card.getChar());}
}
