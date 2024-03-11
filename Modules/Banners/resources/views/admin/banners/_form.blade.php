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
        <label>{{__('main.show_page')}}</label>
        <select class="form-control form-select" name="show_page" required>
            <option value="">{{__('main.choose')}}</option>
            <option @selected($model->show_page == 'home') value="home">{{__('main.home')}}</option>
            <option @selected($model->show_page == 'categories') value="categories">{{__('main.categories')}}</option>
        </select>
    </div>

    <div class="col-md-6 form-group">
        <label>{{__('main.show_location')}}</label>
        <select class="form-control form-select" name="show_location" required>
            <option value="">{{__('main.choose')}}</option>
            <option @selected($model->show_location == 'top') value="top">{{__('main.top')}}</option>
            <option @selected($model->show_location == 'bottom') value="bottom">{{__('main.bottom')}}</option>
            <option @selected($model->show_location == 'left') value="left">{{__('main.left')}}</option>
            <option @selected($model->show_location == 'right') value="right">{{__('main.right')}}</option>
        </select>
    </div>

    <div class="col-md-4 form-group">
        <label>{{__('main.start_date')}}</label>
        <input type="date" class="form-control" name="start_date" value="{{$model->start_date??old('start_date')}}" required>
    </div>
    <div class="col-md-4 form-group">
        <label>{{__('main.end_date')}}</label>
        <input type="date" class="form-control" name="end_date" value="{{$model->end_date??old('end_date')}}" required>
    </div>
    <div class="col-md-4 form-group">
        <label>{{__('main.appearing_duration')}}</label>
        <select class="form-control form-select" name="appearing_duration" required>
            <option value="">{{__('main.choose')}}</option>
            @for($i = 5 ; $i<= 60;$i++)
            <option @selected($model->appearing_duration == $i) value="{{$i}}">{{$i}} {{__('main.second')}}</option>
            @endfor
        </select>
    </div>

    <div class="col-12 mb-3">
        <label class="form-label">  {{__('main.Products')}}  </label>
        <select name="product_ids[]" class="select-2 multiple-select"  multiple="multiple">
            @foreach($products as $key=>$val)
                <option @if(in_array($val,$arrayProductIds)) selected @endif value="{{$val}}">{{$key}}</option>
            @endforeach
        </select>
    </div>


    <div class="col-md-12 form-group">
        <label>{{__('main.image')}}</label>
        <input type="file" class="form-control" name="image" @if(!$model?->image) required @endif>
        @if($model->image)
            <br>
            <img src="{{\Storage::url($model->image)}}" width="200px">
        @endif
    </div>
    <div class="col-md-12 form-group">
        <div class="custom d-flex align-items-center">
            <!-- Rounded switch -->
            <label>{{__('main.status')}}</label>
            <label class="switch mx-2">
                <input type="checkbox" name="is_active"  @if($model?->is_active) checked @endif value="1">
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    <div class="col-md-12 form-group">
        <div class="custom d-flex align-items-center">
            <!-- Rounded switch -->
            <label>{{__('main.offer_status')}}</label>
            <label class="switch mx-2">
                <input type="checkbox" name="offer_status"  @if($model?->offer_status) checked @endif value="1">
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
