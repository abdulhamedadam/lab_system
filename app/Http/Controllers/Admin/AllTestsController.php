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
                    return $row->type;
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
                    return '
                        <div class="btn-group btn-group-sm">
                            <a href="' . route('admin.test.edit', $row->id) . '" class="btn btn-sm btn-primary" title="' . trans('tests.edit') . '" style="font-size: 16px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a onclick="return confirm(\'Are You Sure To Delete?\')"  href="' . route('admin.delete_test', $row->id) . '"  class="btn btn-sm btn-danger" title="' . trans('tests.delete') . '" style="font-size: 16px;" onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                                <i class="bi bi-trash3"></i>
                            </a>
                            <a href="' . route('admin.samples_test', $row->id) . '" class="btn btn-sm btn-success" title="' . trans('tests.samples_test') . '" style="font-size: 16px;">
                                <i class="bi bi-clipboard-check"></i>
                             </a>

                             <a href="' . route('admin.print_soil_sample_report', $row->id) . '" class="btn btn-sm btn-dark" title="' . trans('tests.print_samples_test') . '" style="font-size: 16px;">
                                  <i class="bi bi-printer ms-1"></i>
                             </a>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'talab_image'])
                ->make(true);
        }
        return view('dashbord.tests.all_tests');
    }

}
