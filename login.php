<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once 'src/connection.php';
    require_once 'src/User.php';
    
    $email=isset($_POST['email']) ? 
            $conn->real_escape_string(trim($_POST['email'])) : null;//zeby nie bylo sql injection
    $password=isset($_POST['password']) ? trim($_POST['password']) : null;
    if(strlen($email)>=5 && strlen($password)){     
        if($userId = User::logIn($conn, $email, $password)){//udalo sie zalogowac
            $_SESSION['loggedUserId']=$userId;//zapisywanie id zalogowanego uzytkownika do sesji
            header('Location: index.php'); //przekierowanie do strony glownej-
            //jesli zalogowany
            //do strony glownej
            //echo 'ss';
        }
        else{
            echo 'Nie udalo sie zalogowac';
        }
                
        
        
    }
}

?>
<html>
    <head></head>
    <body>
        <form method="POST">
            <fieldset>
                <label>
                    E-mail:
                    <input type="text" name="email">
                </label>
                <br>
                <label>
                    Password:
                    <input type="password" name="password">
                </label>
                <br>
            </fieldset>
            <input type="submit" value="Login">
        </form>
        <br>
        <a href="register.php">Registration</a>
    </body>
</html>

