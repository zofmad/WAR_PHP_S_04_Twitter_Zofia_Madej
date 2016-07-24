<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Message{
    static public function loadAllMessagesBySenderId(mysqli $conn, $senderId){
        $sqlLoadSendMessages = "SELECT * FROM Message "
                . "WHERE Message.sender_id=$senderId;";
        $result = $conn->query($sqlLoadSendMessages);
        if($result){
            $messages = array();
            foreach($result as $row){
                $message = new Message();
                $message->id = $row['id'];
                $message->senderId = $row['sender_id'];
                $message->receiverId = $row['receiver_id'];
                $message->messageText = $row['message_text'];
                $message->creationDate = $row['creation_date'];
                $message->isRead = $row['is_read'];
                $messages[] = $message;
            }
            return $messages;
        }
        echo $conn->error;
        return [];   
    }
    
    static public function loadAllMessagesByReceiverId(mysqli $conn, $receiverId){
        $sqlLoadReceivedMessages = "SELECT * FROM Message "
                . "WHERE Message.receiver_id=$receiverId;";
        $result = $conn->query($sqlLoadReceivedMessages);
        if($result){
            $messages = array();
            foreach($result as $row){
                $message = new Message();
                $message->id = $row['id'];
                $message->senderId = $row['sender_id'];
                $message->receiverId = $row['receiver_id'];
                $message->messageText = $row['message_text'];
                $message->creationDate = $row['creation_date'];
                $message->isRead = $row['is_read'];
                $messages[] = $message;   
            }
            return $messages;
        }
        echo $conn->error;
        return [];    
    }
    
    
    private $id;
    private $senderId;
    private $receiverId;
    private $messageText;
    private $creationDate;
    private $isRead;
    
    public function __construct(){
        $this->id = -1;
        $this->senderId = 0;
        $this->receiverId = 0;
        $this->messageText = '';
        $this->creationDate = '';
        $this->isRead = 0;
    }
      
    public function loadFromDB(mysqli $conn, $id){
        $sqlLoadMessage = "SELECT * FROM Message "
                . "WHERE Message.id=$id;";
        $result = $conn->query($sqlLoadMessage);
        if($result){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
                $this->senderId = $row['sender_id'];
                $this->receiverId = $row['receiver_id'];
                $this->messageText = $row['message_text'];
                $this->creationDate = $row['creation_date'];
                $this->isRead = $row['is_read'];
                return $this; 
            }
            echo $conn->error;
        }
        return false; 
    }
    
    public function createMessage(mysqli $conn){
        if($this->id === -1){
            $sqlAddMessage = "INSERT INTO Message 
                (sender_id, receiver_id, message_text, creation_date, is_read) 
                VALUES 
                ($this->senderId, $this->receiverId, "
                    . "'$this->messageText', '$this->creationDate', $this->isRead);";

            $result = $conn->query($sqlAddMessage);
            if($result){
                $this->id = $conn->insert_id;
                //echo 'wyslano';
                return $this;
            }
            echo $conn->error;
            echo 'blad;';
        }
        return false;
    }
    public function updateMessage(mysqli $conn){
        if($this->id !== -1){
            $sqlUpdateMessage = "UPDATE Message SET "
                    . "sender_id=$this->senderId, receiver_id=$this->receiverId, "
                    . "message_text='$this->messageText', "
                    . "creation_date='$this->creationDate', is_read=$this->isRead "
                    . "WHERE Message.id=$this->id;";
            
            $result = $conn->query($sqlUpdateMessage);
            if($result){
                $this->id = $conn->insert_id;
                return $this;
            }
            echo $conn->error;
        }
        return false;
    }
    
    public function showMessage(){
        echo "Informacje o wiadomosci:<br>"
        . " id: $this->id, id nadawcy: $this->senderId, id odbiorcy: $this->receiverId,
            tresc: $this->messageText.<br> Data wyslania: $this->creationDate;";
    }
    
    
    public function setSenderId($senderId){
        $this->senderId = is_numeric($senderId) ? $senderId : 0; 
        return $this;
    }
    public function setReceiverId($receiverId){
        $this->receiverId = is_numeric($receiverId) ? $receiverId : 0;
        return $this;
    }
    public function setMessageText($messageText){
        $this->messageText = is_string($messageText) ? $messageText : '';
        return $this;
    }
    public function setCreationDate($creationDate){
        $this->creationDate = is_string($creationDate) ? $creationDate : '';
        return $this;
    }
    public function setIsRead($isRead){
        $this->isRead = is_numeric($isRead) ? $isRead : 0;
        return $this;
    }
    public function getId(){
        return $this->id;
    }
    public function getSenderId(){
        return $this->senderId;
    }
    public function getReceiverId(){
        return $this->receiverId;
    }
    public function getMessageText(){
        return $this->messageText;
    }
    public function getCreationDate(){
        return $this->creationDate;
    }
    public function getIsRead(){
        return $this->isRead;
    }
        
        
   
    
    
}