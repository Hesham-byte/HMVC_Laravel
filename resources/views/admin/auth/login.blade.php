@extends('admin.auth.layout')

@section('title',__('auth.login'))

@section('content')
<x-error-alert/>
<x-success-alert/>


<div class="card-header border-0">
    <div class="card-title text-center">
      <div class="p-1">
        <img src="{{ url('assets/admin/images/logo.png') }}" height="50" alt="branding logo">
      </div>
    </div>
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
      <span>{{ __('auth.login') }}</span>
    </h6>
</div>
<div class="card-content">
  <div class="card-body">
    <form class="form-horizontal form-simple" method="POST" action="{{ route('admin.auth') }}" novalidate>
      @csrf
      <fieldset class="form-group position-relative has-icon-left mb-0">
        <input type="text" class="form-control form-control-lg input-lg" name="email" placeholder="{{__('auth.email')}}" required>
        <div class="form-control-position">
          <i class="ft-user"></i>
        </div>
      </fieldset>
      <fieldset class="form-group position-relative has-icon-left">
        <input type="password" class="form-control form-control-lg input-lg" name="password" placeholder="{{__('auth.password')}}" required>
        <div class="form-control-position">
          <i class="fa fa-key"></i>
        </div>
      </fieldset>
      <div class="form-group row">
        <div class="col-md-6 col-12 text-center text-md-left">
          <fieldset>                
            <input type="checkbox" id="remember-me" class="chk-remember">
            <label for="remember-me">{{__('auth.remember_me')}}</label>
          </fieldset>
        </div>
        <div class="col-md-6 col-12 text-center text-md-right">
          <a href="{{route('admin.forgot-password')}}">{{__('auth.forgot_password')}}</a>
      </div>
      </div>
      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> {{__('auth.login')}}</button>
    </form>
  </div>
</div>






@endsection