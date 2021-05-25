
<div class="modal" tabindex="-1" id="eventDeleteModal<?=$eventID ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Etez vous sur ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Veuiez confirmer la supression.</p>
      </div>
      <div class="modal-footer">
        <form action="components/controller.php" method="POST">
        <input type="hidden" name="id" value="<?=$eventID ?>">
        <button type="button" class="btn-lg btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-danger btn-lg" type="submit" name="deleteEvent">Suprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>