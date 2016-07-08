<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User {
    
    static public function logIn(mysqli $conn, $email, $password){
        $sql = "SELECT * FROM User WHERE User.email='$email'";
        $result=$conn->query($sql);
        if($result->num_rows == 1){
            $row=$result->fetch_assoc();
            ////zwraca jeden rzad z opdowiedzi z kluczami jako nazwy kolumn
            //zwraca wynik zapytania jako tablice asocjacyjna
            var_dump($row);
            if(password_verify($password, $row['password'])){
            //sparwdza czy wpsiane haslo password zgadza sie
            // z zahashowanym odczytanym z bazy 
                return $row['id'];//zwraca id uzytkownikas
            }
            else{
                return false;
            }
        } else {
            return false;
        }
    }
    static public function getUserByEmail(mysqli $conn, $email){
        $sql="SELECT * FROM User WHERE email = '$email'";
        $result=$conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $user = new User();// jesli jest taki email tworzymy uzytkownika
            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setFullName($row['fullName']);
            $user->setActive($row['active']);
            return $user;
        }
        else{
            return false;
        }
        
    }
    
    private $id;
    private $email;
    private $password;
    private $fullName;
    private $active;
    
    public function __construct(){
        $this->id=-1; // jesli id ustawione na -1 to nowy User
        $this->email='';
        $this->password='';
        $this->fullName='';
        $this->active;
    }
    
    public function setId($id){
        $this->id= is_integer($id) ? $id : -1;
        return $this;
    }
    
    public function setEmail($email){
        $this->email=is_string($email) ? $email : '';
        return $this;
    }
    
    public function setPassword($password){
        $this->password=is_string($password)? $password : '';
        return $this;
    }
    public function setHashedPassword($password){
        $this->password=is_string($password)?password_hash($password, PASSWORD_DEFAULT):'';
    }
    
    public function setFullName($fullName){
        $this->fullName=is_string($fullName)?$fullName:'';
        return $this;  
    }
    
    public function setActive($active){
        $this->active = $active == 0 || $active == 1 ? $active : 0;
        
    }
    
    public function saveToDB($conn){
        $sql='';
        if($this->id == -1){//uzytkownika nie  w bazie danych
            $sql = "INSERT INTO User(email, password, fullName, active)"
                    . "VALUES ('$this->email',"
                    . "'$this->password',"
                    . "'$this->fullName',"
                    . "'$this->active')";
            if($conn->query($sql)){
                $this->id = $conn->insert_id;
                return $this;
            }
            else{
                return false;
            } 
        } 
        else {
            $sql="UPDATE User SET"
                    . "email = '$this->email',"
                    . "password = '$this->password,"
                    . "fullName = '$this->fullName',"
                    . "active = '$this->active'"
                    . "WHERE id= $this->id";   //napisy-musza byc apostrofy
                    // liczby nie 
            if($conn->query($sql)){
                return $this;
            }
            else{
                return false;
            }
        
        }
        
    }
    
    
}
