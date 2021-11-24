package clash_royale.states;

import clash_royale.controller.game.ArenaController;
import clash_royale.controller.Controller;
import clash_royale.model.game.arena.Arena;
import clash_royale.view.game.GameViewer;
import clash_royale.view.Viewer;

public class GameState extends State<Arena> {
    public GameState(Arena arena) {
        super(arena);
    }

    @Override
    protected Controller<Arena> getController() {
        return new ArenaController(getModel());
    }

    @Override
    protected Viewer<Arena> getViewer() {
        return new GameViewer(getModel());
    }
}
