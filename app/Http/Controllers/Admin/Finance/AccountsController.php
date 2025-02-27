<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\finance\accounts\StoreRequest;
use App\Http\Requests\finance\accounts\UpdateRequest;
use App\Services\Finance\AccountService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
class AccountsController extends Controller
{
    protected $root_view='dashbord.finance.accounts.';
    public function __construct(AccountService $accountService)
    {
        $this->accountService  =$accountService;
    }
    /******************************************************/
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $allData = $this->accountService->get_accounts();
            return Datatables::of($allData)
                ->editColumn('name', function ($row) {
                    return $row->display_name;
                })

                ->editColumn('parent_account', function ($row) {
                    return optional($row->parent_data)->name;
                })
                ->editColumn('account_type', function ($row) {
                    return $row->account_type;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
                    <a href="' . route('admin.finance.accounts.edit', $row->id) . '"
                        class="btn btn-sm btn-primary"
                        title="' . trans('tests.edit') . '"
                        style="font-size: 16px;">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')"
                        href="' . route('admin.delete_test', $row->id) . '"
                        class="btn btn-sm btn-danger"
                        title="' . trans('tests.delete') . '"
                        style="font-size: 16px;">
                        <i class="bi bi-trash3"></i>
                    </a>
                </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
      //  dd('d');
        return view($this->root_view.'index');
    }
    /***************************************************/
    public function create()
    {
         $data['accounts']=$this->accountService->get_accounts_select();
        return view($this->root_view.'create',$data);
    }
    /***************************************************/
    public function store(StoreRequest $request)
    {
        try {
            $this->accountService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.finance.accounts.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /****************************************************/
    public function edit($id)
    {
        $data['record']  =$this->accountService->find($id)->toArray();
        $data['accounts']=$this->accountService->get_accounts_select();
        return view($this->root_view.'edit',$data);
    }
    /****************************************************/
    public function update(UpdateRequest $request,$id)
    {
        try {
           // dd($request);
            $this->accountService->update($id,$request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.finance.accounts.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
