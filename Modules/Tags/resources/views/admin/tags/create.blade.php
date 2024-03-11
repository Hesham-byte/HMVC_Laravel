@extends('admin.layout.master')

@section('title', __('tags::common.tags'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.tags.index')}}">{{__('tags::common.tags')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.tags.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('tags::admin.tags._form')
            </form>
        </div>
    </div>

@endsection
