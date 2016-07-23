<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//strona glowna


//index jest strona domyslna po wejsciu na katalog

//logowanie z sesji - jesli jest taki indeks 
session_start();
if(!isset($_SESSION['loggedUserId'])){//jesli nie jest ustawione, to sie nie zalogowal
    
    //przesylanie na strone logowania
    header("Location: login.php");//do przekierowania na inna strone
}
?>
Id uzytkownika: <?php echo $_SESSION['loggedUserId'];//moze byc bez srednika ? znacznik zamykajacy
?> 
<meta charset="UTF-8">
<a href='logout.php'>Logout</a>
<!--<a href=''></a>-->


<!--formularz do stworzenia wpisu-->

<form method="POST">
    <label>Stworz nowy wpis:
        <textarea name="text"></textarea>
<!--        placeholder="1-140 znaków"-->
    </label>
    <label>
        <input type="submit" value="Dodaj wpis">
    </label>  
</form>
<?php

require_once 'src/connection.php';
require_once 'src/User.php';
require_once 'src/Tweet.php';


$userId =(int) $_SESSION['loggedUserId']; 
//rzutowanie typu, trzeba przekonwertowac na int, odbiera string

//obsluzenie formularza
if($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['text'])){
    if($_POST['text'] && strlen($_POST['text']) <= 140){
        $text = $conn->real_escape_string($_POST['text']); //mozna zrobic trojargumentowym
        $tweet1 = new Tweet();
        $tweet1->setUserId($userId);
        $tweet1->setText($text);//chaining
        if($tweet1->createTweet($conn)){
            echo 'Dodano tweet<br>';
        }
        else{
            echo 'Nie dodano tweeta.<br>'.$conn->error;
        }
//$newTweet->loadFromDB($conn, 5);
//var_dump($newTweet);      
            
    }
    else{
        echo 'Nieprawidlowa dlugosc tekstu.<br>';
        
    }
    
}

//wyswietlanie wszystkich tweetow zalogowanego uzytkownika
$tweets = array();

$tweets = Tweet::loadAllTweetsByUserId($conn, $userId);//tweety dla usera
//czy loadAllTweets
//var_dump($tweets);
echo 'Twoje wpisy:<br>';
foreach($tweets as $tweet){
    $tweet->showTweet();
    $tweetId = $tweet->getId();
    echo "<a href='tweetDisplay.php?tweetId=$tweetId'>
        Informacje o wpisie</a>";
    
}


?>
<!--

<meta charset="UTF-8">
<a href=''>Przejdz na strone -->


