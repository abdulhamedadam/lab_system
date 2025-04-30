<?php


namespace App\Services;


use App\Interfaces\BasicRepositoryInterface;
use App\Interfaces\ClientInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Clients;
use App\Traits\ImageProcessing;

class ClientService
{

    use ImageProcessing;

    protected $AreasSettingRepository;
    protected $ClientsRepository;
    protected $ClientsRepo;

    public function __construct(BasicRepositoryInterface $basicRepository, ClientInterface $ClientsRepo)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());
        $this->ClientsRepo = $ClientsRepo;
    }

    /************************************************/
    public function store($request)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $dataX = $this->saveImage($file, 'clients');
            $validated_data['image'] = $dataX;
        }
        return $this->ClientsRepository->create($validated_data);
    }

    /************************************************/
    public function get_client($id)
    {
        return $this->ClientsRepository->getById($id);
    }

    /**************************************************/
    public function update($request, $id)
    {
        $validated_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $dataX = $this->saveImage($file, 'clients');
            $validated_data['image'] = $dataX;
        }
        //dd($validated_data);
        return $this->ClientsRepository->update($id, $validated_data);
    }
    /**************************************************/
    public function get_client_company($client_id)
    {
        return $this->ClientsRepo->get_client_company_data($client_id);
    }
    /**************************************************/
    public function get_project($client_id,$company_id)
    {
        return $this->ClientsRepo->get_project($client_id,$company_id);
    }


}
