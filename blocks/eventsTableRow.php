<tr>
  <td><a href="?page=event&id=<?=$eventID ?>">
  <a href="?page=event&id=<?=$eventID ?>"><img class='tab-big-img' src="public/uploads/<?=$img ?>" alt="<?=$img ?>"></a>
  </td>
  <td>
  <?=$date ?>
  </td>
  <td class="">
<?=$time ?>
  </td>
  <td>
  <a href="?page=event&id=<?=$eventID ?>"><?=$name ?></a>
  </td>
  <td>
  <?=$city ?>
  </td>
  <td>
<?=$place ?>
  </td>
  <td>
  <a href="?page=lestEventUsers&eventID=<?=$eventID ?>"><?=$subs ?></a>
  </td>
  <td>
  <a href="?page=event&id=<?=$eventID ?>"><button class="btn btn-primary">Participer</button></a>
  </td>
</tr>