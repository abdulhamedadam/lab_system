<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\Test;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class TestsService
{

    use ImageProcessing;
    protected $TestsRepository;
    protected $SoilCompactionTestRepository;
    protected $SoilCompactionTestDetailsRepository;
    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->TestsRepository   = createRepository($basicRepository, new Test());
        $this->SoilCompactionTestRepository   = createRepository($basicRepository, new SoilCompactionTest());
        $this->SoilCompactionTestDetailsRepository   = createRepository($basicRepository, new SoilCompactionTestDetails());
    }
    /************************************************/
    public function store($request)
    {
        DB::beginTransaction();

        try {
            $validated_data = $request->validated();
            $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
            $validated_data['created_by'] = auth()->user()->id;
            $validated_data['year'] = now()->year;
            $validated_data['month'] = now()->month;
            if ($request->hasFile('talab_image')) {
                $validated_data['talab_image'] = $this->saveImage($request->file('talab_image'), 'tests_talabat');
                $validated_data['status'] = 'received';
            } else {
                $validated_data['status'] = 'pending';
            }
            $test = $this->TestsRepository->create($validated_data);
            if (!$test) {
                throw new \Exception('Failed to create test.');
            }
            $soil_compaction['soil_test_id'] = $test->id;
            $soil_compaction_test = $this->SoilCompactionTestRepository->create($soil_compaction);
            if (!$soil_compaction_test) {
                throw new \Exception('Failed to create soil compaction test.');
            }
            for ($i = 1; $i <= $validated_data['sample_number']; $i++) {
                $details = [
                    'soil_compaction_test_id' => $soil_compaction_test->id,
                    'point' => $i
                ];

                $detailsCreated = $this->SoilCompactionTestDetailsRepository->create($details);

                if (!$detailsCreated) {
                    throw new \Exception("Failed to create soil compaction test details for sample $i.");
                }
            }

            DB::commit();

            return $test;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    /************************************************/
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $validated_data = $request->validated();
            $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
            $validated_data['created_by'] = auth()->user()->id;
            $validated_data['year'] = now()->year;
            $validated_data['month'] = now()->month;
            $test = $this->TestsRepository->getById($id);
            if ($request->hasFile('talab_image')) {
                if ($test->talab_image) {
                    $oldImagePath = public_path('images/' . $test->talab_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $validated_data['talab_image'] = $this->saveImage($request->file('talab_image'), 'tests_talabat');
                $validated_data['status']='received';
            }


            $test = $this->TestsRepository->update($id, $validated_data);
            if (!$test) {
                throw new \Exception('Failed to update test.');
            }
            $soil_compaction['soil_test_id'] = $id;
            $soil_compaction_test = $this->SoilCompactionTestRepository->getBywhere(['soil_test_id'=>$id]);
            if (!$soil_compaction_test)
            {
                $soil_compaction_test = $this->SoilCompactionTestRepository->create($soil_compaction);
            }


            if (!$soil_compaction_test) {
                throw new \Exception('Failed to create soil compaction test.');
            }
            $soil_compaction_test_details=$this->SoilCompactionTestDetailsRepository->deleteWhere('soil_compaction_test_id',$soil_compaction_test[0]->id);
            for ($i = 1; $i <= $validated_data['sample_number']; $i++) {
                $details = [
                    'soil_compaction_test_id' => $soil_compaction_test[0]->id,
                    'point' => $i
                ];

                $detailsCreated = $this->SoilCompactionTestDetailsRepository->create($details);

                if (!$detailsCreated) {
                    throw new \Exception("Failed to create soil compaction test details for sample $i.");
                }
            }

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
                $status=$request->input('evaluation-' . $item->point)=='pass' ? 1 : 0;
                $details = [
                    'point_location'   => $request->input('point_location-' . $item->point),
                    'layer_number'     => $request->input('layer_number-' . $item->point),
                    'can_number'       => $request->input('can_number-' . $item->point),
                    'wt_wet_soil_can'  => $request->input('wt_wet_soil_can-' . $item->point),
                    'wt_dry_soil_can'  => $request->input('wt_dry_soil_can-' . $item->point),
                    'wt_moisture'      => $request->input('wt_moisture-' . $item->point),
                    'wt_can'           => $request->input('wt_can-' . $item->point),
                    'wt_dry_soil'      => $request->input('wt_dry_soil-' . $item->point),
                    'moisture_content' => $request->input('moisture_content-' . $item->point),
                    'wt_wet_soil_gm'   => $request->input('wt_wet_soil_gm-' . $item->point),
                    'mulod_volume'     => $request->input('mulod_volume-' . $item->point),
                    'wet_density'      => $request->input('wet_density-' . $item->point),
                    'dry_density'      => $request->input('dry_density-' . $item->point),
                    'max_dry_density'  => $request->input('max_dry_density-' . $item->point),
                    'compaction'       => $request->input('compaction-' . $item->point),
                    'req_compaction'   => $request->input('req_compaction-' . $item->point),
                //    'evaluation'       => $status,
                  //  'created_by'       => auth()->user()->id,
                ];
                $this->SoilCompactionTestDetailsRepository->update($item->id, $details);
            }
        });

        return 's';
    }



}
