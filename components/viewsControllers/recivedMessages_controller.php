<?php
 $userID = checkConnect();  // CHECK CONNECTION
 if(!$userID){ //NOT CONNECTED
     header("Location: index.php");
 }
 else{ // CONNECTD
$messages = getUserMessages($userID);
 }

?>