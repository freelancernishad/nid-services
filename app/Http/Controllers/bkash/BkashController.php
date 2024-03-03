<?php

namespace App\Http\Controllers\bkash;


use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BkashController extends Controller
{
    private $base_url;
    private $app_key;
    private $app_secret;
    private $username;
    private $password;

    public function __construct()
    {
        // bKash Merchant API Information

        // You can import it from your Database
        $bkash_app_key = '4f6o0cjiki2rfm34kfdadl1eqq'; // bKash Merchant API APP KEY
        $bkash_app_secret = '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b'; // bKash Merchant API APP SECRET
        $bkash_username = 'sandboxTokenizedUser02'; // bKash Merchant API USERNAME
        $bkash_password = 'sandboxTokenizedUser02@12345'; // bKash Merchant API PASSWORD
        $bkash_base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta/tokenized'; // For Live Production URL: https://checkout.pay.bka.sh/v1.2.0-beta

        $this->app_key = $bkash_app_key;
        $this->app_secret = $bkash_app_secret;
        $this->username = $bkash_username;
        $this->password = $bkash_password;
        $this->base_url = $bkash_base_url;
    }

    public function getToken()
    {
        session()->forget('bkash_token');

        $post_token = array(
            'app_key' => $this->app_key,
            'app_secret' => $this->app_secret
        );

        $url = curl_init("$this->base_url/checkout/token/grant");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            "password:$this->password",
            "username:$this->username"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);

        $response = json_decode($resultdata, true);

        if (array_key_exists('msg', $response)) {
            return $response;
        }

        Session::put('bkash_token', $response['id_token']);
        // session()->put('bkash_token', $response['id_token']);


        return response()->json(['success', true, $response]);
    }

    public function createPayment(Request $request)
    {

        // if (((string) $request->amount != (string) session()->get('bkash')['invoice_amount'])) {
        //     return response()->json([
        //         'errorMessage' => 'Amount Mismatch',
        //         'errorCode' => 2006
        //     ],422);
        // }

        // $token = session()->get('bkash_token');
        $token = 'eyJraWQiOiJvTVJzNU9ZY0wrUnRXQ2o3ZEJtdlc5VDBEcytrckw5M1NzY0VqUzlERXVzPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJlODNlMDkwMC1jY2ZmLTQzYTctODhiNy0wNjE5NDJkMTVmOTYiLCJhdWQiOiI2cDdhcWVzZmljZTAxazltNWdxZTJhMGlhaCIsImV2ZW50X2lkIjoiZTdhMGI5N2EtMWIzOC00ZWIxLWI0OTUtZDQ2OGYzMTAzMWEzIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE3MDk0MzY5MDIsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5hcC1zb3V0aGVhc3QtMS5hbWF6b25hd3MuY29tXC9hcC1zb3V0aGVhc3QtMV9yYTNuUFkzSlMiLCJjb2duaXRvOnVzZXJuYW1lIjoic2FuZGJveFRva2VuaXplZFVzZXIwMiIsImV4cCI6MTcwOTQ0MDUwMiwiaWF0IjoxNzA5NDM2OTAyfQ.zfytXZY-Knn2wMYZmgXZ9dmMTZCTztdNwOMT-kJxX_ys72vi2lqjDgfv_KE7sSVy_iEk6Et0kwMhq0o7Hheqs_lPVnqKcFY5pJo1kjyeBLoKMp01cLz0FfN8WJrkZgG8w_TdAqiqM2-TYE-1oZWNZtp4IZlessys9JZRflORSFXQSCtbDRSDG-7pzp_V7_jgoSYn7_FpDhgT6W8AZM1E9CysNJypnIqHnZJO7h0DaR5ObA_OaKGg8gAWbhml4cYP8dTexi1e66ryTNRTWVkBtD2_HLS542q8tzfBfbXfJwb75xnSAAGU5Ob1mJTHxO-z2RiswKxzGGCn_eIqzFFhrg';

        $request['intent'] = 'sale';
        $request['currency'] = 'BDT';
        $request['merchantInvoiceNumber'] = rand();

        $url = curl_init("$this->base_url/checkout/payment/create");
        $request_data_json = json_encode($request->all());
        $header = array(
            'Content-Type:application/json',
            "authorization: $token",
            "x-app-key: $this->app_key"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function executePayment(Request $request)
    {
        // $token = session()->get('bkash_token');
        $token = 'eyJraWQiOiJvTVJzNU9ZY0wrUnRXQ2o3ZEJtdlc5VDBEcytrckw5M1NzY0VqUzlERXVzPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJlODNlMDkwMC1jY2ZmLTQzYTctODhiNy0wNjE5NDJkMTVmOTYiLCJhdWQiOiI2cDdhcWVzZmljZTAxazltNWdxZTJhMGlhaCIsImV2ZW50X2lkIjoiZTdhMGI5N2EtMWIzOC00ZWIxLWI0OTUtZDQ2OGYzMTAzMWEzIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE3MDk0MzY5MDIsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5hcC1zb3V0aGVhc3QtMS5hbWF6b25hd3MuY29tXC9hcC1zb3V0aGVhc3QtMV9yYTNuUFkzSlMiLCJjb2duaXRvOnVzZXJuYW1lIjoic2FuZGJveFRva2VuaXplZFVzZXIwMiIsImV4cCI6MTcwOTQ0MDUwMiwiaWF0IjoxNzA5NDM2OTAyfQ.zfytXZY-Knn2wMYZmgXZ9dmMTZCTztdNwOMT-kJxX_ys72vi2lqjDgfv_KE7sSVy_iEk6Et0kwMhq0o7Hheqs_lPVnqKcFY5pJo1kjyeBLoKMp01cLz0FfN8WJrkZgG8w_TdAqiqM2-TYE-1oZWNZtp4IZlessys9JZRflORSFXQSCtbDRSDG-7pzp_V7_jgoSYn7_FpDhgT6W8AZM1E9CysNJypnIqHnZJO7h0DaR5ObA_OaKGg8gAWbhml4cYP8dTexi1e66ryTNRTWVkBtD2_HLS542q8tzfBfbXfJwb75xnSAAGU5Ob1mJTHxO-z2RiswKxzGGCn_eIqzFFhrg';

        $paymentID = $request->paymentID;
        $url = curl_init("$this->base_url/checkout/payment/execute/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function queryPayment(Request $request)
    {
        // $token = session()->get('bkash_token');
        $token = 'eyJraWQiOiJvTVJzNU9ZY0wrUnRXQ2o3ZEJtdlc5VDBEcytrckw5M1NzY0VqUzlERXVzPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJlODNlMDkwMC1jY2ZmLTQzYTctODhiNy0wNjE5NDJkMTVmOTYiLCJhdWQiOiI2cDdhcWVzZmljZTAxazltNWdxZTJhMGlhaCIsImV2ZW50X2lkIjoiZTdhMGI5N2EtMWIzOC00ZWIxLWI0OTUtZDQ2OGYzMTAzMWEzIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE3MDk0MzY5MDIsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5hcC1zb3V0aGVhc3QtMS5hbWF6b25hd3MuY29tXC9hcC1zb3V0aGVhc3QtMV9yYTNuUFkzSlMiLCJjb2duaXRvOnVzZXJuYW1lIjoic2FuZGJveFRva2VuaXplZFVzZXIwMiIsImV4cCI6MTcwOTQ0MDUwMiwiaWF0IjoxNzA5NDM2OTAyfQ.zfytXZY-Knn2wMYZmgXZ9dmMTZCTztdNwOMT-kJxX_ys72vi2lqjDgfv_KE7sSVy_iEk6Et0kwMhq0o7Hheqs_lPVnqKcFY5pJo1kjyeBLoKMp01cLz0FfN8WJrkZgG8w_TdAqiqM2-TYE-1oZWNZtp4IZlessys9JZRflORSFXQSCtbDRSDG-7pzp_V7_jgoSYn7_FpDhgT6W8AZM1E9CysNJypnIqHnZJO7h0DaR5ObA_OaKGg8gAWbhml4cYP8dTexi1e66ryTNRTWVkBtD2_HLS542q8tzfBfbXfJwb75xnSAAGU5Ob1mJTHxO-z2RiswKxzGGCn_eIqzFFhrg';
        // $paymentID = $request->payment_info['payment_id'];
        $paymentID = 445588;

        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function bkashSuccess(Request $request)
    {
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE
        if ('Noman' == 'success') {

            // THEN YOU CAN REDIRECT TO YOUR ROUTE

            Session::flash('successMsg', 'Payment has been Completed Successfully');

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }
}
