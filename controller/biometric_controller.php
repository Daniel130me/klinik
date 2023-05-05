<?php
session_start();
include_once("../model/conn.php");
$action = $_POST['action'];

$date = date("Y:m:d H:i:s");
if($action === 'upload_biofile') {
    if(!empty($_FILES)){ 
        $path = "../biometric_uploads/"; 
        $img = $_FILES['file']['name']; 
        $tmp = $_FILES['file']['tmp_name'];
        $valid_ext = array("dat","xls");
        // var_dump($valid_ext);
        $img_name = $img;
        // $img_name = rand(10000,1000000).$img;
        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        if(in_array($ext, $valid_ext)) {
            $path = $path.$img_name;
            if(move_uploaded_file($tmp,$path)) {
                $sql = "INSERT INTO bio_file (dateuploaded, filebio, facility_id) VALUES ('$date', '$img_name','".$_SESSION['fa_id']."')"; 
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo "Successfully uploaded";
                }
            }
        }
        else {
            echo "file format not supported";
        }
    } 
}

if($action === 'biofile_download') {
    $select_dates = mysqli_query($conn, "SELECT dateuploaded FROM bio_file GROUP BY dateuploaded DESC");
    while($daterows = mysqli_fetch_array($select_dates)) {
        $select_files = mysqli_query($conn, "SELECT filebio FROM bio_file WHERE dateuploaded = '".$daterows['dateuploaded']."'");
        while($file_rows = mysqli_fetch_array($select_files)) {
            echo $file_rows['filebio'];
        }
    }
}
?>