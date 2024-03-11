@extends('admin.layout.master')

@section('title',__('main.roles'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.roles.index')}}">{{__('main.roles')}}</a>
        <span class="breadcrumb-item active">{{__('main.edit')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.update',['role'=>$role])}}" method="post">
                @method('put')
                @include('admin.authorization.roles._form')
            </form>
        </div>
    </div>
@endsection