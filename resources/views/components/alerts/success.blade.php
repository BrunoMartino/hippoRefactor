@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show text-center px-3 " role="alert">
        <button type="button" id="btn-close-alert" class="btn-close" style="visibility: hidden;" data-bs-dismiss="alert"
            aria-label="Close"></button>

        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('btn-close-alert').click()
        }, 4000);
    </script>
@endif
