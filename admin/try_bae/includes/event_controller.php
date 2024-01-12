<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

//Instance of the class
require_once 'model.php';
require_once 'database.php';  
$model = new model();

$errors  = array();



// if (isset($_GET['delete_id'])) {
//    $count = delete($table, $_GET['delete_id']);
//    $_SESSION['message'] = "Story Delete Successfully";
//    $_SESSION['type'] = "success";
//    header("Location: ../admin_author/view-posts.php");
//    exit();
// }

// if (isset($_GET['published']) && isset($_GET['p_id'])) {
//    $published = $_GET['published'];
//    $id = intval($_GET['p_id']);
//    $count =  changeState($id, $published);
//    $_SESSION['message'] = "Story Published Successfully";
//    $_SESSION['type'] = "success";
//    header("Location: ../admin_author/view-posts.php");
//    exit();
// }
 



//adding a new user
if(isset($_POST['add-user'])) {
   $username = $_POST['username'];
   $role = $_POST['role'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpassword = $_POST['cpassword'];
   $status = $_POST['status'];

   if($pass !== $cpassword){
         echo "<script>Alert('Confirm password not matched')</script>";
   }
    $email_check = $model->validateEmail($email);
   
   if(empty($_SESSION['email-error'])){
      $encpass = password_hash($pass, PASSWORD_BCRYPT);
      $link = "http://localhost/trybae-main/admin/authentication_pages/login-user.php";
      // $insert_data = "INSERT INTO users (username, email, password, role, code, activation_status)values('$username', '$email', '$encpass', '$admin', '$code', '$status')";
       $adduser = $model->registerUser($username, $role,  $email, $encpass, $status);
       $subject = "Account Activation";
       $message = "Your Default Password is ".$pass."\n\n Using it to login the first time. We recommend your change it to a secure one. \n\n follow the Link below \n\n ".$link." \n\n Thank you!";
       $sender = "From: chiyembekezop11@gmail.com";
       $mail = mail($email, $subject, $message, $sender);
          if($mail){
              echo "<script>Alert('We've sent a confirmation to your email - $email')</script>";
              header('location: view-users.php');
              exit();
          }else{
            echo "<script>Alert('Error sending verification code')</script>";
          }
  
      /*
      $adduser = $model->registerUser($username, $role,  $email, $pass, $status);
      if ($adduser) {
         echo "<script>Alert('User Added Successfully')</script>";
         header("Location: ../admin_author/view-users.php");
         exit();
      } else {
         array_push($errors, "User Addition Failed");
      }
      */
   }  else {
      array_push($errors, "User Addition Failed");
   }
}


   //Updating a userProfile

   if(isset($_POST['update-profile']))
   {
   
      if (!empty($_FILES['image']['name'])) {
         $image = time() . '_' . $_FILES['image']['name'];
         $destination = "../uploads/profile/admin/".$image;
         $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
         if ($result) {
            $_POST['image'] = $image;
         } else {
            array_push($errors, "Image upload failed");
         }
      } else {
         array_push($errors, "Image is required");
      }
      $id = $_POST['id'] = $_SESSION['id'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $pass = $_POST['password'];
      $image = $_POST['image'] = $image;

      $encpass = password_hash($pass, PASSWORD_BCRYPT);
      $update_user = $model->updateUser($id, $username,  $email, $encpass, $image);
      if ($update_user) {
            echo "<script>Alert('User Updated Successfully')</script>";
            header("Location: ../admin_author/view-users.php");
            exit();
      } else {
            array_push($errors, "User Update Failed");
         }
   }  




//adding a new event
if (isset($_POST['add-event'])) {

   if (!empty($_FILES['event_image']['name'])) {
      $image = time() . '_' . $_FILES['event_image']['name'];
      $destination = "../uploads/".$image;
      $result = move_uploaded_file($_FILES['event_image']['tmp_name'], $destination);
      if ($result) {
         $_POST['image'] = $image;
      } else {
         array_push($errors, "Image upload failed");
      }
   } else {
      array_push($errors, "Image is required");
   }

   $user_id = $_POST['user_id'] = $_SESSION['id'];
   $event_name = $_POST['event_name'];
   $limits = $_POST['limits'];
   $_POST['published'] = isset($_POST['published']) ? 1 : 0;
   $published = $_POST['published'];
   $address =  $_POST['address'];
   $start_time =  date('Y-m-d H:i', strtotime($_POST['start_time']));
   $end_time  = date('Y-m-d H:i', strtotime($_POST['end_time']));
   $vip =  $_POST['vip'];
   $ordinary =  $_POST['ordinary'];
   $img =  $_POST['image'] = $image;
   $add_info =  $_POST['add_info'];
   $category_id =  $_POST['category_id'];
   $age_id =  intval($_POST['age_id']);
   $city_id = intval($_POST['city_id']);
   $model->createEvent($event_name, $limits, $published, $address, $start_time, 
   $end_time, $vip, $ordinary, $img, $add_info, $age_id, $category_id, $city_id, $user_id);

} 


//updating an event
if (isset($_POST['update-event'])) {

   if (!empty($_FILES['event_image']['name'])) {
      $image = time() . '_' . $_FILES['event_image']['name'];
      $destination = "../uploads/".$image;
      $result = move_uploaded_file($_FILES['event_image']['tmp_name'], $destination);
      if ($result) {
         $_POST['image'] = $image;
      } else {
         array_push($errors, "Image upload failed");
      }
   } else {
      array_push($errors, "Image is required");
   }
   $event_id =  intval($_POST['event_id']);
   $user_id = $_POST['user_id'] = $_SESSION['id'];
   $event_name = $_POST['event_name'];
   $limits = $_POST['limits'];
   $published = $_POST['published'] = "1";
   $address =  $_POST['address'];
   $start_time =  date('Y-m-d H:i', strtotime($_POST['start_time']));
   $end_time  = date('Y-m-d H:i', strtotime($_POST['end_time']));
   $vip =  $_POST['vip'];
   $ordinary =  $_POST['ordinary'];
   $img =  $_POST['image'] = $image;
   $add_info =  $_POST['add_info'];
   $category_id =  $_POST['category_id'];
   $age_id =  intval($_POST['age_id']);
   $city_id = intval($_POST['city_id']);
   $model->updateEvent($event_id, $event_name, $limits, $published, $address, 
   $start_time, $end_time, $vip, $ordinary, $img, $add_info, $category_id, $age_id, $city_id, $user_id);
} 


//adding a new City
if (isset($_POST['add-city'])) {
    
   $city = $_POST['city'];
   $model->addCity($city);
}


//adding a new Category
if (isset($_POST['add_category'])) {
    
   $category = $_POST['category'];
   $description = $_POST['cat_description'];
   $model->addCategory($category, $description);
}





// if (isset($_POST['update-story'])) {
//    $errors = validateStory($_POST);

//    if (!empty($_FILES['image']['name'])) {
//       $image = time() . '_' . $_FILES['image']['name'];
//       $destination = "../uploads/".$image;

//       $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
//       if ($result) {
//          $_POST['image'] = $image;
//       } else {
//          array_push($errors, "Image upload failed");
//       }
//    } else {
//       array_push($errors, "Image is required");
//    }

//    if (count($errors) == 0) {
//       unset($_POST['add-event']);
//       $user_id = $_POST['user_id'] = $_SESSION['user'];
//       $event_name = $_POST['event_name'];
//       $address =  $_POST['address'];
//       $limits = $_POST['limits'];
//       $age_id =  intval($_POST['age_id']);
//       $city_id = intval($_POST['city_id']);
//       $start_time =  date('Y-m-d', strtotime($_POST['start_time']));
//       $end_time  = date('Y-m-d', strtotime($_POST['end_time']));
//       $ordinary =  $_POST['ordinary'];
//       $vip =  $_POST['vip'];
//       $add_info =  $_POST['add_info'];
//       $published = $_POST['published'] = "1";
//       $img =  $_POST['image'] = $image;

//       /*$model->updatePost($event_name, $limits, $published, $address, $start_time, 
//       $end_time, $vip, $ordinary, $img, $add_info,  $age_id, $city_id, $user_id);
//       $_SESSION['message'] = "Story Updated Successfully";
//       $_SESSION['type'] = "success";
//       header("Location: ../../admin_author/view-posts.php");*/
//    }

// }


?>

