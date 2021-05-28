<?php
require_once "blocks/modals/message.php";
require_once "components/convert.php";

$userID = checkConnect();
//------------------------------GET 1 EVENT PAGE
if (isset($_GET['id'])) {
    //--------------------------HYDRATE LA PAGE EVENT
    $eventID = $_GET['id'];
    $today = date("Y-m-d");
    $event = getEventByID($eventID);
    $creatorID = $event['creatorID'];
    $count = subsCount($eventID);
    $name = $event['name'];
    $img = $event['img'];
    $postDate = toFrDate($event['postDate']);
    $date = $event['date'];
    $frDate = toFrDate($date);
    $time = substr($event['time'], 0, 5);
    $names = $event['names'];
    $button = '';
    $link = "?page=user&id=$creatorID";
    $activateButton = "<button class='btn btn-success btn-lg' type='submit' name='activateEvent'>Activer</button>";
    if ($event['active']) {
        $activateButton = "<button class='btn btn-secondary btn-lg' type='submit' name='activateEvent'>Désactiver</button>";
    }
    if ($userID) {
        $check = checkUserInEvent($eventID, $userID);
        //-----------------------------AFFICHE BOUTON PARTICIPER / SE DESINSCRIRE
        if ($check) {
            $button = "<button type='submit' name='unsubscribe' value='$userID' class='btn btn-secondary btn-lg'>Se desinscrire</button>";
        } else {
            $button = "<button type='submit' name='subscribe' value='$userID' class='btn btn-primary btn-lg'>Participer</button>";
        }
        //--------------------------- AFFICHE SI C'EST MOI QUI ORGANISE
        if ($event['creatorID'] == $userID) {
            $firstname = "Moi";
            $lastname = '';
            $button = "<button type='submit' name='manage' value='$userID' class='btn btn-success btn-lg'>Gerer l'evenement</button>";
        }
    }

} else {
    header("Location: ../index.php");
}
