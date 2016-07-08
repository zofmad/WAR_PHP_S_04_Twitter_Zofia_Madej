<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if(isset($_SESSION['loggedUserId'])){
    unset($_SESSION['loggedUserId']);//usuwamy z tablicy sesji
}

header('Location: index.php');//przekierownie na glowna- jesli 
//ktos nie jest
// zalogowany to i tak przejdzie do login