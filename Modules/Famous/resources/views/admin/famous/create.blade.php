@extends('admin.layout.master')

@section('title', __('famous::common.famous'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.famous.index')}}">{{__('famous::common.famous')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.famous.store')}}" method="post">
                @csrf
                @include('famous::admin.famous._form')
            </form>
        </div>
    </div>

@endsection