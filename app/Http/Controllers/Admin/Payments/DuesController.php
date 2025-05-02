<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\payment\SaveDuesPaymentRequest;
use App\Models\Admin\Employee;
use App\Models\ClientTests;
use App\Models\Companies;
use App\Repositories\DuesRepository;
use App\Services\Finance\AccountService;
use App\Services\HelperService;
use App\Services\Payments\ClientPaymentService;
use App\Services\Payments\DuesService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DuesController extends Controller
{
    protected $duesService;

    protected $root_view = 'dashbord.payments.dues.';

    public function __construct(DuesService $duesService)
    {
        $this->duesService = $duesService;
    }

    /********************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filters = [
                'client_id' => $request->input('client_id'),
                'test_code' => $request->input('test_code'),
                'month' => $request->input('month'),
                'year' => $request->input('year'),
                'test_type' => $request->input('test_type'),
            ];
            $allData = $this->duesService->get_all_dues($filters);
            // dd($allData);
            return Datatables::of($allData)
                ->editColumn('num', function ($row) {
                    return $row->id;
                })->editColumn('client', function ($row) {
                    return optional($row->company)->name;
                })->editColumn('test', function ($row) {
                    $test_code = optional($row->test_data)->test_code_st;
                    return $test_code;
                })->editColumn('test_type', function ($row) {
                    return $row->test_type;
                })->editColumn('test_title', function ($row) {
                    return $row->test_name;
                })->editColumn('cost', function ($row) {
                    return $row->test_value;
                })->editColumn('paid', function ($row) {
                    $all_paid = optional($row->client_test_payment)->sum('value');
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
                    return '
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="paymentActionDropdown' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-gear"></i> ' . trans('payment.actions') . '
            </button>
            <ul class="dropdown-menu" aria-labelledby="paymentActionDropdown' . $row->id . '">
                <li>
                    <a class="dropdown-item" href="' . route('admin.payment.pay_dues', $row->id) . '">
                        <i class="bi bi-wallet2 me-2"></i> ' . trans('payment.pay') . '
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="' . route('admin.payment.account_statement', $row->id) . '">
                        <i class="bi bi-receipt me-2"></i> ' . trans('payment.account_statement') . '
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="#"
                       onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                        <i class="bi bi-trash3 me-2"></i> ' . trans('tests.delete') . '
                    </a>
                </li>
            </ul>
        </div>';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
        $data['clients'] = Companies::all();
        $data['testTypes'] = ClientTests::distinct()->pluck('test_type')->filter()->values()->toArray();
        // $data['years'] = ClientTests::distinct()->pluck('year')->filter()->values()->toArray();
        $currentYear = date('Y');
        $data['years'] = range($currentYear - 10, $currentYear);
        $data['months'] = [
            '1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April',
            '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August',
            '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];

        return view($this->root_view . 'all_dues', $data);
    }
    /********************************************************/
    public function create()
    {
        $data['sss'] = 's';
        return view($this->root_view . 'create', $data);
    }

    /********************************************************/
    public function pay_dues($id)
    {
        $data['all_data'] = $this->duesService->find($id);
        $data['num'] = $this->duesService->get_last_num();
        $data['all_emps'] = Employee::all();
        $data['required_value'] = $data['all_data']->test_value - $data['all_data']->client_test_payment->sum('value');
        return view($this->root_view . 'pay', $data);
    }

    /********************************************************/
    public function save_pay_dues(SaveDuesPaymentRequest $request, $id, ClientPaymentService $clientPaymentService)
    {

        try {
            // dd($request->all());
            $clientPaymentService->save_pay_dues($request, $id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.payment.account_statement', $id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /********************************************************/
    public function getInvoiceForPrint($id, ClientPaymentService $clientPaymentService)
    {

        $data['invoice'] = $this->duesService->client_test_payment($id);
       // dd($data['invoice']);
        return view($this->root_view . 'print', $data);

    }

    /********************************************************/
    public function account_statement($id)
    {
        $data['all_data'] = $this->duesService->find($id);
        $data['required_value'] = $data['all_data']->test_value - $data['all_data']->client_test_payment->sum('value');
        // dd(optional($data['all_data']->test_data)->client);
        return view($this->root_view . 'account_statement', $data);
    }

    /********************************************************/
    public function print_account_statement($id)
    {
        $data['all_data'] = $this->duesService->get_test_account_statement($id);
      //  dd($data['all_data']);
        return view($this->root_view . 'print_account_statement', $data);
    }

    /********************************************************/
    public function received_payments(Request $request, $type = null)
    {
        if ($request->ajax()) {
            $filters = [
                'client_id' => $request->input('client_id'),
                'test_code' => $request->input('test_code'),
                'month' => $request->input('month'),
            ];
            $allData = $this->duesService->get_received_payments($type, $filters);
            // dd($allData);
            return Datatables::of($allData)
                ->editColumn('num', function ($row) {
                    return $row->num;
                })->editColumn('client', function ($row) {
                    return '<a  href="' . route('admin.company_projects', $row->client_id) . '" class="text-primary fw-bold" style="color:red">' . optional(optional($row->client_test)->company)->name . '</a>';

                })->editColumn('test', function ($row) {
                    if ($row->client_test->test == null) {
                        $final_code = optional(optional($row->client_test)->external_test)->test_code;
                    } else {
                        $final_code = get_app_config_data('soil_prefix') . optional(optional($row->client_test)->test)->test_code;
                        return '<a href="' . route('admin.samples_test', optional(optional($row->client_test)->test)->id) . '" class="text-primary fw-bold">' . $final_code . '</a>';

                    }
                    return $final_code;
                })->editColumn('test_type', function ($row) {
                    return $row->client_test->test_type;
                })->editColumn('test_title', function ($row) {
                    return $row->client_test->test_name;
                })->editColumn('value', function ($row) {
                    return $row->value;
                })->editColumn('paid_date', function ($row) {
                    return $row->paid_date;
                })->editColumn('payment_type', function ($row) {
                    return $row->payment_type;
                })->editColumn('notes', function ($row) {
                    return $row->notes;
                })->editColumn('month', function ($row) {
                    return !empty($row->paid_date) ? \Carbon\Carbon::parse($row->paid_date)->format('F') : '-';
                })->editColumn('created_date', function ($row) {
                    return \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    return '
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="paymentActionDropdown' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-gear"></i> ' . trans('payment.actions') . '
            </button>
            <ul class="dropdown-menu" aria-labelledby="paymentActionDropdown' . $row->id . '">
                <li>
                    <a class="dropdown-item" href="' . route('admin.payment.pay_dues', $row->id) . '">
                        <i class="bi bi-wallet2 me-2"></i> ' . trans('payment.pay') . '
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="' . route('admin.payment.account_statement', $row->id) . '">
                        <i class="bi bi-receipt me-2"></i> ' . trans('payment.account_statement') . '
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="#"
                       onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                        <i class="bi bi-trash3 me-2"></i> ' . trans('tests.delete') . '
                    </a>
                </li>
            </ul>
        </div>';
                })
                ->rawColumns(['action', 'name', 'client', 'test'])
                ->make(true);
        }
        $data['type'] = $type;
        $data['clients'] = Companies::all();
        $data['months'] = [
            '1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April',
            '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August',
            '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
        ];
        return view($this->root_view . 'received_payments', $data);
    }

    /********************************************************/
    public function clients_account_statement(HelperService $helperService)
    {
        $data['clients'] = $helperService->get_companies();
        return view($this->root_view . 'clients_account_statement', $data);
    }

    /********************************************************/
    public function get_company_statment(Request $request)
    {
        $client_id = $request->input('client_id');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $data['dues_data'] = $this->duesService->get_dues($client_id, $from_date, $to_date);
        $data['client_id'] = $client_id;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'clients_account_statement_ajax', $data);


    }

    /********************************************************/
    public function print_client_account_statment_invoice($client_id, $from_date = null, $to_date = null)
    {
        $data['dues_data'] = $this->duesService->get_dues($client_id, $from_date, $to_date);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'print_client_account_statment_invoice', $data);
    }

    /********************************************************/
    public function financial_reports()
    {
        return view($this->root_view . 'financial_reports');
    }

    /********************************************************/
    public function get_financial_reports(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $data['all_data'] = $this->duesService->get_financial($from_date, $to_date);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'financial_reports_data', $data);
    }

    /********************************************************/
    public function print_financial_report($from_date = false, $to_date = false)
    {
        $data['all_data'] = $this->duesService->get_financial($from_date, $to_date);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'print_financial_report', $data);
    }

    /********************************************************/
    public function revenue_report(HelperService $helperService)
    {
        $data['clients'] = $helperService->get_companies();
        return view($this->root_view . 'revenue_report', $data);
    }

    /********************************************************/
    public function get_revenue_report(Request $request)
    {
        $from_date = $request->input('from_date') ?? false;
        $to_date = $request->input('to_date') ?? false;
        $client_id = $request->input('client_id') ?? false;
        $data['all_data'] = $this->duesService->get_revenue_report($from_date, $to_date, $client_id);
        $data['client_id'] = $client_id;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        // dd($data);
        return view($this->root_view . 'revenue_report_data', $data);
    }

    /********************************************************/
    public function print_revenue_report($client_id, $from_date = false, $to_date = false)
    {
        $data['all_data'] = $this->duesService->get_revenue_report($from_date, $to_date, $client_id);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'print_revenue_report', $data);
    }

    /********************************************************/
    public function expense_report(HelperService $helperService)
    {
        $data['bnod'] = $helperService->get_bnod_sarf();
        return view($this->root_view . 'expense_report', $data);
    }

    /********************************************************/
    public function get_expense_report(Request $request)
    {
        $from_date = $request->input('from_date') ?? false;
        $to_date = $request->input('to_date') ?? false;
        $band_id = $request->input('band_id') ?? false;
        $data['all_data'] = $this->duesService->get_expense_report($from_date, $to_date, $band_id);

        $data['band_id'] = $band_id;
        $data['to_date'] = $to_date;
        $data['from_date'] = $from_date;

        return view($this->root_view . 'expense_report_data', $data);
    }

    /********************************************************/
    public function print_expense_report($band_id = false, $from_date = false, $to_date = false)
    {

        $data['all_data'] = $this->duesService->get_expense_report($from_date, $to_date, $band_id);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view($this->root_view . 'print_expense_report', $data);
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
