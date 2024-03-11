@extends('admin.layout.master')

@section('title', __('tax::common.tax'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.tax.index')}}">{{__('tax::common.tax')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.tax.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('tax::admin.tax._form')
            </form>
        </div>
    </div>

@endsection
