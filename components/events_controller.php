<?php
require_once "components/convert.php";
$events = getAll('events');
foreach ($events as $event) {
    $name = $event['name'];
    $date = toFrDate($event['date']);
    $description = $event['description'];
    $img = $event['img'];
    $eventID = $event['id'];
    $creatorID = $event['creatorID'];
    $button = "";
    if (isset($_COOKIE['userID'])) {
        $userID = $_COOKIE['userID'];
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

    require "blocks/card.php";
}
