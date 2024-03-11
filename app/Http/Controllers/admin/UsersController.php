<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Mail\CreateUserMail;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\admin\UserRequest;

class UsersController extends Controller
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
        $this->authorize('users');
        $users = User::where('type', 'user')->get();
        return view('admin.users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-user');
        return view('admin.users.create')->with('user',new User);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create-user');
        $additional = [
            // 'password'=>Hash::make('12345678'),
            'verify_token'=>sha1(Str::random(30)),
            'password_type'=>'bcrypt',
            'reset_password_token'=>sha1(Str::random(50)),
            'type'=>'user'
        ];

        if($request->password!='') {
            $additional['password'] = Hash::make($request->password);
        }

        $user = User::create(Arr::except($request->validated(), 'password')+$additional);
        //Mail::to($user)->send(new CreateUserMail($user));
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
    public function edit(User $user)
    {
        $this->authorize('edit-user');
        return view('admin.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,User $user)
    {
        $this->authorize('edit-user');
        $additional =[];
        if($request->password!='') {
            $additional['password'] = Hash::make($request->password);
        }
        $user->update(Arr::except($request->validated(), 'password')+$additional);
        return redirect()->back()->with('success',__('users.user_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete-user');
        $user->delete();
    }

    public function getSelect2Ajax(Request $request)
    {
        $admins = User::where('type', 'user')->where(function($q) use($request){
            $q->where('first_name','like',"%{$request->q}%")
            ->orWhere('last_name','like',"%{$request->q}%");
        })->get();
        $choices[] = ['id'=>'', 'text'=>__('main.select')];
        foreach($admins as $user)
        {
            $choices[] = ['id'=>$user->id, 'text'=>$user->first_name.' '.$user->last_name];
        }
        return $choices;
    }
}
