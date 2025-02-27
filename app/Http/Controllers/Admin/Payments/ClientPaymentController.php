<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Http\Controllers\Controller;
use App\Services\Payments\ClientPaymentService;
use App\Services\Payments\DuesService;
use Illuminate\Http\Request;

class ClientPaymentController extends Controller
{
    protected $root_view='dashbord.payments.client_payment';
    public function __construct(ClientPaymentService $clientPaymentService)
    {
        $this->clientPaymentService  = $clientPaymentService;
    }
    /*******************************************************/
    public function create($due_id)
    {

        return view($this->root_view.'from');
    }
}
