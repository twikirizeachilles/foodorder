<?php 
 //Authorization - Access control
 //Check whether the user is logged in or not
 if(!isset($_SESSION['login']))
 {
    //user is not logged in
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access admin panel.</div>";
    header('location:'.SITEURL.'admin/login.php');
 }

?>