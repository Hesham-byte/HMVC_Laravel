<x-success-alert/>
<x-error-alert/>
@csrf

<div class="row">
    <div class="col-6 form-group">
        <label>{{__('main.name_en')}}</label>
        <input type="text" name="name_en" class="form-control" value="{{old('name_en')??$page->name_en??''}}" required>
    </div>
    <div class="col-6 form-group">
        <label>{{__('main.name_ar')}}</label>
        <input type="text" name="name_ar" class="form-control" value="{{old('name_ar')??$page->name_ar??''}}" required>
    </div>
    <div class="col-6 form-group">
        <label>{{__('main.key')}}</label>
        <input type="text" name="key" class="form-control" value="{{old('key')??$page->key??''}}" required>
    </div>
    <div class="col-6 form-group">
        <label>{{__('main.module')}}</label>
        <input type="text" name="module" class="form-control" value="{{old('module')??$page->module??''}}" required>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <button type="submit" class="btn btn-primary text-right">{{__('main.save')}}</button>
    </div>
</div>