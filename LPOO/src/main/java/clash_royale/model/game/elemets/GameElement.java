package clash_royale.model.game.elemets;

import clash_royale.model.Position;

import java.util.Objects;

public class GameElement {
    private Position position;
    private final int id;
    public GameElement(int x, int y, int id){
        this.position = new Position(x,y);
        this.id = id;
    }

    //Can be final
    public Position getPosition(){
        return this.position;
    }

    public int getX() {
        return getPosition().getX();
    }

    public int getY() {
        return getPosition().getY();
    }

    public void setPosition(Position position){
        this.position = position;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        GameElement character = (GameElement) o;
        return (id == character.id);
    }

    @Override
    public int hashCode() {
        return Objects.hash(position,id);
    }

}
