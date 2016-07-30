<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//strona edycji uzytkownika
//Użytkownik ma mieć możliwość edycji informacji o 
//sobie i zmiany hasła. Pamiętaj o tym, że użytkownik 
//        może edytować tylko i wyłącznie swoje informację.

if(!isset($_SESSION['loggedUserId'])){
    header('Location: index.php');
}

//var_dump($_SESSION['loggedUserId']);


$id = is_numeric($_SESSION['loggedUserId']) ? 
        (int) $_SESSION['loggedUserId'] : null; 


//var_dump($id);

require_once 'src/common.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    //header('Location: index.php');
    
    $user = new User();
    $user->loadFromDB($conn, $id);
//    echo 'Aktualne informacje o uzytkowniku:<br>'
//    .$user->showUser();
}


if($_SERVER['REQUEST_METHOD'] === 'POST' 
        && isset($_POST['email']) 
        && isset($_POST['full_name']) 
        && isset($_POST['password']) 
        && isset($_POST['password_confirm'])){
    $email = is_string($_POST['email']) ? 
            $conn->real_escape_string($_POST['email']) : null;
    $fullName = is_string($_POST['full_name']) ? 
            $conn->real_escape_string($_POST['full_name']) : null;
    $password = is_string($_POST['password']) ? 
            $conn->real_escape_string($_POST['password']) : null;
    $passwordConfirm = is_string($_POST['password_confirm']) ? 
            $conn->real_escape_string($_POST['password_confirm']) : null;
    
    if($email && $fullName && $password && $password === $passwordConfirm){
        $user = new User();
        $user->loadFromDB($conn, $id);
//        echo $user->getId();
        $user->setEmail($email);
//        echo $user->getEmail();
        $user->setFullName($fullName);
        $user->setHashedPassword($password);
        $user->setActive(1);
        $user->showUser();
//        var_dump($user->getPassword());
        if($user->saveToDB($conn)){
            echo 'Zmieniono informacje<br>';   
        }
        else{
            echo 'Nie zmieniono informacji<br>';
            
        }
       
    }  
 }
    
    
    
    
    
    
    
    
    
    
//    
//    
//}




//$user->setEmail();
//$user->setPassword();
//$user->setFullName();
//$user->setActive();


?>


<meta charset='UTF-8'>
<form action="" method="POST">
    <fieldset>Edytuj informacje:
        <br>
        <label>Email:
            <input type="text" name="email">
        </label>
        <br>
        <label>Pelne imie:
            <input type="text" name="full_name"
        </label>
        <br>
        <label>Haslo:
            <input type="password" name="password">
        </label>
        <br>
        <label>Potwierdz haslo:
            <input type="password" name="password_confirm">
        </label>
    </fieldset>
    <input type="submit" value="Edytuj">
</form>
