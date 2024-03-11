<x-success-alert/>
<x-error-alert/>
<div class="row">
    <div class="col-md-6 form-group">
        <label>{{__('users.first_name')}}</label>
        <input type="text" class="form-control" name="first_name" value="{{$user->first_name??old('first_name')}}" required>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('users.last_name')}}</label>
        <input type="text" class="form-control" name="last_name" value="{{$user->last_name??old('last_name')}}" required>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('users.email')}}</label>
        <input type="text" class="form-control" name="email" value="{{$user->email??old('email')}}" required>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('users.mobile_number')}}</label>
        <input type="text" class="form-control" name="mobile_number" value="{{$user->mobile_number??old('mobile_number')}}" required>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('users.password')}}</label>
        <input type="password" class="form-control" name="password" @if(!$user->id>0) required @endif>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('users.password_confirmation')}}</label>
        <input type="password" class="form-control" name="password_confirmation" @if(!$user->id>0) required @endif>
    </div>
    <div class="col-md-6">
        <label>{{__('users.type')}}</label>
        <select name="type" class="form-control">
            <option value="">{{__('main.select')}}</option>
            @foreach (\App\Models\User::$types as $type)
                <option value="{{$type}}">{{__('users.'.$type)}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <input type="submit" class="btn btn-primary float-right" value="{{__('main.save')}}">
    </div>
</div>