<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Loan\LoanRequest;
use App\Models\Admin\Employee;
use App\Models\hr\operation\Loan;
use App\Models\Loans;
use App\Services\EmployeeService;
use App\Services\HrService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $hr_loan = Loans::all();
        if ($request->ajax()) {
            $hr_loan = Loans::select('*');
            return Datatables::of($hr_loan)
                ->editColumn('employee_id', function ($row) {
                    //  return optional($row->client)->name;
                    return optional($row->employee)->first_name . ' ' . optional($row->employee)->last_name;

                })
                ->editColumn('date_loan', function ($row) {
                    return $row->date_loan;
                })
                ->editColumn('loan_type', function ($row) {
                    // return  optional($row->company)->name ;
                    return $row->loan_type;

                })
                ->editColumn('date_deductions', function ($row) {
                    return $row->date_deductions;
                })
                ->editColumn('installments_num', function ($row) {
                    return $row->installments_num;
                })
                ->editColumn('value', function ($row) {
                    return $row->value;
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

        return view('dashbord.hr.loan.index', compact('hr_loan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(EmployeeService $employeeService)
    {

        $data['employees'] = $employeeService->get_employess();
        return view('dashbord.hr.loan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoanRequest $request, HrService $hrService)
    {
        try {
            $hrService->save_loans($request);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.loans.index');

        } catch (\Exception $e) {

            dd($e);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function show(string $id, HrService $hrService, EmployeeService $employeeService)
    {
        $data['loan'] = $hrService->get_loan($id);
        $data['employees'] = $employeeService->get_employess();
       // dd($data['loan']);
        return view('dashbord.hr.loan.create', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, HrService $hrService, EmployeeService $employeeService)
    {
        $data['loan'] = $hrService->get_loan($id);
        $data['employees'] = $employeeService->get_employess();
      //  dd($data['loan']->value);
        return view('dashbord.hr.loan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoanRequest $request,$id,HrService $hrService)
    {
        try {
           // dd($id);
            $hrService->update_loans($request,$id);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.loans.index');

        } catch (\Exception $e) {

            dd($e);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**********************************************/
    public  function delete(HrService $hrService,$id)
    {
        try {
            // dd($id);
            $hrService->delete_loan($id);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.loans.index');

        } catch (\Exception $e) {

            dd($e);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**********************************************/

    public function destroy(string $id)
    {
        //
    }
}
