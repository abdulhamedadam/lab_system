<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hr\DeductionsRequest;
use App\Http\Requests\Loan\LoanRequest;
use App\Models\Deductions;
use App\Services\EmployeeService;
use App\Services\HrService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeductionsController extends Controller
{
    public function index(Request $request)
    {
        $hr_deduction = Deductions::all();
        if ($request->ajax()) {
            $hr_deduction = Deductions::select('*');
            return Datatables::of($hr_deduction)
                ->editColumn('employee_id', function ($row) {
                    //  return optional($row->client)->name;
                    return optional($row->employee)->first_name . ' ' . optional($row->employee)->last_name;

                })
                ->editColumn('date_deductions', function ($row) {
                    return $row->date_deductions;
                })


                ->editColumn('value', function ($row) {
                    return $row->value;
                })

                ->editColumn('reason', function ($row) {
                    return $row->reason;
                })
                ->addColumn('action', function ($row) {
                    return '
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown' . $row->id . '" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i> ' . trans('tests.actions') . '
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown' . $row->id . '">
            <li>
                <a class="dropdown-item" href="' . route('admin.deductions.edit', [$row->id]) . '">
                    <i class="bi bi-pencil-square me-2"></i> ' . trans('tests.edit') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="' . route('admin.delete_deduction', $row->id) . '"
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

        return view('dashbord.hr.deduction.index', compact('hr_deduction'));
    }

    public function create(EmployeeService $employeeService)
    {
        $data['employees'] = $employeeService->get_employess();
        return view('dashbord.hr.deduction.create', $data);
    }


    public function store(DeductionsRequest $request, HrService $hrService)
    {
        try {
            $hrService->save_deduction($request);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.deductions.index');

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
        return view('dashbord.hr.deduction.create', $data);
    }


    public function edit(string $id, HrService $hrService, EmployeeService $employeeService)
    {
        $data['deduction'] = $hrService->get_deduction($id);
       // dd($data['deduction']);
        $data['employees'] = $employeeService->get_employess();
        //  dd($data['loan']->value);
        return view('dashbord.hr.deduction.edit', $data);
    }


    public function update(DeductionsRequest $request,$id,HrService $hrService)
    {
        try {
            // dd($id);
            $hrService->update_deduction($request,$id);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.deductions.index');

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
            $hrService->delete_deduction($id);

            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.deductions.index');

        } catch (\Exception $e) {

            //dd($e);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**********************************************/

    public function destroy(string $id)
    {

    }
}
