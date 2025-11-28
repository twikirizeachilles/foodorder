<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php 
         //1. Get the id of selected admin
         $id = $_GET['id'];

         //2. Create SQL Query to get the details
         $sql = "SELECT * FROM tbl_admin WHERE id=$id";

         //3. Execute the Query
         $res = mysqli_query($conn, $sql);

         //check whether the query is executed or not
         if($res==TRUE)
         {
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //Get the details
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else
            {
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
         }
         ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                 </tr>
                 <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                 </tr>
                 <tr>
                    <td  colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                 </tr>
             </table>
         </form>
    </div>   
</div>
<?php
 //check whether the submit button is clicked or not
 if(isset($_POST['submit']))
 {
    //echo "Button Clicked";
    //1. Get the data from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //2. Create a SQL Query to update admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'
    ";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        //echo "Admin Updated";
        $_SESSION['update'] = '<div class="success">Admin Updated Successfully.</div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Failed to Update Admin";
        $_SESSION['update'] = '<div class="error">Failed to Update Admin.</div>';
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

 }
?>
<?php include('partials/footer.php'); ?>

