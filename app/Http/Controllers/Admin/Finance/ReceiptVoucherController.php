<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Receipt_Voucher;
use App\Services\Finance\AccountService;
use App\Services\Finance\ReceiptVoucherService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReceiptVoucherController extends Controller
{
    protected $root_view='dashbord.finance.receipt_voucher.';
    public function __construct(ReceiptVoucherService $receiptVoucherService)
    {
        $this->receiptVoucherService  =$receiptVoucherService;
    }
    /*******************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = $this->receiptVoucherService->get_data_table();
            return Datatables::of($allData)
                ->editColumn('num', function ($row) {
                    return $row->num;
                })->editColumn('date_at', function ($row) {
                    return $row->date_at;
                })->editColumn('from_account', function ($row) {
                    return $row->from_account;
                })->editColumn('to_account', function ($row) {
                    return $row->to_account;
                })->editColumn('amount', function ($row) {
                    return $row->amount;
                })->editColumn('notes', function ($row) {
                    return $row->notes;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"> ' . trans('forms.action') . '
                   <span class="svg-icon svg-icon-5 m-0">
                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                       xmlns="http://www.w3.org/2000/svg">
                           <path d="M11.4343 12.7344L7.25 8.55005C6.83579
                           8.13583 6.16421 8.13584 5.75 8.55005C5.33579
                           8.96426 5.33579 9.63583 5.75 10.05L11.2929
                           15.5929C11.6834 15.9835 12.3166 15.9835
                           12.7071 15.5929L18.25 10.05C18.6642 9.63584
                            18.6642 8.96426 18.25 8.55005C17.8358 8.13584
                            17.1642 8.13584 16.75 8.55005L12.5657
                             12.7344C12.2533 13.0468 11.7467 13.0468
                             11.4343 12.7344Z" fill="currentColor" />
                       </svg>
                   </span>
                 </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                             <a href="' . route('admin.finance.Receipt_Voucher.edit', $row->id) . '"
                               name="' . trans('forms.edite_btn') . '" class="menu-link px-3"
                               > <span class="menu-icon"> <i class="bi bi-pencil fs-3"></i> </span>
                             <span class="menu-title">' . trans('forms.edite_btn') . '</span></a>
                        </div>
                        <div class="menu-item px-3">
                             <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal"
                             onclick="show_details(' . $row->id . ')" title="' . trans('forms.details') . '" class="menu-link px-3" >
                             <span class="menu-icon"> <i class="bi bi-eye fs-3"></i> </span>
                             <span class="menu-title">' . trans('forms.details') . '</span></a>
                        </div>
                        <div class="menu-item px-3">
                             <a href="javascript:print_sand(' . $row->id . ')" title="' . trans('forms.print') . '" class="menu-link px-3" >
                                    <span class="menu-icon"> <i class="bi bi-printer fs-3"></i> </span>
                                            <span class="menu-title">' . trans('forms.print') . '</span>
                              </a>

                        </div>

                        <div class="menu-item px-3">
                                <a href="' . route('admin.finance.Receipt_Voucher.destroy', $row->id) . '" data-kt-table-delete="delete_row"
                                           name="' . trans('forms.delete_btn') . '" class="menu-link px-3" >
                                           <span class="menu-icon"> <i class="bi bi-trash fs-3"></i> </span>
                                            <span class="menu-title">' . trans('forms.delete_btn') . '</span>

                                           </a>
                        </div>
                  </div>



                   </div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view($this->root_view.'index');
    }
    /*******************************************************/
    public function create(AccountService $accountService)
    {
        $data['accounts']=$accountService->get_accounts_select();
        return view($this->root_view.'form',$data);
    }
    /********************************************************/

}
