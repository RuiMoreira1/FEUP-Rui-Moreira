package clash_royale.controller.game;

import clash_royale.Game;
import clash_royale.controller.Controller;
import clash_royale.gui.GUI;
import clash_royale.model.game.elemets.character.SpellCharacter;
import clash_royale.model.gameover.GameOver;
import clash_royale.model.Player;
import clash_royale.model.game.TowerObserver;
import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.character.TroopCharacter;
import clash_royale.model.game.elemets.tower.MainTower;
import clash_royale.model.game.elemets.tower.Tower;
import clash_royale.model.menu.Menu;
import clash_royale.states.GameOverState;
import clash_royale.states.MenuState;

import java.io.IOException;
import java.util.Iterator;
import java.util.Random;

public class ArenaController extends Controller<Arena> implements TowerObserver {

    Random rand = new Random();

    private final PlayerController playerController;
    private final TowerController towerController;

    private boolean gameOver;

    public ArenaController(Arena arena){
        super(arena);

        this.playerController = new PlayerController(arena);
        this.towerController = new TowerController(arena);

        for (Tower tower : arena.getTowerList())
            tower.setTowerObserver(this);
    }

    public boolean isGameOver() {
        return gameOver;
    }

    public Tower getTarget(Character character) {

        Tower tower = null;
        Player opponent = getModel().getOpponent(character);

        double min = Double.MAX_VALUE;
        for (Tower t : opponent.getTowers()) {
            if((character.getPosition().distanceTo(t.getPosition()) < min) && t.getState()) {
                min = character.getPosition().distanceTo(t.getPosition());
                tower = t;
            }
        }

        assert tower != null;
        return tower;
    }

    @Override
    public void healthChanged(Tower tower) {

        if (tower.getHealth() <= 0) {
            if (tower instanceof MainTower)
                gameOver = true;
        }
    }

    @Override
    public void step(Game game, GUI.ACTION action, long time, int id) throws IOException {

        game.getGui().getMouseAction();

        if(game.getGui().isMouseClicked()){
            game.getGui().setMouseClicked();
            int selectedCard = game.getGui().cardBoundaries(game.getGui().getX(),game.getGui().getY());
            if(selectedCard != 4) {
                id++;
                playerController.playCard(getModel().getPlayer1(), getModel().getPlayer1().getCardsInGame().get(selectedCard), selectedCard,  id);
            }
        }
        id++;
        playerController.playCard(getModel().getPlayer2(), id);

        getModel().increaseElixir(); //TODO not sure if it is here

        for (Tower tower : getModel().getPlayer1().getTowers())
            towerController.attack(tower, getModel().getPlayer2());
        for (Tower tower : getModel().getPlayer2().getTowers())
            towerController.attack(tower, getModel().getPlayer1());

        Iterator<Character> i1 = getModel().getPlayer1().getCharacters().iterator();

        while(i1.hasNext()) {
            Character character = i1.next();
            character.move(getTarget(character));
            character.attack(getTarget(character));
            if (character instanceof TroopCharacter)
                if(((TroopCharacter)character).getHealth() <= 0)
                    i1.remove();
            if (character instanceof SpellCharacter)
                if(((SpellCharacter) character).isDead()) {
                    i1.remove();
                }
        }

        Iterator<Character> i2 = getModel().getPlayer2().getCharacters().iterator();

        while(i2.hasNext()) {
            Character character = i2.next();
            character.move(getTarget(character));
            character.attack(getTarget(character));
            if (character instanceof TroopCharacter)
                if(((TroopCharacter)character).getHealth() <= 0)
                    i2.remove();
            if (character instanceof SpellCharacter)
                if(((SpellCharacter) character).isDead()) {
                    i2.remove();
                }
        }

        if(action == GUI.ACTION.QUIT) game.setState(new MenuState(new Menu()));
        if(gameOver) game.setState(new GameOverState(new GameOver()));
    }
}
