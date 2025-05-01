<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\SoilHasaCompactionTest;
use App\Models\Admin\SoilHasaCompactionTestDetails;
use App\Models\Admin\Test;
use App\Models\TestSader;
use App\Repositories\ClientTestsRepository;
use App\Traits\ImageProcessing;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TestsService
{

    use ImageProcessing;

    protected $TestsRepository;
    protected $SoilCompactionTestRepository;
    protected $SoilCompactionTestDetailsRepository;
    protected $HasaCompactionTestRepository;
    protected $HasaCompactionTestDetailsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository, ClientTestsRepository $clientTestsRepository)
    {
        $this->TestsRepository = createRepository($basicRepository, new Test());
        $this->SoilCompactionTestRepository = createRepository($basicRepository, new SoilCompactionTest());
        $this->SoilCompactionTestDetailsRepository = createRepository($basicRepository, new SoilCompactionTestDetails());

        $this->HasaCompactionTestRepository = createRepository($basicRepository, new SoilHasaCompactionTest());
        $this->HasaCompactionTestDetailsRepository = createRepository($basicRepository, new SoilHasaCompactionTestDetails());
        $this->clientTestsRepository = $clientTestsRepository;

    }

    /************************************************/
    //الفانشكن دي لحفظ الsoil بس
    public function store($request, $type, $test)
    {

        DB::beginTransaction();
        //   dd('sss');
        try {
            $validated_data = $request->validated();
            $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
            $validated_data['created_by'] = auth()->user()->id;
            $validated_data['year'] = now()->year;
            $validated_data['month'] = now()->month;
            $validated_data['test_type'] = 'system';
            $validated_data['test_category'] = 'soil';
            $validated_data['test_sub_category'] = $type;
            $validated_data['test'] = $test;
            if ($request->hasFile('talab_image')) {
                $validated_data['talab_image'] = $this->saveImage($request->file('talab_image'), 'tests_talabat');
                $validated_data['status'] = 'received';
            } else {
                $validated_data['status'] = 'pending';
            }
            $validated_data['test_code_st'] = get_prefix($validated_data['test_type']) . $validated_data['test_code'];


            // dd($validated_data);
            $test_data = $this->TestsRepository->create($validated_data);
            if (!$test) {
                throw new \Exception('Failed to create test.');
            }
            $soil_compaction['soil_test_id'] = $test_data->id;
            /***************************************************************/
            if ($type == 'soil') {

                if ($test == 'compaction') {
                    $this->create_soil_compaction_test($soil_compaction, $validated_data['sample_number']);
                }

            }

            if ($type == 'hasa') {
                // dd($test);
                if ($test == 'compaction') {
//                    dd('3');
                    $this->create_hasa_compaction_test($soil_compaction, $validated_data['sample_number']);
                }
            }
            $client_test['client_id'] = $validated_data['company_id'];
            $client_test['test_table'] = $this->TestsRepository->getModel()->getTable();
            $client_test['test_model'] = get_class($this->TestsRepository->getModel());
            $client_test['test_name'] = $validated_data['talab_title'];
            $client_test['test_id'] = $test_data->id;
         //   $client_test['test_value'] = $retotal_cost'];
            $client_test['test_type'] = $type;
            $client_test['month'] = Carbon::now()->month;
            $client_test['year'] = Carbon::now()->year;
            $client_test['created_by'] = auth()->user()->id;
            //  dd($client_test);
            $this->clientTestsRepository->create($client_test);
            // dd('4');
            /***************************************************************/
            DB::commit();

            return $test;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /************************************************/
    public function update($request, $id, $type, $test)
    {
        DB::beginTransaction();
        try {
            $validated_data = $request->validated();
            $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
            $validated_data['created_by'] = auth()->user()->id;
            $validated_data['year'] = now()->year;
            $validated_data['month'] = now()->month;
            $test_data = $this->TestsRepository->getById($id);
            $previous_sample_number = $test_data->sample_number;
            if ($request->hasFile('talab_image')) {
                if ($test_data->talab_image) {
                    $oldImagePath = public_path('images/' . $test_data->talab_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $validated_data['talab_image'] = $this->saveImage($request->file('talab_image'), 'tests_talabat');
                $validated_data['status'] = 'received';
            }


            $test_updated = $this->TestsRepository->update($id, $validated_data);
            if (!$test_updated) {
                throw new \Exception('Failed to update test.');
            }
            $soil_compaction['soil_test_id'] = $id;
            /***************************************************************/
            if ($type == 'soil') {

                if ($test == 'compaction') {

                    $this->update_soil_compaction_test($soil_compaction, $validated_data['sample_number'], $previous_sample_number, $id);
                }

            }

            if ($type == 'hasa') {
                // dd($test);
                if ($test == 'compaction') {
//                    dd('3');
                    $this->update_hasa_compaction_test($soil_compaction, $validated_data['sample_number'], $previous_sample_number, $id);
                }
            }

            $client_test['client_id'] = $validated_data['company_id'];
            $client_test['test_table'] = $this->TestsRepository->getModel()->getTable();
            $client_test['test_model'] = get_class($this->TestsRepository->getModel());
            $client_test['test_name'] = $validated_data['talab_title'];
            $client_test['test_id'] = $test_data->id;
            //$client_test['test_value'] = $validated_data['total_cost'];
            $client_test['test_type'] = $type;
            $client_test['month'] = Carbon::now()->month;
            $client_test['year'] = Carbon::now()->year;
            $client_test['created_by'] = auth()->user()->id;
            //  dd($client_test);
            $this->clientTestsRepository->update($test_data->id, $client_test);
            // dd('4');
            /***************************************************************/

            DB::commit();

            return $test;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**************************************************/
    public function save_compaction_test($request, $test_id)
    {
        DB::transaction(function () use ($request, $test_id) {
            $validated_data = $request->validated();

            $main_data['test_carried_date'] = $validated_data['test_carried_date'];
            $main_data['proctor_test_date'] = $validated_data['proctor_test_date'];
            $main_data['sample_collect_date'] = $validated_data['sample_collect_date'];
            $main_data['location'] = $validated_data['location'];
            $main_data['proctor_ref'] = $validated_data['proctor_ref'];
            $main_data['test_method'] = $validated_data['test_method'];
            $main_data['material_desc'] = $validated_data['material_desc'];
            $main_data['mdd'] = $validated_data['mdd'];
            $main_data['moc'] = $validated_data['moc'];
            $main_data['diameter'] = $validated_data['diameter'];
            $main_data['mold_number'] = $validated_data['mold_number'];
            $main_data['height'] = $validated_data['height'];
            $main_data['volume'] = $validated_data['volume'];
            $main_data['created_by'] = auth()->user()->id;

            $this->SoilCompactionTestRepository->update($request->soil_compaction_test_id, $main_data);
            //  dd($request->soil_compaction_test_id);
            $points_data = $this->SoilCompactionTestDetailsRepository->getBywhere(['soil_compaction_test_id' => $request->soil_compaction_test_id]);
            //  dd($points_data);
            foreach ($points_data as $item) {
                $status = $request->input('evaluation-' . $item->point) == 'pass' ? 1 : 0;
                $details = [
                    'point_location' => $request->input('point_location-' . $item->point),
                    'layer_number' => $request->input('layer_number-' . $item->point),
                    'can_number' => $request->input('can_number-' . $item->point),
                    'wt_wet_soil_can' => $request->input('wt_wet_soil_can-' . $item->point),
                    'wt_dry_soil_can' => $request->input('wt_dry_soil_can-' . $item->point),
                    'wt_moisture' => $request->input('wt_moisture-' . $item->point),
                    'wt_can' => $request->input('wt_can-' . $item->point),
                    'wt_dry_soil' => $request->input('wt_dry_soil-' . $item->point),
                    'moisture_content' => $request->input('moisture_content-' . $item->point),
                    'wt_wet_soil_gm' => $request->input('wt_wet_soil_gm-' . $item->point),
                    'mulod_volume' => $request->input('mulod_volume-' . $item->point),
                    'wet_density' => $request->input('wet_density-' . $item->point),
                    'dry_density' => $request->input('dry_density-' . $item->point),
                    'max_dry_density' => $request->input('max_dry_density-' . $item->point),
                    'compaction' => $request->input('compaction-' . $item->point),
                    'req_compaction' => $request->input('req_compaction-' . $item->point),
                    //    'evaluation'       => $status,
                    //  'created_by'       => auth()->user()->id,
                ];
                $this->SoilCompactionTestDetailsRepository->update($item->id, $details);
            }

            $sader_data['num'] = $validated_data['sader_num'];
            $sader_data['date'] = $validated_data['sader_date'];
            $sader_data['year'] = now()->year;
            $sader = TestSader::create($sader_data);
            $update_test['sader_id'] = $sader->id;
            $test_updated = $this->TestsRepository->update($test_id, $update_test);

        });

        return 's';
    }

    /***************************************************/
    public function create_soil_compaction_test($data, $sample_number)
    {
        $soil_compaction_test = $this->SoilCompactionTestRepository->create($data);
        if (!$soil_compaction_test) {
            throw new \Exception('Failed to create soil compaction test.');
        }
        for ($i = 1; $i <= $sample_number; $i++) {
            $details = [
                'soil_compaction_test_id' => $soil_compaction_test->id,
                'point' => $i
            ];

            $detailsCreated = $this->SoilCompactionTestDetailsRepository->create($details);

            if (!$detailsCreated) {
                throw new \Exception("Failed to create soil compaction test details for sample $i.");
            }
        }
    }

    /****************************************************/

    public function update_soil_compaction_test($data, $sample_number, $previous_sample_number, $id)
    {
        $soil_compaction_test = $this->SoilCompactionTestRepository->getBywhere(['soil_test_id' => $id]);
        if (!$soil_compaction_test) {
            $soil_compaction_test = $this->SoilCompactionTestRepository->create($data);
        }


        if (!$soil_compaction_test) {
            throw new \Exception('Failed to create soil compaction test.');
        }

        $previous_sample_number = $this->SoilCompactionTestDetailsRepository->countWhere(['soil_compaction_test_id' => $soil_compaction_test[0]->id]);
        $new_sample_number = $sample_number;

        if ($new_sample_number > $previous_sample_number) {
            // Add new records
            for ($i = $previous_sample_number + 1; $i <= $new_sample_number; $i++) {
                $details = [
                    'soil_compaction_test_id' => $soil_compaction_test[0]->id,
                    'point' => $i
                ];

                $detailsCreated = $this->SoilCompactionTestDetailsRepository->create($details);

                if (!$detailsCreated) {
                    throw new \Exception("Failed to create soil compaction test details for sample $i.");
                }
            }
        } elseif ($new_sample_number < $previous_sample_number) {
            // Delete the excess records
            //dd($soil_compaction_test[0]->id,$new_sample_number);
            $this->SoilCompactionTestDetailsRepository->deleteWhere_arr([
                ['soil_compaction_test_id', '=', $soil_compaction_test[0]->id],
                ['point', '>', $new_sample_number]
            ]);
        }

    }
    /****************************************************/
    /****************************************************/
    /****************************************************/
    public function create_hasa_compaction_test($data, $sample_number)
    {
        $hasa_compaction_test = $this->HasaCompactionTestRepository->create($data);
        if (!$hasa_compaction_test) {
            throw new \Exception('Failed to create soil compaction test.');
        }
        for ($i = 1; $i <= $sample_number; $i++) {
            $details = [
                'hasa_compaction_test_id' => $hasa_compaction_test->id,
                'point' => $i
            ];

            $detailsCreated = $this->HasaCompactionTestDetailsRepository->create($details);

            if (!$detailsCreated) {
                throw new \Exception("Failed to create soil compaction test details for sample $i.");
            }
        }
    }

    /****************************************************/
    public function update_hasa_compaction_test($data, $sample_number, $previous_sample_number, $id)
    {
        $soil_compaction_test = $this->HasaCompactionTestRepository->getBywhere(['soil_test_id' => $id]);
        if (!$soil_compaction_test) {
            $soil_compaction_test = $this->HasaCompactionTestRepository->create($data);
        }


        if (!$soil_compaction_test) {
            throw new \Exception('Failed to create soil compaction test.');
        }

        $previous_sample_number = $this->HasaCompactionTestDetailsRepository->countWhere(['hasa_compaction_test_id' => $soil_compaction_test[0]->id]);
        $new_sample_number = $sample_number;

        if ($new_sample_number > $previous_sample_number) {
            // Add new records
            for ($i = $previous_sample_number + 1; $i <= $new_sample_number; $i++) {
                $details = [
                    'hasa_compaction_test_id' => $soil_compaction_test[0]->id,
                    'point' => $i
                ];

                $detailsCreated = $this->HasaCompactionTestDetailsRepository->create($details);

                if (!$detailsCreated) {
                    throw new \Exception("Failed to create soil compaction test details for sample $i.");
                }
            }
        } elseif ($new_sample_number < $previous_sample_number) {
            // Delete the excess records
            $this->HasaCompactionTestDetailsRepository->deleteWhere_arr([
                ['hasa_compaction_test_id', '=', $soil_compaction_test[0]->id],
                ['point', '>', $new_sample_number]
            ]);
        }

    }
    /****************************************************/


}
