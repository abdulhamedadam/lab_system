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
        $validated_data = $request->validated();
        $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
        $validated_data['updated_by'] = auth()->user()->id;
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

        return $this->TestsRepository->update($id, $validated_data);
    }
    /**************************************************/




}
