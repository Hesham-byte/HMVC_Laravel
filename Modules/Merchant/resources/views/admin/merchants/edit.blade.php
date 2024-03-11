@extends('admin.layout.master')

@section('title', __('merchant::common.merchants'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.merchants.index')}}">{{__('merchant::common.merchants')}}</a>
        <span class="breadcrumb-item active">{{__('main.edit')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.merchants.update', ['merchant'=>$model])}}" method="post">
                @csrf
                @method('put')
                @include('merchant::admin.merchants._form')
            </form>
        </div>
    </div>

@endsection