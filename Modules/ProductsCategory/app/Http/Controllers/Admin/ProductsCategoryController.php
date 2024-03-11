<?php

namespace Modules\ProductsCategory\app\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Modules\Traits\UploadTrait;
use Yajra\DataTables\Facades\DataTables;
use Modules\ProductsCategory\app\Models\ProductsCategory;
use App\Http\Controllers\admin\BaseController;
use Modules\ProductsCategory\app\Http\Requests\ProductsCategoryRequest;

class ProductsCategoryController extends BaseController
{
    use UploadTrait;

    public $model= ProductsCategory::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('productscategory');
        return view('productscategory::admin.productscategory.index');
    }

    public function getData()
    {
        $this->authorize('productscategory');
        $query = $this->model::select('products_categories.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-productscategory')) {
                    $actions.='<a href="'.route('admin.productscategory.edit', ['productscategory'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-productscategory')) {
                    $actions.='<a href="'.route('admin.productscategory.destroy',['productscategory'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-productscategory');
        $model = [
            'model' => new $this->model
        ];
        return view('productscategory::admin.productscategory.create', $model);
    }

    public function store(ProductsCategoryRequest $request)
    {
        $this->authorize('create-productscategory');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'product-categories');
            }
            ProductsCategory::create($data);
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
        return view('productscategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductsCategory $productscategory)
    {
        $model = $productscategory;
        return view('productscategory::admin.productscategory.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductsCategoryRequest $request, ProductsCategory $productscategory)
    {
        $this->authorize('edit-productscategory');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            isset($data['is_active']) ? $data['is_active']=1 : $data['is_active'] = 0;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'product-categories');
            }
            $productscategory->update($data);
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
    public function destroy(ProductsCategory $productscategory)
    {
        try {
            DB::beginTransaction();
            $productscategory->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
