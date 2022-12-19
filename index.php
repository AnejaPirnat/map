<!DOCTYPE html>
<html>
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>   
        <?php
          include "header.php";
        ?>
        <title>My Page</title>
</head>
<body>
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