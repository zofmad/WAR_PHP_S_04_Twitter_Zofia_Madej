<meta charset="UTF-8">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//strona z formularzem do wyslania wiadomosci


session_start();
if(!($_SERVER['REQUEST_METHOD'] === 'POST' 
        && isset($_POST['user_id']) 
        && isset($_SESSION['loggedUserId']))){
    header('Location: index.php');
}

require_once 'src/Message.php';
require_once 'src/common.php';

$userId = is_numeric($_POST['user_id']) ? (int) $_POST['user_id'] : null;
?>
<a href='index.php'>Strona glowna</a>
<a href='userDisplay.php?user_id=<?php echo $userId; ?>'>
    Powrot do strony wyswietlania uzytkownika</a>
<?php
//obsluzenie formularza

if(isset($_POST['message_text'])){ //czy zmienna przeslana 

    $messageText = is_string($_POST['message_text']) ?  
            $conn->real_escape_string(trim($_POST['message_text'])) : '';

    $senderId = is_numeric($_SESSION['loggedUserId']) ? 
            (int) $_SESSION['loggedUserId'] : null;
    //var_dump($userId);

    $receiverId = is_numeric($_POST['user_id']) ? 
            (int) $_POST['user_id'] : null;


    if($messageText && ($senderId != $receiverId)){

        $message = new Message();

        $message->setSenderId($senderId);
        $message->setReceiverId($receiverId);

        $message->setMessageText($messageText);

        $creationDate = date('Y-m-d H:i:s');
        $message->setCreationDate($creationDate);
        //echo $message->getCreationDate();

        $message->setIsRead(0);  //nowo stworzona wiadomosc 
        //oznaczona jako nieprzeczytana 

        //$message->showMessage();
        if($message->createMessage($conn)){
            echo 'Wyslano wiadomosc<br>';
        }
    }
    
}
$conn->close();
$conn=null;

?>


<form action="" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $userId?>"
    <label>
        <textarea name="message_text"></textarea>
    </label>
    <br>
    <input type="submit" value="Wyslij wiadomosc">
</form>



