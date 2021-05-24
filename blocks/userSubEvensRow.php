<?php
$link = "index.php?unsub=$id&eventID=$eventID";
?>
<tr>
<td><?=$date ?></td>
<td><?=$time ?></td>
<td><?=$event['city'] ?></td>
<td><?=$event['place'] ?></td>
<td><?=$subs ?></td>
<td><a href="index.php?page=user&id=<?=$creatorID ?>"><?=$event['names'] ?></a></td>
<td> <a href="<?=$link ?>"><button class='btn btn-secondary'>Desinscrire</button></a></td>
</tr>
