<?php

namespace Modules\Tags\app\Http\Controllers\Admin;

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
use Modules\Tags\app\Models\Tag;
use App\Http\Controllers\admin\BaseController;
use Modules\Tags\app\Http\Requests\TagRequest;

class TagsController extends BaseController
{
    use UploadTrait;

    public $model= Tag::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('tags');
        return view('tags::admin.tags.index');
    }

    public function getData()
    {
        $this->authorize('tags');
        $query = $this->model::select('tags.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-tags')) {
                    $actions.='<a href="'.route('admin.tags.edit', ['tag'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-tags')) {
                    $actions.='<a href="'.route('admin.tags.destroy',['tag'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-tags');
        $model = [
            'model' => new $this->model
        ];
        return view('tags::admin.tags.create', $model);
    }

    public function store(TagRequest $request)
    {
        $this->authorize('create-tags');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
            $data['offer_status'] = isset($data['offer_status']) ? 1 : 0 ;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'Tags');
            }
            Tag::create($data);
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
        return view('tags::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $model = $tag;
        return view('tags::admin.tags.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $this->authorize('edit-tags');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            isset($data['is_active']) ? $data['is_active']=1 : $data['is_active'] = 0;
            isset($data['offer_status']) ? $data['offer_status']=1 : $data['offer_status'] = 0;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'Tags');
            }
            $tag->update($data);
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
    public function destroy(Tag $tag)
    {
        try {
            DB::beginTransaction();
            $tag->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
