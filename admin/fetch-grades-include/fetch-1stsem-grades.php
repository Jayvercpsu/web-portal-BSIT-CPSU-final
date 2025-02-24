<?php
include('../includes/config.php');

$student_id = $_GET['student_id'];

$query = mysqli_query($con, "SELECT * FROM tblgrades WHERE student_id='$student_id' AND semester='1st Sem'");
$grades = [];

while ($row = mysqli_fetch_assoc($query)) {
    $grades[] = $row;
}

echo json_encode($grades);
?>
