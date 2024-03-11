<?php

namespace Modules\Tax\app\Http\Controllers\Admin;

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
use Modules\Tax\app\Models\Tax;
use App\Http\Controllers\admin\BaseController;
use Modules\Tax\app\Http\Requests\TaxRequest;

class TaxController extends BaseController
{
    use UploadTrait;

    public $model= Tax::class;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('tax');
        $tax = Tax::first();
        return view('tax::admin.tax.index',compact('tax'));
    }


    public function store(TaxRequest $request)
    {
        $this->authorize('create-tax');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            Tax::updateOrCreate(['id' => $data['tax_id']],collect($data)->except(['tax_id'])->toArray());
            DB::commit();
            return redirect()->back()->with('success', __('main.saved_successfully'));

        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }

    }

}
