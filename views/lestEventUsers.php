<?php
$eventID = $_GET['eventID'];
$eventName = getTitleOfEvent($eventID);
?>

<main id='main' class="mt-4 container">
<h2 class="text-center my-5"><?=$eventName ?></h2>
<h2 class="text-center my-4">TABLE DES INSCRITS</h2>

<table class="table text-center">
    <tr>
<th>Nom , Prenom</th>
<th>Date d'inscription</th>
</tr>
<?php
require_once "components/viewsControllers/list_Event_Users_controller.php";

?>
</table>

</main>
