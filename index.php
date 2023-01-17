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
<body class="h-100">
<div class="container h-100">
<div class="row h-100 justify-content-center align-items-center">
  <div class="col-10 col-md-8 col-lg-6">
  <h1  style="text-align: center;"> Organiziraj svoje potovanje</h1>
  <br>
    <h3> Kje želiš začeti potovanje? </h3>
    Iz katere države boš začel potovanje?
    <select class="form-select" id="country" name="country" aria-label="Default select example">
      <?php  
        require_once 'database.php';
        $query = "SELECT DISTINCT(country) FROM location";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        while($row = $stmt ->fetch()){
        echo "<option value ='".$row['country']."'>".$row['country']."</option>";
        }
      ?>
</select>
    <script>
        $(document).ready(function(){
            $('#country').change(function(){
                var country = $(this).val();
                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{country:country},
                    dataType:"text",
                    success:function(data){
                        $('#city').html(data);
                        console.log(data);
                    }
                });
            });
        });
</script>
V katerem mestu boš začel potovanje?
<select class="form-select" name ="city" id ="city" aria-label="Default select example">
</select>
<br>

    <h3>Kam želiš iti?</h3>
       V katero državo želiš potovati?
    <select class="form-select" aria-label="Default select example" onchange="getCities()">
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