<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
echo "<script>alert('Logout Success!');</script>";
header("location: ../index.php");
exit();
?>