<div class="row">
    <div class="col-md-6">

        <form method="POST" action="{{ route('admin.user.reset-password') }}" id="">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="user_id">
            <input type="hidden" value="{{ $user->slug }}" name="slug">

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="mdp" class="form-label">Réinitialiser le mot de passe</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="new_password" id="password" readonly placeholder="**********************">
                            <button class="btn btn-outline-secondary" onclick="generatePassword()" type="button">Générer</button>
                        </div>
                    </div>
                </div>
            </div>
        
            <hr style="color: rgb(184, 184, 184)">
        
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Réinitialiser</button>
                </div>
            </div>
        </form>

    </div>
    <div class="col-md-6">

        <form method="POST" action="{{ route('admin.user.add-permission') }}" id="">
            @csrf
            <input type="hidden" value="{{ $user->id }}" name="user_id">
            <input type="hidden" value="{{ $user->slug }}" name="slug">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Ajouter le droit de gestion des comptes ?</label>
                        <select class="form-select" name="permission" aria-label="Premission selection">
                            <option value="is_admin" selected>Rétirer l'accès au comptes</option>
                            <option value="is_global">Gérer tous les comptes</option>
                          </select>
                    </div>
                </div>
            </div>
        
            <hr style="color: rgb(184, 184, 184)">
        
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2-circle"></i> Valider</button>
                </div>
            </div>
        </form>

    </div>
</div>

