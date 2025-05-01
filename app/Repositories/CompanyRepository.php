<?php


namespace App\Repositories;


use App\Interfaces\CompanyInterface;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;
use App\Models\Companies;

class CompanyRepository implements CompanyInterface
{


    public function get_company_data($id)
    {
        return Companies::with(['client_company' => function($query) {
            $query->select('id', 'client_id', 'company_id');
        }])->find($id);

    }

    public function get_Payments_received($from_date = null, $to_date = null, $company_id = null)
    {
        $query = ClientTestPayment::with(['client_test', 'client_test.client']);

        if ($company_id) {
            $query->whereHas('client_test', function($q) use ($company_id) {
                $q->where('client_id', $company_id);
            });
        }

        if ($from_date && $to_date) {
            $query->whereBetween('paid_date', [$from_date, $to_date]);
        }

        return $query->orderBy('paid_date', 'desc')->get();
    }

    public function get_unpaid_dues($from_date = null, $to_date = null, $company_id = null)
    {
        $query = ClientTests::where(function($query) {
                $query->whereDoesntHave('client_test_payment')
                    ->orWhereHas('client_test_payment', function($q) {
                        $q->selectRaw('client_test_id, SUM(value) as total_paid')
                            ->groupBy('client_test_id')
                            ->havingRaw('SUM(value) < test_value');
                    });
            })
            ->with(['test', 'client_test_payment', 'client']);

        if ($company_id) {
            $query->where('client_id', $company_id);
        }

        if ($from_date && $to_date) {
            $query->whereBetween('created_at', [$from_date, $to_date]);
        }

        return $query->get();
    }

}
