@extends('admin.layout.master')

@section('title',__('main.pages'))

@section('content')

    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">{{__('main.dashboard')}}</a>
        <span class="breadcrumb-item active">{{__('main.pages')}}</span>
    </nav>

    <div class="card">
        <div class="card-body">
            <a href="{{route('admin.pages.create')}}" class="btn btn-outline-primary float-right"><i class="fa fa-plus"></i> {{__('main.create')}}</a>
            <br><br>
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>{{__('main.id')}}</th>
                        <th>{{__('main.name')}}</th>
                        <th>{{__('main.key')}}</th>
                        <th>{{__('main.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{$page->id}}</td>
                            <td>{{$page->lang}}</td>
                            <td>{{$page->key}}</td>
                            <td>
                                <a href="{{route('admin.pages.edit',['page'=>$page])}}" class="col" title="{{__('main.edit')}}"><i class="text-success fa fa-pencil"></i></a>
                                <a href="{{route('admin.pages.destroy',['page'=>$page])}}" class="delete col" title="{{__('main.delete')}}"><i class="text-danger fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <x-delete-js/>
@endpush