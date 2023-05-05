<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

$select = mysqli_query($conn, "SELECT s.id,s.title,s.fname firstname,
s.mname middlename,s.lname lastname,s.email spemail,s.post,s.photo, 
f.id fid,f.fname, f.logo,f.email,f.faddress,f.phone facility_phone,
f.postcode facility_pcode FROM specialist s, facility f 
WHERE s.email='$email' AND s.password='$password' 
AND s.facility=f.id");
if(mysqli_num_rows($select)>0) {
  echo "success";
  $row = mysqli_fetch_array($select);
  //specialist
  $_SESSION['userid'] = $row['id'];
  $_SESSION['user_title'] = $row['title'];
  $_SESSION['user_firstname'] = $row['firstname'];
  $_SESSION['user_middlename'] = $row['middlename'];
  $_SESSION['user_lastname'] = $row['lastname'];
  $_SESSION['user_email'] = $row['spemail'];
  $_SESSION['user_postid'] = $row['post'];
  $_SESSION['user_photo'] = $row['photo'];
  //facility
  $_SESSION['fa_id'] = $row['fid'];
  $_SESSION['fa_name'] = $row['fname'];
  $_SESSION['fa_logo'] = $row['logo'];
  $_SESSION['fa_email'] = $row['email'];
  $_SESSION['fa_address'] = $row['faddress'];
  $_SESSION['fa_phone'] = $row['facility_phone'];
  $_SESSION['fa_pcode'] = $row['facility_pcode'];
}
else {
  echo mysqli_error($conn);
}

?>