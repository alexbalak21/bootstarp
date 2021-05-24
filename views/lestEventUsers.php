<?php
$eventID = $_GET['eventID'];
$eventName = getTitleOfEvent($eventID);
?>

<main class="mt-4 container">
<h2 class="text-center my-5"><?=$eventName ?></h2>
<h2 class="text-center my-4">TABLE DES INSCRITS</h2>

<table class="table text-center">
    <tr>
<th>Date d'inscription</th>
<th>Nom , Prenom</th>
</tr>
<?php
require_once "components/viewsControllers/list_Event_Users_controller.php";

?>
</table>

</main>
