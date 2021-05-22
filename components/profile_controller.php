<?php
if (isset($_COOKIE['user'])) {
    $USER = json_decode($_COOKIE['user'], true);
} else {
    header("Location: index.php");
}
$userID = $USER['id'];

$MyEvents = count(getAllEventsOfUser($userID));
$participatingEvents = count(getAllUsersParticipatingEvets($userID));
