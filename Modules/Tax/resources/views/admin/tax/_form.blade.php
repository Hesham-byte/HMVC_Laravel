<x-success-alert/>
<x-error-alert/>

<div class="row">
        <div class="col-md-6 form-group">
            <input type="hidden" name="tax_id" value="{{$tax?->id}}">
        <label>{{__('tax::common.tax')}} - <span class="text-danger">{{__('tax::common.validateTax')}}</span></label>
            <div class="d-flex align-items-center">
                <input type="number"  min="0" max="99" class="form-control" name="percentage_of_tax" value="{{$tax?->percentage_of_tax}}" required>
                <strong class="bg-secondary badge px-2" style="font-size: 23px;">%</strong>
            </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <input type="submit" class="btn btn-primary float-right" value="{{__('main.save')}}">
    </div>
</div>
