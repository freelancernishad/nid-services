<?php

use App\Models\Sonod;
use App\Models\student;
use App\Models\Visitor;
use App\Models\Uniouninfo;
use Illuminate\Support\Str;
use App\Models\school_detail;
use App\Models\Sonodnamelist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



function nidImageSave($url){


    $FileYear = date('Y');
    $FileMonth = date('m');
    $FileDate = date('d');
    $randomString = Str::random(10);
    $extension = pathinfo($url, PATHINFO_EXTENSION);
    if(!$extension){
        $extension = 'jpg';
    }
    $filenameWithEx = time() . '_' . $randomString . '.' . $extension;
    $filename = "public/$FileYear/$FileMonth/$FileDate/$filenameWithEx";

    $returnFilename = "$FileYear/$FileMonth/$FileDate/$filenameWithEx";

    $fileContents = file_get_contents($url);
     Storage::disk('local')->put($filename, $fileContents);
     return $returnFilename;
}

function PdfMaker($pageSize='A4',$html,$Filename,$Watermark=true)
{
    // $schoolDetails = school_detail::where('school_id',$school_id)->first();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8', 'format' => $pageSize, 'default_font' => 'bangla', 'margin_left' => 5,
        'margin_right' => 5,
        'margin_top' => 6,
        'margin_bottom' => 6,
        'setAutoTopMargin' => 'stretch',
    ]);
    $mpdf->SetDisplayMode('fullpage');
    // $mpdf->SetHTMLHeader(SchoolPad($school_id));
    $mpdf->defaultheaderfontsize = 10;
    $mpdf->defaultheaderfontstyle = 'B';
    $mpdf->defaultheaderline = 0;
    $mpdf->showWatermarkImage = $Watermark;
    // $mpdf->WriteHTML('<watermarkimage src="'.base64('National_emblem_of_Bangladesh.png').'" alpha="0.2" size="80,80" />');
    // $mpdf->SetWatermarkImage(base64($schoolDetails->logo),0.15);
    $mpdf->SetWatermarkImage(base64('National_emblem_of_Bangladesh.png'),0.2,array(60,60),array(72,85));
    $mpdf->WriteHTML($html);
    $mpdf->Output($Filename, 'I');
}




function makeshorturl($url)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://uniontax.xyz/make/url?short_url=$url",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',

    ));

    return $response = curl_exec($curl);

    curl_close($curl);
}

function pushNotification($data)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: key=AAAA-EA0BlM:APA91bEjaymOOGtnp1u9K7RymKyswgYqkI390pCj2R63ritYAHWmYbdI5D9O9h7XB6G6ADa3Nk9sZg9SDCWkwreJnrvcjGGOEI6_euAbgHezKblGxD68_CJEZdLOhyfafJ0u4ZKxQD9D'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}





function ekpayToken($trnx_id=123456789,$trns_info=[],$cust_info=[],$path='payment'){

    $Apiurl = env('AKPAY_API_URL');
    $url = env('AKPAY_IPN_URL');
    $whitelistip = env('WHITE_LIST_IP');
   $req_timestamp = date('Y-m-d H:i:s');




   $post = [
      'mer_info' => [
         "mer_reg_id" => env('AKPAY_MER_REG_ID'),
         "mer_pas_key" => env('AKPAY_MER_PASS_KEY')
      ],
      "req_timestamp" => "$req_timestamp GMT+6",
      "feed_uri" => [
         "c_uri" => url("$path/cancel"),
         "f_uri" => url("$path/fail"),
         "s_uri" => url("$path/success")
      ],
      "cust_info" => $cust_info,
      "trns_info" =>$trns_info,
      "ipn_info" => [
         "ipn_channel" => "3",
         "ipn_email" => "freelancernishad123@gmail.com",
         "ipn_uri" => "$url/api/ipn"
      ],
      "mac_addr" => "$whitelistip"
   ];

   // 148.163.122.80
   $post = json_encode($post);
   Log::info($post);

   $ch = curl_init($Apiurl.'/merchant-api');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
   $response = curl_exec($ch);
   curl_close($ch);

/*      echo '<pre>';
   print_r($response); */

   Log::info($response);
     $response = json_decode($response);
   $sToken =  $response->secure_token;


   return "$Apiurl?sToken=$sToken&trnsID=$trnx_id";

//  return    'https://sandbox.ekpay.gov.bd/ekpaypg/v1?sToken=eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJla3BheWNvcmUiLCJhdXRoIjoiUk9MRV9NRVJDSEFOVCIsImV4cCI6MTU0NTMyMjcxMn0.lqjBuvtqyUbhy4pteKa0IaqpjYQoEDjjnJWSFwcv0Ho2JJHN-8xqr8Q7r-tIJUy_dLajS2XbmrR6lBGrlGFYhQ&trnsID=1234'


//   return "https://sandbox.ekpay.gov.bd/ekpaypg/v1?sToken=$sToken&trnsID=$trnx_id";

}



    function BanglaToEnglish($text)
    {
        $data = '';
        if($text=='জাতীয়'){
            $data = 'national';
        }elseif($text=='আন্তর্জাতিক'){
            $data = 'international';
        }elseif($text=='রাজনীতি'){
            $data = 'politics';
        }elseif($text=='সারাদেশ'){
            $data = 'the_whole_country';
        }elseif($text=='ঢাকা বিভাগ'){
            $data = 'Dhaka_division';
        }elseif($text=='খুলনা বিভাগ'){
            $data = 'Khulna_Division';
        }elseif($text=='রংপুর বিভাগ'){
            $data = 'Rangpur_Division';
        }elseif($text=='চট্টগ্রাম বিভাগ'){
            $data = 'Chittagong_Division';
        }elseif($text=='সিলেট বিভাগ'){
            $data = 'Sylhet_Division';
        }elseif($text=='বরিশাল বিভাগ'){
            $data = 'Barisal_Division';
        }elseif($text=='রাজশাহী বিভাগ'){
            $data = 'Rajshahi_Division';
        }elseif($text=='জেলার সংবাদ'){
            $data = 'District_news';
        }elseif($text=='তেঁতুলিয়ার সংবাদ'){
            $data = 'Tamarind_news';
        }elseif($text=='খেলাধূলা'){
            $data = 'sports';
        }elseif($text=='ফিচার'){
            $data = 'feature';
        }elseif($text=='শিক্ষা'){
            $data = 'education';
        }elseif($text=='বিনোদন'){
            $data = 'entertainment';
        }elseif($text=='অন্যান্য'){
            $data = 'other';
        }elseif($text=='চাকুরী'){
            $data = 'the_job';
        }elseif($text=='অর্থনীতি'){
            $data = 'the_economy';
        }else{
            $data = $text;
        }

        return $data;
    }




