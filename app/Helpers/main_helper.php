<?php



use App\Traits\ImageProcessing;
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

        return  $formattedTime;
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
function get_session_attendance($member_id,$additional_sub_id)
{
    if ($member_id && $additional_sub_id){
        $session_num=\App\Models\MembersAttendance::where('member_id',$member_id)->where('additional_subscription_id',$additional_sub_id)->count();
        return $session_num;
    }
    else{
        return 0;
    }

}

/**************************************************************/
function get_app_config_data($key){
    $data=\App\Models\AppConfig::where('key',$key)->first();
    return $data->value;
}
/***************************************************************/
function AddButton($route)
{
     $button='
            <div class="d-flex">
                <a href="'.$route.'" class="btn btn-icon btn-sm btn-primary flex-shrink-0 ms-4">
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
function PageTitle($title, $breadcrumbs)
{
    $breadcrumbItems = '';
    foreach ($breadcrumbs as $breadcrumb) {
        if (isset($breadcrumb['link']) && $breadcrumb['link'] !== '') {
            $breadcrumbItems .= '<li class="breadcrumb-item text-muted"><a href="'.$breadcrumb['link'].'" class="text-muted text-hover-primary">'.$breadcrumb['label'].'</a></li>';
        } else {
            $breadcrumbItems .= '<li class="breadcrumb-item text-muted">'.$breadcrumb['label'].'</li>';
        }
        $breadcrumbItems .= '<li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>';
    }
    $breadcrumbItems = rtrim($breadcrumbItems, '<li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>');

    $pageTitle = '
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">'.$title.'</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            '.$breadcrumbItems.'
        </ul>
    </div>';

    echo $pageTitle;
}

/**********************************************************/
function generateTable(array $headers)
{

    $table = '<div class="card-body">
                    <div class="">
                        <table id="table" class="table table-bordered">
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

