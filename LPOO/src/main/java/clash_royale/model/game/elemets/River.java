package clash_royale.model.game.elemets;

public class River extends GameElement {

    public River(int x, int y, int width, int height, int id) {
        super(x, y, id);
        this.width = width;
        this.height = height;
    }

    private final int width;
    private final int height;

    public int getWidth() {
        return width;
    }

    public int getHeight() {
        return height;
    }
}