function subjectCol($subject)
    {
        if($subject=='ইংরেজি'){
            return 'English_1st';
        }else if($subject=='বাংলা'){
            return 'Bangla_1st';
        }else if($subject=='জীব বিজ্ঞান'){
            return 'Biology';
        }else if($subject=='পদার্থবিজ্ঞান'){
            return 'physics';
        }else if($subject=='উচ্চতর গণিত'){
            return 'Higher_Mathematics';
        }else{

            $orginal = array("বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান","পদার্থবিজ্ঞান", "রসায়ন", "জীব বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়","ভূগোল ও পরিবেশ", "অর্থনীতি", "বাংলাদেশ ও বিশ্ব সভ্যতার ইতিহাস", "ধর্ম ও নৈতিক শিক্ষা","ইসলাম-ধর্ম","হিন্দু-ধর্ম", "কৃষি শিক্ষা", "উচ্চতর গণিত", "তথ্য ও যোগাযোগ প্রযুক্তি");

            $colname = array("Bangla_1st","Bangla_2nd","English_1st","English_2nd","Math","Science","physics","Chemistry","Biology","B_and_B","vugol","orthoniti","itihas","Religion","ReligionIslam","ReligionHindu","Agriculture","Higher_Mathematics","ICT","Physical_Education_and_Health","Arts_and_Crafts","Work_and_life_oriented_education","Career_Education");


            // $orginal = array("বাংলা ১ম","বাংলা ২য়","ইংলিশ ১ম","ইংলিশ ২য়","গনিত","বিজ্ঞান","পদার্থ","রসায়ন","ভূগোল","অর্থনীতি","ইতিহাস","বাংলাদেশ ও বিশ্ব পরিচয়","ধর্ম","ইসলাম-ধর্ম","হিন্দু-ধর্ম","কৃষি","তথ্য ও যোগাযোগ প্রযোক্তি");
            // $colname = array("Bangla_1st","Bangla_2nd","English_1st","English_2nd","Math","Science","physics","Chemistry","vugol","orthoniti","itihas","B_and_B","Religion","ReligionIslam","ReligionHindu","Agriculture","ICT");


            return str_replace($orginal, $colname, $subject);
        }
    }




function int_en_to_bn($number)
{

    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    return str_replace($en_digits, $bn_digits, $number);
}
function int_bn_to_en($number)
{

    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    return str_replace($bn_digits, $en_digits, $number);
}

