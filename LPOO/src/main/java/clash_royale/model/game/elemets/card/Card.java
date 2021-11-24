package clash_royale.model.game.elemets.card;

import clash_royale.model.game.elemets.character.Character;

public abstract class Card {
    private final char cardChar;
    private final String name;
    private final int elixirCost;
    private final int damage;
    private final double range;

    public Card(String name, int elixirCost, int damage, double range, char cardChar) {
        this.name = name;
        this.elixirCost = elixirCost;
        this.damage = damage;
        this.range = range;
        this.cardChar = cardChar;
    }

    public String getName() {
        return name;
    }

    public int getElixirCost() {
        return elixirCost;
    }

    public int getDamage() {
        return damage;
    }

    public double getRange() {
        return range;
    }

    public abstract Character createCharacter(int x, int y, int id);

    public char getChar() { return cardChar; }

    @Override
    public boolean equals(Object o) {
        return this == o;
    }
}
