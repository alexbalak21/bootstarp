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

if (isset($_POST['subscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['subscribe'];
    $subID = addToEvent($eventID, $userID);
    header("Location:../?page=event&id=$eventID");
}

if (isset($_POST['unsubscribe'])) {
    $eventID = $_POST['eventID'];
    $userID = $_POST['unsubscribe'];
    $unsubID = unsubscribeEvent($eventID, $userID);
    echo $unsubID;
    header("Location:../?page=event&id=$eventID");
}

if (isset($_POST['manage'])) {
    $eventID = $_POST['eventID'];
    header("Location:../?page=updateEvent&id=$eventID");
}
