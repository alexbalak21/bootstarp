<?php
require_once "components/model.php";
require "components/convert.php";
$userID = checkConnect();

$events = getAll('events');
foreach ($events as $event) {
    $eventID = $event['id'];
    $img = $event['img'];
    $date = toFrDate($event['date']);
    $name = $event['name'];
    $city = $event['city'];
    $place = $event['place'];
    $time = substr($event['time'], 0, 5);
    $subs = $event['subscribed'];
    require "blocks/eventsTableRow.php";
}
