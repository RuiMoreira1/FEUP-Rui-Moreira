package clash_royale.controller;

import clash_royale.Game;
import clash_royale.gui.GUI;

import java.io.IOException;
import java.net.URISyntaxException;

public abstract class Controller<T> {

    private final T model;

    public Controller(T model) {
        this.model = model;
    }

    public T getModel() {
        return model;
    }

    public abstract void step(Game game, GUI.ACTION action, long time, int id) throws IOException, URISyntaxException;
}
