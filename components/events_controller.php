<?php
$userID = checkConnect();
require_once "components/convert.php";
$events = getAll('events');
foreach ($events as $event) {
    $eventID = $event['id'];
    $name = $event['name'];
    $date = toFrDate($event['date']);
    $description = $event['description'];
    $img = $event['img'];
    $eventID = $event['id'];
    $creatorID = $event['creatorID'];
    $button = "";
    if ($userID) {
        $check = checkUserInEvent($eventID, $userID);
//-----------------------------AFFICHE BOUTON PARTICIPER / SE DESINSCRIRE
        if ($check) {
            $button = "<a href='index.php?unsub=$userID&eventID=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-secondary btn'>Desinscrire</button></a>
        ";
        } else {
            $button = "<a href='index.php?sub=$userID&eventID=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-primary btn'>Participer</button></a>
        ";
        }
        if ($creatorID == $userID) {
            $button = "<a href='index.php?page=updateEvent&id=$eventID'><button type='submit' class='m-4 position-absolute bottom-0 end-0 btn btn-success btn'>Gerer</button></a>";
        }
    }
    if ($userID == 1) {
        require "blocks/eventDeleteConfirm.php";
        $button = "<button class='btn btn-danger position-absolute bottom-0 end-0 m-4' data-bs-toggle='modal' data-bs-target='#deleteEventConfirm$eventID'>Suprimer</button>";
    }

    require "blocks/card.php";
}
