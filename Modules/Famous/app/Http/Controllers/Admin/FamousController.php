<?php

namespace Modules\Famous\app\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Modules\Famous\app\Models\Famous;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\admin\BaseController;
use Modules\Famous\app\Http\Requests\FamousRequest;

class FamousController extends BaseController
{

    public $model= Famous::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('famous');
        return view('famous::admin.famous.index');
    }

    public function getData()
    {
        $this->authorize('famous');
        $query = $this->model::join('users', 'users.id', '=', 'famous.user_id');
            // ->select('users.*', 'famous.country_id', 'famous.gander');
            
        return DataTables::of($query)
            ->addColumn('name', function($row){
                return $row->first_name.' '.$row->last_name;
            })    
            ->addColumn('country', function($row){
                return $row->country->lang;
            })
            ->addColumn('gander', function($row){
                return __('main.'.$row->gander);
            })
            ->addColumn('status', function($row){
                return __('main.'.$row->status);
            })
            ->addColumn('show_in_app', function($row){
                return __('main.'.$row->show_in_app);
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-famous')) {
                    $actions.='<a href="'.route('admin.famous.edit', ['famous'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-famous')) {
                    $actions.='<a href="'.route('admin.famous.destroy',['famous'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-famous');
        $data = [
            'model' => new $this->model,
            'user' => new User
        ];
        return view('famous::admin.famous.create', $data);
    }

    public function store(FamousRequest $request)
    {
        $this->authorize('create-famous');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'famous'
            ];
            $user = User::create($user_data);
            if($request->password!=''){
                $user->password = Hash::make($request->password);
                $user->save();
            }

            $user->famous()->create($request_data->only(['country_id', 'gander', 'city_name', 'status', 'show_in_app', 'photo'])->toArray());

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
        return view('famous::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Famous $famous)
    {
        $data=[
            'user' => $famous->user,
            'model' => $famous 
        ];
        return view('famous::admin.famous.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FamousRequest $request, Famous $famous)
    {
        $this->authorize('edit-famous');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'famous'
            ];
            $user = $famous->user()->update($user_data);
            if($request->password!=''){
                $famous->user()->update(['password' => Hash::make($request->password)]);
                // $user->password = Hash::make($request->password);
            }

            $famous->update($request_data->only(['country_id', 'gander', 'city_name', 'status', 'show_in_app', 'photo'])->toArray());

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
    public function destroy(Famous $famous)
    {
        try {
            DB::beginTransaction();
            $famous->delete();
            $famous->user()->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
