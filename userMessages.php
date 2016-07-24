<meta charset="UTF-8">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//strona z wiadomosciami

if(!($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id']))){
   // header('Location: index.php');
}
require_once 'src/common.php';
//    require_once ''

$userId = is_numeric($_GET['user_id']) ? 
        (int) $_GET['user_id'] : null;

if($userId){
  
    //wyswietlenie listy otrzymanych i wyslanych wiadomosci

    echo '<ul>Twoje wiadomosci:<br>';

    //wyslane wiadomosci 
    $sendMessages = Message::loadAllMessagesBySenderId($conn, $userId);


    echo '<li>Wyslane wiadomosci:<br><ol>';
    foreach($sendMessages as $message){
        //oznaczenie nieprzeczytanych wiadomosci
        if(!$message->getIsRead()){
            echo "<li style='font-weight: bold'>"; //pogrubienie tekstu
        }
        else{
            echo "<li>";
        }
        //wyswitlanie odbiorcy
        $receiverId = $message->getReceiverId();
        $user = new User();
        $user->loadFromDB($conn, $receiverId);
        echo 'Odbiorca:<br>';
        $user->showUser();
        echo '<br>';
        //data wyslania           
        echo 'Data wyslania: '.$message->getCreationDate().'<br><br>';

        //poczatek wiadomosci
        $subMessageText = substr(trim($message->getMessageText()), 0, 30);
        echo 'Poczatek wiadomosci:<br>'.$subMessageText.'<br>';
        $messageId = $message->getId();
        echo "<a href='messageDisplay.php?message_id=$messageId'>"
                . "Zobacz wiadomosc</a>";
        echo "</li>";
    }
    echo "</ol></li><br>";


    //odebrane wiadomosci
    $receivedMessages = Message::loadAllMessagesByReceiverId($conn, $userId);

    echo "<li>Odebrane wiadomosci:<br><ol>";
    foreach($receivedMessages as $message){
        if(!$message->getIsRead()){
            echo "<li style='font-weight: bold'>";
        }
        else{
            echo "<li>";
        }
        //wyswietlanie nadawcy
        $senderId = $message->getSenderId();
        $user = new User();
        $user->loadFromDB($conn, $senderId);
        echo "Nadawca:<br> ";
        $user->showUser();
        echo '<br>';

        //wyswietlanie daty wyslania
        echo 'Data wyslania: '.$message->getCreationDate().
                '<br><br>';

        //poczatek wiadomosci-pierwsze 30 znakow
        $subMessageText = substr($message->getMessageText(), 0, 30);
        echo 'Poczatek wiadomosci:<br>'.$subMessageText.'<br>';
        $messageId = $message->getId(); 
        echo "<a href='messageDisplay.php?message_id=$messageId'>"
                . "Zobacz wiadomosc</a><br>";
        echo "</li>";

    }
    echo "</ol></li><br>";
    
    $conn->close();
    $conn = null;
}


?>
<!--<ul>Twoje wiadomosci:
    <li><strong>Wiadomosci wyslane:
        <ol>
            <li>tekst
               foreach
            </li>
        </ol>
    </li>
    <li>
        <ol>
            <li>
                
            </li> 
        </ol>
    </li>
</ul>-->
