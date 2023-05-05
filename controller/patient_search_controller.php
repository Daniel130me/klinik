<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$id = test_input($_POST['id']);
$select = mysqli_query($conn, "SELECT id,fname,mname,lname,email,phone,paddress,photo 
FROM patient WHERE id='$id'");
if($row = mysqli_fetch_array($select)) {
    echo $row['fname']."*".$row['mname']."*".$row['lname']."*".$row['email']."*".$row['phone']."*".$row['paddress']."*".$row['id']."*".$row['photo'];
}
else {
    echo "Nothing";
}
?>