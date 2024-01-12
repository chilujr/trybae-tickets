<?php 
include_once ("admin/includes/model.php");
include_once ("admin/includes/database.php"); 
include_once "mail.php";
$model = new model();
$upcoming_events = $model->latestEvents();
$upcoming_onlineEvents = $model->latestOnlineEvent();
$upcoming_confrences = $model->latestConferences();

if(isset($_POST['btn_search']))
{
    $search_request = $_SESSION['search'] = $_POST['search'];
    header('Location: search.php?search='.$search_request);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trybae | Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

       <!-- custom css file link  -->
       <link rel="stylesheet" href="css/style_nav.css">

       <!-- custom css file link  -->
       <link rel="stylesheet" href="css/style_footer.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Navbar Code -->

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

</head>
<body>