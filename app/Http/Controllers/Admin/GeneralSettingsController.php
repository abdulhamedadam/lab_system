<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AddAreaRequest;
use App\Http\Requests\Admin\Setting\AddGovernorateRequest;
use App\Http\Requests\Admin\Setting\GeneralSettingsRequest;
use App\Http\Requests\Admin\Setting\SaveSiteDataRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Branch;
use App\Models\Admin\CaseSettings;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\SarfBand;
use App\Models\Site\SiteData;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
// use DataTables;
class GeneralSettingsController extends Controller
{

    use ImageProcessing;
    use ValidationMessage;

    /***********************************************************/

    protected $GeneralSettingsRepository;
    protected $BranchesRepository;
    protected $AreasRepository;
    protected $SiteDataRepository;
    protected $SarfBandRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->BranchesRepository = createRepository($basicRepository, new Branch());
        $this->AreasRepository = createRepository($basicRepository, new AreaSetting());
        $this->SiteDataRepository = createRepository($basicRepository, new SiteData());
        $this->SarfBandRepository = createRepository($basicRepository, new SarfBand());
    }
    /***********************************************************/

    public function branches()
    {
        return view('dashbord.admin.settings.branches');
    }

    /***********************************************************/
    public function get_ajax_branches()
    {
        if (request()->ajax()) {
            try {
                $data = $this->BranchesRepository->getAll();

                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalbranches" onclick="edit_branch(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        ';
                        // <a onclick="return confirm(\'Are You Sure To Delete?\')" href="' . route('admin.delete_branch', $row->id) . '"  class="btn btn-sm btn-danger">
                        //     <i class="bi bi-trash"></i>
                        // </a>
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_branches: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /***********************************************************/
    public function get_ajax_branches1()
    {
        if (request()->ajax()) {
            try {
                $data = $this->BranchesRepository->getWithRelations(['areaSetting']);

                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->addColumn('address', function ($row) {
                        return $row->address;
                    })
                    ->addColumn('city', function ($row) {
                        return $row->areaSetting->title;  // Ensure this is correct
                    })
                    ->addColumn('country', function ($row) {
                        return $row->areaSetting->parent->title;  // Ensure this is correct
                    })
                    ->addColumn('phone', function ($row) {
                        return $row->phone;
                    })
                    ->addColumn('color', function ($row) {
                        return $row->color;
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalbranches" onclick=" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href=" "  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                    })
                    ->rawColumns(['action', 'color'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_branches: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /*****************************************************/
    public function add_branch(Request $request)
    {
        try {
            // dd($request->all());
            $branch_Model = new Branch();
            $data = $branch_Model->add_branch_data($request);
            if(empty($request->row_id))
            {
                $this->BranchesRepository->create($data);

            }else{
                $this->BranchesRepository->update($request->row_id,$data);
            }
            notify()->success(trans('branch_added_successfully'), '');
            return redirect()->route('admin.branches');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_branch(Request $request,$id)
    {
        try {
            $branch = $this->BranchesRepository->getById($id);
            $this->BranchesRepository->delete($id);
            notify()->success(trans('branch_deleted_successfully'), '');
            return redirect()->route('admin.branches');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function edit_branch($id)
    {
        $data['all_data']=$this->BranchesRepository->getById($id);
        return response()->json($data);
    }

    /****************************************************/
    /***********************************************************/

    public function governorates()
    {
        return view('dashbord.admin.settings.governorates');
    }

    /***********************************************************/
    public function get_ajax_governorates()
    {
        if (request()->ajax()) {
            try {
                $data = $this->AreasRepository->getAll()->whereNull('parent_id');

                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalgovernorates" onclick="edit_governorate(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="' . route('admin.delete_governorate', $row->id) . '"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                    })
                    ->rawColumns(['action', 'color'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_governorates: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /*****************************************************/
    public function add_governorate(Request $request)
    {
        try {
            // dd($request->all());
            $area_Model = new AreaSetting();
            $data = $area_Model->add_governorate_data($request);
            if(empty($request->row_id))
            {
                $this->AreasRepository->create($data);

            }else{
                $this->AreasRepository->update($request->row_id, $data);
            }
            notify()->success(trans('governorate_added_successfully'), '');
            return redirect()->route('admin.governorates');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_governorate(Request $request,$id)
    {
        try {
            $governorate = $this->AreasRepository->getById($id);
            $this->AreasRepository->delete($id);
            notify()->success(trans('governorate_deleted_successfully'), '');
            return redirect()->route('admin.governorates');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function edit_governorate($id)
    {
        $data['all_data']=$this->AreasRepository->getById($id);
        return response()->json($data);
    }

    /***********************************************************/

    public function areas()
    {
        $data['governorates'] = $this->AreasRepository->getAll()->whereNull('parent_id');
        // dd($data);
        return view('dashbord.admin.settings.areas', $data);
    }

    /***********************************************************/
    public function get_ajax_areas()
    {
        if (request()->ajax()) {
            try {
                $data = $this->AreasRepository->getAll()->whereNotNull('parent_id');

                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('governorate', function ($row) {
                        return $row->parent->title;
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalareas" onclick="edit_area(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="' . route('admin.delete_area', $row->id) . '"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_areas: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /*****************************************************/
    public function add_area(Request $request)
    {
        try {
            // dd($request->all());
            $area_Model = new AreaSetting();
            $data = $area_Model->add_area_data($request);
            if(empty($request->row_id))
            {
                $this->AreasRepository->create($data);

            }else{
                $this->AreasRepository->update($request->row_id, $data);
            }
            notify()->success(trans('area_added_successfully'), '');
            return redirect()->route('admin.areas');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_area(Request $request,$id)
    {
        try {
            $area = $this->AreasRepository->getById($id);
            $this->AreasRepository->delete($id);
            notify()->success(trans('area_deleted_successfully'), '');
            return redirect()->route('admin.areas');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function edit_area($id)
    {
        $data['all_data']=$this->AreasRepository->getById($id);
        return response()->json($data);
    }

    public function get_area_list($id)
    {
        $data['all_data'] = $this->AreasRepository->getBywhere(array('parent_id' => $id));
        // dd($data['all_data']);
        return view('dashbord.admin.settings.load_area_select', $data);
    }

    /***********************************************************/

    public function siteData()
    {
        return view('dashbord.admin.settings.siteData');
    }

    /***********************************************************/
    public function get_ajax_siteData()
    {
        if (request()->ajax()) {
            try {
                $data = SiteData::where('id', 1)->get();
                    // dd($data);
                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('name', function ($row) {
                        return $row->getTranslation('name', app()->getLocale()) ?? 'N/A';
                    })
                    ->addColumn('email', function ($row) {
                        return $row->email;
                    })
                    ->addColumn('address', function ($row) {
                        return $row->getTranslation('address', app()->getLocale()) ?? 'N/A';
                    })
                    ->addColumn('fax', function ($row) {
                        return $row->fax ?? 'N/A';
                    })
                    ->addColumn('phone', function ($row) {
                        return $row->phone ?? 'N/A';
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalsiteData" onclick="edit_siteData(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>';
                    })
                    ->rawColumns(['action', 'name', 'address'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_siteData: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }


    /****************************************************/
    // public function edit_siteData($id)
    // {
    //     $data['all_data'] = $this->SiteDataRepository->getById($id);
    //     return response()->json($data);
    // }

    public function edit_siteData($id)
    {
        $branches = Branch::all();
        $siteData = $this->SiteDataRepository->getById($id);

        // Build translatable data
        $translatable = ['name', 'address', 'description', 'contract_terms'];

        $translations = [];
        foreach ($translatable as $field) {
            $translations[$field] = $siteData->getTranslation($field, app()->getLocale());
        }

        // Add image URLs
        $siteData->image = $siteData->image ? asset('images/' . $siteData->image) : null;
        $siteData->image_print = $siteData->image_print ? asset('images/' . $siteData->image_print) : null;

        return response()->json([
            'branches' => $branches,
            'all_data' => $siteData,
            'translations' => $translations,
        ]);
    }
    /*****************************************************/
    public function save_siteData(SaveSiteDataRequest $request)
    {
        try {
            $siteData = $request->row_id
                ? SiteData::findOrFail($request->row_id)
                : new SiteData();

            $siteData->name = $request->name;
            $siteData->email = $request->email;
            $siteData->branch_id = $request->branch_id;
            $siteData->fax = $request->fax;
            $siteData->phone = $request->phone;
            $siteData->video = $request->video;
            $siteData->discount_ratio = $request->discount_ratio;
            $siteData->tax_number = $request->tax_number;
            $siteData->commercial_registration_number = $request->commercial_registration_number;
            $siteData->maplocation = $request->maplocation;
            $siteData->short_about = $request->short_about;
            $siteData->description = $request->description;
            $siteData->contract_terms = $request->contract_terms;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('site_images', 'images');
                $siteData->image = $imagePath;
            }

            if ($request->hasFile('image_print')) {
                $imagePrintPath = $request->file('image_print')->store('site_images', 'images');
                $siteData->image_print = $imagePrintPath;
            }

            $siteData->save();

            // notify()->success(trans('siteData_added_successfully'), '');
            return redirect()->route('admin.siteData');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function sarf_bands()
    {
        return view('dashbord.admin.settings.sarf_band');
    }

    /***********************************************************/
    public function get_ajax_sarf_bands()
    {
        if (request()->ajax()) {
            try {
                $data = $this->SarfBandRepository->getAll();

                $counter = 0;

                return DataTables::of($data)
                    ->addColumn('id', function () use (&$counter) {
                        $counter++;
                        return $counter;
                    })
                    ->addColumn('title', function ($row) {
                        return $row->title;
                    })
                    ->addColumn('action', function ($row) {
                        return '<a data-bs-toggle="modal" data-bs-target="#modalSarfBands" onclick="edit_sarf_band(' . $row->id . ')" class="btn btn-sm btn-warning" title="">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a onclick="return confirm(\'Are You Sure To Delete?\')" href="' . route('admin.delete_sarf_band', $row->id) . '"  class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error in get_ajax_sarf_bands: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }
    }

    /*****************************************************/
    public function add_sarf_band(Request $request)
    {
        try {
            // dd($request->all());
            $sarf_band_Model = new SarfBand();
            $data = $sarf_band_Model->add_sarf_band_data($request);
            if(empty($request->row_id))
            {
                $this->SarfBandRepository->create($data);

            }else{
                $this->SarfBandRepository->update($request->row_id, $data);
            }
            notify()->success(trans('sarf_band_added_successfully'), '');
            return redirect()->route('admin.sarf_bands');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    /*****************************************************/
    public function delete_sarf_band(Request $request,$id)
    {
        try {
            $bsarf_band = $this->SarfBandRepository->getById($id);
            $this->SarfBandRepository->delete($id);
            notify()->success(trans('sarf_band_deleted_successfully'), '');
            return redirect()->route('admin.sarf_bands');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function edit_sarf_band($id)
    {
        $data['all_data']=$this->SarfBandRepository->getById($id);
        return response()->json($data);
    }
}
