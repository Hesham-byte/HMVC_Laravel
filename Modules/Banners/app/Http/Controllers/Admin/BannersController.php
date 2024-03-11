<?php

namespace Modules\Banners\app\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Modules\Products\app\Models\Product;
use Modules\Traits\UploadTrait;
use Yajra\DataTables\Facades\DataTables;
use Modules\Banners\app\Models\Banner;
use App\Http\Controllers\admin\BaseController;
use Modules\Banners\app\Http\Requests\BannerRequest;

class BannersController extends BaseController
{
    use UploadTrait;

    public $model= Banner::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('banners');
        return view('banners::admin.banners.index');
    }

    public function getData()
    {
        $this->authorize('banners');
        $query = $this->model::select('banners.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-banners')) {
                    $actions.='<a href="'.route('admin.banners.edit', ['banner'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-banners')) {
                    $actions.='<a href="'.route('admin.banners.destroy',['banner'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-banners');
        $model = [
            'model' => new $this->model,
            'products' => Product::where('is_active', true)->pluck('id', 'name_'.app()->getLocale()),
            'arrayProductIds' =>[],
        ];
        return view('banners::admin.banners.create', $model);
    }

    public function store(BannerRequest $request)
    {
        $this->authorize('create-banners');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
            $data['offer_status'] = isset($data['offer_status']) ? 1 : 0 ;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'banners');
            }
            $created = Banner::create(collect($data)->except(['product_ids'])->toArray());
            if(isset($data['product_ids']))
            {
                $products=(array)$data['product_ids'];
                $pivotData = array_fill(0, count($products), ['banner_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($products, $pivotData);
                $created->products()->sync($syncData);
            }
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
        return view('banners::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        $model = $banner;
        $products = Product::where('is_active', true)->pluck('id', 'name_'.app()->getLocale());
        $arrayProductIds = $model->products->pluck('id')->toArray();
        return view('banners::admin.banners.edit', compact('model','products','arrayProductIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request, Banner $banner)
    {
        $this->authorize('edit-banners');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            isset($data['is_active']) ? $data['is_active']=1 : $data['is_active'] = 0;
            isset($data['offer_status']) ? $data['offer_status']=1 : $data['offer_status'] = 0;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'banners');
            }
            $banner->update(collect($data)->except(['product_ids'])->toArray());

            $banner->products()->detach();
            if(isset($data['product_ids']))
            {
                $products=(array)$data['product_ids'];
                $pivotData = array_fill(0, count($products), ['banner_id'=>$banner->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($products, $pivotData);
                $banner->products()->sync($syncData);
            }
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
    public function destroy(Banner $banner)
    {
        try {
            DB::beginTransaction();
            $banner->products()->delete();
            $banner->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
