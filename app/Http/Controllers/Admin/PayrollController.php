<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hr\SavePayrollRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Payroll;
use App\Models\SalaryReport;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PayrollController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /***********************************************/

    public function index(Request $request)
    {
        $payroll = Payroll::all();
        if ($request->ajax()) {
            $payroll = Payroll::select('*');
            return Datatables::of($payroll)
                ->editColumn('from_date', function ($row) {
                    //  return optional($row->client)->name;
                    return $row->form_date;

                })
                ->editColumn('to_date', function ($row) {
                    return $row->to_date;
                })
                ->editColumn('report_date', function ($row) {
                    // return  optional($row->company)->name ;
                    return $row->report_date;

                })
                ->editColumn('total_main_salary', function ($row) {
                    return $row->total_main_salary;
                })
                ->editColumn('total_bonus', function ($row) {
                    return $row->total_bonus;
                })
                ->editColumn('total_deductions', function ($row) {
                    return $row->total_deductions;
                })->editColumn('total_loans', function ($row) {
                    return $row->total_loans;
                })->editColumn('grand_total', function ($row) {
                    return $row->grand_total;
                })
                ->addColumn('action', function ($row) {
                    return '
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i> ' . trans('tests.actions') . '
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown' . $row->id . '">
            <li>
                <a class="dropdown-item" href="' . route('admin.loans.edit', [$row->id]) . '">
                    <i class="bi bi-pencil-square me-2"></i> ' . trans('tests.edit') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="' . route('admin.delete_loan', $row->id) . '"
                   onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                    <i class="bi bi-trash3 me-2"></i> ' . trans('tests.delete') . '
                </a>
            </li>

        </ul>
    </div>';
                })
                ->rawColumns(['action', 'talab_image', 'test_code', 'company', 'client'])
                ->make(true);
        }

        return view('dashbord.hr.payroll.index', compact('payroll'));
    }

    /************************************************/

    public function create(EmployeeService $employeeService)
    {

        return view('dashbord.hr.payroll.form');
    }

    /*************************************************/
    public function get_payroll(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $data['all_data'] = $this->employeeService->get_payroll_reports_in_period($from_date, $to_date);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        return view('dashbord.hr.payroll.create', $data);
    }

    /**************************************************/
    public function store(SavePayrollRequest $request)
    {
        try {
            $response = $this->employeeService->save_payroll_data($request);

            if ($response->getStatusCode() === 200) {
                return $response;
            }
            return $response;
        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
