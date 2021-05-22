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
<h1 class="text-center my-4">TABLE DES EVENMENTS</h1>
<table class="table text-center">
    <tr>
<th>Date</th>
<th>Nom de l'evenment</th>
<th>Ville</th>
<th>Endroit</th>
<th>Participants</th>
<?=$actions ?>
</tr>
<?php
require_once "components/tab_controller.php";
?>
</table>
</main>


