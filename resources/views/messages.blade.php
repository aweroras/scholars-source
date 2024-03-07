@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorAlert = document.querySelector('.alert-danger');
        const successAlert = document.querySelector('.alert-success');
        
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 3000); // 3 seconds
        }

        if (successAlert) {
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 3000); // 3 seconds
        }
    });
</script>
