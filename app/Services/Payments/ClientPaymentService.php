<?php


namespace App\Services\Payments;


use App\Repositories\ClientPaymentRepository;
use App\Repositories\DuesRepository;
use App\Traits\ImageProcessing;

class ClientPaymentService
{
    use ImageProcessing;
    /*****************************************************/
    public function __construct(ClientPaymentRepository $clientPaymentRepository)
    {
        $this->clientPaymentRepository=$clientPaymentRepository;
    }
    /******************************************************/
    public function save_pay_dues($request,$id)
    {
        $validated_data=$request->validated();
        $validated_data['client_test_id']=$id ? $id : $request->client_test_id;
        $validated_data['client_id']    = $request->client_id;
        $validated_data['created_by']    = auth()->user()->id;
      //  dd($validated_data);
      return  $this->clientPaymentRepository->create($validated_data);


    }

    /*****************************************************/
    public function find($id)
    {
        return  $this->clientPaymentRepository->find($id);
    }

}
