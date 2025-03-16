<?php


namespace App\Services;


use App\Models\ExternalTests;
use App\Repositories\ClientPaymentRepository;
use App\Repositories\ClientTestsRepository;
use App\Repositories\ExternalTestsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExternalTestsService
{
    public function __construct(ExternalTestsRepository $externalTestsRepository, ClientTestsRepository $clientTestsRepository,ClientPaymentRepository $clientPaymentRepository)
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
           //dd($validated_data);
            $validated_data['report_number'] =$validated_data['report_num'];
            $validated_data['sample_number'] =$validated_data['sample_num'];
            $validated_data['month'] = Carbon::parse($validated_data['report_date'])->month;
            $validated_data['year'] = Carbon::parse($validated_data['report_date'])->year;
            $validated_data['created_by'] = auth()->user()->id;
            $repeated_from=$validated_data['kt_docs_repeater_basic'];
            unset($validated_data['kt_docs_repeater_basic']);
            unset($validated_data['report_num']);
            unset($validated_data['sample_num']);
          //  dd($validated_data);
            $test = $this->externalTestsRepository->save($validated_data);
            //dd($repeated_from);
            $client_test['client_id'] = $validated_data['company_id'];
            $client_test['test_table'] = (new ExternalTests())->getTable();
            $client_test['test_model'] = ExternalTests::class;
            $client_test['test_id'] = $test->id;
            $client_test['test_type'] = $validated_data['test_type'];
            $client_test['test_name'] = $validated_data['test_type'];
            $client_test['test_value'] = $validated_data['total_cost'];
            $client_test['month'] = Carbon::parse($validated_data['report_date'])->month;
            $client_test['year'] = Carbon::parse($validated_data['report_date'])->year;
            $client_test['created_by'] = auth()->user()->id;
            $client_test = $this->clientTestsRepository->create($client_test);

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
        });
    }

    /**********************************************************/
    public function get_company_test($company_id)
    {
        return $this->externalTestsRepository->get_company_test($company_id);
    }
}
