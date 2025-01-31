        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-chat-square-text"></i>
                <div class="flash-message">
                    {{ session('success') }}
                </div>
          </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <div class="flash-message">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle"></i>
                <div class="flash-message">
                    {{ session('warning') }}
                </div>
            </div>
        @endif