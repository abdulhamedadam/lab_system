<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\payment\SaveDuesPaymentRequest;
use App\Models\Admin\Employee;
use App\Repositories\DuesRepository;
use App\Services\Finance\AccountService;
use App\Services\Payments\ClientPaymentService;
use App\Services\Payments\DuesService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DuesController extends Controller
{
    protected $root_view='dashbord.payments.dues.';
    public function __construct(DuesService $duesService)
    {
        $this->duesService  =$duesService;
    }
    /********************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = $this->duesService->get_all_dues();
           // dd($allData);
            return Datatables::of($allData)
                ->editColumn('num', function ($row) {
                    return $row->id;
                }) ->editColumn('client', function ($row) {
                    return optional($row->client)->name;
                }) ->editColumn('test', function ($row) {
                    $test_code=optional($row->test_data)->test_code;
                    $final_code=get_app_config_data('soil_prefix').$test_code;
                    return $final_code;
                }) ->editColumn('test_type', function ($row) {
                    return $row->test_type;
                })->editColumn('test_title', function ($row) {
                    return $row->test_name;
                })->editColumn('cost', function ($row) {
                    return $row->test_value;
                })->editColumn('paid', function ($row) {
                    $all_paid=optional($row->client_test_payment)->sum('value');
                    return $all_paid;
                })->editColumn('remain', function ($row) {
                    return $row->test_value - optional($row->client_test_payment)->sum('value');
                })->editColumn('year', function ($row) {
                    return $row->year;
                })->editColumn('month', function ($row) {
                    return \Carbon\Carbon::createFromFormat('m', $row->month)->format('F');
                })->editColumn('created_date', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
                })

                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">
        <a href="' . route('admin.payment.pay_dues', $row->id) . '"
            class="btn btn-sm btn-primary"
            title="' . trans('payment.pay') . '"
            style="font-size: 16px;">
            <i class="bi bi-wallet2"></i>
        </a>
        <a href="' . route('admin.payment.account_statement', $row->id) . '"
            class="btn btn-sm btn-dark"
            title="' . trans('payment.account_statement') . '"
            style="font-size: 16px;">
            <i class="bi bi-receipt"></i>
        </a>
        <a onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')"
            href="#"
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

        return view($this->root_view.'all_dues');
    }

    /********************************************************/
    public function pay_dues($id)
    {
        $data['all_data']=$this->duesService->find($id);
        $data['num']=$this->duesService->get_last_num();
        $data['all_emps']=Employee::all();
        $data['required_value']=$data['all_data']->test_value-$data['all_data']->client_test_payment->sum('value');
        return view($this->root_view.'pay',$data);
    }

    /********************************************************/
    public function save_pay_dues(SaveDuesPaymentRequest $request,$id,ClientPaymentService $clientPaymentService)
    {

        try {

            $clientPaymentService->save_pay_dues($request,$id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.payment.pay_dues',$id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /********************************************************/
    public function getInvoiceForPrint($id,ClientPaymentService $clientPaymentService)
    {

        $data['invoice']=$this->duesService->client_test_payment($id);
       // dd($data['invoice']);
        return view($this->root_view.'print',$data);

    }
    /********************************************************/
    public function account_statement($id)
    {
        $data['all_data']=$this->duesService->find($id);
        $data['required_value']=$data['all_data']->test_value-$data['all_data']->client_test_payment->sum('value');
       // dd($data['required_value']);
        return view($this->root_view.'account_statement',$data);
    }
    /********************************************************/
    public function print_account_statement($id)
    {
        $data['all_data']=$this->duesService->find($id);
        return view($this->root_view.'print_account_statement',$data);
    }

    /********************************************************/
    public function create()
    {

    }

    /********************************************************/
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
