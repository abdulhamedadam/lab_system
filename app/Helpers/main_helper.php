<?php


use App\Interfaces\BasicRepositoryInterface;
use App\Traits\ImageProcessing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


if (!function_exists('getDefultImage')) {

    function getDefultImage()
    {
        return asset('assets/media/avatars/blank.png');
    }
}
if (!function_exists('getMainData')) {

    function getMainData()
    {
        $mdata = \App\Models\Site\SiteData::first();
        return ($mdata);
    }
}
if (!function_exists('extractVideoId')) {

    function extractVideoId($videoLink)
    {
        // Extract video ID from the YouTube link
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $videoLink, $matches);

        // Check if the regex matched and return the video ID or null
        return isset($matches[1]) ? $matches[1] : null;
    }
}

if (!function_exists('formatDateForDisplay')) {


    function formatDateForDisplay($dateTimeStr)
    {
        $dateTime = new DateTime($dateTimeStr);

        $formattedDate = $dateTime->format('d M Y');
        $formattedTime = $dateTime->format('g:ia');
        $formattedTime = strtolower($formattedTime);

        return $formattedDate . ' at ' . $formattedTime;
    }
}
if (!function_exists('formatTimeForDisplay')) {


    function formatTimeForDisplay($dateTimeStr)
    {
        $dateTime = new DateTime($dateTimeStr);

        $formattedTime = $dateTime->format('g:i a');
        $formattedTime = strtolower($formattedTime);

        return $formattedTime;
    }
}
if (!function_exists('formatDateDayDisplay')) {


    function formatDateDayDisplay($dateTimeStr)
    {
        $dateTime = new DateTime($dateTimeStr);

        $formattedDate = $dateTime->format('Y-m-d');

        return $formattedDate;
    }
}


if (!function_exists('getFirstLetters')) {
    function getFirstLetters($inputString)
    {
        $words = explode(' ', $inputString);
        $firstLetters = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $firstLetters .= strtoupper($word[0]);  // Get the first letter and convert to uppercase
            }
        }

        return $firstLetters;
    }


}

if (!function_exists('generateUniqueRandomCode')) {

    function generateUniqueRandomCode($table, $column)
    {
        do {
            $code = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $exists = DB::table($table)->where($column, $code)->exists();
        } while ($exists);

        return $code;
    }
}


/*************************************************************/
function get_session_attendance($member_id, $additional_sub_id)
{
    if ($member_id && $additional_sub_id) {
        $session_num = \App\Models\MembersAttendance::where('member_id', $member_id)->where('additional_subscription_id', $additional_sub_id)->count();
        return $session_num;
    } else {
        return 0;
    }

}

/**************************************************************/
function get_app_config_data($key)
{
    $data = \App\Models\AppConfig::where('key', $key)->first();
    return $data->value ?? ' ';
}

/***************************************************************/
function AddButton($route)
{
    $button = '
            <div class="d-flex">
                <a href="' . $route . '" class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"/>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"/>
                        </svg>
                    </span>

                </a>
            </div>';

    echo $button;
}

/****************************************************************/
function BackButton($route)
{
    $button = '
            <div class="d-flex">
                <a href="' . $route . '" class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4">
                    <span class="svg-icon svg-icon-2">
                                   <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                       <path
                                           d="M17.6 4L9.6 12L17.6 20H13.6L6.3 12.7C5.9 12.3 5.9 11.7 6.3 11.3L13.6 4H17.6Z"
                                           fill="currentColor"/>
                                   </svg>
                    </span>

                </a>
            </div>';

    echo $button;
}

/****************************************************************/
function PageTitle($title, $breadcrumbs)
{
    $breadcrumbItems = '';
    foreach ($breadcrumbs as $breadcrumb) {
        if (isset($breadcrumb['link']) && $breadcrumb['link'] !== '') {
            $breadcrumbItems .= '<li class="breadcrumb-item text-muted"><a href="' . $breadcrumb['link'] . '" class="text-muted text-hover-primary">' . $breadcrumb['label'] . '</a></li>';
        } else {
            $breadcrumbItems .= '<li class="breadcrumb-item text-muted">' . $breadcrumb['label'] . '</li>';
        }
        $breadcrumbItems .= '<li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>';
    }
    $breadcrumbItems = rtrim($breadcrumbItems, '<li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>');

    $pageTitle = '
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">' . $title . '</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            ' . $breadcrumbItems . '
        </ul>
    </div>';

    echo $pageTitle;
}

