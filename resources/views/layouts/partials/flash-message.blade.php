        <!-- Message de succès -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show custom-alert alert-fixed-center" role="alert">
                <div class="d-flex" style="align-items: center;">
                    <div class="alert-icon alert-icon-success">
                        <span><i class="bi bi-chat-text" style=""></i></span>
                    </div>
                    <div style="margin-left: 10px;">
                        <span class="alert-title">Félicitation !</span> <br>
                        <span class="alert-message">{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <!-- Message d'erreur -->
            <div class="alert alert-danger alert-dismissible fade show custom-alert alert-fixed-center" role="alert">
                <div class="d-flex" style="align-items: center;">
                    <div class="alert-icon alert-icon-danger">
                        <span><i class="bi bi-sign-stop" style=""></i></span>
                    </div>
                    <div style="margin-left: 10px;">
                        <span class="alert-title">Erreur !</span> <br>
                        <span class="alert-message">{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                </div>
            </div>
        @endif
        
        @if (session('primary'))
            <!-- Message d'information -->
            <div class="alert alert-primary alert-dismissible fade show custom-alert alert-fixed-center" role="alert">
                <div class="d-flex" style="align-items: center;">
                    <div class="alert-icon alert-icon-primary">
                        <span><i class="bi bi-info-lg" style=""></i></span>
                    </div>
                    <div style="margin-left: 10px;">
                        <span class="alert-title">Information !</span> <br>
                        <span class="alert-message">{{ session('primary') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                </div>
            </div>
        @endif
            
        @if (session('warning'))
            <!-- Message d'avertissement -->
            <div class="alert alert-warning alert-dismissible fade show custom-alert alert-fixed-center" role="alert">
                <div class="d-flex" style="align-items: center;">
                    <div class="alert-icon alert-icon-warning">
                        <span><i class="bi bi-exclamation-triangle-fill" style="color: white"></i></span>
                    </div>
                    <div style="margin-left: 10px;">
                        <span class="alert-title">Attention !</span> <br>
                        <span class="alert-message">{{ session('warning') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
                    </div>
                </div>
            </div>
        @endif
        
    
        