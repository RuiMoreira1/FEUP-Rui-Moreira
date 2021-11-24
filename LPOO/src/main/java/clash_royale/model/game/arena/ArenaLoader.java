package clash_royale.model.game.arena;

import clash_royale.model.Player;
import clash_royale.model.game.elemets.Boundary;
import clash_royale.model.game.elemets.Bridge;
import clash_royale.model.game.elemets.River;
import clash_royale.model.game.elemets.card.Card;
import clash_royale.model.game.elemets.card.SpellCard;
import clash_royale.model.game.elemets.card.TroopCard;
import clash_royale.model.game.elemets.tower.MainTower;
import clash_royale.model.game.elemets.tower.SubTower;
import clash_royale.model.game.elemets.tower.Tower;

import java.io.*;

import java.net.URISyntaxException;
import java.net.URL;
import java.util.*;

public class ArenaLoader extends ArenaBuilder {

    private final List<String> troopCards;
    private final List<String> spellCards;
    private final List<String> arenaFile;


    public ArenaLoader() throws NullPointerException, URISyntaxException {
        troopCards = getLines(buffReader("cards/troopcards.txt"));
        spellCards = getLines(buffReader("cards/spellcards.txt"));
        arenaFile = getLines(buffReader("arenaFormat.txt"));
    }


    private File buffReader(String pathName) throws URISyntaxException {
        URL resource = getClass().getClassLoader().getResource(pathName);
        if(resource == null){
            throw new IllegalArgumentException("file not found!");
        }
        else{
            return new File(resource.toURI());
        }
    }

    @Override
    protected int getWidth(){
        int width = 0;
        for(String line: arenaFile) width = Math.max(width, line.length());
        return width;
    }

    //Hardcoded
    @Override
    protected int getHeight(){
        return 25;
    }

    @Override
    protected List<Boundary> createBoundariesCards(){
        List<Boundary> bound = new ArrayList<>();

        for( int i = 19  ; i < arenaFile.size(); i++ ){
            for( int j = 0; j < arenaFile.get(i).length() ; j++){
                if( arenaFile.get(i).charAt(j) == '#' ) bound.add( new Boundary(j,i+1,i*j+i) );
            }
        }
        return bound;
    }

    @Override
    protected List<Card> createCards(){
        List<Card> cardsSet = new ArrayList<>();
        String[] tempArray;
        for( String str : troopCards ){
            tempArray = str.trim().split("\\s+");
            cardsSet.add(troopCardLoader(tempArray));
        }
        for( String str2 : spellCards ){
            tempArray = str2.trim().split("\\s+");
            cardsSet.add(spellCardLoader(tempArray));
        }
        return cardsSet;
    }

    @Override
    protected TroopCard troopCardLoader( String[] array ) throws NumberFormatException{
        return new TroopCard(array[0],Integer.parseInt(array[1]), Integer.parseInt(array[2]), Integer.parseInt(array[3]),Double.parseDouble(array[4]), Double.parseDouble(array[5]), Integer.parseInt(array[6]),(char) Integer.parseInt( array[7].substring(2), 16 ));

    }

    @Override
    protected SpellCard spellCardLoader( String[] array ) throws NumberFormatException{
        return new SpellCard(array[0],Integer.parseInt(array[1]), Integer.parseInt(array[2]), (char) Integer.parseInt( array[3].substring(2), 16 ));
    }

    @Override
    protected List<String> getLines(File myFile){
        List<String> temporary = new ArrayList<>();
        try{
            Scanner reader = new Scanner(myFile);
            while(reader.hasNextLine()){
                String line = reader.nextLine();
                temporary.add(line);
            }
            reader.close();
        } catch (FileNotFoundException exc) {
            System.err.println("An error occurred.");
            exc.printStackTrace();
        }
        return temporary;
    }

    @Override
    protected River createRiver(){ //TODO Load from file (height)
        return new River(0,getHeight()/2 - 1, getWidth(), 2, 9);
    } //TODO Load from file

    @Override
    protected List<Bridge> createBridges(){ //TODO Load from file
        List<Bridge> temp = new ArrayList<>();
        temp.add(new Bridge(2, getHeight()/2 - 2, 7, 3, 4));
        temp.add(new Bridge(getWidth() - 2 - 3, getHeight()/2 - 2, 8, 3, 4));
        return temp;
    }

    @Override
    protected List<Tower> createTowers(){
        int id = 0;
        List<Tower> temp = new ArrayList<>();
        for( int i = 0 ; i < arenaFile.size(); i++){
            for( int j = 0; j < arenaFile.get(i).length(); j++ ){
                if( arenaFile.get(i).charAt(j) == 't' ){
                    temp.add( new SubTower(j,i, id++, 100, 2, 3000));
                }
                else if( arenaFile.get(i).charAt(j) == 'T' ){
                    temp.add( new MainTower(j,i,id++,200,3,4000));
                }
            }
        }
        return temp;
    }

    @Override
    protected List<Tower> assignTower(List<Tower> towers, int cap){
        List<Tower> playerTower = new ArrayList<>();
        for(int i = cap; i < cap+3; i++){
            playerTower.add(towers.get(i));
        }
        return playerTower;
    }

    @Override
    protected Player createPlayer1(List<Card> cards, List<Tower> tower){
        return new Player(tower,cards,"#CC0000");

    }

    @Override
    protected Player createPlayer2(List<Card> cards, List<Tower> tower){
        return new Player(tower,cards,"#0060FF");
    }
}
