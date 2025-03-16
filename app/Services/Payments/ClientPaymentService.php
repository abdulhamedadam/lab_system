<?php


namespace App\Services\Payments;


use App\Repositories\ClientPaymentRepository;
use App\Repositories\DuesRepository;
use App\Traits\ImageProcessing;

class ClientPaymentService
{
    use ImageProcessing;
    protected $clientPaymentRepository;

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
    /*****************************************************/
    public function save_company_pay_dues($request,$id)
    {

        foreach ($request->num as $index => $num) {
            $data['client_id']     = $id;
            $data['created_by']    = auth()->user()->id;
            $data['paid_date']     = $request->paid_date;
            $data['payment_type']  = $request->payment_type;
            $data['received_by']   = $request->received_by;
            $data['num']           = $num;
            $data['value']         = $request->value[$index];
            $data['client_test_id']= $request->client_test_id[$index];

         //   dd($data);
            $this->clientPaymentRepository->create($data);
        }



    }

}
