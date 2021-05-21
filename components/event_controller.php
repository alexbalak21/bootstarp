<?php
//------------------------------GET 1 EVENT PAGE
if (isset($_GET['id'])) {
    //--------------------------HYDRATE LA PAGE EVENT
    $eventID = $_GET['id'];
    $event = getEventByID($eventID);
    $name = $event['name'];
    $postDate = toFrDate($event['postDate']);
    $date = $event['date'];
    $frDate = toFrDate($date);
    $time = substr($event['time'], 0, 5);
    $firstname = $event['firstname'];
    $lastname = $event['lastname'];
    $button = '';
    if (isset($_COOKIE['user'])) {
        $USER = json_decode($_COOKIE['user'], true);
        $userID = $USER['id'];

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

function toFrDate($date)
{
    $ymd = explode('-', $date);
    $frommatDate = $ymd[2] . '/' . $ymd[1] . '/' . $ymd[0];
    return $frommatDate;
}
