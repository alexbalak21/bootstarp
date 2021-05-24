<tr>
<td><?=$event['id'] ?></td>
<td><a href="?page=event&id=<?=$eventID ?>"><?=$event['name'] ?></a></td>
<td><?=$event['category'] ?></td>
<td><?=$event['city'] ?></td>
<td><?=$event['place'] ?></td>
<td><?=$date ?></td>
<td><?=$time ?></td>
<td><?=$postDate ?></td>
<td><a href="index.php?page=lestEventUsers&eventID=<?=$eventID ?>"><?=$count ?></a></td>
<td><?=$activ ?></td>
<td><?=$delete ?></td>
<td><?="<img class='tab-img' src='public/uploads/$img'></img>" ?></td>
</tr>