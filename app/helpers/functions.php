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
    $mpdf->SetWatermarkImage(base64('National_emblem_of_Bangladesh.png'),0.2,array(60,60),array(72,90));
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

function month_number_en_to_bn_text($number)
{
    $en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
    $bn = array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');

    // Adjust the number to be within 1-12 range
    $number = max(1, min(12, $number));

    return str_replace($en, $bn, $number);
}

function month_name_en_to_bn_text($name)
{
    $en = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $bn = array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
    return str_replace($en, $bn, $name);
}

