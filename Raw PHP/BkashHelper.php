<?php

session_start();

class BkashHelper
{
    // bKash Merchant API Information

    public $base_url = 'https://checkout.sandbox.bka.sh/v1.2.0-beta'; // For Live Production URL: https://checkout.pay.bka.sh/v1.2.0-beta
    public $app_key = '5tunt4masn6pv2hnvte1sb5n3j'; // bKash Merchant API APP KEY
    public $app_secret = '1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka'; // bKash Merchant API APP SECRET
    public $username = 'sandboxTestUser'; // bKash Merchant API USERNAME
    public $password = 'hWD@8vtzw0'; // bKash Merchant API PASSWORD


    public function getToken()
    {
        $_SESSION['id_token'] = null;

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
        $result_data = curl_exec($url);
        curl_close($url);

        $response = json_decode($result_data, true);

        if (array_key_exists('msg', $response)) {
            return json_encode($response);
        }

        $_SESSION['id_token'] = $response['id_token'];

        return json_encode($response);
    }

    public function createPayment()
    {
        if (((string)$_POST['amount'] != (string)$_SESSION['final_amount'])) {
            return json_encode([
                'errorMessage' => 'Amount Mismatch',
                'errorCode' => 2006
            ]);
        }

        $token = $_SESSION['id_token'];

        $_POST['intent'] = 'sale';
        $_POST['currency'] = 'BDT';
        $_POST['merchantInvoiceNumber'] = rand();

        $url = curl_init("$this->base_url/checkout/payment/create");
        $request_data_json = json_encode($_POST);
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
        $result_data = curl_exec($url);
        curl_close($url);

        return $result_data;
    }

    public function executePayment()
    {
        $token = $_SESSION['id_token'];

        $paymentID = $_POST['paymentID'];

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
        $result_data = curl_exec($url);
        curl_close($url);

        return $result_data;
    }

    public function queryPayment()
    {
        $token = $_SESSION['id_token'];
        $paymentID = $_GET['paymentID'];

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
        $result_data = curl_exec($url);
        curl_close($url);

        return $result_data;
    }

    public function searchTransaction($trxID)
    {
        $url = curl_init("$this->base_url/checkout/payment/search/" . $trxID);

        $header = array(
            'Content-Type:application/json',
            'authorization:' . $_SESSION['id_token'],
            "x-app-key: $this->app_key"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $result_data = curl_exec($url);
        curl_close($url);

        return $result_data;
    }
}
