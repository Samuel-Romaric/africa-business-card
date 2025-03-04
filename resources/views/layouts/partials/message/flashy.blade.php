        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-chat-square-text"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
            {{-- <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a> --}}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
            {{-- <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a> --}}
        </div>
        @endif

        @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 10px;"></button>
            {{-- <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a> --}}
        </div>
        @endif
        
        
        
        {{-- @if (session('success'))
            <div class="flashy flashy-success d-flex align-items-center" role="alert">
                <i class="bi bi-chat-square-text"></i>
                <div class="flashy-message">
                    {{ session('success') }}
                </div>
          </div>
        @endif

        @if (session('error'))
            <div class="flashy flashy-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <div class="flashy-message">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div class="flashy flashy-warning d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle"></i>
                <div class="flashy-message">
                    {{ session('warning') }}
                </div>
            </div>
        @endif --}}