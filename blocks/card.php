<div class="col-xl-4 col-lg-6 mb-4">
  <div class="card shadow-sm h-100">
    <a href="?page=event&id=<?=$eventID ?>"><img class="card-img-top img-card" src="public/uploads/<?=$img ?>" alt="<?=$img ?>"></a>
    <div class="card-body">
    <div class="row">
    <small class="col-2 text-muted">Ville: </small>
    <small class="col-9 text-end text-muted">Date: </small>
    <h4 class='col-6 text-start mb-3' ><?=$event['city'] ?></h4>

    <h5 class='col-6 text-end'><?=$date ?></h5>
    </div>
    <b> <h2 class="text-center  " ><?=$name ?></h2></b>
    <small class="text-muted">Description:</small>
      <p class="card-text card-desc"><?=$cardDesc ?></p>
      <div class="position-realative">
      <div class="col-4">
        <?=$viewButton ?>
      </div>
      <?=$button ?>
      </div>
    </div>
  </div>
</div>