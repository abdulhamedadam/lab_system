<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\external_test\SaveRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Services\ExternalTestsService;
use Illuminate\Http\Request;

class ExternalTestsController extends Controller
{
    protected $duesService;

    protected $root_view = 'dashbord.external_test.';

    public function __construct(ExternalTestsService $externalTestsService)
    {
        $this->externalTestsService = $externalTestsService;
    }

    /************************************************/
    public function index()
    {

    }

    /*************************************************/
    public function create()
    {
        $data['clients'] = Clients::where('is_active', 1)->get();
        $data['companies'] = ClientsCompanies::all();
        $data['projects'] = ClientsProjects::all();
        return view($this->root_view . 'create', $data);
    }
    /*************************************************/
    public function store(SaveRequest $request)
    {
        try {

            $this->externalTestsService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.payment.dues.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
