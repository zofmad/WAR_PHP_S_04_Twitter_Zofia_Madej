<meta charset='UTF-8'>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//strona wiadomosci

if(!($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['message_id']))){
    //header('Location: index.php');
}
    
    require_once 'src/common.php';
    
    $messageId = is_numeric($_GET['message_id']) ? 
            (int) $_GET['message_id'] : null;
    if($messageId){
        
        echo "Informacje o wiadomosci:<br>";

        $message = new Message();
        $message->loadFromDB($conn, $messageId);
        //$message->showMessage($conn);
        //oznaczenie wiadomosci jako przeczytana -  
        //- zmiana wartosci atrybutu isRead
        $message->setIsRead(1);
        //zapis do bazy danych  
        $message->updateMessage($conn);

        //nadawca wiadomosci
        $senderId = $message->getSenderId();
        $user = new User();
        $user->loadFromDB($conn, $senderId);

        echo 'Nadawca:<br>';
        $user->showUser();
        echo '<br>';

        //odbiorca wiadomosci
        $receiverId = $message->getReceiverId();
        $user->loadFromDB($conn, $receiverId);

        echo 'Odbiorca:<br>';
        $user->showUser();
        echo '<br>';
        
        //data wyslania
        
        echo 'Data dodania: '.$message->getCreationDate();
        echo '<br><br>';
        
        //tresc 
        
        echo 'Tresc wiadomosci:<br>'.$message->getMessageText();
        

    }

$conn->close();
$conn = null;  





