<?php 
include_once ("admin/includes/model.php");
include_once ("admin/includes/database.php"); 
include_once "mail.php";
$model = new model();
$upcoming_events = $model->latestEvents();
$upcoming_onlineEvents = $model->latestOnlineEvent();
$upcoming_confrences = $model->latestConferences();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">

</head>
<body>