<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$password='gssdfg';//hashownaie-zeby ktos nie mogl sie dotsac do naszej bazy danych


var_dump(password_hash($password,PASSWORD_DEFAULT)); //zawsze zwraca str o 
//dlugosci 60, najlepiej uzywam wdluzszej kolumny VARCHAR(255), bo w pryszlosci moze sie zmienic algorytm
