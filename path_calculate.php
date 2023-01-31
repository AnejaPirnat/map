<!DOCTYPE html>
<html lang="sl" class="h-100">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href = "css.css" rel = "stylesheet" />
       <?php
          include "header.php";
        ?>
        <title>MapTraveller</title>
</head>
<?php
require_once 'database.php';
$query = "SELECT * FROM location WHERE id = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute([$_POST['city']]);
$row = $stmt->fetch();
$cityname = $row['city'];
$city = array("lat" => $row['latitude'], "lng" => $row['longitude']);
$stmt->execute([$_POST['city2']]);
$row = $stmt->fetch();
$cityname2 = $row['city'];
$city2 = array("lat" => $row['latitude'], "lng" => $row['longitude']);

?>
<body class="h-100">
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6">
  <h1  style="text-align: center;"> Tvoje potovanje je ustvarjeno!</h1>
  <br>
<?php
    echo "<h3 style='text-align: center;'> <i class='bi bi-geo-alt'></i>" . $cityname . "<i class='bi bi-arrow-right'></i> " . $cityname2 . "<i class='bi bi-flag'></i></h3>";
?>
<br>
  <h3 style="text-align: center;"> Klikni na spodnjo povezavo, da si ogledaš potovanje na Google Maps </h3>
<?php

// Plot the path between the two cities
$path = array($city, $city2);

// Print the path coordinates
$url = "https://www.google.com/maps/dir/" . 
    $path[0]['lat'] . "%2F" . $path[0]['lng'] . "/" . 
    $path[1]['lat'] . "%2F" . $path[1]['lng'] . "/@45.6707088,13.9229265,9z/data=!4m9!4m8!1m3!2m2!1d" . 
    $path[0]['lng'] . "!2d" . $path[0]['lat'] . "!1m3!2m2!1d" . 
    $path[1]['lng'] . "!2d" . $path[1]['lat'];
echo '<a href='.$url.'"  style = " background: linear-gradient(90deg, rgba(143,242,208,1) 0%, rgba(175,249,123,1) 100%);" class="btn d-block w-100 d-sm-inline-block btn-light">Oglej si potovanje</a>'
?>



