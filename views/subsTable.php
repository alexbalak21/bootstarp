<?php
require_once "components/checkLogin.php";
$actions = "";
if (!($USER == 'NOTCON')) {
    if ($USER['id'] == $_GET['userID']) {
        $actions = "<th>Actions</th>";
    }
}

?>
<main class="mt-4 container">
<h1 class="text-center my-4">TABLE DES INSCRIPTIONS EVNMENTS</h1>
<h3 class="text-center my-4"><?=eventName ?></h3>
<h4 class="text-center my-4"><?=eventDate ?></h4>
<table class="table text-center">
<tr>
<th>Inscrit</th>
<th>Prenom, Nom</th>
<th>Inscrit à </th>
<th>ACtion</th>
<?=$actions ?>
</tr>
<?php
require_once "components/viewsControllers/subs_controller.php";
?>
</table>
</main>


