<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//strona tworzenia uzytkownika


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once "src/connection.php";
    require_once "src/User.php";
    
    $email = (isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5) ? 
            $conn->real_escape_string(trim($_POST['email'])) : null;
            //real_escape_string-czyszczenie znakow spejalnych-zwrocona 
            //zmienna moze byc bezpiecznie uzyta w zpytaniach SQL
            //(ochrona przed SQL Injection
    $password = isset($_POST['password']) ?
            $conn->real_escape_string(trim($_POST['password']))
            : null;//tutaj juz sprawdzamy haslo bo wysylamy do formularza,
            // a tam tylko odczytujemy (w login.php)
    
    $passwordConfirmation= isset($_POST['passwordConfirmation']) ? 
            trim($_POST['passwordConfirmation']) : null; 
            /////tutaj nie sprawdzamy sql injection, 
            //bo nie przesylamy tego hasla,
            // tylko sprawdzamy
    $fullName=isset($_POST['fullName']) ? 
            $conn->real_escape_string(trim($_POST['fullName'])) : ' ';//bylo null
    //full Name nie jest wymagane w tabeli
    
    //metoda sprawdzajaca czy email jest juz w bazie danych 
    $user=User::getUserByEmail($conn, $email); 
    if($email && $password && $password === $passwordConfirmation && !$user){
        //gdy wszystkie dane poprawne i uzytkownika nie ma w systemie
        //dodajemy uzytkownika
        $newUser = new User();
        $newUser->setEmail($email);
        $newUser->setHashedPassword($password);//zahashowane haslo
        $newUser->setFullName($fullName);
        $newUser->setActive(1);
        if($newUser->saveToDB($conn)){
            //powinno byc na strone glowna 
            header('Location: login.php');//przekierowanie na strone logowania
        }
        else{
            echo 'Rejestracja nie powiodla sie';
        }
    }
    else{
        if($user){//jesli user juz istnieje-
        //czyli jest juz taki email w bazie danych-nie ma przekierowania
            
            //komunikat o zajetym adresie email
            echo 'Podany adres e-mail juz istnieje w bazie danych<br>';
        }else{
            echo 'Nieprawidlowe dane<br>';  
        }
    }
    
}


?>
<!--//formularz do rejestracji:

//fieldset-zestaw pol-->
<meta charset="UTF-8">
<form method="POST">
    <fieldset>
        <label>
            E-mail:<br>
            <input type="text" name="email">
        </label>
        <br>
        <label>
            Password:<br>
            <input type="password" name="password">
        </label>
        <br>
        <label>
            Password confirmation:<br>
            <input type="password" name="passwordConfirmation">
        </label>
        <br>
        <label>
            Full name:<br>
            <input type="text" name="fullName">
        </label>
    </fieldset>
    <br>
    <input type="submit" value="Register">
</form>
    