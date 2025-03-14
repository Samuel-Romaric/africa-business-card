<form method="POST" action="{{ route('admin.user.update-personal-info') }}" enctype="multipart/form-data"> 
    @csrf
    <input type="hidden" value="{{ $user->id }}" name="user_id" id="user_id">
    <input type="hidden" value="{{ $user->slug }}" name="slug" id="user_slug">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" value="{{ $user->name }}" name="name" required class="form-control" id="name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input type="text" value="{{ $user->firstname }}" name="firstname" required class="form-control" id="firstname">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" id="email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="avatar" class="form-label">Photo de profile</label>
                <input type="file" name="avatar" class="form-control" id="avatar">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="telephone" class="form-label">Numero de téléphone</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" value="{{ $user->telephone }}" name="telephone" class="form-control" id="telephone">
            </div>
        </div>
        <div class="col-md-6">
            <label for="whatsapp" class="form-label">Numero WhatsApp</label>
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                <input type="text" value="{{ $user->whatsapp }}" name="whatsapp" class="form-control" id="whatsapp">
            </div>
        </div>
    </div>

    <hr style="color: rgb(184, 184, 184)">

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Enregistrer</button>
        </div>
    </div>
</form>