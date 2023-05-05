<?php
include_once("../model/conn.php");
include_once("../model/functions.php");
$title = test_input($_POST['title']);
$fname = test_input($_POST['fname']);
$lname = test_input($_POST['lname']);
$mname = test_input($_POST['mname']);
$address = test_input($_POST['address']);
$lga = test_input($_POST['lga']);

// 
$city = test_input($_POST['city']);
$state_res = test_input($_POST['state_res']);
$lga_origin = test_input($_POST['lga_origin']);
// 
$email = test_input($_POST['email']);
$phone = test_input($_POST['phone']);
$pcode = test_input($_POST['postcode']);
$state_origin = test_input($_POST['state_origin']);
$dob = test_input($_POST['dob']);
$blood = test_input($_POST['blood']);
$genotype = test_input($_POST['genotype']);
$gender = test_input($_POST['gender']);
$height = test_input($_POST['height']);
$weight = test_input($_POST['weight']);


$etitle = test_input($_POST['etitle']);
$efname = test_input($_POST['efname']);
$elname = test_input($_POST['elname']);
$emname = test_input($_POST['emname']);
$eaddress = test_input($_POST['eaddress']);
$elga = test_input($_POST['elga']);
// 
$ecity = test_input($_POST['ecity']);
$estate = test_input($_POST['estate']);
$elga_origin = test_input($_POST['elga_origin']);
// 
$eemail = test_input($_POST['eemail']);
$ephone = test_input($_POST['ephone']);
$epcode = test_input($_POST['epcode']);
$estate_of_origin = test_input($_POST['estate_of_origin']);
$edob = test_input($_POST['edob']);
$eblood = test_input($_POST['eblood']);
$egenotype = test_input($_POST['egenotype']);
$erelation = test_input($_POST['erelation']);

$facility =  $_SESSION['fa_id'];
$registrar = $_SESSION['userid'];
$datecreated = date("Y-m-d H:i:s");

if(!does_it_exist("id","patient","email='$email' OR phone='$phone'")) {
$valid_ext = array("jpg","jpeg","png");
$path = "../uploads/";
$img = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$img_name = rand(1000,1000000000).$img;
$pat_id = rand(100,999);
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
if(in_array($ext,$valid_ext)) {
    $path = $path.$img_name;
    if(move_uploaded_file($tmp,$path)) {
        $insert = mysqli_query($conn, "INSERT INTO patient(id,title,fname,mname,lname,paddress,lga,email,
        phone,postcode,state_origin,dob,bloodgroup,genotype,etitle,efname,elname,emname,eemail,eaddress,elga,
        ephone,epostcode,estate_of_origin,edob,ebloodgroup,egenotype,erelation,facility,createdby,datecreated,
        photo,gender,height,pweight,city,state_res,lga_origin,ecity,estate,elga_origin)
        VALUES('$pat_id','$title','$fname','$mname','$lname','$address','$lga','$email','$phone','$pcode',
        '$state_origin','$dob','$blood','$genotype','$etitle','$efname','$elname','$emname','$eemail',
        '$eaddress','$elga','$ephone','$epcode','$estate_of_origin','$edob','$eblood','$egenotype',
        '$erelation','$facility','$registrar','$datecreated','$img_name','$gender',
        '$height','$weight','$city','$state_res','$lga_origin','$ecity','$estate','$elga_origin')");
        if($insert) {
            echo "success";
        }
        else {
            echo mysqli_error($conn);
        }
    }
}
}
else  {
    echo "Information already exist!";
}
?>