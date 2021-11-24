package clash_royale.model.game.elemets;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class RiverTest {

    River river = new River(13, 2, 2, 3, 1);

    @Test
    public void getWidth() {
        Assertions.assertEquals(2, river.getWidth());
    }

    @Test
    public void getHeight() {
        Assertions.assertEquals(3, river.getHeight());
    }
}
