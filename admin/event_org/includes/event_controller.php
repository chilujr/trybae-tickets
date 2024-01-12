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

if (isset($_GET['id'])) {
  
}


/*if (isset($_GET['delete_id'])) {
   $count = delete($table, $_GET['delete_id']);
   $_SESSION['message'] = "Story Delete Successfully";
   $_SESSION['type'] = "success";
   header("Location: ../admin_author/view-posts.php");
   exit();
}

if (isset($_GET['published']) && isset($_GET['p_id'])) {
   $published = $_GET['published'];
   $id = intval($_GET['p_id']);
   $count =  changeState($id, $published);
   $_SESSION['message'] = "Story Published Successfully";
   $_SESSION['type'] = "success";
   header("Location: ../admin_author/view-posts.php");
   exit();
}*/
 


   //Updating a userProfile

   if(isset($_POST['update-profile']))
   {
   
      if (!empty($_FILES['image']['name'])) {
         $image = time() . '_' . $_FILES['image']['name'];
         $destination = "../uploads/profile/event_org/".$image;
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


if(isset($_POST['checkIn']))
{
   $transaction_id = $_POST['id'];
   $model->confirmTransaction($transaction_id);
}



if (isset($_POST['update-story'])) {
   

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
   $published = $_POST['published'] = "1";
   $address =  $_POST['address'];
   $start_time =  date('Y-m-d H:i', strtotime($_POST['start_time']));
   $end_time  = date('Y-m-d H:i', strtotime($_POST['end_time']));
   $vip =  $_POST['vip'];
   $ordinary =  $_POST['ordinary'];
   $img =  $_POST['image'] = $image;
   $add_info =  $_POST['add_info'];
   $age_id =  intval($_POST['age_id']);
   $city_id = intval($_POST['city_id']);

   $model->UpdateEvent($event_name, $limits, $published, $address, $start_time, 
   $end_time, $vip, $ordinary, $img, $add_info, $age_id, $city_id, $user_id);    
}
?>

