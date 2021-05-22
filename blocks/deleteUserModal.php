<div class="modal" tabindex="-1" id="deleteUserModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Etez vous sur ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
          <h3 class="text-danger">Supprimer Votre Compte:</h3>
          <p>Etrez votre mot de pass pour confirmer</p>
          <form class="needs-validation" action="components/controller.php" method="POST" novalidate>
        <div class="py-4">
        <input class="col-8" type="password" name="password" required>
        </div>
        <div class="py-3">
        <button class="btn btn-danger btn-lg" type="submit" name="deleteUser">Suprimer Compte</button>
        <button class="btn btn-primary btn-lg" type="button" data-bs-dismiss="modal">Annuler</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
