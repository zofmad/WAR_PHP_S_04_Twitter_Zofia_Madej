<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//plik do laczenia z baza danych

$serverName='localhost';
$userName='root';
$password='coderslab';
$baseName='WAR_PHP_S_04_Twitter_Zofia_Madej';
//jeszcze nie mamy -pusta //domyslnie-serwer

$conn=new mysqli($serverName, 
        $userName, $password, $baseName);

if($conn->connect_error){
    die('Błąd przy połączeniu do'
            . ' bazy danych $baseName:'.$conn1->connect_error);
    //np Blad przy polaczeniu do bazy danych :
    //Unknown database 'a'
    
}
$conn->set_charset("utf8");
echo 'Połączenie z bazą danych udane<br>';//nie trzeba else bo jest die()



