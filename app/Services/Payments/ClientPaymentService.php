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
       // dd($request);
        foreach ($request->num as $index => $num) {
            if (!isset($request->value[$index]) || !isset($request->client_test_id[$index])) {
                continue; // تخطي التكرار ده لو ناقص بيانات
            }

            $data = [
                'client_id'       => $id,
                'created_by'      => auth()->user()->id,
                'paid_date'       => $request->paid_date,
                'payment_type'    => $request->payment_type,
                'received_by'     => $request->received_by,
                'num'             => $num,
                'value'           => $request->value[$index],
                'client_test_id'  => $request->client_test_id[$index],
            ];

            $this->clientPaymentRepository->create($data);
        }


    }

}
