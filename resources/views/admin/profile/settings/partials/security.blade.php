<div class="row">
    <div class="col-md-12">

        <form method="POST" action="{{ route('admin.profile.reset-password') }}" id="">
            @csrf
            {{-- <input type="hidden" value="{{ $user->id }}" name="user_id">
            <input type="hidden" value="{{ $user->slug }}" name="slug"> --}}

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Mot de passe actuel</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="current_password" id="current_password" placeholder="**********************">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="password" class="form-label">Nouveau mot de passe</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="password" id="password" placeholder="**********************">
                            <button class="btn btn-outline-secondary" onclick="generatePassword()" type="button">Générer</button>
                        </div>
                    </div>
                </div><div class="col-md-4">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="**********************">
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
</div>
