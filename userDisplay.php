<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once 'index.php'; 

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['userId'])){
    require_once 'src/connection.php';
    require_once 'src/Tweet.php';
    require_once 'src/Comment.php';//mozna zalaczyc do jednego pliku
    // i dolaczac plik
    
    $userId = is_numeric($_GET['userId']) ? $_GET['userId'] : null;
    //var_dump(is_numeric($userId));
    
    //var_dump($userId);
    if($userId){
        //wyswietlanie wszytskich wpisow uzytkownika
        $tweets = Tweet::loadAllTweetsByUserId($conn, $userId);

        echo 'Wpisy uzytkownika:<br>';
        foreach($tweets as $tweet){
            //echo "<a href='tweetDisplay.php'>{$tweet->showTweet()}</a>";
            
            //metoda wyswietlajaca wpis
            $tweet->showTweet();  
            
            //wyswietlanie liczby komentarzy
            $comments = $tweet->loadAllCommentsByTweetId($conn);
            echo 'Liczba komentarzy: '.count($comments).'<br>';
            
            $tweetId = $tweet->getId();
            echo "<a href='tweetDisplay.php?tweetId=$tweetId'>Zobacz tweeta</a> <br>";
        }
    }else{
        echo 'Nieprawidlowe id<br>';
    }
    $conn->close();
    $conn = NULL;

}
//else{
//    header('Location: login.php'); //przekierowanie na strone logowania
//}


?>
<!--guzik do wyslania wiadomosci do uzytkownika-->
<meta charset='UTF-8'>
<form action="#" method='POST'>
    <label>
        <button type='submit' value='send_message'>
            Wyslij wiadomosc do uzytkownika</button>
    </label>
</form>
    


<!--pozamykac polaczenia!-->