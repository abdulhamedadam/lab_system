<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Test;
use App\Traits\ImageProcessing;

class TestsService
{

    use ImageProcessing;
    protected $TestsRepository;
    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->TestsRepository   = createRepository($basicRepository, new Test());
    }
    /************************************************/
    public function store($request)
    {
        $validated_data = $request->validated();
       // dd($validated_data);
        $validated_data['test_code'] = explode('/', $validated_data['test_code'])[1] ?? null;
        $validated_data['created_by'] = auth()->user()->id;
        $validated_data['year'] = now()->year;
        $validated_data['month'] = now()->month;

        if ($request->hasFile('talab_image')) {
            $validated_data['talab_image'] = $this->saveImage($request->file('talab_image'), 'tests_talabat');
            $validated_data['status']='received';
        }else{
            $validated_data['status']='pending';
        }

        return $this->TestsRepository->create($validated_data);
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
