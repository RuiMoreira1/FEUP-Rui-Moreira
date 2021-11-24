package clash_royale.gui;

import clash_royale.model.Position;
import com.googlecode.lanterna.TerminalPosition;
import com.googlecode.lanterna.TerminalSize;
import com.googlecode.lanterna.TextColor;
import com.googlecode.lanterna.graphics.TextGraphics;
import com.googlecode.lanterna.input.KeyStroke;
import com.googlecode.lanterna.input.KeyType;
import com.googlecode.lanterna.screen.Screen;
import com.googlecode.lanterna.screen.TerminalScreen;
import com.googlecode.lanterna.terminal.DefaultTerminalFactory;
import com.googlecode.lanterna.terminal.MouseCaptureMode;
import com.googlecode.lanterna.terminal.Terminal;
import com.googlecode.lanterna.terminal.swing.AWTTerminalFontConfiguration;
import com.googlecode.lanterna.terminal.swing.AWTTerminalFrame;

import java.awt.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.io.File;
import java.io.IOException;
import java.net.URISyntaxException;
import java.net.URL;

public class LanternaGUI implements GUI {
    private final Screen screen;
    private final Terminal terminal;
    int x,y; boolean mouseClicked; ACTION mouseAction;

    public LanternaGUI(Screen screen, Terminal terminal){
        this.screen = screen; this.terminal = terminal;
    }

    public LanternaGUI(int width, int height) throws IOException, FontFormatException, URISyntaxException {
        AWTTerminalFontConfiguration fontConfiguration = loadFont();
        this.terminal = createTerminal(width,height + 1, fontConfiguration);
        this.screen = createScreen(terminal);
        //getMouseAction();
    }

    private Screen createScreen(Terminal terminal) throws IOException {
        final Screen screen;
        screen = new TerminalScreen(terminal);

        screen.setCursorPosition(null);
        screen.startScreen();
        screen.doResizeIfNecessary();
        return screen;
    }


    private Terminal createTerminal(int width, int height, AWTTerminalFontConfiguration fontConfiguration) throws IOException {
        TerminalSize terminalSize = new TerminalSize(width+1, height+5);
        DefaultTerminalFactory terminalFactory = new DefaultTerminalFactory().setInitialTerminalSize(terminalSize).
                setForceAWTOverSwing(true).setTerminalEmulatorFontConfiguration(fontConfiguration).setMouseCaptureMode(MouseCaptureMode.CLICK);
        return terminalFactory.createTerminal();
    }

    private AWTTerminalFontConfiguration loadFont() throws URISyntaxException, FontFormatException, IOException {
        URL resource = getClass().getClassLoader().getResource("fonts/gamefont.ttf");
        File fontFile = new File(resource.toURI());
        Font font = Font.createFont(Font.TRUETYPE_FONT, fontFile);

        GraphicsEnvironment graphicsEnv = GraphicsEnvironment.getLocalGraphicsEnvironment();

        graphicsEnv.registerFont(font);

        Font loadedFont = font.deriveFont(Font.PLAIN, 25);

        return AWTTerminalFontConfiguration.newInstance(loadedFont);
    }

    public void getMouseAction() {
        ((AWTTerminalFrame)terminal).getComponent(0).addMouseListener(new MouseAdapter() {
            @Override
            public void mouseClicked(MouseEvent e) {
                if( e.getButton() == 1 ) mouseAction = ACTION.LEFT_MOUSE;
                else if( e.getButton() == 2 ) mouseAction = ACTION.MIDDLE_MOUSE;
                else if( e.getButton() == 3 ) mouseAction = ACTION.RIGHT_MOUSE;
                x = e.getX(); y = e.getY(); mouseClicked = true;
            }
        });
    }

    public int cardBoundaries(int x, int y){
        if( y > 500 && y < 605){
            if( x < 135 ) return 0;
            else if(x < 265) return 1;
            else if( x < 390) return 2;
            else if( x <= 525) return 3;
        }
        return 4;
    }

