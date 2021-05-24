<?php
require_once "components/convert.php";
$conn = false;
$userID = checkConnect();
if (isset($_GET['userID'])) {
    $getID = $_GET['userID'];
    if ($getID == $userID) {
        $conn = true;
    }
}
$events = getAllEventsOfUser($getID);
foreach ($events as $event) {
    $name = $event['name'];
    $date = toFrDate($event['date']);
    $city = $event['city'];
    $place = $event['place'];
    $subs = $event['subscribed'];
    $description = $event['description'];
    $img = $event['img'];
    $eventID = $event['id'];
    $ations = '';
    $updateButton = '';
    $activateButton = '';
    $deleteButton = '';
    if ($conn) {
        $updateButton = "<button type='submit' name='manage' value='$userID' class='btn btn-primary mx-2'>Gerer l'evenement</button>";
        //ACTIVATE / DEACTIVATE BUTTON
        $activateButton = "<button class='btn btn-success mx-2' type='submit' name='activateEvent'>Activer</button>";
        if ($event['active']) {
            $activateButton = "<button class='btn btn-secondary mx-2' type='submit' name='activateEvent'>Désactiver</button>";
        }
        $deleteButton = "<button class='col-2 btn btn-danger mx-2' data-bs-toggle='modal' data-bs-target='#eventDeleteModal$eventID'>Suprimer</button>";
    }
    if (!$conn && $userID) {
        $updateButton = "<a href='index.php?page=event&id=$eventID'><button type='button' class='btn btn-primary btn'>Voir</button></a>";
    }
    require "blocks/row.php";
}
