<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$fname = test_input($_POST['facility_name']);
$femail = test_input($_POST['facility_email']);
$fadd = test_input($_POST['facility_address']);
$fphone = test_input($_POST['facility_phone']);
$fcode = test_input($_POST['facility_postcode']);
if(!does_it_exist("id","facility","email='$femail' OR phone='$fphone'")) {

$path = "../uploads/";
$valid_ext = array("jpg","png","jpeg");
$img_name = $_FILES['flogo']['name'];
$tmp = $_FILES['flogo']['tmp_name'];
$ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
$final_img = rand(10000,1000000).$img_name;
if(in_array($ext,$valid_ext)) {
    $path = $path.$final_img;
    if(move_uploaded_file($tmp,$path)) {
   
        $insert = mysqli_query($conn, "INSERT INTO facility(fname,email,faddress,phone,postcode,logo) 
        VALUES('$fname','$femail','$fadd','$fphone','$fcode','$final_img')");
        if($insert) {   
                   echo "success";
        }
        else {
            echo mysqli_error($conn);
        }
    }
}
else {
    echo "file format not supported";
}
}
else {
    echo "Information already exist!";
}
?>