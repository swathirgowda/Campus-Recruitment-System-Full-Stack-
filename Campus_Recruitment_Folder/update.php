<?php
$data=$_POST['val'];
$data1=$_POST['val1'];
$value=0 ;
$conn = mysqli_connect('localhost', 'root', '', 'campus_recruitment') or die('ERROR: Cannot Connect='.mysql_error($conn));

$applyQuery = "INSERT INTO application(job_id, usn, status) VALUES($data, \"$data1\", $value);";

mysqli_query($conn, $applyQuery);

?>
