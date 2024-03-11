@extends('admin.auth.layout')

@section('title',__('auth.reset_password'))

@section('content')
<x-success-alert/>
<x-error-alert/>

<div class="card-header border-0">
    <div class="card-title text-center">
      <div class="p-1">
        <img src="{{ url('assets/admin/images/logo/logo-dark.png') }}" alt="branding logo">
      </div>
    </div>
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
      <span>{{ __('auth.reset_password') }}</span>
    </h6>
</div>
<div class="card-content">
    <div class="card-body">
        <form method="post" action="{{route('admin.post-reset-password')}}">
            @csrf
            <input type="hidden" name="reset_password_token" value="{{$token}}">

            <fieldset class="form-group position-relative has-icon-left">
                <input type="password" name="password" placeholder="{{__('auth.password')}}" class="form-control form-control-lg input-lg" id="user-email" required="">
                <div class="form-control-position">
                    <i class="fa fa-key"></i>
                </div>
            </fieldset>
            <fieldset class="form-group position-relative has-icon-left">
                <input type="password" name="password_confirmation" placeholder="{{__('auth.password_confirmation')}}" class="form-control form-control-lg input-lg" id="user-email" required="">
                <div class="form-control-position">
                    <i class="fa fa-key"></i>
                </div>
            </fieldset>
            <div class="form-group">
                <label><a href="{{route('admin.login')}}">{{__('auth.back_to_login')}}</a></label>
            </div>
            <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> {{__('auth.reset')}}</button>
      </form>
    </div>
</div>

@endsection