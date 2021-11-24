package clash_royale.view.game;

import clash_royale.gui.GUI;
import clash_royale.model.Position;
import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.elemets.GameElement;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.tower.Tower;
import clash_royale.view.Viewer;

import java.io.IOException;
import java.util.List;

public class GameViewer extends Viewer<Arena> {



    public GameViewer(Arena arena) {
        super(arena);
    }

    @Override
    public void drawElements(GUI gui) throws IOException {
        gui.clear();

        drawBackground(getModel().getWidth() + 1, getModel().getHeight() - 1, gui);
        drawElement(getModel().getRiver(), new RiverViewer(), gui);
        drawElements(getModel().getBridges(), new BridgeViewer(), gui);

        drawElements(getModel().getTowerList(), new TowerViewer(), gui);

        drawElements(getModel().getPlayer1().getCharacters(), new CharacterViewer(getModel().getPlayer1().getColor()), gui);
        drawElements(getModel().getPlayer2().getCharacters(), new CharacterViewer(getModel().getPlayer2().getColor()), gui);

        drawElements(getModel().getBoundaries(), new BoundaryViewer(), gui);

        for(int i = 0; i < 4; i++){
            Card newCard = getModel().getPlayer1().getCardsInGame().get(i);
            gui.drawCard(new Position(2+5*i,21), newCard.getChar());
            gui.drawText(new Position(3+5*i,21), String.valueOf(newCard.getElixirCost()), "#CC0000","#4B8B3B");
        }

        gui.drawText(new Position(0, getModel().getHeight()), "Elixir1: " + getModel().getPlayer1().getElixir(), "#CC0000", "#000000");

        drawTowerHealth(gui);

        gui.refresh();
    }

    private <T extends GameElement> void drawElements(List<T> elements, ElementViewer<T> viewer, GUI gui) {
        for( T element : elements ){
            drawElement(element,viewer, gui);
        }
    }

    private <T extends GameElement> void drawElement(T element, ElementViewer<T> viewer, GUI gui) {
        viewer.drawElement(element, gui);
    }

    private void drawCard(Card card, CardViewer viewer, GUI gui) { //TODO quando tivermos seleção de cartas
        viewer.drawCard(card, gui, 1, 20);
    }

    private void drawTowerHealth(GUI gui) {
        for (Tower tower : getModel().getPlayer1().getTowers())
            if(tower.getState())
                gui.drawText(tower.getPosition().getDown().getLeft(), String.valueOf(tower.getHealth()), "#FFD700", "#4B8B3B");

        for (Tower tower : getModel().getPlayer2().getTowers())
            if(tower.getState())
                gui.drawText(tower.getPosition().getUp().getLeft(), String.valueOf(tower.getHealth()), "#FFD700", "#4B8B3B");
    }

    private void drawBackground(int width, int height,  GUI gui) {
        gui.drawBackground(width,height, "#4B8B3B");
    }

}