    public ACTION getNextAction() throws IOException {
        KeyStroke keyStroke = screen.pollInput();
        if (keyStroke == null) return ACTION.NONE;

        if (keyStroke.getKeyType() == KeyType.EOF) return ACTION.QUIT;
        if (keyStroke.getKeyType() == KeyType.Character && keyStroke.getCharacter() == 'q') return ACTION.QUIT;

        if (keyStroke.getKeyType() == KeyType.ArrowUp) return ACTION.UP;
        if (keyStroke.getKeyType() == KeyType.ArrowRight) return ACTION.RIGHT;
        if (keyStroke.getKeyType() == KeyType.ArrowDown) return ACTION.DOWN;
        if (keyStroke.getKeyType() == KeyType.ArrowLeft) return ACTION.LEFT;

        if (keyStroke.getKeyType() == KeyType.Enter) return ACTION.SELECT;

        return ACTION.NONE;

    }

    public void drawRectangle(Position position, int width, int height, String color){
        TextGraphics textG = screen.newTextGraphics();
        textG.setBackgroundColor(TextColor.Factory.fromString(color));
        textG.fillRectangle(
                new TerminalPosition(position.getX(), position.getY()), new TerminalSize(width,height), ' ');

    }

    private void drawCharacter(int x, int y, char c, String color, String backgroundColor){
        TextGraphics textG = screen.newTextGraphics();
        textG.setBackgroundColor(TextColor.Factory.fromString(backgroundColor));
        textG.setForegroundColor(TextColor.Factory.fromString(color));
        textG.putString(x,y, "" + c);
    }

    @Override
    public void drawBackground(int width, int height, String color){
        TextGraphics textG = screen.newTextGraphics();
        textG.setBackgroundColor(TextColor.Factory.fromString(color));
        textG.fillRectangle(new TerminalPosition(0, 0), new TerminalSize(width, height), ' ');
    }

    @Override
    public void drawText(Position pos, String text, String color, String backgroundColor){
        TextGraphics textG = screen.newTextGraphics();
        textG.setBackgroundColor(TextColor.Factory.fromString(backgroundColor));
        textG.setForegroundColor(TextColor.Factory.fromString(color));
        textG.putString(pos.getX(), pos.getY(), text);
    }

    @Override
    public void drawCharacter(Position pos, String color, char troopChar ){
        if(pos.getY() >= 10 && pos.getY() < 14 && ( (2 <= pos.getX() && pos.getX() <= 4) || (15 <= pos.getX() && pos.getX() <= 18) ) ){
            drawCharacter(pos.getX(),pos.getY(), troopChar, color, "#9B7653");
        }
        else if(pos.getY() >= 11 && pos.getY() < 13){
            drawCharacter(pos.getX(),pos.getY(), troopChar, color, "#89CFF0");
        }
        else drawCharacter(pos.getX(),pos.getY(), troopChar, color, "#4B8B3B");
    }

    @Override
    public void drawBoundaries(Position pos){
        drawCharacter(pos.getX(), pos.getY(), '#', "#FFD700", "#4B8B3B");
    }

    @Override
    public void drawCard(Position pos, char cardPic){

        drawCharacter(pos.getX(), pos.getY(), cardPic, "#CC0000", "#4B8B3B");
    }

    @Override
    public void drawTower(Position pos){ drawCharacter(pos.getX(), pos.getY(), '\u00b3', "#FFD700", "#4B8B3B");
    }

    @Override
    public void clear(){
        screen.clear();
    }

    @Override
    public void refresh() throws IOException{
        screen.refresh();
    }

    @Override
    public void close() throws IOException{
        screen.close();
    }

    @Override
    public int getX() { return this.x; }

    @Override
    public int getY() { return this.y; }

    @Override
    public ACTION getMAction() { return this.mouseAction; }

    @Override
    public boolean isMouseClicked() { return this.mouseClicked; }

    @Override
    public void setMouseClicked() { this.mouseClicked = false; }


}
