@extends('admin.layout.master')

@section('title', __('customers::common.customers'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('customers::common.customers')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.customers.create')}}" class="btn btn-outline-primary mb-1 float-right"><i class="fa fa-plus"></i> {{__('main.create')}}</a>

            <table class="table" id="customers-table">
                <thead>
                    <tr>
                        <th>{{__('main.id')}}</th>
                        <th>{{__('users.name')}}</th>
                        <th>{{__('users.email')}}</th>
                        <th>{{__('users.mobile_number')}}</th>
                        <th>{{__('main.country')}}</th>
                        <th>{{__('main.gander')}}</th>
                        <th>{{__('main.actions')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@push('js')
<script>
    $(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.customers.get-data',request()->all())}}",
            columns:[
                {data:'id',name:'id'},
                {data:'name',name:'name'},
                {data:'email',name:'email'},
                {data:'mobile_number',name:'mobile_number'},
                {data:'country',name:'country'},
                {data:'gander',name:'gander'},
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