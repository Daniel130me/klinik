<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$action = $_POST['action'];
$facility =  $_SESSION['fa_id'];
$user = $_SESSION['userid'];
$postid = $_SESSION['user_postid'];
$date =  date("Y-m-d H:i:s");

if($action === 'add') {
$diagnosis = test_input($_POST['diagnosis']);
$treatment = test_input($_POST['treatment']);
$prescription = test_input($_POST['prescription']);
$test = test_input($_POST['test']);
$pat_id = test_input($_POST['patid']);

// SELECT r.*, f.fname,s.title,s.fname,s.mname,s.lname,s.post,p.post FROM record r, facility f, specialist s, post p WHERE r.facility=f.id AND r.createdby=s.id AND s.post=p.id ORDER BY datecreated DESC
// $facility =  $_SESSION['fa_id'];
// $createdby = $_SESSION['userid'];
// $postid = $_SESSION['user_postid'];
$datecreated = date("Y-m-d H:i:s");
if($_FILES['record_file']['name']) {
    $img = $_FILES['record_file']['name'];
    $tmp = $_FILES['record_file']['tmp_name'];
    $valid_ext = array("jpeg","jpg","png","pdf");
    $path = "../uploads/";
    $img_name = rand(10000,10000000).$img;
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if(in_array($ext,$valid_ext)) {
        $path = $path.$img_name;
        if(move_uploaded_file($tmp,$path)) {
            $insert = mysqli_query($conn, "INSERT INTO record(patient_id,diagnosis,treatment,prescription,facility,createdby,userpost,datecreated,test,test_file)
            VALUES('$pat_id','$diagnosis','$treatment','$prescription','$facility','$user','$postid','$datecreated','$test','$img_name')");
            if($insert) {
                echo 'success';
            }
            else {
                echo mysqli_error($conn);
            }
        }
    }
    else {
        echo "File format not supported";
    }
}
else {
    $insert = mysqli_query($conn, "INSERT INTO record(patient_id,diagnosis,treatment,prescription,facility,createdby,userpost,datecreated,test)
    VALUES('$pat_id','$diagnosis','$treatment','$prescription','$facility','$user','$postid','$datecreated','$test')");
    if($insert) {
        echo 'success';
    }
    else {
        echo mysqli_error($conn);
    }
}
}
// if($action === 'update') {
// $diagnosis = test_input($_POST['diagnosis']);
// $treatment = test_input($_POST['treatment']);
// $prescription = test_input($_POST['prescription']);
// $test = test_input($_POST['test']);
// $recordid = test_input($_POST['recordid']);

// // SELECT r.*, f.fname,s.title,s.fname,s.mname,s.lname,s.post,p.post FROM record r, facility f, specialist s, post p WHERE r.facility=f.id AND r.createdby=s.id AND s.post=p.id ORDER BY datecreated DESC

// $dateupdated = date("Y-m-d H:i:s");
// if($_FILES['record_file']['name']) {
//     $img = $_FILES['record_file']['name'];
//     $tmp = $_FILES['record_file']['tmp_name'];
//     $valid_ext = array("jpeg","jpg","png","pdf");
//     $path = "../uploads/";
//     $img_name = rand(10000,10000000).$img;
//     $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
//     if(in_array($ext,$valid_ext)) {
//         $path = $path.$img_name;
//         if(move_uploaded_file($tmp,$path)) {
//             $update = mysqli_query($conn, "UPDATE record SET diagnosis='$diagnosis',treatment='$treatment'
//             ,prescription='$prescription',facility='$facility',updatedby='$user',
//             userpost='$postid',dateupdated='$dateupdated',test='$test',test_file='$img_name' WHERE id='$recordid'");
//             if($update) {
//                 echo 'success';
//             }
//             else {
//                 echo mysqli_error($conn);
//             }
//         }
//     }
//     else {
//         echo "File format not supported";
//     }
// }
// else {
//     $update = mysqli_query($conn, "UPDATE record SET  diagnosis='$diagnosis',treatment='$treatment'
//     ,prescription='$prescription',facility='$facility',updatedby='$user',
//     userpost='$postid',dateupdated='$dateupdated',test='$test' WHERE id='$recordid'");
//     if($update) {
//         echo 'success';
//     }
//     else {
//         echo mysqli_error($conn);
//     }
// }
// //$log_update = mysqli_query($conn,"UPDATE update_record SET initiatedid='$user',date_initiated='$date',updated_data='$$recordid'")

// }
?>