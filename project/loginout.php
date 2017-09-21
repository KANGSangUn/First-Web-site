
<?php
session_start();
$logout = isset($_GET['logout']) ? $_GET['logout'] : null;

if($logout=="out"){
    unset($_SESSION['id']);
    unset($_SESSION['passwd']);
    session_destroy();
   echo "<script>location.href = 'login.html';</script>";
}
?>

