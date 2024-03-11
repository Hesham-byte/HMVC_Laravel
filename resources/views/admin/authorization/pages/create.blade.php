@extends('admin.layout.master')

@section('title',__('main.pages'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.pages.index')}}">{{__('main.pages')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.pages.store')}}" method="post">
                @include('admin.authorization.pages._form')
            </form>
        </div>
    </div>
@endsection