<div class="col-xl-4 col-lg-6 mb-4">
  <div class="card shadow-sm h-100 ">
    <a href="?page=event&id=<?=$eventID ?>"><img class="card-img-top img-card" src="public/uploads/<?=$img ?>" alt="<?=$img ?>"></a>
    <div class="card-body">
    <div class="row">
    <h3 class='col-6 text-start mb-3' ><?=$event['city'] ?></h3>
    <h4 class='col-6 text-end'><?=$date ?></h4>
    </div>
    <h2 class="text-center  " ><?=$name ?></h2>
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



