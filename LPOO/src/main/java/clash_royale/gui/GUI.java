package clash_royale.gui;

import clash_royale.model.Position;
import java.io.IOException;

public interface GUI {
    void getMouseAction() throws IOException;

    ACTION getNextAction() throws IOException;

    void drawBackground(int width, int height, String color);

    void drawRectangle(Position pos, int width, int height, String color);

    void drawCard(Position pos, char cardPic);

    void drawTower(Position pos);

    void drawBoundaries(Position pos);
    void drawCharacter(Position pos, String color, char troopChar);

    void drawText(Position pos, String text, String hexColor, String BackgroundColor);

    void clear();

    void refresh() throws IOException;

    void close() throws IOException;

    int getX();

    int getY();

    ACTION getMAction();

    boolean isMouseClicked();

    void setMouseClicked();

    enum ACTION {MIDDLE_MOUSE, LEFT_MOUSE, RIGHT_MOUSE,UP, RIGHT, DOWN, LEFT, NONE, QUIT, SELECT};

}
