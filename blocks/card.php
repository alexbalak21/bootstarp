<div class="col-xl-4 col-lg-6 mb-4">
  <div class="card h-100">
    <a href="?page=event&id=<?=$eventID ?>"><img class="card-img-top img-card" src="public/uploads/<?=$img ?>" alt="<?=$img ?>"></a>
    <div class="card-body">
    <div class="row">
    <h3 class='col-6 text-start' ><?=$name ?></h3>
    <h3 class='col-6 text-end'><?=$date ?></h3>
    </div>
    <h3 class="text-center  " ><?=$event['city'] ?></h3>
      <p class="card-text card-desc"><?=$event['description'] ?></p>
      <div class="position-realative">
      <div class="col-4">
      <a href="?page=event&id=<?=$eventID ?>"><button type="button" class="m-4 position-absolute bottom-0 start-0 btn btn-primary">Voir les details</button></a>
      </div>
      <?=$button ?>
      </div>
    </div>
  </div>
</div>



