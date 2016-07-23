<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tweet{
    
    static public function loadAllTweets(mysqli $conn){
        $sqlLoadTweets = "SELECT * FROM Tweet";
        $result = $conn->query($sqlLoadTweets);
        if($result){
            $tweets = array();
            foreach($result as $row){
                $tweet = new Tweet();
                $tweet->id = $row['id'];
                $tweet->userId = $row['user_id'];
                $tweet->text = $row['text'];
                $tweets[]=$tweet;
            }
            return $tweets; 
            //zwrocona tablica z tweetami 
        }
        return []; //pusta tablica
    }
    
    static public function loadAllTweetsByUserId(mysqli $conn, $userId){
        $sqlLoadTweets = "SELECT * FROM Tweet WHERE user_id=$userId";
        $result = $conn->query($sqlLoadTweets);
        if($result){
            $tweets = array();
            if($result->num_rows > 0){
                while($row=$result->fetch_assoc()){
                    //$row = $result->fetch_assoc();
                    $tweet = new Tweet();
                    $tweet->id = $row['id'];
                    $tweet->userId = $row['user_id'];
                    $tweet->text = $row['text'];   
                    $tweets[] = $tweet;
                }
            //echo 'tablica';
            return $tweets;
            }  
            
        }
        echo $conn->error;//na czas edycji kodu,
        // pozniej-w kodzie produkcyjnym nie 
        // wyswietlamy bledow uzytkownikowi
        //echo 'tablica';
        return []; //zwracamy pusta tablice
    }
    
    
    
    
    
    private $id;
    private $userId;
    private $text;
    
    public function __construct(){
        $this->id=-1;
        $this->userId=0;
        $this->text='';        
    }
    
    
    //nastawianie atrybutow obiektu wylacznie 
    //za pomoca seterow
    
    public function loadAllCommentsByTweetId(mysqli $conn){ //getAllComments
        return Comment::loadAllCommentsByTweetId
                ($conn, $this->id, $this->userId);
    }
    
    public function loadFromDB(mysqli $conn, $id){ //wcztujemy istniejacy tweet
    //(nie mamy setId)
        $sqlLoadTweet = "SELECT * FROM Tweet WHERE id=$id";
        $result = $conn->query($sqlLoadTweet);
        if($result){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->userId = $row['user_id'];
                $this->text = $row['text'];   
                return $this;
            }
        }
        else{
            return false;
        }       
    }
    
    public function createTweet(mysqli $conn){
        if($this->id === -1){
            $sqlAddTweet = "INSERT INTO Tweet"
                    . " (user_id, text) VALUES"
                    . " ($this->userId, '$this->text');"; 
            if($conn->query($sqlAddTweet)){
                $this->id = $conn->insert_id;
                //echo 'dodano tweet';     
                return $this;     
            }
            //echo $conn->error.'<br>';
        }
        //niepotrzebne else, 
        //jak najmniej return-ow-cztelnosc kodu
        //echo 'nie dodano';       
        return false;   
    }
    
    public function updateTweet(mysqli $conn){
        if($this->id !== 1){
            
            $sqlUpdateTweet = "UPDATE Tweet SET "
                    . "text='$this->text' "
                    . "WHERE Tweet.id=$this->id";
            if($conn->query($sqlUpdateTweet)){
                return $this;
            }       
        }
        
        return false;   
    }
    
    public function showTweet(){
        echo "<br>Tweet o id: $this->id, dla usera o id: $this->userId:<br>"
                . "$this->text<br>";
    } 
    public function getAllComments(){//
        
    }
    
    public function setUserId($userId){
        $this->userId = is_integer($userId) ? $userId : -1 ; 
        return $this;
    }
    public function setText($text){
        $this->text = is_string($text) ? $text : '';
        return $this;
    }
    public function getId(){
        return $this->id;
        
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getText(){
        return $this->text;
    }
    
    
}
    
        
    
    
            
    
    
    
    
    
    
    
    
    
