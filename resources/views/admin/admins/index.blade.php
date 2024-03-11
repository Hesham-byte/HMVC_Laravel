@extends('admin.layout.master')

@section('title',__('users.admins'))

@section('content')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('users.admins')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.admins.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus" aria-hidden="true"></i> {{__('main.create')}}</a>
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>{{__('main.id')}}</th>
                        <th>{{__('users.name')}}</th>
                        <th>{{__('users.email')}}</th>
                        <th>{{__('users.role')}}</th>
                        <th>{{__('users.mobile_number')}}</th>
                        <th>{{__('main.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->lang }}</td>
                            <td>{{ $user->mobile_number }}</td>
                            <td>
                                @can('edit-admin')
                                    <a href="{{route('admin.admins.edit',['admin'=>$user])}}" title="{{__('main.edit')}}" class="col"><i class="fa fa-pencil text-success" aria-hidden="true"></i></a>
                                @endcan
                                @can('delete-admin')
                                    <a href="{{route('admin.admins.destroy',['admin'=>$user])}}" title="{{__('main.delete')}}" class="col delete"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                @endcan
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