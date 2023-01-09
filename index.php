<!DOCTYPE html>
<html lang="sl" class="h-100">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
        <link href = "css.css" rel = "stylesheet" />
       <?php
          include "header.php";
        ?>
        <title>My Page</title>
</head>
<body class="h-100">
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6">
  <h1  style="text-align: center;"> Organiziraj svoje potovanje</h1>
  <br>
    <h3> Kje želiš začeti potovanje? </h3>
    Iz katere države boš začel potovanje?
    <select class="form-select" aria-label="Default select example">
      <?php  
        require_once 'database.php';
        $query = "SELECT DISTINCT country FROM location";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt ->fetch()){
        echo "<option value ='".$row['id']."'>".$row['country']."</option>";
        }
      ?>
</select>

V katerem mestu boš začel potovanje?
<select class="form-select" aria-label="Default select example">
      <?php  
        require_once 'database.php';
        $query = "SELECT DISTINCT city FROM location";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt ->fetch()){
        echo "<option value ='".$row['id']."'>".$row['city']."</option>";
        }
      ?>
</select>
<br>

    <h3>Kam želiš iti?</h3>
       V katero državo želiš potovati?
    <select class="form-select" aria-label="Default select example">
      <?php  
        require_once 'database.php';
        $query = "SELECT DISTINCT country FROM location";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt ->fetch()){
        echo "<option value ='".$row['id']."'>".$row['country']."</option>";
        }
      ?>
</select>
    V katero mesto želiš potovati?
<select class="form-select" aria-label="Default select example">
      <?php  
        require_once 'database.php';
        $query = "SELECT DISTINCT city FROM location";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt ->fetch()){
        echo "<option value ='".$row['id']."'>".$row['city']."</option>";
        }
      ?>
</select>
Koliko dni želiš potovati?
<div class="form-outline">
  <input type="number" id="typeNumber" class="form-control" placeholder = "Trajanje potovanja (dnevi)" />
</div>
<br>
<button type="button" class="btn btn-primary btncolor">Submit</button>
</form>
</div>
</div>
</div>
</body>