<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$title = test_input($_POST['title']);
$fname = test_input($_POST['fname']);
$mname = test_input($_POST['mdname']);
$lname = test_input($_POST['lname']);
$address = test_input($_POST['address']);
$email = test_input($_POST['email']);
$phone = test_input($_POST['phone']);
$pcode = test_input($_POST['pcode']);
$dob = test_input($_POST['dob']);
$post = test_input($_POST['post']);
$facility = test_input($_POST['facility']);
$password = test_input($_POST['password']);

// $facility =  $_SESSION['fa_id'];
$user = isset($_SESSION['userid']) === false ? '' : $_SESSION['userid'];
$datecreated = date("Y-m-d H:i:s");

if(!does_it_exist("id","specialist","email='$email' OR phone='$phone'")) {
$path = "../uploads/";
$img = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$valid_ext = array("jpeg","jpg","png");
$img_name = rand(10000,1000000).$img;
$ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
if(in_array($ext, $valid_ext)) {
    $path = $path.$img_name;
    if(move_uploaded_file($tmp,$path)) {
        $insert = mysqli_query($conn, "INSERT INTO specialist(title,fname,mname,lname,address,email,phone,pcode,dob,post,facility,password,photo,datecreated,createdby) 
        VALUES('$title','$fname','$mname','$lname','$address','$email','$phone','$pcode','$dob','$post','$facility','$password','$img_name','$datecreated','$user')");
        if($insert) {
            echo 'success';
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