<x-success-alert/>
<x-error-alert/>

<div class="row">


    <div class="tab-teaser mx-1 w-100">
        <div class="tab-menu">
            <ul>
                <li><a href="#" class="active" data-rel="tab-1"> <i class="mx-1 fa fa-list-ol"></i>  {{__('main.ProductInfo')}}</a></li>
                <li><a href="#" data-rel="tab-2" class=""> <i class="mx-1 fa fa-image"></i> {{__('main.UploadImages')}}</a></li>
                <li><a href="#" data-rel="tab-3" class=""> <i class="mx-1 fa fa-columns"></i>  {{__('main.ProductOptions')}}</a></li>
                <li><a href="#" data-rel="tab-4" class=""> <i class="mx-1 fa fa-users"></i>{{__('main.ProductFamous')}}</a></li>
                <li><a href="#" data-rel="tab-5" class=""> <i class="mx-1 fa fa-address-book"></i>{{__('main.ProductWithTags')}}</a></li>
            </ul>
        </div>

        <div class="tab-main-box mt-2">
            <div class="tab-box" id="tab-1" style="display:block;">
                <div class="col-12 mb-2">
                    <label class="form-label">  {{__('main.ProductsCategories')}}  </label>
                    <select name="product_category_id" class="form-control form-select" required>
                        <option value="">{{__('main.choose')}}  </option>
                        @foreach($categories as $key=>$val)
                            <option @selected($model->product_category_id == $val) value="{{$val}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.display_id')}}</label>
                    <input type="text" class="form-control" name="display_id" value="{{$model->display_id??old('display_id')}}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.name_en')}}</label>
                    <input type="text" class="form-control" name="name_en" value="{{$model->name_en??old('name_en')}}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.name_ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" value="{{$model->name_ar??old('name_ar')}}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.description_en')}}</label>
                    <textarea rows="4" cols="4" class="form-control" name="description_en" required>{!!$model->description_en??old('description_en')!!}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.description_ar')}}</label>
                    <textarea rows="4" cols="4" class="form-control" name="description_ar" required>{!!$model->description_ar??old('description_ar')!!}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.brand_name')}}</label>
                    <input type="text" class="form-control" name="brand_name" value="{{$model->brand_name??old('brand_name')}}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label>{{__('main.master')}} {{__('main.image')}}</label>
                    <input type="file" class="form-control" name="master_image" @if(!$model?->master_image) required @endif>
                    @if($model->master_image)
                        <br>
                        <img src="{{\Storage::url($model->master_image)}}" width="200px">
                    @endif
                </div>
                <div class="col-md-12 form-group">
                    <div class="custom d-flex align-items-center">
                        <!-- Rounded switch -->
                        <label>{{__('main.allow_cash_on_delivery')}}</label>
                        <label class="switch mx-2">
                            <input type="checkbox" name="allow_cash_on_delivery"  @if($model?->allow_cash_on_delivery) checked @endif value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="custom d-flex align-items-center">
                        <!-- Rounded switch -->
                        <label>{{__('main.auto_update_stock')}}</label>
                        <label class="switch mx-2">
                            <input type="checkbox" name="auto_update_stock"  @if($model?->auto_update_stock) checked @endif value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="custom d-flex align-items-center">
                        <!-- Rounded switch -->
                        <label>{{__('main.show_stock_less_5')}}</label>
                        <label class="switch mx-2">
                            <input type="checkbox" name="show_stock_less_5"  @if($model?->show_stock_less_5) checked @endif value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
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

            </div>
            <div class="tab-box" id="tab-2">
                <div class="col-md-12 form-group">
                    <div class="imagesPreview my-2">
                        <label for="files" class="uploadBtn btn btn-lg btn-secondary  d-block"> <i class="fa fa-plus-circle mx-2"></i> {{__('main.uploadMultipleImages')}}</label>
                        <input type="file" id="files" name="images[]" class="form-control" multiple hidden />
                    </div>
                    @if(count($model->images) > 0)
                        <div class="imagesPreview row m-0">
                            <div class="col-12 ">
                                <h4 class="mx-2">{{__('main.currentProductImages')}}</h4>
                            </div>
                            @foreach($model->images as $image)
                                <div class="col-md-3 currentImage">
                                    <img src="{{\Storage::url($image->image)}}"
                                         onerror="this.onerror=null;this.src='{{asset("assets/admin/images/backgrounds/in.jpg")}}';"
                                         width="230px">
                                    <a class="btn btn-sm btn-danger text-white d-block" href="{{route('admin.product.image.delete', $image->id)}}">
                                        <i class="fa fa-remove text-lg-center"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <div class="tab-box" id="tab-3">
                <div class="col-12 my-4">
                    <h4>{{__('main.productOptions')}}:</h4>


                    <div id="body">
                        @if(count($model->options) > 0)
                            @foreach($model->options as $key=>$option)
                                <div class="form-group row mb-2 mx-0 newItem" id="newItem">
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.sku')}}</label>
                                        <input type="text" class="form-control sku" value="{{$option->sku}}" name="options[{{$key}}][sku]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.color')}}</label>
                                        <input type="color" class="form-control color" value="{{$option->color}}" name="options[{{$key}}][color]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.size')}}</label>
                                        <input type="text" class="form-control size"  value="{{$option->size}}"name="options[{{$key}}][size]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.volume')}}</label>
                                        <input type="text" class="form-control volume" value="{{$option->volume}}" name="options[{{$key}}][volume]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.option_name_en')}}</label>
                                        <input type="text" class="form-control option_name_en"  value="{{$option->option_name_en}}" name="options[{{$key}}][option_name_en]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.option_name_ar')}}</label>
                                        <input type="text" class="form-control option_name_ar" value="{{$option->option_name_ar}}" name="options[{{$key}}][option_name_ar]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.option_value_en')}}</label>
                                        <input type="text" class="form-control option_value_en" value="{{$option->option_value_en}}" name="options[{{$key}}][option_value_en]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.option_value_ar')}}</label>
                                        <input type="text" class="form-control option_value_ar" value="{{$option->option_value_ar}}" name="options[{{$key}}][option_value_ar]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.price')}}</label>
                                        <input type="number" class="form-control price" value="{{$option->price}}" name="options[{{$key}}][price]" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.discount_price')}}</label>
                                        <input type="number" min="0" class="form-control discount_price" value="{{$option->discount_price}}" name="options[{{$key}}][discount_price]">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>{{__('main.stock')}}</label>
                                        <input type="number" min="0" class="form-control stock" value="{{$option->stock}}" name="options[{{$key}}][stock]">
                                    </div>
                                    <button type="button" class="w-100 my-2 removeItem btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                                </div>
                            @endforeach
                        @else
                        <div class="form-group row mb-2 mx-0 newItem" id="newItem">
                            <div class="col-md-4 form-group">
                                <label>{{__('main.sku')}}</label>
                                <input type="text" class="form-control sku" name="options[0][sku]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.color')}}</label>
                                <input type="color" class="form-control color" name="options[0][color]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.size')}}</label>
                                <input type="text" class="form-control size" name="options[0][size]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.volume')}}</label>
                                <input type="text" class="form-control volume" name="options[0][volume]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.option_name_en')}}</label>
                                <input type="text" class="form-control option_name_en" name="options[0][option_name_en]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.option_name_ar')}}</label>
                                <input type="text" class="form-control option_name_ar" name="options[0][option_name_ar]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.option_value_en')}}</label>
                                <input type="text" class="form-control option_value_en" name="options[0][option_value_en]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.option_value_ar')}}</label>
                                <input type="text" class="form-control option_value_ar" name="options[0][option_value_ar]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.price')}}</label>
                                <input type="number" class="form-control price" name="options[0][price]" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.discount_price')}}</label>
                                <input type="number" min="0" class="form-control discount_price" name="options[0][discount_price]">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>{{__('main.stock')}}</label>
                                <input type="number" min="0" class="form-control stock" name="options[0][stock]">
                            </div>
                            <button type="button" class="w-100 my-2 removeItem btn btn-sm btn-danger"><i class="fa fa-remove"></i></button>
                        </div>
                        @endif
                    </div>

                    <div class="float-end mb-2">
                        <button type="button" class="btn btn-sm btn-success" id="addNewItem">{{__('main.addAnotherOptions')}}</button>
                    </div>
                </div>
            </div>
            <div class="tab-box" id="tab-4">
                <div class="col-12 mb-3">
                    <label class="form-label">  {{__('main.chooseFamous')}}  </label>
                    <select name="famous_ids[]" class="select-2 multiple-select"  multiple="multiple">
                        @foreach($famous as $key=>$val)
                            <option @if(in_array($val,$arrayFamousIds)) selected @endif value="{{$val}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tab-box" id="tab-5">
                <div class="col-12 mb-3">
                    <label class="form-label">  {{__('main.ProductWithTags')}}  </label>
                    <select name="tag_ids[]" class="select-2 multiple-select"  multiple="multiple">
                        @foreach($tags as $key=>$val)
                            <option @if(in_array($val,$arrayTagIds)) selected @endif value="{{$val}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row mt-2">
    <div class="col-12">
        <input type="submit" class="btn btn-primary float-right" value="{{__('main.save')}}">
    </div>
</div>
