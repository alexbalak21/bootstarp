<?php
require_once "controller.php";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (!file_exists("views/$page.php")) {
        $page = 'events';

    }
} else {
    $page = "events";
}
if (isset($_GET['logout'])) {
    require_once "logout.php";
}

//-----------------------------------SHOW EVENT UPDATE FORM
if (isset($_GET['manage'])) {
    $eventID = $_GET['id'];
    header("Location:../?page=updateEvent&id=$eventID");
}

//------------------------------------------SUBSCRIBE / UNSUBSCRIBE
if (isset($_GET['sub'])) {
    $userID = $_GET['sub'];
    $eventID = $_GET['eventID'];
    $subID = addToEvent($eventID, $userID);
    header("Location: index.php");
}

//--------------------------------UNSUCB
if (isset($_GET['unsub'])) {
    $userID = $_GET['unsub'];
    $eventID = $_GET['eventID'];
    $unsubID = unsubscribeEvent($eventID, $userID);
    echo $unsubID;
    header("Location: index.php");
}
