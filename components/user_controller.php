<?php
if ($_GET['page'] = "user") {
    $userID = $_GET['id'];
} else {
    header("Location: index.php");
}

$user = getUserByID($userID);

$MyEvents = count(getAllEventsOfUser($userID));
$participatingEvents = count(getAllUsersParticipatingEvets($userID));
