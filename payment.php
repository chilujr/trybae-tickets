<?php 
session_start();
if(isset($_POST['pay']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $amount = intval($_POST['amount']);
    $_SESSION['amount'] = $amount;

    //* Prepare our rave request
    $request = [
        'tx_ref' => time(),
        'amount' => $amount,
        'currency' => 'ZMW',
        'payment_options' => 'mobile_money_zambia',
        'redirect_url' => 'http://localhost/trybae-main/process.php',
        'customer' => [
            'email' => $email,
            'name' =>  $name
        ],
        'meta' => [
            'price' => $amount
        ],
        'customizations' => [
            'title' => 'Paying for a TryBae Event Ticket',
            'description' => 'Sample'
        ]
    ];

    //* Call flutterwave endpoint
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($request),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer FLWSECK_TEST-f34980a6e76d6c89e47f1402bcc7f899-X',
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $res = json_decode($response);
    if($res->status == 'success')
    {
        $link = $res->data->link;
        header('Location: '.$link);
    }
    else
    {
        echo 'Error: '.$res->message;
        echo 'We can not process your payment';
    }
}

?>