/**********************************************************/
function generateTable(array $headers)
{

    $table = '<div class="card-body">
                    <div class="">
                        <table id="table1" class="table table-bordered">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">';

    foreach ($headers as $header) {
        $table .= '<th style="text-align: center;">' . htmlspecialchars(trans($header)) . '</th>';
    }

    $table .= '</tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>';

    echo $table;

}


/*----------------------------------------------*/
if (!function_exists('createRepository')) {
    function createRepository(BasicRepositoryInterface $basicRepository, $model)
    {
        $repository = clone $basicRepository;
        $repository->set_model($model);
        return $repository;
    }
}

if (!function_exists('count_branches')) {
    function count_branches()
    {
        $query = DB::table('tbl_branches');
        $count = $query->count();

        return $count;
    }
}

if (!function_exists('count_sarf_band')) {
    function count_sarf_band()
    {
        $query = DB::table('tbl_sarf_bands');
        $count = $query->count();

        return $count;
    }
}

if (!function_exists('count_areas')) {
    function count_areas($parent_id = null)
    {
        $query = DB::table('tbl_area_settings');

        if (is_null($parent_id)) {
            $nullCount = $query->whereNull('parent_id')->count();

            return $nullCount;
        }

        $notNullCount = $query->whereNotNull('parent_id')->count();

        return $notNullCount;
    }
}

if (!function_exists('test')) {
    function test($data)
    {
        $startTime = microtime(true);
        echo '<pre>';
        print_r($data);
        die();
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;

        echo "Execution Time: $executionTime seconds";
    }

    if (!function_exists('formatFileSize')) {
        function formatFileSize($destination)
        {
            $bytes = filesize($destination);
            if ($bytes >= 1073741824) {
                return number_format($bytes / 1073741824, 2) . ' GB';
            } elseif ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                return number_format($bytes / 1024, 2) . ' KB';
            } elseif ($bytes > 1) {
                return $bytes . ' bytes';
            } elseif ($bytes == 1) {
                return $bytes . ' byte';
            } else {
                return '0 bytes';
            }
        }
    }
}

/************************************************/
/**********************************************/
if (!function_exists('generateCardHeader')) {
    function generateCardHeader($card_title, $route, $add_button_title)
    {
        if ($add_button_title != ' ') {
            $button = '<a class="btn btn-primary" href="' . route($route) . '">
                                <i class="bi bi-plus fs-1"></i>' . htmlspecialchars(trans($add_button_title)) . '
                            </a>';
        } else {
            $button = '';
        }
        $header = '
         <div class="card-header">
                    <h3 class="card-title">' . htmlspecialchars(trans($card_title)) . '</h3>
                    <div class="card-toolbar">
                        <div class="text-center">
                          ' . $button . '
                        </div>
                    </div>
                </div>
        ';

        echo $header;
    }
}
/***********************************************/
if (!function_exists('form_icon')) {
    function form_icon($type)
    {
        $icons = [
            'text' => '<i class="bi bi-pencil-square fs-4"></i>',
            'date' => '<i class="bi bi-calendar-event fs-4"></i>',
            'select' => '<i class="bi bi-list-ul fs-4"></i>',
            'number' => '<i class="bi bi-hash fs-4"></i>',
            'email' => '<i class="bi bi-envelope fs-4"></i>',
            'password' => '<i class="bi bi-key fs-4"></i>',
            'image' => '<i class="bi bi-image fs-4"></i>',
            'phone' => '<i class="bi bi-telephone fs-4"></i>',
            'file' => '<i class="bi bi-file-earmark fs-4"></i>',
            'checkbox' => '<i class="bi bi-check2-square fs-4"></i>',
            'address' => '<i class="bi bi-geo-alt fs-4"></i>',
            'status' => '<i class="bi bi-toggle-on fs-4"></i>',
            'role' => '<i class="bi bi-person-badge fs-4"></i>',
        ];

        // Return the icon if it exists, otherwise return a default icon
        return $icons[$type] ?? '<i class="bi bi-question-circle fs-4"></i>';
    }
}

