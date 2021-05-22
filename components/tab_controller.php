<?php
require_once "model.php";
if (isset($_GET['userID'])) {
    //--------------------------HYDRATE LA PAGE EVENT
    $userID = $_GET['userID'];
    $conn = false;
    if (!($USER == 'NOTCON')) {
        if ($USER['id'] == $userID) {
            $conn = true;
        }
    }
    $events = getAllEventsOfUser($userID);
    foreach ($events as $event) {
        $name = $event['name'];
        $date = $event['date'];
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
        require "blocks/row.php";
    }

}
