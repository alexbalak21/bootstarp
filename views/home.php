<main class="mt-4 container">
<h1 class="text-center my-4">TITRE</h1>
      <div class="row">
        <div class="row">
<?php

require_once "components/controller.php";
$events = getAllEvents();

foreach($events as $event){
$name = $event['name'];
$startTime = $event['startTime'];
$description = $event['description'];
$img = $event['img'];
require "blocks/card.php";
}
?>
</di>
        </div>
</main>
