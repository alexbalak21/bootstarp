<?php
$events = getAll('events');
foreach ($events as $event) {
    $name = $event['name'];
    $date = $event['date'];
    $description = $event['description'];
    $img = $event['img'];
    $eventID = $event['id'];
    $creatorID = $event['creatorID'];
    require "blocks/card.php";
}
