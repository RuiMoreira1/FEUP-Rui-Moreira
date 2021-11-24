package clash_royale.model.game.arena;

import clash_royale.model.Player;
import clash_royale.model.game.elemets.Boundary;
import clash_royale.model.game.elemets.character.Character;
import clash_royale.model.game.elemets.Bridge;
import clash_royale.model.game.elemets.GameElement;
import clash_royale.model.game.elemets.River;
import clash_royale.model.game.elemets.tower.Tower;

import java.util.ArrayList;
import java.util.List;

public class Arena {
    private final int width;
    private final int height;

    private final Player player1;
    private final Player player2;

    private final River river;
    private final List<Bridge> bridges;

    private final List<Boundary> boundaries;

    public Arena(int w, int h, Player player1, Player player2, River river, List<Bridge> bridges, List<Boundary> boundaries) {
        this.width = w;
        this.height = h;
        this.player1 = player1;
        this.player2 = player2;
        this.river = river;
        this.bridges = bridges;
        this.boundaries = new ArrayList<>(boundaries);
    }

    public int getWidth(){
        return this.width;
    }

    public int getHeight(){
        return this.height;
    }

    public Player getPlayer1(){
        return this.player1;
    }

    public Player getPlayer2(){
        return this.player2;
    }

    public List<Boundary> getBoundaries(){
        return this.boundaries;
    }

    public List<Bridge> getBridges() {
        return bridges;
    }

    public River getRiver() {
        return river;
    }

    public Player getOpponent(Player player) {
        if (player.equals(player1)) return player2;
        else return player1;
    }

    public Player getPlayer(GameElement element) {
        return player1.getElements().contains(element) ? player1 : player2;
    }

    public Player getOpponent(GameElement element) {
        return player1.getElements().contains(element) ? player2 : player1;
    }

    public List<Tower> getTowerList(){
        List<Tower> list = new ArrayList<>();

        list.addAll(player1.getTowers());
        list.addAll(player2.getTowers());
        return list;
    }

    public List<Character> getCharacterList(){
        List<Character> list = new ArrayList<>();

        list.addAll(player1.getCharacters());
        list.addAll(player2.getCharacters());
        return list;
    }

    public void increaseElixir() {
        player1.increaseElixir();
        player2.increaseElixir();
    }

    /*public boolean isEmpty(Position position) {
        for( Boundarie boundarie : boundaries ) {
            if(boundarie.getPosition().equals(position)) return false;
        }
        for( Tower towers : getTowerList() ) {
            if(towers.getPosition().equals(position)) return false;
        }
        for( Character character : getCharacterList() ){
            if(character.getPosition().equals(position)) return false;
        }
        return true;
    }*/
}