function class_en_to_bn($class)
{

    $bn = array('শিশু শ্রেণি', 'নার্সারি', 'প্রথম শ্রেণি', 'দ্বিতীয় শ্রেণি', 'তৃতীয় শ্রেণী', 'চতুর্থ শ্রেণী', 'পঞ্চম শ্রেণী', 'ষষ্ঠ শ্রেণী', 'সপ্তম শ্রেণী', 'অষ্টম শ্রেণী', 'নবম শ্রেণী', 'দশম শ্রেণী');
    $en = array('Play', 'Nursery', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten');

    return str_replace($en, $bn, $class);
}

function month_en_to_bn($month)
{

    $bn_month = array('জানুয়ারি', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগষ্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
    $en_month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');


    return str_replace($en_month, $bn_month, $month);
}
function exam_en_to_bn($month)
{


    $bn_exam = array("ভর্তির ফলাফল", "অর্ধ বার্ষিক", "বার্ষিক পরীক্ষা","মডেল টেস্ট","প্রি-টেস্ট","টেস্ট");
    $en_exam = array("Admission Result", "Half Yearly", "Annual Examination","Model Test","Pre-Test","Test");


    return str_replace($en_exam, $bn_exam, $month);
}

function month_to_number($month)
{
    $monthName = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $monthNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
    return str_replace($monthName, $monthNumber, $month);
}

function number_to_month($month)
{
    if($month==1){
        return 'January';
    }elseif($month==2){
        return 'February';
    }elseif($month==3){
        return 'March';
    }elseif($month==4){
        return 'April';
    }elseif($month==5){
        return 'May';
    }elseif($month==6){
        return 'June';
    }elseif($month==7){
        return 'July';
    }elseif($month==8){
        return 'August';
    }elseif($month==9){
        return 'September';
    }elseif($month==10){
        return 'October';
    }elseif($month==11){
        return 'November';
    }elseif($month==12){
        return 'December';
    }


}

function day_en_to_bn($day)
{

    $bn_month = array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার ', 'শুক্রবার');
    $en_month = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');


    return str_replace($en_month, $bn_month, $day);
}







function numberTowords($num)
{
    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    ); /*limit t quadrillion */
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}


//translate


// function sessionFlush()
// {
//     Session::forget('source');
//     Session::forget('target');
// }

// function setTarget($target)
// {
//     Session::put('target', $target);
// }

// function setSource($source)
// {
//     Session::put('source', $source);
// }

// function translateText($text)
// {
//     $src = Session::get('source');
//     $target = Session::get('target');
//     if ($target == '' || $target == null) return $text;
//     if ($src == '' || $src == null) {
//         $src = env('BaseLanguage');
//         Session::put('source', env('BaseLanguage'));
//     }
//     if ($src == $target) return $text;
//     else {
//         $translation = TranslateText::translate($src, $target, $text);
//         return $translation;
//     }
// }




function filterarray($arryvalue)
{
    return ($arryvalue->stu_id == 2206033);
}
function attendancemonthCheck($cutentdate, $class, $StudentID)
{



    $months = date("F", strtotime($cutentdate));


    $wh = [
        'month' => $months,
        'student_class' => $class,
        'date' => $cutentdate,
    ];

    $attendancescount = DB::table('attendances')->where($wh)->count();
    if ($attendancescount > 0) {
        $attendances = DB::table('attendances')->where($wh)->get();
        $attendance = json_decode($attendances[0]->attendance);
        $attendance = array_filter($attendance, function ($attendances) use ($StudentID) {
            return ($attendances->stu_id == $StudentID);
        });


        foreach ($attendance as $rr) {

            if ($rr->stu_id == $StudentID) {
                if ($rr->attendence == 'Present') {

                    return  $td =  '<td><i class="fas fa-check text-success"></i>  </td>';
                } else if ($rr->attendence == 'Absent') {
                    $attendace = 'fas fa-times text-danger';
                    // return '<td>'.$rr->stu_id.'-'.$StudentID.'</td>';
                    return  $td =  '<td><i class="fas fa-times text-danger"></i></td>';
                } else {
                    return  $td = '<td>-</td>';
                }
            } else {
                return  $td = '<td>-</td>';
            }
            // return  $td;

            // return filterarray($$rr->stu_id,$StudentID);
            //  if ($rr->stu_id == $StudentID) {
            //     return $StudentID.'true';
            // }else{
            //     return $StudentID.'false';
            // }

            //return $type;


        }
    } else {
        // return 'dont have';
    }
}


function attendancemonth($cutentdate, $class, $StudentID, $tt, $school_id)
{

    // $school_id = sitedetails()->school_id;

    $months = date("F", strtotime($cutentdate));


    $wh = [
        'month' => $months,
        'student_class' => $class,
        'date' => $cutentdate,
        'school_id' => $school_id
    ];


    $attendancescount = DB::table('attendances')->where($wh)->count();
    if ($attendancescount > 0) {
        $attendances = DB::table('attendances')->where($wh)->get();
        $attendance = json_decode($attendances[0]->attendance);

        foreach ($attendance as $rr) {

            if ($rr->stu_id == $StudentID) {
                if ($rr->attendence == 'Present') {
                    if ($tt == 'pdf') {
                        $td =  '<td><img width="20px" src="https://static.vecteezy.com/system/resources/previews/001/200/261/large_2x/check-png.png" /> </td>';
                    } else {

                        $td =  '<td><i class="fas fa-check text-success"></i> </td>';
                    }
                } else if ($rr->attendence == 'Absent') {
                    // $attendace = 'fas fa-times text-danger';
                    // return '<td>'.$rr->stu_id.'-'.$StudentID.'</td>';

                    if ($tt == 'pdf') {
                        $td =  '<td><img width="20px" src="https://www.mycryptons.com/img/delete-icon.png" /> </td>';
                    } else {

                        $td =  '<td><i class="fas fa-times text-danger"></i></td>';
                    }
                } else {
                    $td = '<td>-</td>';
                }
                return  $td;
            }
        }
    } else {
        return '<td>-</td>';
    }
}




function visitor()
{
    $ip =  $_SERVER['REMOTE_ADDR'];

    $visitorWhere = [
        'ip' => $ip,
        'date' => date('d-m-Y'),
    ];

    $Visitor = Visitor::where($visitorWhere)->count();
    if ($Visitor > 0) {
    } else {

        $datainsert = [
            'ip' => $ip,
            'date' => date('d-m-Y'),
            'month' => date('F'),
            'year' => date('Y'),
        ];
        Visitor::create($datainsert);
    }
}





function sent_response($message, $data = [])
{
    $response = [
        'status' => true,
        'message' => $message,
        'data' => $data,
    ];
    return response()->json([$response]);
}

function sent_error($message, $messages = [], $code = 404)
{
    $response = [
        'status' => false,
        'message' => $message,
        'code' => $code
    ];
    !empty($messages) ? $response['errors'] = $messages : null;


    return response()->json(['response' => $response], $code);
}

function feesconvert($text)
{


    if ($text == 'Monthly_fee') {
        $result = 'মাসিক বেতন';
    } elseif ($text == 'মাসিক বেতন') {
        $result = 'Monthly_fee';
    } else
if ($text == 'Session_fee') {
        $result = 'সেশন ফি';
    } elseif ($text == 'সেশন ফি') {
        $result = 'Session_fee';
    } else
if ($text == 'Exam_fee') {
        $result = 'পরিক্ষার ফি';
    } elseif ($text == 'পরিক্ষার ফি') {
        $result = 'Exam_fee';
    } else
if ($text == 'Other') {
        $result = 'অন্যান্য';
    } elseif ($text == 'অন্যান্য') {
        $result = 'Other';
    }
    return $result;
}



function allList($type = '', $class = '', $group = '')
{
    $type = strtolower($type);
    $class = strtolower($class);
   $group = strtolower($group);
    $data = [];
    if ($type == 'year') {


        //year list
        $data = [];
        $cerrentYear = date('Y');
        $first = $cerrentYear + 1 - 1;
        array_push($data, $first);
        for ($i = 0; $i < 25; $i++) {
            $cerrentYear = $cerrentYear - 1;
            array_push($data, $cerrentYear);
            //  echo $cerrentYear;
            //  echo "<br>";
        }
    } else if ($type == 'month') {
        $data = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    } else if ($type == 'days') {
        $data = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday"];
    } else if ($type == 'subjects') {



        if ($class == 'nursery') {
            $data = ["বাংলা", "ইংরেজি", "গণিত"];
        } elseif ($class == 'play' || $class == 'one' || $class == 'two') {
            $data = ["বাংলা", "ইংরেজি", "গণিত"];
        } elseif ($class == 'three' || $class == 'four' || $class == 'five') {
            $data = ["বাংলা", "ইংরেজি", "গণিত", "বাংলাদেশ ও বিশ্ব পরিচয়", "বিজ্ঞান", "ধর্ম"];
        } elseif ($class == 'three' || $class == 'four' || $class == 'five') {
            $data = ["বাংলা", "ইংরেজি", "গণিত", "বাংলাদেশ ও বিশ্ব পরিচয়", "বিজ্ঞান", "ধর্ম"];
        } elseif ($class == 'six' || $class == 'seven' ) {
            $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম ও নৈতিক শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা"];
        } elseif ($class == 'eight') {
            $data = ["বাংলা", "ইংরেজি", "গণিত", "বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম ও নৈতিক শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা"];
        }elseif ($class == 'nine' || $class == 'ten') {
            if ($group == 'science') {
                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "পদার্থবিজ্ঞান", "রসায়ন", "জীব বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম ও নৈতিক শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা", "উচ্চতর গণিত"];
            } elseif ($group == 'humanities') {
                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "ভূগোল ও পরিবেশ", "অর্থনীতি", "বাংলাদেশ ও বিশ্ব সভ্যতার ইতিহাস", "ধর্ম ও নৈতিক শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা"];
            } elseif ($group == 'commerce') {

                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "পদার্থ", "রসায়ন", "জীব-বিজ্ঞান", "ভূগোল", "অর্থনীতি", "ইতিহাস", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা"];
            } else {

                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "পদার্থ", "রসায়ন", "জীব-বিজ্ঞান", "ভূগোল", "অর্থনীতি", "ইতিহাস", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম", "তথ্য ও যোগাযোগ প্রযুক্তি", "কৃষি শিক্ষা"];
            }
        }


    } else if ($type == 'groups') {
        $data = ["Science", "Humanities", "Commerce"];
    } else if ($type == 'exams') {
        $data = ["Admission Result", "Half Yearly", "Annual Examination","Model Test","Pre-Test","Test"];
    } else if ($type == 'religions') {
        $data = ["Islam", "Hindu", "Other"];
    }

    return $data;
}



