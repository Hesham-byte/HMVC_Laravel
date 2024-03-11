@if($errors->any())
<div class="alert alert-danger  fade show" role="alert">

    <div class="iq-alert-text">
        {{-- <p><b> errors</b> !</p> --}}
        @foreach ($errors->all() as $error)
        <span>{{ $error }}</span><br>
        @endforeach
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="ri-close-line text-danger"></i>
    </button>
</div>
@endif
