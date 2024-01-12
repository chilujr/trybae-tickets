<?php
class model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //function that registers users 
    

    public function registerUser($username, $first_name, $surname, $email, $pass)
    {   $role = "User";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `user_tbl` (`username`, `first_name`, `surname`, `email_address`, 
        `usr_password`, `usr_role) VALUES (:username, :fname, :surname, :email, :usr_pass, :usr_role)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':fname', $first_name);
        $query->bindParam(':surname', $surname);
        $query->bindParam(':email', $email);
        $query->bindParam(':usr_pass', $pass);
        $query->bindParam(':usr_role', $role);
        if($query->execute())
        {
            echo"<script>window.location.href = 'login.php'</script>";
        }
    }



    //Update user details
    
    public function updateUser($id, $username, $email, $pass, $image)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `users` SET `username`=:username, `email`=:email, `password`=:pass, `images`=:images WHERE `id`=:id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':pass', $pass);
        $query->bindParam(':images', $image);
        if($query->execute())
        {
            echo"<script>Alert('User Updated Successfully')</script>";
            echo"<script>window.location.href = 'my-profile.php'</script>";
        }   
    }



        //Function that gets all events


    public function getAllEvents($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.city_id, events.user_id, cities.city,
        events.start_time, events.end_time, users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        WHERE events.user_id = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query;
    }

    public function getAllTransactions($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT transactions.id, transactions.amount, transactions.name, transactions.tx_time,
        events.event_name, events.user_id, cities.city, events.start_time, events.end_time, 
        users.username, transactions.email
        FROM  transactions INNER JOIN events ON events.id = transactions.event_id
        INNER JOIN users ON users.id = events.user_id INNER JOIN cities ON cities.id = events.city_id
        WHERE events.user_id = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query;
    }

    //Function that logs in users


    public function login($email, $pass)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['id'] = $result['id'];
           $_SESSION['email'] = $result['email'];
           $_SESSION['name'] = $result['username'];
           $_SESSION['role'] = $result['role'];
           $_SESSION['user_pass'] = $result['password'];
           $role = $result['role'];
           if($role == "Admin")
           {
                echo"<script>alert('Login Successful');</script>";
                header("Location: ../try_bae/index.php");
           }
           elseif($role == "eventOrg")
           {
                echo"<script>alert('Login Successful');</script>";
                header("Location: ../event_org/index.php");
           }
          
        } 
        else 
        {
            echo "<script>alert('Invalid Username / Password Error');</script>";
        }
    }


    // Function That Gets All The Equipment


    public function getEquipment()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `equipment_tbl`";
        return $dbConn->query($sql);
    }


    // Function That Searches for Equipment


    public function searchProduct($search)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `equipment_tbl` LIKE %'$search'%";
        return $dbConn->query($sql);
    }


    // Function that adds  Equipment


    public function addEquipment($e_name, $e_type, $pic, $e_price, $e_plan)
    {
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `equipment_tbl`(`equipment_name`, 
        `equipment_type`, `pic_location`, `e_price`, `p_plan`) VALUES (
        :e_name, :e_type, :p_location, :e_price, :e_plan)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_name', $e_name);
        $query->bindParam(':e_type', $e_type);
        $query->bindParam(':p_location', $pic);
        $query->bindParam(':e_price', $e_price);
        $query->bindParam(':e_plan', $e_plan);
        if($query->execute())
        {
            echo"<script>alert('Equipment Added Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }

    }

    

    // Function That Deletes Equipment


    public function deleteEquipment($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="DELETE FROM `equipment_tbl` WHERE equipment_id=:e_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_id', $e_id);
        if($query->execute())
        {
            echo"<script>alert('Equipment Deleted Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }
    }


    // Function That Adds To Cart


    public function addCart($e_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `cart_tbl`(`equipment_id`, `user_id`) 
        VALUES(:e_id, :u_id)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_id', $e_id);
        $query->bindParam(':u_id', $e_id);
        if($query->execute())
        {
            echo"<script>alert('Equipment Added Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }
    }


    // Function That Deletes From Cart


    public function removeCart($p_id)
    {
            $dbConn = $this->db->getConnection();
            $sql ="DELETE FROM `cart_tbl` WHERE `P_id`=:p_id";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':p_id', $p_id);
            if($query->execute())
            {
                echo"<script>alert('Equipment Removed Successfully')</script>";
                echo"<script>window.location.href = 'products.php'</script>";
            }
    }





    // Function that gets all orders

    public function getOrders()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT cart_tbl.P_id, equipment_tbl.equipment_name, equipment_tbl.e_price, 
        user_tbl.first_name, user_tbl.surname
        FROM cart_tbl
        INNER JOIN user_tbl ON user_tbl.user_id = cart_tbl.user_id
        INNER JOIN equipment_tbl ON equipment_tbl.equipment_id = cart_tbl.equipment_id";
        return $dbConn->query($sql);
    }



        // Function that gets all cities


        public function getCities()
        {
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM cities";
            return $dbConn->query($sql);
        }

        
    // Function that gets all Categories


    public function getCategories()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM categories";
        return $dbConn->query($sql);
    }
    
    
        // Function that gets all Age Groups
    
        public function getAgeGroups()
        {
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM Age";
            return $dbConn->query($sql);
        }
    
    
    // Function that creates new Events

    public function createEvent($event_name, $limits, $published, $address, 
    $start_time, $end_time, $vip, $ordinary, $img, $add_info, $category_id, $age_id, $city_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `events`(`event_name`, `attendance_limit`, `published`, `address`,
        `start_time`, `end_time`, `vip`, `ordinary`, `images`, `add_info`, `category_id`, `age_id`, `city_id`,
        `user_id`) VALUES(:event_name, :limits, :published, :addres, :start_time, :end_time, :vip, :ordinary, 
        :img_location, :add_info, :category_id, :age_id, :city_id, :user_id)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':event_name', $event_name);
        $query->bindParam(':limits', $limits);
        $query->bindParam(':published', $published);
        $query->bindParam(':addres', $address);
        $query->bindParam(':start_time', $start_time);
        $query->bindParam(':end_time', $end_time);
        $query->bindParam(':vip', $vip);
        $query->bindParam(':ordinary', $ordinary);
        $query->bindParam(':img_location', $img);
        $query->bindParam(':add_info', $add_info);
        $query->bindParam(':category_id', $category_id);
        $query->bindParam(':age_id', $age_id);
        $query->bindParam(':city_id', $city_id);
        $query->bindParam(':user_id', $user_id);
        if($query->execute())
        {
            echo"<script>alert('Event Added Successfully')</script>";
            header("Location: ../event_org/view-events.php");
        }else{
            echo"<script>alert('Event Not Added')</script>";
            echo"<script>window.location.href = 'add-events.php'</script>";
        }
    
    }


    //Verify Transaction ID

    public function verifyTransaction($transaction_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT transactions.id, transactions.amount, transactions.attendance, transactions.name, transactions.tx_time,
        events.event_name, events.user_id, events.start_time, events.end_time, transactions.email
        FROM  transactions 
        INNER JOIN events ON events.id = transactions.event_id
        WHERE transactions.id = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $transaction_id);
        $query->execute();
       if($query->rowCount() > 0)
       {
           $verify = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['txt'] = $verify['id'];
           $_SESSION['amount'] = $verify['amount'];
           $_SESSION['customer'] = $verify['name'];
           $_SESSION['attendance'] = $verify['attendance'];
           $_SESSION['event'] = $verify['event_name'];
       }
    }

    //Confirm Transaction 

    public function confirmTransaction($transaction_id)
    {
        $time = date('Y-m-d H:i');
        $dbConn = $this->db->getConnection();
        $sql ="UPDATE `transactions` SET `attendance`='1', `checkIn_time`=:c_time WHERE `id`=:transaction_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':transaction_id', $transaction_id);
        $query->bindParam(':c_time', $time);
        $query->execute();
        echo "<script>alert('Ticket Confirmed')</script>";
        unset($_SESSION['txt']);
        unset($_SESSION['amount']);
        unset($_SESSION['customer']);
        unset($_SESSION['attendance']);
        unset($_SESSION['event']);
        echo "<script>window.location.href = 'qr-code-scan.php'</script>";
    }

    public function UpdateEvent($event_name, $limits, $published, $address, 
    $start_time, $end_time, $vip, $ordinary, $img, $add_info,  $age_id, $city_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `events`(`event_name`, `attendance_limit`, `published`, `address`,
        `start_time`, `end_time`, `vip`, `ordinary`, `images`, `add_info`, `age_id`, `city_id`,
        `user_id`) VALUES(:event_name, :limits, :published, :addres, :start_time, :end_time, :vip, :ordinary, 
        :img_location, :add_info, :age_id, :city_id, :user_id)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':event_name', $event_name);
        $query->bindParam(':limits', $limits);
        $query->bindParam(':published', $published);
        $query->bindParam(':addres', $address);
        $query->bindParam(':start_time', $start_time);
        $query->bindParam(':end_time', $end_time);
        $query->bindParam(':vip', $vip);
        $query->bindParam(':ordinary', $ordinary);
        $query->bindParam(':img_location', $img);
        $query->bindParam(':add_info', $add_info);
        $query->bindParam(':age_id', $age_id);
        $query->bindParam(':city_id', $city_id);
        $query->bindParam(':user_id', $user_id);
        if($query->execute())
        {
            echo"<script>alert('Event Added Successfully')</script>";
            header("Location: ../event_org/view-events.php");
        }else{
            echo"<script>alert('Event Not Added')</script>";
            echo"<script>window.location.href = 'add-events.php'</script>";
        }
    }

        //function that returns a single user record from the DB


        function getUser($id)
        {
            $dbConn = $this->db->getConnection();
            $sql = "SELECT * FROM `users` WHERE `id`='$id'";
            $query = $dbConn->prepare($sql);
            return $dbConn->query($sql);
        }


}