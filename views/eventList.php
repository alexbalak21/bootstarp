<?php
$userID = checkConnect();
if ($userID != 1) {
    header("Location: index.php");
}

?>



<main id='main' class="mt-4 container">
<h1 class="text-center my-4">TABLE DES EVENMENTS</h1>
<table class="table text-center">
<tr>
<th>ID</th>
<th>Nom</th>
<th>Cathegorie</th>
<th>Ville</th>
<th>Endroit:</th>
<th>Date debut</th>
<th>Heuere</th>
<th>Date de mise en ligne</th>
<th>Inscris</th>
<th>Ativé</th>
<th>Actions</th>
<th>Image</th>
</tr>
<?php
require_once "components/viewsControllers/eventList_controller.php";
?>
</table>

</main>
