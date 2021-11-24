package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.character.Character;

public class CharacterViewer implements ElementViewer<Character>{

    private final String color;

    public CharacterViewer(String color) {
        this.color = color;
    }

    @Override
    public void drawElement(Character troop, GUI gui) {
        gui.drawCharacter(troop.getPosition(), color, troop.getCardChar());
    }

}