function resultSub($class = '', $group = '')
{

    $class = strtolower($class);
   $group = strtolower($group);
    $data = [];



        if ($class == 'nursery') {
            $data = ["বাংলা", "ইংরেজি", "গণিত"];
        } elseif ($class == 'play' || $class == 'one' || $class == 'two') {
            $data = ["বাংলা", "ইংরেজি", "গণিত"];
        } elseif ($class == 'three' || $class == 'four' || $class == 'five') {
            $data = ["বাংলা", "ইংরেজি", "গণিত", "বাংলাদেশ ও বিশ্ব পরিচয়", "বিজ্ঞান", "ধর্ম"];
        } elseif ($class == 'six' || $class == 'seven' || $class == 'eight') {
            $data = ["বাংলা", "ইংরেজি", "গণিত", "বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম ও নৈতিক শিক্ষা", "কৃষি শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি"];
        } elseif ($class == 'nine' || $class == 'ten') {
            if ($group == 'science') {
                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "পদার্থবিজ্ঞান", "রসায়ন", "জীব বিজ্ঞান", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম ও নৈতিক শিক্ষা", "কৃষি শিক্ষা", "উচ্চতর গণিত", "তথ্য ও যোগাযোগ প্রযুক্তি","শারীরিক শিক্ষা ও স্বাস্থ্য","চারু ও কারুকলা","ক্যারিয়ার শিক্ষা"];
            } elseif ($group == 'humanities') {
                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "ভূগোল ও পরিবেশ", "অর্থনীতি", "বাংলাদেশ ও বিশ্ব সভ্যতার ইতিহাস", "ধর্ম ও নৈতিক শিক্ষা", "কৃষি শিক্ষা", "তথ্য ও যোগাযোগ প্রযুক্তি","শারীরিক শিক্ষা ও স্বাস্থ্য","চারু ও কারুকলা","ক্যারিয়ার শিক্ষা"];
            } elseif ($group == 'commerce') {

                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "পদার্থ", "রসায়ন", "জীব-বিজ্ঞান", "ভূগোল", "অর্থনীতি", "ইতিহাস", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম", "কৃষি", "তথ্য ও যোগাযোগ প্রযুক্তি"];
            } else {

                $data = ["বাংলা ১ম", "বাংলা ২য়", "ইংরেজি ১ম", "ইংরেজি ২য়", "গণিত", "বিজ্ঞান", "পদার্থ", "রসায়ন", "জীব-বিজ্ঞান", "ভূগোল", "অর্থনীতি", "ইতিহাস", "বাংলাদেশ ও বিশ্ব পরিচয়", "ধর্ম", "কৃষি", "তথ্য ও যোগাযোগ প্রযুক্তি"];
            }
        }



    return $data;
}




