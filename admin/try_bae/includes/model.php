<?php
class model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //function that registers users 
    

    public function registerUser($username, $role,  $email, $encpass, $status)
    {  
        $code = 0;
        $created_at = date("Y-m-d H:i:s");
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `users`(`username`, `role`, `email`, `password`, `code`, `activation_status`, `created_at`)
         VALUES (:username, :role, :email, :pass, :code, :status, :created_time)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':role', $role);
        $query->bindParam(':email', $email);
        $query->bindParam(':pass', $encpass);
        $query->bindParam(':code', $code);
        $query->bindParam(':status', $status);
        $query->bindParam(':created_time', $created_at);
        if($query->execute())
        {
            echo"<script>Alert('Account Created Successfully')</script>";
            echo"<script>window.location.href = 'view-users.php'</script>";
        }
    }

     //Function that valiates an email

     public function validateEmail($email)
     {
         $dbConn = $this->db->getConnection();
         $sql ="SELECT * FROM users WHERE email = '$email'";
         $query = $dbConn->query($sql);
         if ($query->rowCount() > 0) 
         {
             $_SESSION['email-error'] = "Email that you have entered is already exist!";
         }else{
            unset($_SESSION['email-error']);
         }
     }


    public function updateUser($id, $username, $email, $encpass, $image)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `users` SET `username`=:username, `email`=:email, `password`=:pass, `images`=:images WHERE `id`=:id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':pass', $encpass);
        $query->bindParam(':images', $image);
        if($query->execute())
        {
            echo"<script>Alert('User Updated Successfully')</script>";
            echo"<script>window.location.href = 'my-profile.php'</script>";
        }   
    }

    public function getEventORG()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM `users` WHERE `role` = 'eventOrg'";
        $query = $dbConn->prepare($sql);
        $query->execute();
        return $query;
    }

    public function getAdmin()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM `users` WHERE `role` = 'admin'";
        $query = $dbConn->prepare($sql);
        $query->execute();
        return $query;
    }


    // Function that updates account status

    public function accountStatus($id, $status)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `users` SET `activation_status`= :status WHERE `id` = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->bindParam(':status', $status);
        if($query->execute())
        {
            echo"<script>Alert('Account Status Updated Successfully')</script>";
            echo"<script>window.location.href = 'view-users.php'</script>";
        }
    }


    // Function that updates the attendance limit


    public function ticketCounter($event_id)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `events` SET `attendance_limit`= attendance_limit - 1 WHERE `id` = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $event_id);
        $record = $query->execute();
        return $record;
          
    }

    //Function that gets all events


    public function getAllEvents()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.city_id, events.user_id, cities.city,
        events.start_time, events.end_time, users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id ORDER BY events.id DESC";
        return $dbConn->query($sql);
        
    }



    // Function that gets a single Event


    public function getEvent($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.age_id, age.age, events.city_id, events.images, events.address, events.user_id, cities.city, 
        users.username, events.vip, events.ordinary, events.published, events.add_info, events.start_time, events.end_time, 
        events.attendance_limit
        FROM  events 
        INNER JOIN users ON users.id = events.user_id
        INNER JOIN age ON age.id = events.age_id
        INNER JOIN cities ON cities.id = events.city_id WHERE events.id = '$id'";
        return $dbConn->query($sql); 
    }

    
    // Function that updates the state of an event

    public function changeState($id, $publish)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `events` SET `published`= '$publish' WHERE `id` = '$id'";
        $query = $dbConn->query($sql);
        if($query)
        {
            echo"<script>alert('Event Visibility Has Changed');</script>";
            echo"<script>window.location.href = 'view-events.php'</script>";
        }
    }


    public function deleteEvent($id)
    {
            $dbConn = $this->db->getConnection();
            $sql ="DELETE FROM `events` WHERE `id`=:id";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute())
            {
                echo"<script>alert('Equipment Removed Successfully')</script>";
                echo"<script>window.location.href = 'view-events.php'</script>";
            }
    }


    public function deleteEventORG($id)
    {
            $dbConn = $this->db->getConnection();
            $sql ="DELETE FROM `users` WHERE `id`=:id";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':id', $id);
            if($query->execute())
            {
                echo"<script>alert('Equipment Removed Successfully')</script>";
                echo"<script>window.location.href = 'view-users.php'</script>";
            }
    }


    public function getTransactions()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT transactions.id, transactions.amount, transactions.name, transactions.tx_time,
        events.event_name, events.user_id, cities.city, events.start_time, events.end_time, 
        users.username, transactions.email
        FROM  transactions INNER JOIN events ON events.id = transactions.event_id
        INNER JOIN users ON users.id = events.user_id INNER JOIN cities ON cities.id = events.city_id";
        return $dbConn->query($sql);
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



    // Function That Searches for Equipment


    public function searchProduct($search)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `equipment_tbl` LIKE %'$search'%";
        return $dbConn->query($sql);
    }



        // Function that adds  Equipment


        public function addEvent($e_name, $e_type, $pic, $e_price, $e_plan)
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
                echo"<script>alert('Event Added Successfully')</script>";
                echo"<script>window.location.href = 'events.php'</script>";
            }
    
        }



   // Function that Executes the queries
    function excuteQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
    
}




    // Function that Adds new City
    public function addCity($city)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `cities`(`city`) VALUES (:city)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':city', $city);
        if($query->execute())
        {
            echo"<script>alert('Event Added Successfully')</script>";
            header("Location: ../try_bae/view-cities.php");
        }else{
            echo"<script>alert('Event Not Added')</script>";
            echo"<script>window.location.href = 'add-cities.php'</script>";
        }
    
    }
    // Function that gets all cities
    public function getCities()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT * FROM cities";
        return $dbConn->query($sql);
    }





public function addCategory($category, $description)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `categories`(`category`, `cat_description`) VALUES (:category, :cat_description)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':category', $category);
        $query->bindParam(':cat_description', $description);
        if($query->execute())
        {
            echo"<script>alert('Category Added Successfully')</script>";
            header("Location: ../try_bae/view-categories.php");
        }else{
            echo"<script>alert('Category Not Added')</script>";
            echo"<script>window.location.href = 'add-categories.php'</script>";
        }
    
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
            header("Location: ../try_bae/view-events.php");
        }else{
            echo"<script>alert('Event Not Added')</script>";
            echo"<script>window.location.href = 'add-events.php'</script>";
        }
    
    }


   

    //Function that updates an Event

    public function updateEvent($event_id, $event_name, $limits, $published, $address, 
    $start_time, $end_time, $vip, $ordinary, $img, $add_info, $category_id, $age_id, $city_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="UPDATE  `events` SET `event_name`=:event_name, `attendance_limit`=:limits, `published`=:published,
        `address`=:addres, `start_time`=:start_time, `end_time`=:end_time, `vip`=:vip, `ordinary`=:ordinary, 
        `images`=:img_location,`add_info`=:add_info, `category_id`=:category_id, `age_id`=:age_id, 
        `city_id`=:city_id, `user_id`=:user_id WHERE `id`=:event_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':event_id', $event_id);
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
            echo"<script>alert('Event Updated Successfully')</script>";
            echo"<script>window.location.href = 'view-events.php'</script>";
        }else{
            echo"<script>alert('Event Not Updated')</script>";
            echo"<script>window.location.href = 'view-events.php'</script>";
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