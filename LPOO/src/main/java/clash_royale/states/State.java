package clash_royale.states;

import clash_royale.Game;
import clash_royale.controller.Controller;
import clash_royale.gui.GUI;
import clash_royale.view.Viewer;

import java.io.IOException;
import java.net.URISyntaxException;

public abstract class State<T> {

    private final T model;
    private final Viewer<T> viewer;
    private final Controller<T> controller;

    public State(T model) {
        this.model = model;
        this.viewer = getViewer();
        this.controller = getController();
    }

    protected abstract Controller<T> getController();

    protected abstract Viewer<T> getViewer();

    public T getModel() {
        return model;
    }

    public void step(Game game, GUI gui, long time, int id) throws IOException, URISyntaxException {
        //gui.getMouseAction();
        GUI.ACTION action = gui.getNextAction();
        controller.step(game, action, time, id);
        viewer.draw(gui);
    }

}
