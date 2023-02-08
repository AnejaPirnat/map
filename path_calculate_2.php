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

// Get the two cities from the user
$city = $_POST['city'];
$city2 = $_POST['city2'];

// Get the number of days from the user
$days = $_POST['days'];

// Get the latitude and longitude for the two cities
$query = "SELECT latitude, longitude, city FROM location WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$city]);
$city1 = $stmt->fetch();
$stmt->execute([$city2]);
$city2 = $stmt->fetch();

// Calculate the center point of the oval
$center_lat = ($city1['latitude'] + $city2['latitude']) / 2;
$center_lng = ($city1['longitude'] + $city2['longitude']) / 2;

// Calculate the semi-major axis of the oval
$semi_major = sqrt(pow($city1['latitude'] - $center_lat, 2) + pow($city1['longitude'] - $center_lng, 2));

// Calculate the semi-minor axis of the oval
$semi_minor = sqrt(pow($city2['latitude'] - $center_lat, 2) + pow($city2['longitude'] - $center_lng, 2));

// Select all of the cities in the oval shape
$query = "SELECT city, latitude, longitude FROM location WHERE 
  (pow((latitude - ?), 2) / pow(?, 2)) + (pow((longitude - ?), 2) / pow(?, 2)) <= 1";
$stmt = $pdo->prepare($query);
$stmt->execute([$center_lat, $semi_major, $center_lng, $semi_minor]);
$cities = $stmt->fetchAll();

// Calculate the step size based on the number of days
$step_size = 1 / $days;

// Calculate the points along the path
$path = [];
for ($i = 0; $i <= 1; $i += $step_size) {
  $lat = (1 - $i) * $city1['latitude'] + $i * $city2['latitude'];
  $lng = (1 - $i) * $city1['longitude'] + $i * $city2['longitude'];

  // Find the nearest city to this point
  $nearest_city = $cities[0];
  $nearest_distance = sqrt(pow($lat - $nearest_city['latitude'], 2) + pow($lng - $nearest_city['longitude'], 2));
  foreach ($cities as $c) {
    $distance = sqrt(pow($lat - $c['latitude'], 2) + pow($lng - $c['longitude'], 2));
    if ($distance < $nearest_distance) {
      $nearest_city = $c;
      $nearest_distance = $distance;
    }
  }

  $path[] = $nearest_city;
}
$path[count($path) - 1] = $city2;
// Output the path


?>
<body class="h-100">
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6">
  <h1  style="text-align: center;"> Tvoje potovanje je ustvarjeno!</h1>
  <br>
<?php
 echo "<div> <h3 style='text-align: center;'> <i class='bi bi-geo-alt'></i>" . $city1['city'] . "<i class='bi bi-arrow-right'></i> " . $city2['city'] . "<i class='bi bi-flag'></i></h3> </div>";
 echo "<hr>";
 echo "<br>";
 echo "<h5 style='text-align: center;'><i class='bi bi-geo-alt'></i>". $city1['city'] ."\n";

  for ($i = 0; $i < count($path) - 2; $i++) {
    echo "<h5 style='text-align: center;'><i class='bi bi-moon'></i>". $path[$i]['city'] ."\n";
    echo "<br>";

  }
  echo "<h5 style='text-align: center;'><i class='bi bi-flag'></i>". $city2['city'] ."\n";
?>
<br>
<br>
<hr>
  <h3 style="text-align: center;"> Klikni na spodnjo povezavo, da si ogledaš potovanje na Google Maps </h3>
<?php

// Build the URL for the Google Maps link
$url = 'https://www.google.com/maps/dir/';
$url .= $city1['latitude'] . '%2F' . $city1['longitude'];
foreach ($path as $c) {
  $url .= '/' . $c['latitude'] . '%2F' . $c['longitude'];
}
$url .= '/' . $city2['latitude'] . '%2F' . $city2['longitude'];
$url .= '/@' . $center_lat . ',' . $center_lng . ',8z/data=!4m' . (2 * count($path) + 2) . '!4m' . (2 * count($path) + 1);

// Output the Google Maps link
echo '<a href='.$url.'" target="_blank"  style = " background: linear-gradient(90deg, rgba(143,242,208,1) 0%, rgba(175,249,123,1) 100%);" class="btn d-block w-100 d-sm-inline-block btn-light">Oglej si potovanje</a>';

?>