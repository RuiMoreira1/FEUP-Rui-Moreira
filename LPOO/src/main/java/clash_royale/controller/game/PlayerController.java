package clash_royale.controller.game;

import clash_royale.model.Player;
import clash_royale.model.Position;
import clash_royale.model.game.arena.Arena;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.character.Character;

import java.util.Random;

public class PlayerController extends GameController {

    Random rand = new Random();

    public PlayerController(Arena arena) {
        super(arena);
    }

    void playCard(Player player, Card selectedCard, int index, int id) { //TODO quando tivermos seleção de cartas

        if (player.getElixir() > selectedCard.getElixirCost()) {

            Position position = player.getSubTowers().get(rand.nextInt(2)).getPosition();

            Character character = selectedCard.createCharacter(position.getX(), position.getY(), id);
            player.addCharacter(character);
            player.getCardsInGame().set(index, player.getCards().get(rand.nextInt(12)));
        }
    }

    void playCard(Player player, int id) {

        int selectedCard = rand.nextInt(4);
        Card card = player.getCards().get(selectedCard);

        if (player.getElixir() > card.getElixirCost()) {

            Position position = player.getSubTowers().get(rand.nextInt(2)).getPosition();

            Character character = card.createCharacter(position.getX(), position.getY(), id);
            player.addCharacter(character);
            player.getCardsInGame().set(selectedCard, player.getCards().get(rand.nextInt(12)));
        }
    }
}
