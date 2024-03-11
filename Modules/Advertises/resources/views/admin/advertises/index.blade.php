@extends('admin.layout.master')

@section('title', __('advertises::common.advertises'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('advertises::common.advertises')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.advertises.create')}}" class="btn btn-outline-primary mb-1 float-right"><i class="fa fa-plus"></i> {{__('main.create')}}</a>

            <table class="table" id="advertises-table">
                <thead>
                    <tr>
                        <th>{{__('main.id')}}</th>
                        <th>{{__('users.name')}}</th>
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
        $('#advertises-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.advertises.get-data',request()->all())}}",
            columns:[
                {data:'id',name:'id'},
                {data:'name',name:'name'},
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
