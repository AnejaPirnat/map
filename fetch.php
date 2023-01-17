<?php
include_once 'database.php';
$country = $_POST['country'];
$country ="SELECT * FROM location WHERE country = ?";
$stmt = $pdo->prepare($country);
$stmt->execute([$country]);
foreach($stmt as $row){
    echo "<option value ='".$row['id']."'>".$row['country']."</option>";
}
?>