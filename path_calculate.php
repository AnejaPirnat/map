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
$days = $_POST['days'];

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
$stops = array_slice($path, 0, $days + 1);

for ($i = 0; $i < $days; $i++)
{
$query = "SELECT latitude AS lat, longitude AS lng FROM location ORDER BY RAND() LIMIT 1";
$stmt = $pdo->prepare($query);
$stmt->execute();
$citystop = $stmt->fetch();

// Check if the random city is near the path
$distance = get_great_circle_distance($city['lat'], $city['lng'], $citystop['lat'], $citystop['lng']);
if($city['lat'] != $citystop['lat'] && $city['lng'] != $citystop['lng'])
{
    if($distance < 50) 
    {
    // Insert the random city into the path
    array_splice($path, 1, 0, array($citystop));
    }
    else
    {
         $i--;
    }
}
else
{
    $i--;
}
}
$stops = array_slice($path, 0, $days + 1);

$urls = array();

foreach($stops as $coordinate) {
    $urls[] = $coordinate['lat'] . "%2F" . $coordinate['lng'];
}

$urls[] = $city2['lat'] . "%2F" . $city2['lng'];

$url = "https://www.google.com/maps/dir/" . implode("/", $urls) . "/@45.9318581,14.2233111,8.72z/data=!4m" . (count($stops) + 3) . "!4m" . (count($stops) + 2) . "!1m3";
echo '<a href='.$url.'" target="_blank"  style = " background: linear-gradient(90deg, rgba(143,242,208,1) 0%, rgba(175,249,123,1) 100%);" class="btn d-block w-100 d-sm-inline-block btn-light">Oglej si potovanje</a>';

// Get the great circle distance between two points
function get_great_circle_distance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6371;

    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2) * sin($dLng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));

    return $earth_radius * $c;
}

?>



