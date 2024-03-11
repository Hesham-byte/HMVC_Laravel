@extends('admin.layout.master')

@section('title',__('main.roles'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('main.roles')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.roles.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> {{__('main.create')}}</a>
            <br><br>
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>{{__('main.id')}}</th>
                        <th>{{__('main.name')}}</th>
                        <th>{{__('main.full_access')}}</th>
                        <th>{{__('main.can_download')}}</th>
                        <th>{{__('main.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->lang}}</td>
                            <td>@if($role->full_access) <i class="fa fa-check-circle text-success"></i> @endif</td>
                            <td>@if($role->can_download) <i class="fa fa-check-circle text-success"></i> @endif</td>
                            <td>
                                <a href="{{route('admin.roles.edit',['role'=>$role])}}" class="col" title="{{__('main.edit')}}"><i class="text-success fa fa-pencil"></i></a>
                                <a href="{{route('admin.roles.destroy',['role'=>$role])}}" class="delete col" title="{{__('main.delete')}}"><i class="text-danger fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <x-delete-js/>
@endpush