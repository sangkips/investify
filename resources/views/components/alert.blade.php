@props([
    'autoDismiss' => 5000, // Auto dismiss after 5 seconds (in milliseconds)
])

@if (session('success') || session('error') || $errors->any())
<style>
    .alert-auto-dismiss {
        animation: slideIn 0.3s ease-out;
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }
    .alert-auto-dismiss.fade-out {
        opacity: 0;
        transform: translateY(-20px);
    }
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible alert-auto-dismiss" role="alert" data-auto-dismiss="{{ $autoDismiss }}">
        <h3 class="mb-1">Success</h3>
        <p class="mb-0">{{ session('success') }}</p>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible alert-auto-dismiss" role="alert" data-auto-dismiss="{{ $autoDismiss }}">
        <h3 class="mb-1">Oops...</h3>
        <p class="mb-0">{{ session('error') }}</p>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible alert-auto-dismiss" role="alert" data-auto-dismiss="{{ $autoDismiss }}">
        <h3 class="mb-1">Oops...</h3>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    </div>
@endif

@if (session('success') || session('error') || $errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.alert-auto-dismiss').forEach(function(alert) {
            const dismissTime = parseInt(alert.dataset.autoDismiss) || 5000;
            
            // Auto dismiss after specified time
            setTimeout(function() {
                alert.classList.add('fade-out');
                
                // Remove element after fade animation
                setTimeout(function() {
                    alert.remove();
                }, 500);
            }, dismissTime);
        });
    });
</script>
@endif
