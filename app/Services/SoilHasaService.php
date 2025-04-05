<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\SoilHasaCompactionTest;
use App\Models\Admin\SoilHasaCompactionTestDetails;
use App\Models\Admin\Test;
use App\Traits\ImageProcessing;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\DB;

class SoilHasaService
{
    use ImageProcessing;

    protected $TestsRepository;
    protected $SoilCompactionTestRepository;
    protected $SoilCompactionTestDetailsRepository;
    protected $HasaCompactionTestRepository;
    protected $HasaCompactionTestDetailsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->TestsRepository = createRepository($basicRepository, new Test());
        $this->SoilCompactionTestRepository = createRepository($basicRepository, new SoilCompactionTest());
        $this->SoilCompactionTestDetailsRepository = createRepository($basicRepository, new SoilCompactionTestDetails());

        $this->HasaCompactionTestRepository = createRepository($basicRepository, new SoilHasaCompactionTest());
        $this->HasaCompactionTestDetailsRepository = createRepository($basicRepository, new SoilHasaCompactionTestDetails());
    }

    /**********************************************/
    public function save_compaction_test($request ,$test_id)
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
//            $main_data['moc'] = $validated_data['moc'];
            $main_data['diameter'] = $validated_data['diameter'];
           // $main_data['mold_number'] = $validated_data['mold_number'];
            $main_data['height'] = $validated_data['height'];
//            $main_data['volume'] = $validated_data['volume'];
            $main_data['mass_mold_sand1'] = $validated_data['mass_mold_sand1'];
            $main_data['mass_mold_sand2'] = $validated_data['mass_mold_sand2'];
            $main_data['mass_empty_sand'] = $validated_data['mass_empty_sand'];
            $main_data['unit_wt_sand1'] = $validated_data['unit_wt_sand1'];
            $main_data['unit_wt_sand2'] = $validated_data['unit_wt_sand2'];
            $main_data['avg_unit_wt_sand'] = $validated_data['avg_unit_wt_sand'];
            $main_data['wt_sand_cone'] = $validated_data['wt_sand_cone'];
            $main_data['sader_num'] = $validated_data['sader_num'];
            $main_data['sader_date'] = $validated_data['sader_date'];
            $main_data['created_by'] = auth()->user()->id;

        //    dd($request->hasa_compaction_test_id,$main_data);
            $this->HasaCompactionTestRepository->update($request->hasa_compaction_test_id, $main_data);
            //  dd($request->soil_compaction_test_id);
            $points_data = $this->HasaCompactionTestDetailsRepository->getBywhere(['hasa_compaction_test_id' => $request->hasa_compaction_test_id]);
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

                    'wt_wet_soil' => $request->input('wt_wet_soil-' . $item->point),
                    'wt_bottle_sand_before' => $request->input('wt_bottle_sand_before-' . $item->point),
                    'wt_bottle_sand_after' => $request->input('wt_bottle_sand_after-' . $item->point),
                    'wt_sand_used' => $request->input('wt_sand_used-' . $item->point),
                    'wt_sand_cone' => $request->input('wt_sand_cone-' . $item->point),
                    'wt_sand_fill_hole' => $request->input('wt_sand_fill_hole-' . $item->point),
                    'unit_wt_sand' => $request->input('unit_wt_sand-' . $item->point),
                    'hole_volume' => $request->input('hole_volume-' . $item->point),
                    'wet_density' => $request->input('wet_density-' . $item->point),
                    'dry_density' => $request->input('dry_density-' . $item->point),
                    'max_dry_density' => $request->input('max_dry_density-' . $item->point),
                    'compaction' => $request->input('compaction-' . $item->point),
                    'req_compaction' => $request->input('req_compaction-' . $item->point),
                    'evaluation' => $request->input('evaluation-' . $item->point),
                    //    'evaluation'       => $status,
                    //  'created_by'       => auth()->user()->id,
                ];
                $this->HasaCompactionTestDetailsRepository->update($item->id, $details);
                $sader_data['num'] = $validated_data['sader_num'];
                $sader_data['date'] = $validated_data['sader_date'];
                $sader_data['year'] = now()->year;
                $sader = TestSader::create($sader_data);
                $update_test['sader_id'] = $sader->id;
                $test_updated = $this->TestsRepository->update($test_id, $update_test);
            }
        });

        return 's';
    }
}
