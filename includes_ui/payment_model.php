<?php

class model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //function that Adds Transactions to the database 


    public function addTransaction($txid, $event_id, $amountPaid, $email, $name, $tx_time)
    {
        $attend = '0';
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `transactions`(`id`, `event_id`, `amount`, `email`, `name`, `tx_time`, `attendance`) 
        VALUES(:id, :event_id, :amount, :email, :u_name, :tx_time, :attend)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $txid);
        $query->bindParam(':event_id', $event_id);
        $query->bindParam(':amount', $amountPaid);
        $query->bindParam(':email', $email);
        $query->bindParam(':u_name', $name);
        $query->bindParam(':tx_time', $tx_time);
        $query->bindParam(':attend', $attend);
        if($query->execute())
        {
            echo"<script>alert('Transaction Successful')</script>";
            header("Location: qr-code-page.php");
        }
    }


    // Function that updates Attendance Limit


    public function updateAttendanceLimit($id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `events` SET `attendance_limit` = `attendance_limit` - 1 
        WHERE `events`.`id` = '$id'";
        $query = $dbConn->query($sql);
    }


    // Function that updates the attendance limit

    
    public function ticketChecker($event_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT attendance_limit FROM `events` WHERE `id` = '$event_id'";
        $query = $dbConn->prepare($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['id'] = $result['id'];
           $limit = $result['attendance_limit'];
           if($limit == "0")
           { 
                $_SESSION['tickets'] = "Sold Out";
           }
           else
           {
                $_SESSION['tickets'] = "Tickets Available";
           }
          
        } 
            
    }



}