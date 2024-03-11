@extends('admin.layout.master')

@section('title', __('advertises::common.advertises'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.advertises.index')}}">{{__('advertises::common.advertises')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.advertises.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('advertises::admin.advertises._form')
            </form>
        </div>
    </div>

@endsection
