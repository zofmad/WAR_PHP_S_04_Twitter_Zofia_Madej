<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//strona wyswietlania postu 


session_start();


if(!($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tweetId'])
        || ($_SERVER['REQUEST_METHOD'] === 'POST' 
                && isset($_POST['tweet_id']) 
                && isset($_POST['comment_text'])))){
    
    header('Location: login.php');
}

require_once 'src/Tweet.php';
require_once 'src/Comment.php';
require_once 'src/connection.php';
require_once 'src/User.php';
//require_once 'src/common.php';
 
    
 if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tweetId'])){  
    $tweetId = is_numeric($_GET['tweetId']) ? 
            (int) $_GET['tweetId'] : null;
 }
 
//obsluzenie formularza
if($_SERVER['REQUEST_METHOD'] === 'POST' && 
        isset($_POST['comment_text']) && isset($_POST['tweet_id'])){
    
//    require_once 'src/User.php';
//    require_once 'src/connection.php';
//    require_once 'src/Tweet.php';
//    require_once 'src/Comment.php';
    
    $commentText = is_string($_POST['comment_text']) ? 
            $conn->real_escape_string(trim($_POST['comment_text'])) : '';
    
    $tweetId = (int) $_POST['tweet_id'];
    
    if($commentText){
          
        $comment = new Comment();
        
        //id zalogowanego uzytkownika
        $userId = (int) $_SESSION['loggedUserId']; 
        //var_dump($userId);
        $comment->setUserId($userId);
        
        $tweetId = (int) $_POST['tweet_id'];
        //var_dump($tweetId);
        $comment->setTweetId($tweetId);
        
        $creationDate = date('Y-m-d H:i:s');
        // DATETIME – data w formacie RRRR-MM-DD GG:MM:SS
        $comment->setCreationDate($creationDate);
        
        $comment->setText($commentText);
        
        $comment->createComment($conn);
        //$commentUserId = $comment->
        
        
        //dodatkowo ALL strona z wszystkimi uzytkownikami 
        //widzimy tweety i komentarze, 
        //zamiast dodaj tweet , wyslij wiadomosc 
        //inbox - odebrane / wyslane  
        
    }
    else{
        echo "Nieprawidlowy tekst komentarza.<br>";
    }
}
 
if($tweetId){
        
        
    //wyswietlanie postu
    $tweet = new Tweet();
    $tweet->loadFromDB($conn, $tweetId);
    //metoda wyswietlajaca post
    $tweet->showTweet();

    //wyswietlanie autora posta
    $user = new User();
    $userId = (int) $tweet->getUserId();//autor tweeta
    //var_dump($userId);
    $user->loadFromDB($conn, $userId);
    //var_dump($user);
    //autor postu:
    echo "Autor tweeta:<br>";
    //metoda wyswietlajaca autora posta
    $user->showUser();
    //var_dump($tweetId);


    //wyswietlanie komentarzy do posta:
    $comments = Comment::loadAllCommentsByTweetId
            ($conn, $tweetId, $userId);

    echo 'Komentarze:<br>';
    foreach($comments as $comment){
        //var_dump($comment);
        //metoda wyswietlajaca komentarz do posta
        $comment->showComment();
        $commentUserId = $comment->getUserId();
        
        //wyswitlanie informacji o autorze komentarza
        $commentUser = new User();
        $commentUser->loadFromDB($conn, $commentUserId);
        //metoda wyswietlajaca autora do komentarza
        $commentUser->showUser();

    }  

}

$conn->close();
$conn = NULL;

//else{
//    header('Location: register.php');
//}
?>
<!--formularz do tworzenia nowego komentarza przypisanego do postu-->
<meta charset='UTF-8'>
<form action='#' method='POST'>
    <fieldset>
        <label>
            <textarea name="comment_text"></textarea>
        </label>
        <label>
            <input type='submit' value="Dodaj nowy komentarz"></input>
        </label>
        <input type="hidden" name="tweet_id" value="<?php echo $tweetId?>"> 
<!--        hidden schowane pole formularza, wylacznie przekazywanie zmiennej-->
    </fieldset>
</form>
            
<?php
 

?>

