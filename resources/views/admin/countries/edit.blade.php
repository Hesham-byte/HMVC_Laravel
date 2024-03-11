@extends('admin.layout.master')

@section('title', __('main.countries'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.countries.index')}}">{{__('main.countries')}}</a>
        <span class="breadcrumb-item active">{{__('main.edit')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.countries.update', $model->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('admin.countries._form')
            </form>
        </div>
    </div>

@endsection
