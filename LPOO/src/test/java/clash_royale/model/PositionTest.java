package clash_royale.model;

import org.junit.jupiter.api.Assertions;
import org.junit.jupiter.api.Test;


public class PositionTest {

    Position position = new Position(2,3);

    @Test
    public void getX() {
        Assertions.assertEquals(2, position.getX());
    }

    @Test
    public void getY() {
        Assertions.assertEquals(3, position.getY());
    }

    @Test
    public void getUp() {
        Assertions.assertEquals(new Position(2,2), position.getUp());
    }

    @Test
    public void getDown() {
        Assertions.assertEquals(new Position(2,4), position.getDown());
    }

    @Test
    public void getLeft() {
        Assertions.assertEquals(new Position(1,3), position.getLeft());
    }

    @Test
    public void getRight() {
        Assertions.assertEquals(new Position(3,3), position.getRight());
    }

    @Test
    public void equals() {

        Position equalPosition = new Position(2,3);

        Position difXPosition = new Position(4,3);

        Position difYPosition = new Position(2,4);

        Position difPosition = new Position(7,5);

        Assertions.assertEquals(position, position);
        Assertions.assertEquals(position.hashCode(), position.hashCode());

        Assertions.assertNotEquals(position, null);

        Assertions.assertTrue(position.equals(equalPosition) && equalPosition.equals(position));
        Assertions.assertEquals(equalPosition.hashCode(), position.hashCode());

        Assertions.assertFalse(position.equals(difXPosition) && difXPosition.equals(position));
        Assertions.assertNotEquals(difXPosition.hashCode(), position.hashCode());

        Assertions.assertFalse(position.equals(difYPosition) && difYPosition.equals(position));
        Assertions.assertNotEquals(difYPosition.hashCode(), position.hashCode());

        Assertions.assertFalse(position.equals(difPosition) && difPosition.equals(position));
        Assertions.assertNotEquals(difPosition.hashCode(), position.hashCode());
    }
}
