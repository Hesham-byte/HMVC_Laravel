@extends('admin.layout.master')

@section('title', __('famous::common.famous'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('famous::common.famous')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            @can('create-famous')
                <a href="{{route('admin.famous.create')}}" class="btn btn-outline-primary mb-1 float-right"><i class="fa fa-plus"></i> {{__('main.create')}}</a>
            @endcan

            <div class="table-responsive">
                <table class="table" id="famous-table">
                    <thead>
                        <tr>
                            <th>{{__('main.id')}}</th>
                            <th>{{__('users.name')}}</th>
                            <th>{{__('users.email')}}</th>
                            <th>{{__('users.mobile_number')}}</th>
                            <th>{{__('main.country')}}</th>
                            <th>{{__('main.city_name')}}</th>
                            <th>{{__('main.gander')}}</th>
                            <th>{{__('main.status')}}</th>
                            <th>{{__('main.show_in_app')}}</th>
                            <th>{{__('main.actions')}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
    $(function() {
        $('#famous-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.famous.get-data',request()->all())}}",
            columns:[
                {data:'id',name:'id'},
                {data:'name',name:'name'},
                {data:'email',name:'email'},
                {data:'mobile_number',name:'mobile_number'},
                {data:'country',name:'country'},
                {data:'city_name',name:'city_name'},
                {data:'gander',name:'gander'},
                {data:'status',name:'status'},
                {data:'show_in_app',name:'show_in_app'},
                {data:'actions',name:'actions', orderable: false, searchable: false},
            ]
            ,dom: 'Bfrtip'
            @if(app()->isLocale('ar'))
                    ,language: {
                        url: '{{ url("/theme/datatable-ar.json") }}'
                    }
            @endif
            @if(auth()->user()->role && auth()->user()->role->can_download)
                ,buttons: [
                    { extend: 'pdf', className: 'dt-button buttons-excel buttons-html5' },
                    { extend: 'print', className: 'dt-button buttons-excel buttons-html5' },
                    { extend: 'excel', className: 'dt-button buttons-excel buttons-html5' }
                ]
            @endif
        });
    });
</script>
<x-delete-js/>
@endpush