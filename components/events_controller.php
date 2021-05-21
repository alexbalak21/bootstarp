<?php
$events = getAll('events');
foreach ($events as $event) {
    $name = $event['name'];
    $date = $event['date'];
    $description = $event['description'];
    $img = $event['img'];
    $id = $event['id'];
    require "blocks/card.php";
}
