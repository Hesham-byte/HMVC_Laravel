@extends('admin.auth.layout')

@section('title',__('auth.login'))

@section('content')
<x-error-alert/>
<x-success-alert/>
<form method="post" action="{{route('admin.auth')}}">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{__('auth.login')}}</h3>
        </div>
        <div class="card-content">


            <div class="form-group">
                <input type="email" name="email" placeholder="{{__('auth.email')}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="*******" value="" class="form-control">
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="remember_me" value="1" checked style="visibility: inherit;opacity: inherit;">
                {{__('auth.remember_me')}}
              </label>
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" name="sub" class="btn btn-fill btn-wd">{{__('auth.login')}}</button>
        </div>
        <div class="form-group">
            <div class="row text-center">
                <div class="col-md-12">
                    <label>
                        <a href="{{route('admin.forgot-password')}}">{{__('auth.forgot_password')}}</a>
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection