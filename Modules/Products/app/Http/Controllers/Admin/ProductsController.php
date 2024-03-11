<?php

namespace Modules\Products\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Products\app\Http\Requests\ProductRequest;
use Modules\Products\app\Models\Product;
use Modules\Products\app\Models\ProductImage;
use Modules\Products\app\Models\ProductOption;
use Modules\ProductsCategory\app\Models\ProductsCategory;
use Modules\Tags\app\Models\Tag;
use Modules\Traits\UploadTrait;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    use UploadTrait;

    public $model= Product::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('products');
        return view('products::admin.products.index');
    }

    public function getData()
    {
        $this->authorize('products');
        $query = $this->model::select('products.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-product')) {
                    $actions.='<a href="'.route('admin.products.edit', ['product'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-product')) {
                    $actions.='<a href="'.route('admin.products.destroy',['product'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create-product');
        $model = [
            'model' => new $this->model,
            'categories' => ProductsCategory::whereIsActive(true)->pluck('id', 'name_'.app()->getLocale()),
            'famous' => User::whereTypeAndStatus('famous', 'active')->pluck('id', 'email'),
            'arrayFamousIds' =>[],
            'tags' => Tag::where('is_active', true)->pluck('id', 'name_'.app()->getLocale()),
            'arrayTagIds' =>[],

        ];
        return view('products::admin.products.create', $model);
    }

    public function store(ProductRequest $request)
    {
        $this->authorize('create-product');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
            $data['allow_cash_on_delivery'] = isset($data['allow_cash_on_delivery']) ? 1 : 0 ;
            $data['auto_update_stock'] = isset($data['auto_update_stock']) ? 1 : 0 ;
            $data['show_stock_less_5'] = isset($data['show_stock_less_5']) ? 1 : 0 ;
            if ($request->hasFile('master_image')) {
                $data['master_image'] = $this->upload_file($request, 'master_image', 'products');
            }
            $created = Product::create(collect($data)->except(['famous_ids','images','options','tag_ids'])->toArray());

            //Save Images
            $this->save_product_images($data,$created->id);

            //Save Famous
            $this->save_many_famous_for_product($data, $created);

            //Save Options
            $this->save_product_options($data, $created->id);

            //Save Tags
            $this->save_many_tags_for_product($data, $created);

            DB::commit();
            return redirect()->back()->with('success', __('main.saved_successfully'));

        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('products::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $model = $product;
        $categories = ProductsCategory::whereIsActive(true)->pluck('id', 'name_'.app()->getLocale());
        $famous = User::whereTypeAndStatus('famous', 'active')->pluck('id', 'email');
        $arrayFamousIds = $model->famous->pluck('id')->toArray();
        $tags = Tag::where('is_active', true)->pluck('id', 'name_'.app()->getLocale());
        $arrayTagIds = $model->tags->pluck('id')->toArray();

        return view('products::admin.products.edit', compact('model','categories','famous','arrayFamousIds','tags','arrayTagIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('edit-product');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
            $data['allow_cash_on_delivery'] = isset($data['allow_cash_on_delivery']) ? 1 : 0 ;
            $data['auto_update_stock'] = isset($data['auto_update_stock']) ? 1 : 0 ;
            $data['show_stock_less_5'] = isset($data['show_stock_less_5']) ? 1 : 0 ;
            if ($request->hasFile('master_image')) {
                $data['master_image'] = $this->upload_file($request, 'master_image', 'products');
            }
            $product->update(collect($data)->except(['famous_ids','images','options','tag_ids'])->toArray());

            //Save Images
            $this->save_product_images($data,$product->id);

            //Famous
            $product->famous()->detach();
            $this->save_many_famous_for_product($data, $product);

            //Save Options
            $product->options()->delete();
            $this->save_product_options($data, $product->id);

            //Save Tags
            $product->tags()->detach();
            $this->save_many_tags_for_product($data, $product);


            DB::commit();
            return redirect()->back()->with('success', __('main.saved_successfully'));

        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->images()->delete();
            $product->famous()->delete();
            $product->options()->delete();
            $product->tags()->delete();
            $product->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function delete_product_image($id)
    {
        try {
            ProductImage::whereId($id)->delete();
            return redirect()->back()->with('success', __('main.deleted'));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }



    //Save multiple images for product
    protected function save_product_images($data,$productID)
    {
        if(isset($data['images']))
        {
            foreach ($data['images'] as $image)
            {
                $file_name = md5('products').Str::random(10).'.'.$image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $image, $file_name);
                $imageUploaded =  "products/".$file_name;
                ProductImage::create([
                    'product_id' =>$productID,
                    'image' =>$imageUploaded,
                ]);
            }
        }
    }

    //Save many famous
    protected function save_many_famous_for_product($data,$item)
    {
        if(isset($data['famous_ids']))
        {
            $famous=(array)$data['famous_ids'];
            $pivotData = array_fill(0, count($famous), ['product_id'=>$item->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($famous, $pivotData);
            $item->famous()->sync($syncData);
        }

    }

    protected function save_product_options($data,$productID)
    {
        if (count($data['options']) > 0)
        {
            foreach ($data['options'] as $key => $val)
            {
                ProductOption::create([
                    'product_id'=>$productID,
                    'sku' =>$val['sku'],
                    'color' =>$val['color'],
                    'size' =>$val['size'],
                    'volume' =>$val['volume'],
                    'option_name_en' =>$val['option_name_en'],
                    'option_name_ar' =>$val['option_name_ar'],
                    'option_value_en' =>$val['option_value_en'],
                    'option_value_ar' =>$val['option_value_ar'],
                    'price' =>$val['price'],
                    'discount_price' =>$val['discount_price'],
                    'stock' =>$val['stock'],
                ]);
            }
        }
    }


    //Save many famous
    protected function save_many_tags_for_product($data,$item)
    {
        if(isset($data['tag_ids']))
        {
            $tags=(array)$data['tag_ids'];
            $pivotData = array_fill(0, count($tags), ['product_id'=>$item->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
            $syncData  = array_combine($tags, $pivotData);
            $item->tags()->sync($syncData);
        }

    }

}
