package clash_royale.model.game.elemets;

public class Bridge extends GameElement{
    public Bridge(int x, int y, int id, int width, int height) {
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
