<?php

namespace App\Http\Controllers\admin\authorization;

use App\Models\Page;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\authorization\RoleRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('roles');
        return view('admin.authorization.roles.index')->with('roles',Role::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-role');
        $data['pages'] = $this->getPages();
        $data['role'] = new Role();
        return view('admin.authorization.roles.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('create-role');
        $role = Role::create($request->validated());
        $role->pages()->attach($request->pages??[]);
        return redirect()->back()->with('success',__('main.saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit-role');
        $data['pages'] = $this->getPages();
        $data['role'] = $role;
        return view('admin.authorization.roles.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('edit-role');
        $request->can_download = $request->can_download??0;
        $request->full_access = $request->full_access??0;
        $role->update($request->validated());
        $role->pages()->sync($request->pages);
        return redirect()->back()->with('success',__('main.saved_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete-role');
        $role->delete();
    }

    public function getPages()
    {
        $pages = Page::all();
        $result = [];
        foreach($pages as $page)
        {
            if($page->module == $page->key)
            {
                $result[$page->module]['master_page'] = $page;
            }else{
                $result[$page->module][] = $page;
            }
        }
       // dd($result);
        return $result;
    }
}
