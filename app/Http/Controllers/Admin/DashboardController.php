<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Test;
use App\Models\ClientsCompanies;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $data['dues'] = ClientTestPayment::whereMonth('paid_date', Carbon::now()->month)
            ->whereYear('paid_date', Carbon::now()->year)
            ->sum('value');

        $data['last_month_dues'] = ClientTestPayment::whereMonth('paid_date', Carbon::now()->subMonth()->month)
            ->whereYear('paid_date', Carbon::now()->subMonth()->year)
            ->sum('value');

        $totalSoilDues = ClientTests::where('test_table', 'tbl_tests')
            ->whereHas('client_test_payment', function ($query) {
                $query->whereMonth('paid_date', Carbon::now()->month);
            })
            ->withSum(['client_test_payment' => function ($query) {
                $query->whereMonth('paid_date', Carbon::now()->month);
            }], 'value')
            ->get();


         $data['soil_dues']= $totalSoilDues->sum('client_test_payment_sum_value');;

        $data['soil_test_count'] = Test::count();
        $data['soil_done_count'] = Test::where('status','test_done')->count();


        $data['companies_count'] = ClientsCompanies::count();
        $data['todayes_companies'] = ClientsCompanies::whereDate('created_at', Carbon::today())->get();











        $data['concrete_dues']=0;
        return view('dashbord.home',$data);
    }

    /***********************************************************/
    public function projects_dashboard()
    {
        return view('dashbord.projects_dashboard');
    }
}
