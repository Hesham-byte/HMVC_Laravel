<x-success-alert/>
<x-error-alert/>

<div class="row">
    <div class="col-md-6 form-group">
        <label>{{__('main.name_en')}}</label>
        <input type="text" class="form-control" name="name_en" value="{{$model->name_en??old('name_en')}}" required>
    </div>
    <div class="col-md-6 form-group">
        <label>{{__('main.name_ar')}}</label>
        <input type="text" class="form-control" name="name_ar" value="{{$model->name_ar??old('name_ar')}}" required>
    </div>

    <div class="col-md-6 form-group">
        <label>{{__('main.iso_code_2')}}</label>
        <input type="text" class="form-control" name="iso_code_2" value="{{$model->iso_code_2??old('iso_code_2')}}" required>
    </div>

    <div class="col-md-6 form-group">
        <label>{{__('main.iso_code_3')}}</label>
        <input type="text" class="form-control" name="iso_code_3" value="{{$model->iso_code_3??old('iso_code_3')}}" required>
    </div>
    <div class="col-md-12 form-group">
        <label>{{__('main.countryCode')}}</label>
        <input type="text" class="form-control" name="country_code" value="{{$model->country_code??old('country_code')}}" required>
    </div>

    <div class="col-md-12 form-group">
        <label>{{__('main.image')}}</label>
        <input type="file" class="form-control" name="flag" @if(!isset($model?->flag)) required @endif>
        @if(isset($model->flag))
            <br>
            <img src="{{\Storage::url($model->flag)}}" width="200px">
        @endif
    </div>
    <div class="col-md-12 form-group">
        <div class="custom d-flex align-items-center">
            <!-- Rounded switch -->
            <label>{{__('main.status')}}</label>
            <label class="switch mx-2">
                <input type="checkbox" id="checkedLabel" name="is_active" @if(isset($model->is_active) && $model->is_active == 1) checked @endif value="1">
                <span class="slider round"></span>
            </label>
        </div>
    </div>



</div>

<div class="row mt-2">
    <div class="col-12">
        <input type="submit" class="btn btn-primary float-right" value="{{__('main.save')}}">
    </div>
</div>
