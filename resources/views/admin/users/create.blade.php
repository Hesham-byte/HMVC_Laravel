@extends('admin.layout.master')

@section('title',__('users.users'))

@section('content')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.users.index')}}">{{__('users.users')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.users.store')}}" method="post">
                @csrf
                @include('admin.users._form')
            </form>
        </div>
    </div>
@endsection