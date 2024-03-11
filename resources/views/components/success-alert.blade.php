@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="ri-close-line text-success"></i>
    </button>
</div><br>
@endif