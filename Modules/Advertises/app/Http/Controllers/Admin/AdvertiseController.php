<?php

namespace Modules\Advertises\app\Http\Controllers\Admin;

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
use Modules\Advertises\app\Models\Advertise;
use App\Http\Controllers\admin\BaseController;
use Modules\Advertises\app\Http\Requests\AdvertiseRequest;

class AdvertiseController extends BaseController
{
    use UploadTrait;

    public $model= Advertise::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('advertises');
        return view('advertises::admin.advertises.index');
    }

    public function getData()
    {
        $this->authorize('advertises');
        $query = $this->model::select('advertises.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-advertises')) {
                    $actions.='<a href="'.route('admin.advertises.edit', ['advertise'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-advertises')) {
                    $actions.='<a href="'.route('admin.advertises.destroy',['advertise'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-advertises');
        $model = [
            'model' => new $this->model,
            'famous' => User::whereTypeAndStatus('famous', 'active')->pluck('id', 'email'),
            'arrayFamousIds' =>[]
        ];
        return view('advertises::admin.advertises.create', $model);
    }

    public function store(AdvertiseRequest $request)
    {
        $this->authorize('create-advertises');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['send_directly'] = isset($data['send_directly']) ? 1 : 0 ;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'advertises');
            }
            $created = Advertise::create(collect($data)->except(['famous_ids'])->toArray());
            if(isset($data['famous_ids']))
            {
                $famous=(array)$data['famous_ids'];
                $pivotData = array_fill(0, count($famous), ['advertise_id'=>$created->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($famous, $pivotData);
                $created->famous()->sync($syncData);
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
        return view('advertises::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertise $advertise)
    {
        $model = $advertise;
        $famous = User::whereTypeAndStatus('famous', 'active')->pluck('id', 'email');
        $arrayFamousIds = $model->famous->pluck('id')->toArray();
        return view('advertises::admin.advertises.edit', compact('model','famous','arrayFamousIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertiseRequest $request, Advertise $advertise)
    {
        $this->authorize('edit-advertises');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['send_directly'] = isset($data['send_directly']) ? 1 : 0 ;
            if ($request->hasFile('image')) {
                $data['image'] = $this->upload_file($request, 'image', 'advertises');
            }
            $advertise->update(collect($data)->except(['famous_ids'])->toArray());
            $advertise->famous()->detach();
            if(isset($data['famous_ids']))
            {
                $famous=(array)$data['famous_ids'];
                $pivotData = array_fill(0, count($famous), ['advertise_id' => $advertise->id, 'created_at' =>date('Y-m-d H:i:s'), 'updated_at' =>date('Y-m-d H:i:s')]);
                $syncData  = array_combine($famous, $pivotData);
                $advertise->famous()->sync($syncData);
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
    public function destroy(Advertise $advertise)
    {
        try {
            DB::beginTransaction();
            $advertise->famous()->detach();
            $advertise->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
