@extends('admin.layout.master')

@section('title', __('productscategory::common.productscategory'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.productscategory.index')}}">{{__('productscategory::common.productscategory')}}</a>
        <span class="breadcrumb-item active">{{__('main.edit')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.productscategory.update', $model->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('productscategory::admin.productscategory._form')
            </form>
        </div>
    </div>

@endsection
