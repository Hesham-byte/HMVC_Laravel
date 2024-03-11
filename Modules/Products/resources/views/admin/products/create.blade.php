@extends('admin.layout.master')

@section('title', __('products::common.products'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.products.index')}}">{{__('products::common.products')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('products::admin.products._form')
            </form>
        </div>
    </div>

@endsection

