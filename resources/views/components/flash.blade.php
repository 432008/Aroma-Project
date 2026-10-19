{{-- Global flash messages, rendered as floating toasts. --}}

@if(session('success') || session('error'))

      <div class="aroma-toasts" aria-live="polite" aria-atomic="true">

            @if(session('success'))
                  <div class="aroma-toast aroma-toast--success" role="status">
                        <i class="bi bi-check-circle"></i>
                        <p>{{ session('success') }}</p>
                        <button type="button" class="aroma-toast-close" aria-label="Dismiss notification">
                              <i class="bi bi-x-lg"></i>
                        </button>
                  </div>
            @endif

            @if(session('error'))
                  <div class="aroma-toast aroma-toast--error" role="alert">
                        <i class="bi bi-exclamation-circle"></i>
                        <p>{{ session('error') }}</p>
                        <button type="button" class="aroma-toast-close" aria-label="Dismiss notification">
                              <i class="bi bi-x-lg"></i>
                        </button>
                  </div>
            @endif

      </div>

@endif
