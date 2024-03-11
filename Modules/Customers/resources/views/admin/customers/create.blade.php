@extends('admin.layout.master')

@section('title', __('customers::common.customers'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <a class="breadcrumb-item" href="{{route('admin.customers.index')}}">{{__('customers::common.customers')}}</a>
        <span class="breadcrumb-item active">{{__('main.create')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.customers.store')}}" method="post">
                @csrf
                @include('customers::admin.customers._form')
            </form>
        </div>
    </div>

@endsection