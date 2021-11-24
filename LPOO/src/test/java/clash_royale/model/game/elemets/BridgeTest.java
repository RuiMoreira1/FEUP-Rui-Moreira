package clash_royale.model.game.elemets;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class BridgeTest {
    Bridge bridge = new Bridge(13, 2, 2, 3, 1);

    @Test
    public void getWidth() {
        Assertions.assertEquals(3, bridge.getWidth());
    }

    @Test
    public void getHeight() {
        Assertions.assertEquals(1, bridge.getHeight());
    }
}
