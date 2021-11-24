package clash_royale.states;

import clash_royale.controller.Controller;
import clash_royale.controller.menu.MenuController;
import clash_royale.model.menu.Menu;
import clash_royale.view.Viewer;
import clash_royale.view.menu.MenuViewer;

public class MenuState extends State<Menu> {
    public MenuState(Menu model) {
        super(model);
    }

    @Override
    protected Controller<Menu> getController() {
        return new MenuController(getModel());
    }

    @Override
    protected Viewer<Menu> getViewer() {
        return new MenuViewer(getModel());
    }
}
