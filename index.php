<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//index jest strona domyslna po wejsciu na katalog

//logowanie z sesji - jesli jest taki indeks 
session_start();
if(!isset($_SESSION['loggedUserId'])){//jesli nie jest ustawione, to sie nie zalogowal-
    //przesylanie na strone logowania
    header("Location: login.php");//do przekierowania na inna strone
}
?>
Id uzytkownika: <?php echo $_SESSION['loggedUserId'];//moze byc bez srednika ? znacznik zamykajacy
?> 
<a href='logout.php'>Logout</a>