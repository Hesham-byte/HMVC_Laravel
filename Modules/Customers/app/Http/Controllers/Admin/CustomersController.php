<?php

namespace Modules\Customers\app\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use Modules\Customers\app\Models\Customer;
use App\Http\Controllers\admin\BaseController;
use Modules\Customers\app\Http\Requests\CustomerRequest;

class CustomersController extends BaseController
{

    public $model= Customer::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('customers');
        return view('customers::admin.customers.index');
    }

    public function getData()
    {
        $this->authorize('customers');
        $query = $this->model::join('users', 'users.id', '=', 'customers.user_id')
            ->select('users.*', 'customers.country_id', 'customers.gander');
            
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
                if(auth()->user()->can('edit-customer')) {
                    $actions.='<a href="'.route('admin.customers.edit', ['customer'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-customer')) {
                    $actions.='<a href="'.route('admin.customers.destroy',['customer'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
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
        $this->authorize('create-customer');
        $data = [
            'model' => new $this->model,
            'user' => new User
        ];
        return view('customers::admin.customers.create', $data);
    }

    public function store(CustomerRequest $request)
    {
        $this->authorize('create-customer');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'customer'
            ];
            $user = User::create($user_data);
            if($request->password!=''){
                $user->password = Hash::make($request->password);
            }

            $user->customers()->create($request_data->only(['country_id', 'gander'])->toArray());

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
        return view('customers::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $data=[
            'user' => $customer->user,
            'model' => $customer 
        ];
        return view('customers::admin.customers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('edit-customer');
        try {
            DB::beginTransaction();
            $request_data = collect($request->validated());

            $user_data = $request_data->only([ 'first_name', 'last_name', 'email', 'mobile_number'])->toArray() + [
                'email_verified_at'=>now(),
                'reset_password_token'=>sha1(Str::random(50)),
                'type'=>'customer'
            ];
            $user = $customer->user()->update($user_data);
            if($request->password!=''){
                $user->password = Hash::make($request->password);
            }

            $customer->update($request_data->only(['country_id', 'gander'])->toArray());

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
    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();
            $customer->delete();
            $customer->user()->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