function base642($Image)
{
    $url = $Image;
    $image = file_get_contents($url);
    if ($image !== false) {
        return 'data:image/jpg;base64,' . base64_encode($image);
    }
}

function base64($Image)
{
    //  return $Image;

    if (File::exists(env('FILE_PATH') . $Image)) {

        $Image = env('FILE_PATH') . $Image;
    } else {
        $Image = env('FILE_PATH') . 'backend/image.png';
    }

    $ext =  pathinfo($Image, PATHINFO_EXTENSION);;
    return $b64image = "data:image/$ext;base64," . base64_encode(file_get_contents($Image));
}

function fileupload($Image, $path, $width = '', $height = '', $customname = '')
{
    // same file server
    if (!file_exists(env('FILE_PATH') . $path)) {
        File::makeDirectory(env('FILE_PATH') . $path, 0777, true, true);
    }

    $position = strpos($Image, ';');
    $sub = substr($Image, 0, $position);
    $ext = explode('/', $sub)[1];
    $random = rand(10000, 99999);
    if ($customname != '') {
        $name = time() . '____' . $customname . '.' . $ext;
    } else {
        $name = time() . '____' . $random . '.' . $ext;
    }
    $upload_path = $path;
    $image_url = $upload_path . $name;

    if ($width == '' && $height == '') {

        $img = Image::make($Image);
    } else {

        $img = Image::make($Image)->resize($width, $height);
    }



    $img->save(env('FILE_PATH') . $image_url);
    return $image_url;

    // separate file server
    // $url = env('FILE_SERVER');
    // $curl = curl_init($url);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // // $headers = array(
    // //    "Content-Type: application/json",
    // // );
    // // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    // $data = ["files"=> $Image,'customname'=>$customname,'path'=>$path,'width'=>$width,'height'=>$height];
    // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    // $resp = curl_exec($curl);
    // curl_close($curl);
    // return json_decode($resp);











}


function fileupload2($file, $path)
{


    $bases = explode('base64,',explode(';', $file)[1])[1];
    $base64_decode = base64_decode($bases);
    $base64 = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];

    // $path = backend/notice/"backend/notice/";
    if (!file_exists(env('FILE_PATH') . $path)) {
        File::makeDirectory(env('FILE_PATH') . $path, 0777, true, true);
    }
    $destinationPath =env('FILE_PATH').$path. $base64;
    file_put_contents($destinationPath, $base64_decode);
    return $destinationPath;

}


function class_list()
{
    $result = ['Six', 'Seven', 'Eight', 'Nine', 'Ten'];
    return $result;
}













///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



// echo     $apiKey  = API_KEY;

define("SERVER", "https://bulksms.brotherit.net");
define("API_KEY", "2668e548a3250c3e4126e2e2c830d2797084f918");
//  define("API_KEY", "$apiKey");


define("USE_SPECIFIED", 0);
define("USE_ALL_DEVICES", 1);
define("USE_ALL_SIMS", 2);

/**
 * @param string     $number      The mobile number where you want to send message.
 * @param string     $message     The message you want to send.
 * @param int|string $device      The ID of a device you want to use to send this message.
 * @param int        $schedule    Set it to timestamp when you want to send this message.
 * @param bool       $isMMS       Set it to true if you want to send MMS message instead of SMS.
 * @param string     $attachments Comma separated list of image links you want to attach to the message. Only works for MMS messages.
 * @param bool       $prioritize  Set it to true if you want to prioritize this message.
 *
 * @return array     Returns The array containing information about the message.
 * @throws Exception If there is an error while sending a message.
 */
function sendSingleMessage($number, $message, $device = 0, $schedule = null, $isMMS = false, $attachments = null, $prioritize = false)
{
    $url = SERVER . "/services/send.php";
    $postData = array(
        'number' => $number,
        'message' => $message,
        'schedule' => $schedule,
        'key' => API_KEY,
        'devices' => $device,
        'type' => $isMMS ? "mms" : "sms",
        'attachments' => $attachments,
        'prioritize' => $prioritize ? 1 : 0
    );
    return sendRequest($url, $postData)["messages"][0];
}

/**
 * @param array  $messages        The array containing numbers and messages.
 * @param int    $option          Set this to USE_SPECIFIED if you want to use devices and SIMs specified in devices argument.
 *                                Set this to USE_ALL_DEVICES if you want to use all available devices and their default SIM to send messages.
 *                                Set this to USE_ALL_SIMS if you want to use all available devices and all their SIMs to send messages.
 * @param array  $devices         The array of ID of devices you want to use to send these messages.
 * @param int    $schedule        Set it to timestamp when you want to send these messages.
 * @param bool   $useRandomDevice Set it to true if you want to send messages using only one random device from selected devices.
 *
 * @return array     Returns The array containing messages.
 *                   For example :-
 *                   [
 *                      0 => [
 *                              "ID" => "1",
 *                              "number" => "+11234567890",
 *                              "message" => "This is a test message.",
 *                              "deviceID" => "1",
 *                              "simSlot" => "0",
 *                              "userID" => "1",
 *                              "status" => "Pending",
 *                              "type" => "sms",
 *                              "attachments" => null,
 *                              "sentDate" => "2018-10-20T00:00:00+02:00",
 *                              "deliveredDate" => null
 *                              "groupID" => ")V5LxqyBMEbQrl9*J$5bb4c03e8a07b7.62193871"
 *                           ]
 *                   ]
 * @throws Exception If there is an error while sending messages.
 */
