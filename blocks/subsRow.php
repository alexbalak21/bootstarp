<tr>
  <td>
    <?=$sub['id'] ?>
  </td>
  <td>
    <a href="?page=event&id=<?=$sub['eventID'] ?>">
    <?=$sub['eventName'] ?>
  </a>
  </td>
  <td>
  <a href="?page=event&id=<?=$sub['eventID'] ?>">
    <?=$sub['eventID'] ?>
    </a>
  </td>
  <td>
  <a href="?page=user&id=<?=$sub['userID'] ?>">
    <?=$sub['userID'] ?>

  </td>
  <td>
  <a href="?page=user&id=<?=$sub['userID'] ?>">
  <?=$sub['names'] ?>
  </a>
  </td>
  <td>
  <?=$subOn ?>
  </td>
  <td>
  <a href="components/controller.php?cmd=DelSub&SubID=<?=$sub['id'] ?>">
    <button class="btn btn-danger">Supprimer Inscription</button>
    </a>
  </td>
</tr>
