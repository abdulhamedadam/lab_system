<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Test;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AllTestsController extends Controller
{


    /*************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Test::with(['company', 'client', 'project', 'user', 'sader'])->orderBy('id', 'desc')->get();
            return DataTables::of($allData)
                ->editColumn('test_code', function ($row) {
                    return  $row->test_code_st;
                })
                ->editColumn('company', function ($row) {
                    return $row->client ? $row->client->name : 'N/A' . ' | ' .
                        ($row->company ? $row->company->name : 'N/A') . ' | ' .
                        ($row->project ? $row->project->project_name : 'N/A');
                })
                ->editColumn('type', function ($row) {
                    return $row->test_type;
                })
                ->editColumn('test_type', function ($row) {
                    return $row->test_sub_category;
                })->editColumn('sub_type', function ($row) {
                    return $row->test;
                })->editColumn('talab_title', function ($row) {
                    return $row->talab_title;
                })
                ->editColumn('talab_date', function ($row) {
                    return $row->talab_date;
                })
                ->editColumn('talab_end_date', function ($row) {
                    return $row->talab_end_date;
                })
                ->editColumn('sample_number', function ($row) {
                    return $row->sample_number;
                })
                ->editColumn('sader_number', function ($row) {
                    return optional($row->sader)->num ?? '-';
                })
                ->editColumn('sader_date', function ($row) {
                    return optional($row->sader)->date ?? '-';
                })
                ->editColumn('status', function ($row) {
                    $status_arr = ['pending' => trans('tests.pending'), 'received' => trans('tests.received'),
                        'test_progress' => trans('tests.test_progress'), 'test_done' => trans('tests.test_done'), 'reports_progress' => trans('tests.reports_progress'),
                        'reports_done' => trans('tests.reports_done')
                    ];
                    return $status_arr[$row->status];
                })
                ->addColumn('action', function ($row) {
                    if ($row->test_category == 'soil' and $row->test_sub_category== 'hasa' and $row->test=='compaction')
                    {
                        $edit_action=route('admin.hasa_compaction_edit_soil_test', [$row->id]);
                    }elseif ($row->test_category == 'soil' and $row->test_sub_category== 'soil' and $row->test=='compaction')
                    {
                        $edit_action=route('admin.soil_compaction_edit_soil_test', [$row->id]);
                    }else{
                        $edit_action=route('admin.external_test.edit', [$row->id]);
                    }
                    return '
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i> ' . trans('tests.actions') . '
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown'.$row->id.'">


             <li>
                <a class="dropdown-item test-cost-btn" href="#" data-bs-toggle="modal"  data-bs-target="#testCostModal" onclick="edit_test_cost(' . $row->id . ')">
                    <i class="bi bi-currency-dollar me-2"></i> ' . trans('tests.test_cost') . '
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="' . $edit_action . '">
                    <i class="bi bi-pencil-square me-2"></i> ' . trans('tests.edit') . '
                </a>
            </li>

        </ul>
    </div>';
                })
                ->rawColumns(['action', 'talab_image'])
                ->make(true);
        }
        return view('dashbord.tests.all_tests');
    }

}
