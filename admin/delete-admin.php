<?php
   include('../config/constants.php'); 
    //1. Get the id of admin to be deleted
    $id = $_GET['id'];

    //2. Create SQL Query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //. Execute the Query
    $res = mysqli_query($conn, $sql);

    //check whether the query is executed or not
    if($res==TRUE)
    {
        //echo'<div class="success">Admin Deleted Successfully.</div>';
        $_SESSION['delete'] = '<div class="success">Admin Deleted Successfully.</div>';
        header('location:'.SITEURL.'admin/manage-admin.php');    
    } 
    else
    {
       // echo'<div class="error">Failed to Delete Admin.</div>';
        $_SESSION['delete'] = '<div class="error">Failed to Delete Admin.</div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>