<?php
session_start();
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function does_it_exist($what_to_select,$tbl,$condition) {
    global $conn;
    $select_query = mysqli_query($conn, "SELECT $what_to_select FROM $tbl WHERE {$condition}");
    $ans = mysqli_num_rows($select_query) > 0 ? true : false;
    return $ans;
}

?>