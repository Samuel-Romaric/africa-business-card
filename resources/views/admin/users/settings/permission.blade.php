<div class="row">
    <div class="col-md-6">

        <form method="POST" action="{{ route('admin.user.update-password') }}" id="">
            @csrf
            
            <input type="hidden" value="{{ $user->id }}" name="user_id" id="user_id">
            <input type="hidden" value="{{ $user->slug }}" name="slug_id" id="slug_id">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="name" class="form-label">Ancien mot de passe</label>
                        <input type="text" name="password" required class="form-control" id="name" placeholder="**********************">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Nouveau mot de passe</label>
                        <input type="text" name="new_password" required class="form-control" id="firstname" placeholder="**********************">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Confirmer mot de passe</label>
                        <input type="text" name="confirmation" required class="form-control" id="firstname" placeholder="**********************">
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

