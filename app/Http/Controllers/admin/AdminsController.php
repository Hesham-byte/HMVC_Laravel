<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\CreateUserMail;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\admin\AdminRequest;

class AdminsController extends Controller
{

    function __construct()
    {
        view()->share([
            'types'=>['admin','user']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admins');
        $admins = User::where('type', 'admin')->get();
        return view('admin.admins.index',['admins'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-admin');
        return view('admin.admins.create')->with('user',new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $this->authorize('create-admin');
        $additional = [
            'password'=>Hash::make('12345678'),
            'verify_token'=>sha1(Str::random(30)),
            'password_type'=>'bcrypt',
            'reset_password_token'=>sha1(Str::random(50)),
            'type'=>'admin'
        ];
        $admin = User::create($request->validated()+$additional);
        Mail::to($admin)->send(new CreateUserMail($admin));
        return redirect()->back()->with('success',__('users.user_created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $this->authorize('edit-admin');
        return view('admin.admins.edit')->with('user',$admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request,User $admin)
    {
        $this->authorize('edit-admin');
        $admin->update($request->validated());
        return redirect()->back()->with('success',__('users.user_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $this->authorize('delete-admin');
        $admin->delete();
    }

    public function getSelect2Ajax(Request $request)
    {
        $admins = User::where('type', 'admin')->where('first_name','like',"%{$request->q}%")->orWhere('last_name','like',"%{$request->q}%")->get();
        $choices[] = ['id'=>'', 'text'=>__('main.select')];
        foreach($admins as $user)
        {
            $choices[] = ['id'=>$user->id, 'text'=>$user->first_name.' '.$user->last_name];
        }
        return $choices;
    }
}
