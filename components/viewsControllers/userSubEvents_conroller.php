<?php
require_once "components/convert.php";
$actionBtn = "";
$id = $_GET['id'];
$events = allParticipateEvents($id);
foreach ($events as $event) {
    $creatorID = $event['creatorID'];
    $eventID = $event['id'];
    $date = toFrDate($event['date']);
    $time = substr($event['time'], 0, 5);
    $subs = $event['subscribed'];
    require "blocks/userSubEvensRow.php";
}
