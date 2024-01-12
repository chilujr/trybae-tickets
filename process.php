<?php
session_start();
require_once "includes_ui/database.php";
require_once "includes_ui/payment_model.php";
require_once "phpqrcode/qrlib.php";
$model = new model();
if(isset($_GET['status']))
    {
        //* check payment status
        if($_GET['status'] == 'cancelled')
        {
            echo"<script>alert('Transaction Cancelled')</script>";
            header('Location: index.php');
        }
        elseif($_GET['status'] == 'successful')
        {
            $txid = $_GET['transaction_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-eee25be1b44ef9a132a872075b3a0910-X"
                ),
              ));
              
              $response = curl_exec($curl);
              
              curl_close($curl);
              
              $res = json_decode($response);
              if($res->status)
              {
                $path = 'img/qrcode_img/';
                $file = $path .$txid.".png";
                  echo 'Payment successful';
                  //* Continue to give item to the user
                  $email = $_SESSION['email'];
                  $name = $_SESSION['name'];
                  $event_id = $_SESSION['event_id'];
                  $amount = $_SESSION['amount'];
                  $event_name = $_SESSION['event_name'];
                  $tx_time = date('Y-m-d H:i:s');
                  $_SESSION['tx_id'] = $txid;
                  $text = $txid;
                  QRcode::png($text, $file,'M' ,5 ,2);
                  $model->addTransaction($txid, $event_id, $amount, $email, $name, $tx_time);
                  $model-> updateAttendanceLimit($event_id);
              }
              else
              {
                echo"<script>alert('Transaction Failed')</script>";
                header('Location: index.php');
              }
        }
    
    }