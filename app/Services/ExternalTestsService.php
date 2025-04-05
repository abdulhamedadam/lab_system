<?php


namespace App\Services;


use App\Models\Admin\Test;
use App\Models\ExternalTests;
use App\Models\TestSader;
use App\Repositories\ClientPaymentRepository;
use App\Repositories\ClientTestsRepository;
use App\Repositories\ExternalTestsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExternalTestsService
{
    public function __construct(ExternalTestsRepository $externalTestsRepository, ClientTestsRepository $clientTestsRepository, ClientPaymentRepository $clientPaymentRepository)
    {
        $this->externalTestsRepository = $externalTestsRepository;
        $this->clientTestsRepository = $clientTestsRepository;
        $this->clientPaymentRepository = $clientPaymentRepository;
    }

    /*****************************************************/
    public function store($request)
    {
        DB::transaction(function () use ($request) {
            $validated_data = $request->validated();

            $validated_data['sample_number'] = $validated_data['sample_num'];
            $validated_data['month'] = now()->month;
            $validated_data['year'] = now()->year;
            $validated_data['test_type'] = 'external';
            $validated_data['created_by'] = auth()->user()->id;
            $repeated_from = $request->kt_docs_repeater_basic;

            $sader_exist = TestSader::where('date', $validated_data['sader_date'])->first();
            if ($sader_exist) {
                $sader = $sader_exist;
            } else {
                $sader_data['num'] = $validated_data['sader_num'];
                $sader_data['date'] = $validated_data['sader_date'];
                $sader = TestSader::create($sader_data);
            }
            unset($validated_data['kt_docs_repeater_basic']);
            unset($validated_data['sample_num']);
            unset($validated_data['sader_date']);
            unset($validated_data['sader_num']);
            $validated_data['sader_id'] = $sader->id;
           //  dd($validated_data);
            $test = Test::create($validated_data);
         //   dd($test);
            $client_test['client_id'] = $validated_data['company_id'];
            $client_test['test_table'] = (new Test())->getTable();
            $client_test['test_model'] = Test::class;
            $client_test['test_id'] = $test->id;
            $client_test['test_type'] = $validated_data['test_category'];
            $client_test['test_name'] = $validated_data['test'];
            $client_test['test_value'] = $validated_data['total_cost'];
            $client_test['month'] = now()->month;
            $client_test['year'] = now()->year;
            $client_test['created_by'] = auth()->user()->id;
            $client_test = $this->clientTestsRepository->create($client_test);

            if ($repeated_from)
            {
                foreach ($repeated_from as $dues) {
                    $dues_data['num'] = $dues['invoice_num'];
                    $dues_data['paid_date'] = $dues['invoice_date'];
                    $dues_data['value'] = $dues['value'];
                    $dues_data['payment_type'] = 'cash';
                    $dues_data['notes'] = $validated_data['notes'];
                    $dues_data['client_test_id'] = $client_test->id;
                    $dues_data['client_id'] = $validated_data['company_id'];
                    $this->clientPaymentRepository->create($dues_data);
                }
            }

        });
    }

    /**********************************************************/
    public function get_company_test($company_id)
    {
        return $this->externalTestsRepository->get_company_test($company_id);
    }
}
