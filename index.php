<?php
if(isset($_GET['pg'])) {
    include($_GET['pg'].".php");
}
else {
    header('Location: login.html');
}
?>