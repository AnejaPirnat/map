<?php
include_once 'database.php';
$country = $_POST['country'];
$query ="SELECT * FROM location WHERE country = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$country]);
echo "<option value=''>Izberi mesto</option>";
foreach($stmt as $row){
    echo "<option value ='".$row['id']."'>".$row['city']."</option>";
}
?>