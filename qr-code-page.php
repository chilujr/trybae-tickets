<?php 
session_start();
include_once "includes_ui/header2.php"; 
if(isset($_SESSION['tx_id']))
{
    //$file = $_SESSION['tx_id'].'.png';
	$file = 'img/qrcode_img/'.$_SESSION['tx_id'].'.png';
    $email = $_SESSION['email'];
    $name = $_SESSION['name'];
    $event_name = $_SESSION['event_name'];
    $subject = "Your ".$event_name." QR Code";
    $message= nl2br("Hi ".$name.",\n\n Thank you for purchasing a ticket with Try Bae, Below is the QR-Code to  ".$event_name.". \n The same QR-Code will be used to gain access to the venue.\n\n Thank you! \n Try Bae Team");

    $mail = new mail();
    $mail->send_qrcode($name, $email, $subject, $message, $file);
}
if(isset($_POST['download']))
{
    $filepath = 'img/qrcode_img/'.$_SESSION['tx_id'].'.png';
    $fn = $_SESSION['tx_id'].'.png';
    if(!empty($name) && file_exists($filepath))
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$fn);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        exit;
    
	}
}
?>
        <div class="container">
            <div class="row">
                <div class="col-md-5 offset-md-4 form login-form">
                    <div class="tgs_logo" style="height:150px; width: 150px;" >
                        <img src="admin/assets/img/icons/logo.png" alt="">
                    </div>
                    <h3 class="text-center">Your QR-Code</h3>
                    <br>
                    <div class="tgs_logo" style="height: 220px ; width: 220px;">
                        <img src="img/qrcode_img/<?=$_SESSION['tx_id']?>.png" alt="">
                    </div>
                    <hr style="height: 4px; color:black;">
                    <h6 class="text-center">This qr-code will be used to gain entrance to the event you've purchased this ticket for</h6><br>
                    <div class="link login-link text-center"><form method="POST"><button name="download" class="btn btn-primary">Download</button></form></div><br>
                    <div class="link login-link text-center">Back to <a href="index.php">Home page</a></div>            
                </div>
            </div>
        </div>
        
    </body>
</html>