<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//strona logowania 

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once 'src/connection.php';
    require_once 'src/User.php';
    
    $email=isset($_POST['email']) ? 
            $conn->real_escape_string(trim($_POST['email'])) : null;//zeby nie bylo sql injection
    
    $password=isset($_POST['password']) ?
            trim($_POST['password']) : null;
    
    if(strlen(trim($email)) && strlen($password)){  //bez 5  
        if($userId = User::logIn($conn, $email, $password)){
        //udalo sie zalogowac-email i haslo poprawne   
            
            $_SESSION['loggedUserId']=$userId;
            header('Location: index.php'); //przekierowanie do strony glownej-
            //jesli zalogowany
            //do strony glownej
        }
        else{
            echo 'Nie udalo sie zalogowac.';//lukasz
        }  
    }
    //echo 'Nie udalo sie zalogowac. Bledny login lub haslo';
    $conn->close();
    $conn = null;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST">
            <fieldset>
                <label>
                    E-mail:
                    <input type="text" name="email" required>
                </label>
                <br>
                <label>
                    Password:
                    <input type="password" name="password" required>
                </label>
                <br>
            </fieldset>
            <input type="submit" value="Login">
        </form>
        <br>
<!--        link do strony tworzenia uzytkownika-->
        <a href="register.php">Registration</a>
    </body>
</html>

