<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use Illuminate\Http\Request;

class PopUpController extends Controller
{
    protected $AreasSettingRepository;
    protected $ClientsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());

    }
    /**************************************************/
    // public function show_setting(Request $request)
    // {
    //     $data['type'] = $request->type;
    //     $data['input_id'] = $request->input_id;
    //     $data['all_data'] = GeneralSetting::where('ttype', $data['type'])->orderBy('id', 'desc')->get();

    //     return view('dashbord.admin.settings.show_popup_setting', $data);
    // }
    public function show_setting(Request $request) {
        // $type = $request->type;
        // $input_id = $request->input_id;

        // if ($type === 'clients') {
        //     return view('dashbord.pop_up_forms.client_form', compact('input_id'));
        // } elseif ($type === 'companies') {
        //     return view('dashbord.pop_up_forms.company_form', compact('input_id'));
        // } elseif ($type === 'projects') {
        //     return view('dashbord.pop_up_forms.project_form', compact('input_id'));
        // }

        // return response()->json(['error' => 'Invalid type'], 400);
        $all_data['type'] = $request->type;
        $all_data['input_id'] = $request->input_id;
        $all_data['clients'] = Clients::all();
        $all_data['companies'] = ClientsCompanies::all();
        $all_data['projects'] = ClientsProjects::all();
        $all_data['governates'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));

        if ($all_data['type'] === 'clients') {
            return view('dashbord.pop_up_forms.client_form', $all_data);
        } elseif ($all_data['type'] === 'companies') {
            return view('dashbord.pop_up_forms.company_form', compact('all_data', 'type', 'input_id'));
        } elseif ($all_data['type'] === 'projects') {
            return view('dashbord.pop_up_forms.project_form', compact('all_data', 'type', 'input_id'));
        }

        return response()->json(['error' => 'Invalid type'], 400);
    }
    /*************************************************/
    // public function add_popup_setting(Request $request)
    // {
    //     $data['title'] = $request->title;
    //     $data['ttype'] = $request->type;
    //     $settings = GeneralSetting::create($data);
    //     return response()->json($settings);
    // }
    public function add_popup_setting(Request $request) {
        $type = $request->type;

        if ($type === 'clients') {
            $client = Clients::create([
                'name' => $request->client_name,
                'email' => $request->client_email,
                'phone' => $request->client_phone,
            ]);
            return response()->json(['id' => $client->id, 'name' => $client->name]);
        } elseif ($type === 'companies') {
            // Handle company creation
        } elseif ($type === 'projects') {
            // Handle project creation
        }

        return response()->json(['error' => 'Invalid type'], 400);
    }

    /***************************************************/
    public function get_popup_settings(Request  $request)
    {
        $type = $request->input('type');
        $settings = GeneralSetting::where('type', $type)->get();
        return response()->json($settings);
    }

    /*************************************************/
    public function update_popup_setting(Request $request)
    {
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $data['id'] = $request->id;

        $setting = GeneralSetting::find($data['id']);
        $setting->update($data);

        $settings = GeneralSetting::where('ttype', $data['type'])->get();

        return response()->json(['settings' => $settings, 'message' => 'Setting updated successfully!']);
    }

    /************************************************/
    public function delete_popup_setting(Request $request)
    {
        $data['id'] = $request->id;
        $data['type'] = $request->type;
        GeneralSetting::where('id', $data['id'])->delete();
        $settings = GeneralSetting::where('ttype', $data['type'])->get();
        return response()->json(['settings' => $settings, 'message' => 'Setting deleted successfully!']);
    }
}
