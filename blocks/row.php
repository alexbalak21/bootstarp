<tr>
<td>
    <?=$date ?>
</td>
<td>
    <?=$name ?>
</td>
<td>
    <?=$city ?>
</td>
<td>
    <?=$place ?>
</td>
<td>
    <?=$subs ?>
</td>
<td class="d-flex">

<form action="components/router.php" method="GET">
    <?=$updateButton ?>
    <input type="hidden" name="id" value="<?=$eventID ?>">
<input type="hidden" name="table" value="1">
</form>
<form action="components/controller.php" method="POST">
<input type="hidden" name="id" value="<?=$eventID ?>">
<input type="hidden" name="table" value="0">

<?=$activateButton ?>

</form>
<?=$deleteButton ?>

</td>
<?php
require "blocks/eventModal.php";
?>
</tr>