/***************************************************/
function get_print_image()
{
    $data = \App\Models\Site\SiteData::find(1);
    // dd($data ? $data->image_print : 'null');
    return $data ? $data->image_print : 'null';
}

/***************************************************/
function get_clients()
{
    $data = \App\Models\Clients::all();
    return $data ?? [];
}
/***************************************************/
function toTLV($tag, $value)
{
    $length = strlen($value);
    return chr($tag) . chr($length) . $value;
}

/***************************************************/


if (!function_exists('saveClientButtonWithModal')) {
    function saveClientButtonWithModal()
    {
        return '

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="fas fa-plus"></i>
            </button>


            <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addClientModalLabel">' . trans('clients.add_new') . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="client_name" class="form-label">' . trans('clients.name') . '</label>
                                <input type="text" class="form-control" id="client_name" name="client_name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . trans('common.close') . '</button>
                            <button type="button" onclick="saveClient()" class="btn btn-primary">' . trans('common.save') . '</button>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                function saveClient() {
                    var clientName = $("#client_name").val();
                    if (clientName) {
                        $.ajax({
                            url: "' . route('admin.save_client_popup') . '",
                            type: "POST",
                            data: {
                                name: clientName,
                                _token: $("meta[name=\'csrf-token\']").attr("content")
                            },
                            dataType: "json",
                            success: function (data) {
                                if (data.success) {
                                    $("#client_id").append(new Option(data.client.name, data.client.id, true, true));
                                    if ($.fn.select2) {
                                        $("#client_id").trigger("change");
                                    }
                                    $("#addClientModal").modal("hide");
                                    $("#client_name").val("");
                                }
                            }
                        });
                    }
                }
            </script>
        ';
    }
}


if (!function_exists('saveCompanyButtonWithModal')) {
    function saveCompanyButtonWithModal()
    {
        $clients = get_clients(); // استدعاء الكلاينتس هنا مرة واحدة

        $clientOptions = '';
        foreach ($clients as $client) {
            $clientOptions .= '<option value="' . $client->id . '">' . $client->name . '</option>';
        }

        return '
        <!-- زر فتح المودال -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
            <i class="fas fa-plus"></i>
        </button>

        <!-- المودال -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCompanyModalLabel">' . trans('companies.add_new') . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      <div class="mb-3">
                            <label for="client_id" class="form-label">' . trans('companies.client') . '</label>
                            <select class="form-select" id="client_id" name="client_id">

                                ' . $clientOptions . '
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">' . trans('companies.name') . '</label>
                            <input type="text" class="form-control" id="company_name" name="company_name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">' . trans('common.close') . '</button>
                        <button type="button" onclick="saveCompany()" class="btn btn-primary">' . trans('common.save') . '</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- سكريبت الحفظ -->
        <script>
            var saveCompanyUrl = "' . route('admin.save_company_popup') . '";

            function saveCompany() {
                var companyName = $("#company_name").val();
                var clientId = $("#client_id").val();
                if (companyName && clientId) {
                    $.ajax({
                        url: saveCompanyUrl,
                        type: "POST",
                        data: {
                            name: companyName,
                            client_id: clientId,
                            _token: $("meta[name=\'csrf-token\']").attr("content")
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.success) {
                                $("#company_id").append(new Option(data.company.name, data.company.id, true, true));
                                if ($.fn.select2) {
                                    $("#company_id").trigger("change");
                                }
                                $("#addCompanyModal").modal("hide");
                                $("#company_name").val("");
                                $("#client_id").val("");
                            }
                        }
                    });
                }
            }
        </script>
    ';
    }

}

/*****************************************************/
function get_prefix($type)
{
    $type_arr = ['soil' => 'soil_prefix', 'concrete' => 'concrete_prefix', 'roads' => 'road_prefix', 'mechanic' => 'mechanic_prefix'];
    return get_app_config_data($type_arr);
}
/*****************************************************/
function get_last_sader()
{
    $lastRecord = \App\Models\TestSader::orderBy('id','desc')->first();

    if ($lastRecord) {
        return $lastRecord;
    }
    return null;
}



