<?php
include_once './header.php';
?>
<!DOCTYPE html>
<html lang="sl" class="h-100">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href = "css.css" rel = "stylesheet" />
        <title>MapTraveller - login</title>
</head>
<body class="h-100">
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6">
  <h1  style="text-align: center;"> Prijava</h1>
  <form action = "login_check.php" method = "post">
  <br>
    Email
    <input type="email" class="form-control" name="email" placeholder="Email">
<br>
Geslo
<input type="password" class="form-control" name="password" placeholder="Geslo">
<br>
<button type="submit" class="btn btn-primary btncolor">Prijava</button>
</form>
</div>
</div>
</div>
</body>
  