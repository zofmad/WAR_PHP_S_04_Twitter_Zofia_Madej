<meta charset="UTF-8">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//strona z wszystkimi uzytkownikami 
session_start();
if(!isset($_SESSION['loggedUserId'])){
    header("Location: index.php");
}
require_once 'src/common.php';

$users = User::loadAllUsers($conn);
foreach($users as $user){
    $user->showUser();
    $userId = $user->getId();
    echo "<a href='userDisplay.php?user_id=$userId'>Wyswietl uzytkownika</a><br>";
}




$conn->close();
$conn = null;