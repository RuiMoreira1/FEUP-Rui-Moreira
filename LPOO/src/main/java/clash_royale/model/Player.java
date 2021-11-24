package clash_royale.model;

import clash_royale.model.game.elemets.GameElement;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.character.Character;

import java.util.*;

public class Player {

    private int elixir;
    private final List<Tower> towers;
    private final List<Card> cards;
    private final List<Card> cardsInGame;
    private final List<Character> characters;
    private final String color;

    public Player(List<Tower> towers, List<Card> cards, String color) {
        this.color = color;
        this.elixir = 5;
        this.towers = towers;
        this.cards = cards;
        characters = new ArrayList<>();
        cardsInGame = new ArrayList<>();
        cardsInGame.addAll(cards.subList(0, 4)); //TODO quando tivermos seleção de cartas
    }

    public int getElixir() {
        return elixir;
    }

    public List<Tower> getTowers() {
        return towers;
    }

    public List<Card> getCards() {
        return cards;
    }

    public List<Character> getCharacters() {
        return characters;
    }

    public List<Card> getCardsInGame() {
        return cardsInGame;
    }

    public String getColor() {
        return color;
    }

    public List<SubTower> getSubTowers() {
        List<SubTower> subTowers = new ArrayList<>();

        for (Tower t : towers)
            if(t instanceof SubTower)
                subTowers.add((SubTower) t);

        return subTowers;
    }

    public List<GameElement> getElements() {
        List<GameElement> temp = new ArrayList<>();

        temp.addAll(towers);
        temp.addAll(characters);
        return temp;
    }

    public void addCharacter(Character character) {
        characters.add(character);
        this.decreaseElixir(character.getElixirCost());
    }

    public void removeCharacter(Character character) {
        characters.removeIf(character::equals);
    }

    public void increaseElixir() {
        if (elixir < 10)
            elixir++;
    }

    public void decreaseElixir(int cost) {
        if (elixir >= cost)
            elixir -= cost;
        else
            elixir = 0;
    }

}