function sendMessages($messages, $option = USE_SPECIFIED, $devices = [], $schedule = null, $useRandomDevice = true)
{
    $url = SERVER . "/services/send.php";
    $postData = [
        'messages' => json_encode($messages),
        'schedule' => $schedule,
        'key' => API_KEY,
        'devices' => json_encode($devices),
        'option' => $option,
        'useRandomDevice' => $useRandomDevice
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param int    $listID      The ID of the contacts list where you want to send this message.
 * @param string $message     The message you want to send.
 * @param int    $option      Set this to USE_SPECIFIED if you want to use devices and SIMs specified in devices argument.
 *                            Set this to USE_ALL_DEVICES if you want to use all available devices and their default SIM to send messages.
 *                            Set this to USE_ALL_SIMS if you want to use all available devices and all their SIMs to send messages.
 * @param array  $devices     The array of ID of devices you want to use to send the message.
 * @param int    $schedule    Set it to timestamp when you want to send this message.
 * @param bool   $isMMS       Set it to true if you want to send MMS message instead of SMS.
 * @param string $attachments Comma separated list of image links you want to attach to the message. Only works for MMS messages.
 *
 * @return array     Returns The array containing messages.
 * @throws Exception If there is an error while sending messages.
 */
function sendMessageToContactsList($listID, $message, $option = USE_SPECIFIED, $devices = [], $schedule = null, $isMMS = false, $attachments = null)
{
    $url = SERVER . "/services/send.php";
    $postData = [
        'listID' => $listID,
        'message' => $message,
        'schedule' => $schedule,
        'key' => API_KEY,
        'devices' => json_encode($devices),
        'option' => $option,
        'type' => $isMMS ? "mms" : "sms",
        'attachments' => $attachments
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param int $id The ID of a message you want to retrieve.
 *
 * @return array     The array containing a message.
 * @throws Exception If there is an error while getting a message.
 */
function getMessageByID($id)
{
    $url = SERVER . "/services/read-messages.php";
    $postData = [
        'key' => API_KEY,
        'id' => $id
    ];
    return sendRequest($url, $postData)["messages"][0];
}

/**
 * @param string $groupID The group ID of messages you want to retrieve.
 *
 * @return array     The array containing messages.
 * @throws Exception If there is an error while getting messages.
 */
function getMessagesByGroupID($groupID)
{
    $url = SERVER . "/services/read-messages.php";
    $postData = [
        'key' => API_KEY,
        'groupId' => $groupID
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param string $status         The status of messages you want to retrieve.
 * @param int    $deviceID       The deviceID of the device which messages you want to retrieve.
 * @param int    $simSlot        Sim slot of the device which messages you want to retrieve. Similar to array index. 1st slot is 0 and 2nd is 1.
 * @param int    $startTimestamp Search for messages sent or received after this time.
 * @param int    $endTimestamp   Search for messages sent or received before this time.
 *
 * @return array     The array containing messages.
 * @throws Exception If there is an error while getting messages.
 */
function getMessagesByStatus($status, $deviceID = null, $simSlot = null, $startTimestamp = null, $endTimestamp = null)
{
    $url = SERVER . "/services/read-messages.php";
    $postData = [
        'key' => API_KEY,
        'status' => $status,
        'deviceID' => $deviceID,
        'simSlot' => $simSlot,
        'startTimestamp' => $startTimestamp,
        'endTimestamp' => $endTimestamp
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param int $id The ID of a message you want to resend.
 *
 * @return array     The array containing a message.
 * @throws Exception If there is an error while resending a message.
 */
function resendMessageByID($id)
{
    $url = SERVER . "/services/resend.php";
    $postData = [
        'key' => API_KEY,
        'id' => $id
    ];
    return sendRequest($url, $postData)["messages"][0];
}

/**
 * @param string $groupID The group ID of messages you want to resend.
 * @param string $status  The status of messages you want to resend.
 *
 * @return array     The array containing messages.
 * @throws Exception If there is an error while resending messages.
 */
function resendMessagesByGroupID($groupID, $status = null)
{
    $url = SERVER . "/services/resend.php";
    $postData = [
        'key' => API_KEY,
        'groupId' => $groupID,
        'status' => $status
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param string $status         The status of messages you want to resend.
 * @param int    $deviceID       The deviceID of the device which messages you want to resend.
 * @param int    $simSlot        Sim slot of the device which messages you want to resend. Similar to array index. 1st slot is 0 and 2nd is 1.
 * @param int    $startTimestamp Resend messages sent or received after this time.
 * @param int    $endTimestamp   Resend messages sent or received before this time.
 *
 * @return array     The array containing messages.
 * @throws Exception If there is an error while resending messages.
 */
function resendMessagesByStatus($status, $deviceID = null, $simSlot = null, $startTimestamp = null, $endTimestamp = null)
{
    $url = SERVER . "/services/resend.php";
    $postData = [
        'key' => API_KEY,
        'status' => $status,
        'deviceID' => $deviceID,
        'simSlot' => $simSlot,
        'startTimestamp' => $startTimestamp,
        'endTimestamp' => $endTimestamp
    ];
    return sendRequest($url, $postData)["messages"];
}

/**
 * @param int    $listID      The ID of the contacts list where you want to add this contact.
 * @param string $number      The mobile number of the contact.
 * @param string $name        The name of the contact.
 * @param bool   $resubscribe Set it to true if you want to resubscribe this contact if it already exists.
 *
 * @return array     The array containing a newly added contact.
 * @throws Exception If there is an error while adding a new contact.
 */
function addContact($listID, $number, $name = null, $resubscribe = false)
{
    $url = SERVER . "/services/manage-contacts.php";
    $postData = [
        'key' => API_KEY,
        'listID' => $listID,
        'number' => $number,
        'name' => $name,
        'resubscribe' => $resubscribe
    ];
    return sendRequest($url, $postData)["contact"];
}

/**
 * @param int    $listID The ID of the contacts list from which you want to unsubscribe this contact.
 * @param string $number The mobile number of the contact.
 *
 * @return array     The array containing the unsubscribed contact.
 * @throws Exception If there is an error while setting subscription to false.
 */
function unsubscribeContact($listID, $number)
{
    $url = SERVER . "/services/manage-contacts.php";
    $postData = [
        'key' => API_KEY,
        'listID' => $listID,
        'number' => $number,
        'unsubscribe' => true
    ];
    return sendRequest($url, $postData)["contact"];
}

/**
 * @return string    The amount of message credits left.
 * @throws Exception If there is an error while getting message credits.
 */
function getBalance()
{
    $url = SERVER . "/services/send.php";
    $postData = [
        'key' => API_KEY
    ];
    $credits = sendRequest($url, $postData)["credits"];
    return is_null($credits) ? "Unlimited" : $credits;
}

/**
 * @param string $request   USSD request you want to execute. e.g. *150#
 * @param int $device       The ID of a device you want to use to send this message.
 * @param int|null $simSlot Sim you want to use for this USSD request. Similar to array index. 1st slot is 0 and 2nd is 1.
 *
 * @return array     The array containing details about USSD request that was sent.
 * @throws Exception If there is an error while sending a USSD request.
 */
function sendUssdRequest($request, $device, $simSlot = null)
{
    $url = SERVER . "/services/send-ussd-request.php";
    $postData = [
        'key' => API_KEY,
        'request' => $request,
        'device' => $device,
        'sim' => $simSlot
    ];
    return sendRequest($url, $postData)["request"];
}

/**
 * @param int $id The ID of a USSD request you want to retrieve.
 *
 * @return array     The array containing details about USSD request you requested.
 * @throws Exception If there is an error while getting a USSD request.
 */
function getUssdRequestByID($id)
{
    $url = SERVER . "/services/read-ussd-requests.php";
    $postData = [
        'key' => API_KEY,
        'id' => $id
    ];
    return sendRequest($url, $postData)["requests"][0];
}

/**
 * @param string   $request        The request text you want to look for.
 * @param int      $deviceID       The deviceID of the device which USSD requests you want to retrieve.
 * @param int      $simSlot        Sim slot of the device which USSD requests you want to retrieve. Similar to array index. 1st slot is 0 and 2nd is 1.
 * @param int|null $startTimestamp Search for USSD requests sent after this time.
 * @param int|null $endTimestamp   Search for USSD requests sent before this time.
 *
 * @return array     The array containing USSD requests.
 * @throws Exception If there is an error while getting USSD requests.
 */
function getUssdRequests($request, $deviceID = null, $simSlot = null, $startTimestamp = null, $endTimestamp = null)
{
    $url = SERVER . "/services/read-ussd-requests.php";
    $postData = [
        'key' => API_KEY,
        'request' => $request,
        'deviceID' => $deviceID,
        'simSlot' => $simSlot,
        'startTimestamp' => $startTimestamp,
        'endTimestamp' => $endTimestamp
    ];
    return sendRequest($url, $postData)["requests"];
}

function sendRequest($url, $postData)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    if ($httpCode == 200) {
        $json = json_decode($response, true);
        if ($json == false) {
            if (empty($response)) {
                throw new Exception("Missing data in request. Please provide all the required information to send messages.");
            } else {
                throw new Exception($response);
            }
        } else {
            if ($json["success"]) {
                return $json["data"];
            } else {
                throw new Exception($json["error"]["message"]);
            }
        }
    } else {
        throw new Exception("HTTP Error Code : {$httpCode}");
    }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*

try {
    // Send a message using the primary device.
    $msg = sendSingleMessage("+8801909756552", "This is a test of single message.");

    // Send a message using the Device ID 1.
    $msg = sendSingleMessage("+8801909756552", "This is a test of single message.", 94);

     // Send a prioritize message using Device ID 1 for purpose of sending OTP, message reply etc…
    $msg = sendSingleMessage("+8801909756552", "This is a test of single message.", 94, null, false, null, true);

    // Send a MMS message with image using the Device ID 1.
    $attachments = "https://example.com/images/footer-logo.png,https://example.com/downloads/sms-gateway/images/section/create-chat-bot.png";
    $msg = sendSingleMessage("+8801909756552", "This is a test of single message.", 94, null, true, $attachments);

    // Send a message using the SIM in slot 1 of Device ID 1 (Represented as "1|0").
    // SIM slot is an index so the index of the first SIM is 0 and the index of the second SIM is 1.
    // In this example, 1 represents Device ID and 0 represents SIM slot index.
    $msg = sendSingleMessage("+8801909756552", "This is a test of single message.", "94|1");

    // Send scheduled message using the primary device.
    $msg = sendSingleMessage("+8801909756552", "This is a test of schedule feature.", null, strtotime("+2 minutes"));
    print_r($msg);

    echo "Successfully sent a message.";
} catch (Exception $e) {
    echo $e->getMessage();
}
 */


//  $messages = array();

// for ($i = 1; $i <= 3; $i++) {
//     array_push($messages,
//         [
//             "number" => "+8801909756552",
//             "message" => "This is a test #{$i} of PHP version. Testing bulk message functionality."
//         ]);
// }

// try {
//     // Send messages using the primary device.
//     $msgs = sendMessages($messages);

// Send messages using default SIM of all available devices. Messages will be split between all devices.
//sendMessages($messages, USE_ALL_DEVICES);

// Send messages using all SIMs of all available devices. Messages will be split between all SIMs.
//sendMessages($messages, USE_ALL_SIMS);

// Send messages using only specified devices. Messages will be split between devices or SIMs you specified.
// If you send 12 messages using this code then 4 messages will be sent by Device ID 1, other 4 by SIM in slot 1 of
// Device ID 2 (Represendted as "2|0") and remaining 4 by SIM in slot 2 of Device ID 2 (Represendted as "2|1").
// sendMessages($messages, USE_SPECIFIED, [1, "2|0", "2|1"]);

// Send messages on schedule using the primary device.
// sendMessages($messages, null, null, strtotime("+2 minutes"));

// Send a message to contacts in contacts list with ID of 1.
//sendMessageToContactsList(1, "Test", USE_SPECIFIED, 1);

// Send a message on schedule to contacts in contacts list with ID of 1.
// sendMessageToContactsList(1, "Test", null, null, strtotime("+2 minutes"));

// Array of image links to attach to MMS message;
/*     $attachments = [
        "https://example.com/images/footer-logo.png",
        "https://example.com/downloads/sms-gateway/images/section/create-chat-bot.png"
    ];
    $attachments = implode(',', $attachments);

    $mmsMessages = [];
    for ($i = 1; $i <= 12; $i++) {
        array_push($mmsMessages,
            [
                "number" => "+11234567890",
                "message" => "This is a test #{$i} of PHP version. Testing bulk MMS message functionality.",
                "type" => "mms",
                "attachments" => $attachments
            ]);
    } */
// Send MMS messages using all SIMs of all available devices. Messages will be split between all SIMs.
// $msgs = sendMessages($mmsMessages, USE_ALL_SIMS);

//     print_r($msgs);

//     echo "Successfully sent bulk messages.";
// } catch (Exception $e) {
//     echo $e->getMessage();
// }


function smsSend($deccription = '', $applicant_mobile = '01909756552')
{

    $messages = array();
    array_push(
        $messages,
        [
            "number" => '88' . int_bn_to_en($applicant_mobile),
            "message" => "$deccription"
        ]
    );
    ///sms functions
    try {
        $msgs = sendMessages($messages,1);
    } catch (Exception $e) {
        array_push($responsemessege, $e->getMessage());
    }


}


function characterCount($string)
{
    // replace array below with proper Bengali stopwords
    $stopWords = array('i', 'a', 'about', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'com', 'de', 'en', 'for', 'from', 'how', 'in', 'is', 'it', 'la', 'of', 'on', 'or', 'that', 'the', 'this', 'to', 'was', 'what', 'when', 'where', 'who', 'will', 'with', 'und', 'the', 'www');

    $string = preg_replace('/\s\s+/i', '', $string); // replace whitespace
    $string = trim($string); // trim the string
    // remove this preg_replace because Bengali sybmols doesn't match this pattern
    // $string = preg_replace('/[^a-zA-Z0-9 -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…
    $string = strtolower($string); // make it lowercase

    preg_match_all('/\s.*?\s/i', $string, $matchWords);
    $matchWords = $matchWords[0];

    foreach ($matchWords as $key => $item) {
        if ($item == '' || in_array(strtolower(trim($item)), $stopWords) || strlen($item) <= 3) {
            unset($matchWords[$key]);
        }
    }
    $wordCountArr = array();
    if (is_array($matchWords)) {
        foreach ($matchWords as $key => $val) {
            $val = trim(strtolower($val));
            if (isset($wordCountArr[$val])) {
                $wordCountArr[$val]++;
            } else {
                $wordCountArr[$val] = 1;
            }
        }
    }
    arsort($wordCountArr);
    $wordCountArr = array_slice($wordCountArr, 0, 10);
    return $wordCountArr;
}

// $string = <<<EOF
// টিপ বোঝে না, টোপ বোঝে না টিপ বোঝে না, কেমন বাপু লোক
// EOF;
// var_dump(extractCommonWords($string), $string);




 function Greeting($mark,$total,$type)
{
    $greed = 'F';
    $point = '0.00';


    $Persent_33 = (32*$total)/100;
    $Persent_40 = (40*$total)/100;
    $Persent_50 = (50*$total)/100;
    $Persent_60 = (60*$total)/100;
    $Persent_70 = (70*$total)/100;
    $Persent_80 = (80*$total)/100;
    $Persent_101 = (101*$total)/100;



        if($mark<$Persent_33){
            $greed ='F';
            $point ='0.00';
        }elseif($mark<$Persent_40){
            $greed ='D';
            $point ='1.00';
        }
        elseif($mark<$Persent_50){
            $greed ='C';
            $point ='2.00';
        }
        elseif($mark<$Persent_60){
            $greed ='B';
            $point ='3.00';
        }
        elseif($mark<$Persent_70){
            $greed ='A-';
            $point ='3.50';
        }
        elseif($mark<$Persent_80){
            $greed ='A';
            $point ='4.00';
        }
        elseif($mark<$Persent_101){
            $greed ='A+';
            $point ='5.00';
        }





    if($type=='greed'){
        return $greed;
    }elseif($type=='point'){
        return $point;
    }



}
 function word_digit($word)
{
    $warr = explode(';', $word);
    $result = '';
    foreach ($warr as $value) {
        switch (trim($value)) {
            case 'Play':
                $result .= '0';
                break;
            case 'Nursery':
                $result .= '11';
                break;
            case 'One':
                $result .= '1';
                break;
            case 'Two':
                $result .= '2';
                break;
            case 'Three':
                $result .= '3';
                break;
            case 'Four':
                $result .= '4';
                break;
            case 'Five':
                $result .= '5';
                break;
            case 'Six':
                $result .= '6';
                break;
            case 'Seven':
                $result .= '7';
                break;
            case 'Eight':
                $result .= '8';
                break;
            case 'Nine':
                $result .= '9';
                break;
            case 'Ten':
                $result .= '10';
                break;
        }
    }
    return $result;
}





