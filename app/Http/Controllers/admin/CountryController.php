<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\admin\CountryRequest;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{

    public function index()
    {
        $this->authorize('countries');
        $countries = Country::get();
        return view('admin.countries.index',['countries'=>$countries]);
    }

    public function getData()
    {
        $this->authorize('countries');
        $query = Country::select('countries.*');

        return DataTables::of($query)
            ->addColumn('name', function($row){
                return ((app()->isLocale('ar'))) ? $row->name_ar:$row->name_en;
            })
            ->addColumn('actions', function($row){
                $actions = '';
                if(auth()->user()->can('edit-country')) {
                    $actions.='<a href="'.route('admin.countries.edit', ['country'=>$row->id]).'" class="btn btn-sm btn-outline-info"> <i class="fas fa-pen"></i> '.__('main.edit').'</a>';
                }
                if(auth()->user()->can('delete-country')) {
                    $actions.='<a href="'.route('admin.countries.destroy',['country'=>$row->id]).'" class="btn btn-sm btn-outline-danger delete "> <i class="fas fa-trash"></i> '.__('main.delete').'</a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make();
    }



    public function create()
    {
        $this->authorize('create-country');
        $model = [];
        return view('admin.countries.create',compact('model'));
    }


    public function store(CountryRequest $request)
    {
        $this->authorize('create-country');
        $data = $request->validated();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
        if ($request->hasFile('flag')) {
            $data['flag'] = $this->upload_file($request, 'flag', 'countries');
        }
        Country::create($data);
        return redirect()->back()->with('success',__('main.item_created_successfully'));
    }


    public function edit(Country $country)
    {
        $this->authorize('edit-country');
        return view('admin.countries.edit')->with('model',$country);
    }


    public function update(CountryRequest $request,Country $country)
    {
        $this->authorize('edit-country');
        $data =$request->validated();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0 ;
        if ($request->hasFile('flag')) {
            $data['flag'] = $this->upload_file($request, 'flag', 'countries');
        }
        $country->update($data);
        return redirect()->back()->with('success',__('main.item_updated_successfully'));
    }


    public function destroy(Country $country)
    {
        $this->authorize('delete-country');
        $country->delete();
    }


    //Main Upload File Method
    public function upload_file($request, $fileInputName, $moveTo)
    {
        $file = $request->file($fileInputName);
        $file_name = md5($moveTo).Str::random(10).'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($moveTo, $file, $file_name);
        return $moveTo."/".$file_name;
    }
}
