<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br><br>
        <?php
        
        
         ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                       <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                       <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php
    if(isset($_POST['submit']))
    {
        //get the data from form
        $id = $_GET['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check whether the user with current id and current password exist or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            //check whether data is available or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //user available and password can be changed
                //echo "User Found";
                
                // checck whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update the password
                    $sql2 = "UPDATE tbl_admin SET 
                    password = '$new_password'
                    WHERE id=$id
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //check whether the query executed or not
                    if($res2==TRUE){
                        //display success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        //display error message
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                        //redirect to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to manage admin page with error message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
             }
             else
             {
                 //user not available set message and redirect to manage admin page
                 $_SESSION['no-user-found'] = "<div class='error'>User Not Found.</div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
             }
         }
    }
?>


<?php include('partials/footer.php'); ?>
