<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Test;
use App\Models\TestSader;
use App\Services\HelperService;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function __construct(HelperService $helperService)
    {
        $this->helperService=$helperService;
    }
    /****************************************************/
    public function save_client_popup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $client_name=$request->name;
            $data['name']=$client_name;
            $client=$this->helperService->save_client($data);
            return response()->json([
                'success' => true,
                'message' => 'Client added successfully',
                'client' => $client
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add client: ' . $e->getMessage()
            ], 500);
        }

    }
    /****************************************************/
    public function save_company_popup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $company_name=$request->name;
            $data['name']=$company_name;
            $company=$this->helperService->save_company($data);
            return response()->json([
                'success' => true,
                'message' => 'Client added successfully',
                'company' => $company
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add client: ' . $e->getMessage()
            ], 500);
        }
    }
    /****************************************************/
    public function save_project_popup(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
        ]);
        try {
            $project_name=$request->project_name;
            $data['project_name']=$project_name;
            $project=$this->helperService->save_project($data);
            return response()->json([
                'success' => true,
                'message' => 'Client added successfully',
                'project' => $project
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add client: ' . $e->getMessage()
            ], 500);
        }
    }

    /**************************************************/
    public function update_test_status(Request $request, $test_id)
    {
        $status = $request->status;
        //dd($status);
        if ($status) {
            $this->helperService->update_test_status($status, $test_id);
        }
        return redirect()->back();
    }
    /**************************************************/
    public function check_sader_date(Request $request)
    {
        ;
        $validated = $request->validate([
            'date' => 'required|string|max:255',
        ]);
        try {
            $date = $request->input('date');
            $year = $request->input('year');

            $records = TestSader::whereYear('date', $year)
                ->whereDate('date', $date)
                ->get();

            if ($records->count() > 0) {
                $numbers = $records->pluck('num', 'id')->toArray();

                $filteredNumbers = [];
                foreach ($numbers as $id => $num) {
                    $existsInTests = Test::where('sader_id', $id)->exists();
                    if (!$existsInTests) {
                        $filteredNumbers[] = $num;
                    }
                }

                return response()->json([
                    'exists' => true,
                    'next_number' => $filteredNumbers
                ]);
            } else {
                $lastRecord = TestSader::whereYear('date', $year)
                    ->orderByDesc('num')
                    ->first();

                return response()->json([
                    'exists' => false,
                    'next_number' => $lastRecord ? $lastRecord->num + 1 : 1
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add client: ' . $e->getMessage()
            ], 500);
        }
    }




}
