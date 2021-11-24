package clash_royale.model.game.elemets;

import clash_royale.model.Position;
import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;

public class BoundaryTest {

    Boundary element = new Boundary(2, 4, 1);

    @Test
    public void getPosition(){
        Assertions.assertEquals(new Position(2, 4), element.getPosition());
    }

    @Test
    public void getX() {
        Assertions.assertEquals(2, element.getX());
    }

    @Test
    public void getY() {
        Assertions.assertEquals(4, element.getY());
    }

    @Test
    public void setPosition() {

        Position newPosition = new Position(13, 13);
        element.setPosition(newPosition);

        Assertions.assertEquals(newPosition, element.getPosition());
    }

    @Test
    public void equals() {
        Boundary equalElement = new Boundary(2, 4, 1);
        Boundary difElement = new Boundary(2, 4, 7);

        Assertions.assertTrue(element.equals(equalElement) && equalElement.equals(element));
        Assertions.assertTrue(element.hashCode() == equalElement.hashCode());

        Assertions.assertFalse(element.equals(null));

        Assertions.assertFalse(element.equals(difElement) && difElement.equals(element));
        Assertions.assertFalse(element.hashCode() == difElement.hashCode());
    }
}
