@foreach (['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $message)
    @if(Session::has('alert-'.$message))
        <div class="alert alert-{{ $message }} alert-dismissible fade show" role="alert">
            {{ Session::get('alert-'.$message) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach