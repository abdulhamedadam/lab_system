<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Interfaces\CompanyInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\Companies;
use App\Repositories\CompanyRepository;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;

class CompanyService
{

    use ImageProcessing;

    protected $CompanyRepository;
    protected $CompanyClientRepository;
    protected $companyInterface;
    protected $CompanyRepository1;

    public function __construct(BasicRepositoryInterface $basicRepository, CompanyInterface $companyInterface,CompanyRepository $CompanyRepository1)
    {
        $this->CompanyRepository = createRepository($basicRepository, new Companies());
        $this->CompanyClientRepository = createRepository($basicRepository, new ClientsCompanies());
        $this->companyInterface = $companyInterface;
        $this->CompanyRepository1 = $CompanyRepository1;
    }

    /************************************************/
    public function store($request)
    {
        DB::beginTransaction();

        try {
            //dd($request);
            $validated_data = $request->validated();
            $validated_data['company_code'] = $request->company_code;
            $validated_data['created_by'] = auth()->user()->id;

            $company = $this->CompanyRepository->create($validated_data);

            foreach ($request->client_id as $index => $client) {
                $compnay_client_data['client_id'] = $client;
                $compnay_client_data['company_id'] = $company->id;
                $this->CompanyClientRepository->create($compnay_client_data);
                // DB::table('company_client')->insert($compnay_client_data);
            }

            DB::commit();

            return $company;

        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /************************************************/
    public function get_company($id)
    {
        return $this->CompanyRepository->getById($id);
    }

    /************************************************/
    public function update($request, $id)
    {

        DB::beginTransaction();

        try {
            $validated_data = $request->validated();
            $validated_data['company_code'] = $request->company_code;
            $validated_data['created_by'] = auth()->user()->id;

            $this->CompanyRepository->update($id, $validated_data);
            ClientsCompanies::where('company_id',$id)->delete();
            foreach ($request->client_id as $index => $client) {
                $compnay_client_data['client_id'] = $client;
                $compnay_client_data['company_id'] = $id;
                $this->CompanyClientRepository->create($compnay_client_data);
                // DB::table('company_client')->insert($compnay_client_data);
            }

            DB::commit();

            return '';

        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }


    }

    /**************************************************/
    public function get_company_data($id)
    {
        return $this->companyInterface->get_company_data($id);
    }

    public function get_Payments_received($from_date,$to_date,$company_id)
    {
        return $this->CompanyRepository1->get_Payments_received($from_date,$to_date,$company_id);
    }

    public function get_unpaid_dues($from_date,$to_date,$company_id)
    {
        return $this->CompanyRepository1->get_unpaid_dues($from_date,$to_date,$company_id);
    }

}
