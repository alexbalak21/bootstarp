<div class="modal" tabindex="-1" id="deleteUserConfirm<?=$eventID ?>">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Etez vous sur ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
          <h3 class="text-danger">Supprimer ce Compte:</h3>
          <form action="components/controller.php" method="POST">
          <input type="hidden" name="userToDelete" value="<?=$eventID ?>">
        <div class="py-3">
        <button class="btn btn-danger btn-lg" type="submit" name="confirmDeleteUser">Suprimer</button>
        <button class="btn btn-primary btn-lg" type="button" data-bs-dismiss="modal">Annuler</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>
