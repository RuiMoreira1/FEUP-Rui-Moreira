package clash_royale;

import clash_royale.gui.LanternaGUI;

import clash_royale.model.menu.Menu;
import clash_royale.states.MenuState;
import clash_royale.states.State;

import java.awt.*;
import java.io.IOException;
import java.net.URISyntaxException;

public class Game {
    private final LanternaGUI gui;
    private State state;

    public Game() throws FontFormatException, IOException, URISyntaxException {
        this.gui = new LanternaGUI(20, 20);
        this.state = new MenuState(new Menu());
    }

    public State getState() {
        return state;
    }

    public void setState(State state) {
        this.state = state;
    }

    public LanternaGUI getGui() { return this.gui; }

    private void start() throws IOException, URISyntaxException {
        int FPS = 1;
        int frameTime = 1000 / FPS;

        int id = 10;
        while (this.state != null) {
            long startTime = System.currentTimeMillis();

            state.step(this, gui, startTime, id);

            long elapsedTime = System.currentTimeMillis() - startTime;
            long sleepTime = frameTime - elapsedTime;

            try {
                if (sleepTime > 0) Thread.sleep(sleepTime);
            } catch (InterruptedException e) { }

            id+=2;
        }

        gui.close();
    }

    public static void main(String[] args) throws IOException, FontFormatException, URISyntaxException {

        new Game().start();
    }
}
