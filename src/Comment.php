<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Comment{
    
    static public function loadAllCommentsByTweetId(mysqli $conn, $tweetId){
//        $sqlLoadComment = "SELECT * FROM Comment 
//WHERE Comment.user_id=$userId AND Comment.tweet_id=$tweetId
//ORDER BY Comment.creation_date DESC;"; 
//niepotrzebne userId
        
        $sqlLoadComment = "SELECT * FROM Comment 
            WHERE Comment.tweet_id=1 
            ORDER BY Comment.creation_date DESC;";
        
        $result=$conn->query($sqlLoadComment);
        if($result){
            if($result->num_rows > 0){
                $comments = array();
                foreach($result as $row){
                    $comment = new Comment();
                    $comment->id = $row['id'];
                    $comment->userId = $row['user_id'];
                    $comment->tweetId = $row['tweet_id'];
                    $comment->creationDate = $row['creation_date'];
                    $comment->text = $row['text'];
                    $comments[] = $comment;
                }
                return $comments;
            }      
        }
        return [];    
    }
    
    private $id;
    private $userId;
    private $tweetId;
    private $creationDate;
    private $text;


    public function __construct(){
        $this->id = -1;
        $this->userId = 0;
        $this->tweetId = 0;
        $this->creationDate = '';
        $this->text = '';
    }
    
    
    public function loadFromDB(mysqli $conn, $id){
        $sqlLoadComment = "SELECT * FROM Comment"
                . " WHERE Comment.id=$id";
        $result = $conn->query($sqlLoadComment);
        if($result){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->userId = $row['user_id'];
                $this->tweetId = (int)$row['tweet_id'];
                $this->creationDate = $row['creation_date'];
                $this->text = $row['text'];
                return $this;
            }
        }
        return false;   
    }
    
    public function createComment(mysqli $conn){
        if($this->id === -1){
            $sqlAddComment = "INSERT INTO Comment
                (user_id, tweet_id, creation_date, text)
                VALUES 
                ($this->userId, $this->tweetId, '$this->creationDate', '$this->text');";
            
            $result = $conn->query($sqlAddComment);
            if($result){
                $this->id = $conn->insert_id;
                return $this;
            }
            echo $conn->error;
        }
        return false;     
    }
    
    public function updateComment(){
        if($this->id !== -1){
            $sqlUpdateComment = "UPDATE Comment "
                    . "SET "
                    . "user_id=$this->userId, "
                    . "tweet_id=$this->tweetId, "
                    . "creation_date='$this->creationDate', "
                    . "text='$this->text' "
                    . "WHERE Comment.id=$this->id";
            if($conn->query($sqlUpdateComment)){
                return $this;
            }       
        }
        return false;    
    }
    
    public function showComment(){
        echo "<br>Komentarz o id: $this->id "
                . "dla wpisu o id: $this->tweetId:<br>"
                . "$this->text<br>"
                . "Data dodania: $this->creationDate.<br>";
    }
    
    public function setUserId($userId){
        $this->userId = is_integer($userId) ? $userId : 0;  
        return $this;
    }

    public function setTweetId($tweetId){
        $this->tweetId = is_integer($tweetId) ? $tweetId : 0;
        return $this;
    }

    public function setCreationDate($creationDate){
        $this->creationDate = is_string($creationDate)
                ? $creationDate : 0;//date()
        return $this;
    }
    
    public function setText($text){
        $this->text =  is_string($text) ? $text : '';
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getUserId(){
        return $this->userId;
    }
    public function getTweetId(){
        return $this->tweetId;
    }
    public function getCreationDate(){
        return $this->creationDate;
    }
    public function getText(){
        return $this->text;
    }

}
//
//
//require_once 'connection.php';
//$comment1 = new Comment();
//$comment1->setUserId(14);
//$comment1->setTweetId(12);
//$comment1->setText('komentarz1');
//$comment1->createComment($conn);
//var_dump($comment1);
//$comments = Comment::loadAllCommentsByTweetId($conn, 1);
//foreach($comments as $comment){
//    $comment->showComment();
//    var_dump($comment);
//}
//
