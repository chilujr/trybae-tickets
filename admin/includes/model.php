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


    //Function that logs in users


    public function login($email, $pass)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['id'] = $result['id'];
           $_SESSION['email'] = $result['email'];
           $_SESSION['name'] = $result['username'];
           $_SESSION['role'] = $result['role'];
           $_SESSION['user_pic'] = $result['images'];
           $_SESSION['user_pass'] = $result['password'];
           $verified = $result['activation_status'];
           $password = $_SESSION['user_pass'];
           if(password_verify($pass, $password)){
            $role = $result['role'];
            if($role == "Admin")
            {
                    echo"<script>alert('Login Successful');</script>";
                    header("Location: ../try_bae/index.php");
            }
            elseif($role == "eventOrg" )
            {
                if($verified == "verified")
                {
                    echo"<script>alert('Login Successful');</script>";
                    header("Location: ../event_org/index.php");
                }else{
                    echo"<script>alert('Your Account is Disabled: Kindly Contact The Admin');</script>";
                }
               
            }
        }else{
            echo "<script>alert('Invalid Username / Password Error');</script>";
        }
          
        } 
        else 
        {
            echo "<script>alert('Login Error: User Not Found');</script>";
        }
    }

    //function to check if an email exists in the database


    public function checkEmail($email)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            return true;
        } 
        else 
        {
            return false;
            $errors['email'] = "Email that you have entered does not already exist!";
        }
    }



    //function that sends an otp to the user's email


    public function sendOTP($email, $code){
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `users` SET `code`='$code' WHERE `email` = '$email'";
        $query = $dbConn->query($sql);
        if($query->execute())
        {
            echo"<script>alert('An OTP has Been Sent To Your Email');</script>";
        }
        else
        {
            echo"<script>alert('Password Reset Error');</script>";
        }
    }


    //Function to get user otp details


    public function getUserOTP($otp_code)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM users WHERE code = $otp_code";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
            $_SESSION['info'] = "OTP Confirmed!";
            echo "<script>window.location.href = 'change-password.php'</script>";

        }else{
            $_SESSION['info'] = "Invaild OTP - Check Your Email!";
        }
    }



    //Function to change user password

    public function changePassword($email, $pass)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `users` SET `password` = '$pass', `code` = '0' WHERE `email` = '$email'";
        $info = "Your Password Changed. Now You Can Login with Your New Password.";
        $_SESSION['info'] = $info;
        $query = $dbConn->query($sql);
        if($query->execute())
        {
            echo"<script>alert('Password Changed Successfully');</script>";
            echo"<script>window.location.href = 'login-user.php'</script>";
        }
        else
        {
            echo"<script>alert('Password Change Error');</script>";
        }
    }
        



    // Function That Searches for Equipment


    public function searchEvents($search)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT events.id,categories.id as category_id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM events 
        INNER JOIN users ON users.id = events.user_id 
        INNER JOIN cities ON cities.id = events.city_id
        INNER JOIN age ON age.id = events.age_id
        INNER JOIN categories ON categories.id = events.category_id 
        WHERE events.event_name LIKE '%$search%' OR events.add_info LIKE '%$search%' AND events.published=1 ORDER BY events.id DESC";
        return $dbConn->query($sql);
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
  


    // Function that gets  3 Latest events under the Festivals Category

    public function latestEvents()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        INNER JOIN age ON age.id = events.age_id
        INNER JOIN categories ON categories.id = events.category_id
        WHERE events.category_id =2 AND events.published=1 ORDER BY events.id DESC LIMIT 4";
        return $dbConn->query($sql);
    }


    // Function that gets  3 Latest events under the Conferences Category

    public function getCategories($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.category_id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM  events 
        INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        INNER JOIN categories ON categories.id = events.category_id
        INNER JOIN age ON age.id = events.age_id
        WHERE events.category_id ='$id' AND events.published=1 ORDER BY events.id DESC";
        return $dbConn->query($sql);
    } 


    public function changeState($id, $publish)
    {
        $dbConn = $this->db->getConnection();
        $sql = "UPDATE `events` SET `published`= '$publish' WHERE `id` = '$id'";
        $query = $dbConn->query($sql);
        if($query)
        {
            echo"<script>alert('Event Visibility Has Changed');</script>";
        }
    }


    // Function that gets  3 Latest events under the Conferences Category

    public function latestConferences()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        INNER JOIN categories ON categories.id = events.category_id
        INNER JOIN age ON age.id = events.age_id
        WHERE events.category_id =1 AND events.published=1 ORDER BY events.id DESC LIMIT 3";
        return $dbConn->query($sql);
    }    

    // Function that gets  3 Latest events under the Conferences Category

    public function latestOnlineEvent()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        INNER JOIN categories ON categories.id = events.category_id
        INNER JOIN age ON age.id = events.age_id
        WHERE events.category_id =3 AND events.published=1 ORDER BY events.id DESC LIMIT 3";
        return $dbConn->query($sql);
    }


    // function that gets a single events

    public function getSingleEvent($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.attendance_limit, events.city_id, events.add_info, events.address, 
        events.images, events.user_id, cities.city, age.age, categories.category, events.start_time, events.end_time, 
        users.username, events.vip, events.ordinary, events.published
        FROM  events 
        INNER JOIN users ON users.id = events.user_id
        INNER JOIN age ON age.id = events.age_id
        INNER JOIN categories ON categories.id = events.category_id
        INNER JOIN cities ON cities.id = events.city_id WHERE events.id ='$id' AND events.published=1";
        return $dbConn->query($sql);
    }

        // Function that updates Attendance Limit


        public function updateAttendanceLimit($id)
        {
            $dbConn = $this->db->getConnection();
            $sql = "UPDATE `events` SET `attendance_limit` = `attendance_limit` - 1 
            WHERE `events`.`id` = '$id'";
            $query = $dbConn->query($sql);
        }


}