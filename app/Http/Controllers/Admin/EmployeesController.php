<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\EmployeeStoreRequest;
use App\Http\Requests\Admin\Employee\SaveSalaryRequest;
use App\Http\Requests\Admin\Employees\AddEmployeeRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Branch;
use App\Models\Admin\Employee;
use App\Models\Admin\EmployeeFiles;
use App\Models\Admin\EmployeeSalary;
use App\Services\EmployeeService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\EmployeeInterface;

class EmployeesController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    /*---------------------------------------------------*/

    protected $GeneralSettingRepository;
    protected $UsersRepository;
    protected $BranchRepository;
    protected $AreasSettingRepository;
    protected $EmployeeRepository;
    protected $EmployeeFilesRepository;
    protected $employee_service;

    public function __construct(BasicRepositoryInterface $basicRepository, EmployeeService $employee_service)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->BranchRepository = createRepository($basicRepository, new Branch());
        $this->EmployeeRepository = createRepository($basicRepository, new Employee());
        $this->EmployeeFilesRepository = createRepository($basicRepository, new EmployeeFiles());
        $this->employee_service = $employee_service;
    }

    /************************************************************/
    public function index()
    {
        // $data = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch']);
        // dd($data);
        return view('dashbord.admin.employees.employee_data');
    }

    /***********************************************************/
    public function get_ajax_employee(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch']);
            $counter = 0;
            return DataTables::of($data)
                ->addColumn('id', function () use (&$counter) {
                    $counter++;
                    return $counter;
                })
                ->addColumn('image', function ($row) {
                    if ($row->profile_picture) {
                        $imagePath = asset('images/' . $row->profile_picture);
                        return '<img src="' . $imagePath . '" alt="Employee Image" class="img-thumbnail" style="width: 50px; height: 50px;">';
                    }
                })
                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch ? $row->branch->name : '';
                })
                ->addColumn('address', function ($row) {
                    return $row->address;
                })
                ->addColumn('position', function ($row) {
                    return $row->position;
                })
                ->addColumn('governate', function ($row) {
                    return $row->governate->title;
                })
                ->addColumn('area', function ($row) {
                    return $row->area ? $row->area->title : '';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group">
                        <button type="button" style="font-size: 16px" class="btn btn-sm btn-secondary">' . trans('employees.actions') . '</button>
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a style="font-size: 14px" class="hover-effect dropdown-item" target="_blank" href="' . route('admin.edit_employee', $row->id) . '"><i class=" bi bi-pencil"></i> ' . trans('employees.edit_data') . '</a></li>
                            <li><a style="font-size: 14px" class="hover-effect dropdown-item" target="_blank" href="' . route('admin.employee_files', $row->id) . '"><i class="bi bi-files"></i> ' . trans('employees.employee_file') . '</a></li>

                        </ul>
                    </div>
                    ';
                })->rawColumns(['image', 'action', 'branch'])
                ->make(true);

            return response()->json($data);
        }
    }

    /***********************************************************/
    public function add_employee()
    {
        $data['emp_code'] = $this->EmployeeRepository->getLastFieldValue('emp_code');
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));
        $data['branches'] = $this->BranchRepository->getAll();
        // dd($data);
        return view('dashbord.admin.employees.employee_form', $data);
    }

    //     /*********************************************************/
    public function save_employee(AddEmployeeRequest $request)
    {
        try {
            // dd($request->all());
            $emplyee_model = new Employee();
            $insert_data = $emplyee_model->data_to_insert($request);
            if ($request->hasFile('personal_photo')) {
                $file = $request->file('personal_photo');
                $dataX = $this->saveImage($file, 'employees');
                $insert_data['profile_picture'] = $dataX;
            }

            // dd($insert_data);

            $employee = $this->EmployeeRepository->create($insert_data);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.employee_data');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /*********************************************************/
    public function edit_employee($id)
    {
        $data['emp_code'] = $this->EmployeeRepository->getLastFieldValue('emp_code');
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));
        // $data['branches'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));
        $data['branches'] = $this->BranchRepository->getAll();
        $data['employee'] = $this->EmployeeRepository->getById($id);
        //dd($data['all_data']);
        return view('dashbord.admin.employees.employee_edit', $data);
    }

    /***********************************************************/
    public function update_employee(Request $request, $id)
    {
        try {
            //dd('sss');
            $emplyee_model = new Employee();
            $insert_data = $emplyee_model->data_to_insert($request);
            if ($request->hasFile('personal_photo')) {
                $file = $request->file('personal_photo');
                $dataX = $this->saveImage($file, 'employees');
                $insert_data['profile_picture'] = $dataX;
            }
            $employee = $this->EmployeeRepository->update($id, $insert_data);

            $request->session()->flash('toastMessage', trans('updated_successfully'));
            return redirect()->route('admin.employee_data');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /***********************************************************/
    public function delete_employee($id)
    {
    }

    /***********************************************************/
    public function employee_files($id)
    {
        $data['all_data'] = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch'])->where('id', $id)->first();
        $data['files_data'] = $this->EmployeeFilesRepository->getBywhere(array('emp_id' => $id));
        // dd($data);
        return view('dashbord.admin.employees.employee_files', $data);
    }

    /***********************************************************/
    public function employee_add_files(Request $request, $emp_id)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
            'file_name' => 'required|string|max:255',
        ]);
        try {
            $emp = $this->EmployeeRepository->getById($emp_id);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $dataX = $this->saveFile($file, 'employee' . $emp->id);

                $data['file'] = $dataX;
                $data['file_name'] = $request->file_name;
                $data['emp_id'] = $emp->id;
                $data['publisher'] = auth('admin')->user()->id;
                $data['publisher_n'] = auth('admin')->user()->name;
                $file = $this->EmployeeFilesRepository->create($data);
            }
            notify()->success(trans('File_added_successfully'), '');
            return redirect()->route('admin.employee_files', $emp_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**********************************************************/
    public function employee_details($id)
    {
        $data['all_data'] = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch'])->where('id', $id)->first();
        return view('dashbord.admin.employees.employee_details', $data);
    }

    public function download_file($file_id)
    {
        try {
            $employee_file = $this->EmployeeFilesRepository->getById($file_id);

            $file_path = Storage::disk('files')->path($employee_file->file);
            $file_extension = pathinfo($employee_file->file, PATHINFO_EXTENSION);
            $file_name_with_extension = $employee_file->file_name;

            if (!str_ends_with($file_name_with_extension, ".$file_extension")) {
                $file_name_with_extension .= ".$file_extension";
            }

            $headers = [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $file_name_with_extension . '"',
            ];

            return response()->download($file_path, $file_name_with_extension, $headers);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function read_file($file_id)
    {
        try {
            $emp_file = $this->EmployeeFilesRepository->getById($file_id);
            $file_path = 'files/' . $emp_file->file;
            // $file_path  = Storage::disk('files')->path($emp_file->file);
            return response()->file($file_path);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete_file(Request $request, $file_id)
    {
        try {
            $emp_file = $this->EmployeeFilesRepository->getWithRelations('employee')->where('id', $file_id)->first();
            $emp_id = $emp_file->employee->id;
            // dd($emp_id);
            $this->EmployeeFilesRepository->delete($file_id);


            return redirect()->route('admin.employee_files', $emp_id);
        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /************************************************** */
    public function employee_salary($id)
    {
        $data['all_data'] = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch','employee_salary'])->where('id', $id)->first();
        //dd($data['all_data']->employee_salary);
        return view('dashbord.admin.employees.employee_salary', $data);
    }

    /******************************************************  */
    public function save_employee_salary(SaveSalaryRequest $request, $id)
    {
        try {
            $this->employee_service->save_employee_salary($request, $id);
            $request->session()->flash('toastMessage', trans('File_deleted_successfully'));
            return redirect()->route('admin.employee_salary', $id);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', trans('employee.error_saving_salary'));
        }
    }
    /*******************************************************/
    public function employee_loans($id)
    {
        $data['all_data'] = $this->EmployeeRepository->getWithRelations(['area', 'governate', 'branch','employee_salary'])->where('id', $id)->first();
        return view('dashbord.admin.employees.employee_loans', $data);
    }
}
