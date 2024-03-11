@extends('admin.layout.master')

@section('title',__('users.admins'))

@section('content')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.admins.index')}}">{{__('users.admins')}}</a>
        <span class="breadcrumb-item active">{{__('main.edit')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.admins.update',['admin'=>$user])}}" method="post">
                @method('put')
                @csrf
                @include('admin.admins._form')
            </form>
        </div>
    </div>
@endsection