<x-success-alert />
<x-error-alert />
@csrf

<div class="row">
  <div class="col-6 form-group">
    <label>{{__('main.name_en')}}</label>
    <input type="text" name="name_en" class="form-control" value="{{old('name_en')??$role->name_en??''}}" required>
  </div>
  <div class="col-6 form-group">
    <label>{{__('main.name_ar')}}</label>
    <input type="text" name="name_ar" class="form-control" value="{{old('name_ar')??$role->name_ar??''}}" required>
  </div>
  <div class="col-6">
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="can_download" id="" value="1" @if($role->can_download==1
        || old('can_download')) checked @endif>
        {{__('main.can_download')}}
      </label>
    </div>
  </div>
  <div class="col-6">
    <div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="full_access" id="" value="1" @if($role->full_access==1 ||
        old('full_access')) checked @endif>
        {{__('main.full_access')}}
      </label>
    </div>
  </div>
</div>

<div class="row" style="margin-top:10px">
  <hr>
</div>

<div id="pages">

    @php
        $role_pages = $role->pages()->pluck('pages.id')->toArray();
    @endphp
  @foreach ($pages as $module=>$module_pages)
  <div class="row" style="margin-bottom: 40px;border-bottom:1px dashed;padding-bottom:11px">



    @foreach ($module_pages as $key=>$page)

    @if($key=='master_page')
      <div class="col-md-3 order-1">
        <div class="pretty p-image p-round p-jelly">
          <input type="checkbox" name="pages[]" value="{{$page->id}}" class="module-check"
            data-target="check-{{$module}}"  @if(in_array($page->id,$role_pages)) checked @endif/>
          <div class="state">
            <img class="image"
              src="data:image/png;base64,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">
            <label style="font-weight: bolder;" class="text-info">{{$page->lang}}</label>
          </div>
        </div>
      </div>
    @else
    <div class="col-md-3 order-{{$key+2}}">
      <div class="pretty p-default p-curve p-thick p-jelly check-{{$module}}" @if(!$role->pages()->where('key',$module)->first()) style="display:none" @endif>
        <input type="checkbox" name="pages[]" value="{{$page->id}}"   @if(in_array($page->id,$role_pages)) checked @endif/>
        <div class="state p-success-o">
          <label>{{$page->lang}}</label>
        </div>
      </div>

    </div>
    @endif
    @endforeach

  </div>
  @endforeach
</div>

<div class="row">
  <div class="col-12">
    <button type="submit" class="btn btn-primary text-right">{{__('main.save')}}</button>
  </div>
</div>

@push('js')
<script>
  $(function(){
        $('.module-check').change(function(){
          let checked = $(this).prop('checked');
          let target = $(this).data('target');
          if(checked)
          {
            $('.'+target).show();
            $('.'+target).removeAttr('disabled');
          }else{
            $('.'+target).hide();
            $('.'+target).attr('disabled');
          }
        });
      });
</script>
@endpush