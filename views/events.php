<main class="mt-4 container">
<h1 class="text-center my-4">EVENMENTS</h1>      
</main>

<?php
 require_once"components/model.php";
 $events = getAll('events');
 var_dump($events);

?>
