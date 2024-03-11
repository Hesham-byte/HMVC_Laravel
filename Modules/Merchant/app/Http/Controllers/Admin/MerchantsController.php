<?php

namespace Modules\Merchant\app\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Merchant\app\Models\Merchant;
use App\Http\Controllers\admin\BaseController;
use Modules\Merchant\app\Http\Requests\MerchantRequest;

class MerchantsController extends BaseController
{

    public $model= Merchant::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('merchants');
        return view('merchant::admin.merchants.index');
    }

    public function getData()
    {
        $this->authorize('merchants');
        $query = $this->model::join('users', 'users.id', '=', 'merchants.user_id');
            // ->select('users.*', 'merchants.country_id', 'merchants.gander');
            
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
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-merchant')) {
                    $actions.='<a href="'.route('admin.merchants.edit', ['merchant'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-merchant')) {
                    $actions.='<a href="'.route('admin.merchants.destroy',['merchant'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-merchant');
        $data = [
            'model' => new $this->model,
            'user' => new User
        ];
        return view('merchant::admin.merchants.create', $data);
    }

    public function store(MerchantRequest $request)
    {
        $this->authorize('create-merchant');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'merchant'
            ];
            $user = User::create($user_data);
            if($request->password!=''){
                $user->password = Hash::make($request->password);
                $user->save();
            }

            $user->merchants()->create($request_data->only(['country_id', 'gander'])->toArray());

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
        return view('merchant::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merchant $merchant)
    {
        $data=[
            'user' => $merchant->user,
            'model' => $merchant 
        ];
        return view('merchant::admin.merchants.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MerchantRequest $request, Merchant $merchant)
    {
        $this->authorize('edit-merchant');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'merchant'
            ];
            $user = $merchant->user()->update($user_data);
            if($request->password!=''){
                $merchant->user()->update(['password' => Hash::make($request->password)]);
                // $user->password = Hash::make($request->password);
            }

            $merchant->update($request_data->only(['country_id', 'gander', 'city_name', 'status'])->toArray());

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
    public function destroy(Merchant $merchant)
    {
        try {
            DB::beginTransaction();
            $merchant->delete();
            $merchant->user()->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
