<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Full Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
</div>

<?php include('partials/footer.php'); ?>

<?php
    // Process the value from form and save it in database
    
    //check whether the value is clicked or not 
    if(isset($_POST['submit']))
    {
        //if button is clicked
        //echo "Button Clicked";
        //1. Get the data from form
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']); 

         //2. SQL Query to save the data into database
         $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
         ";

         //3. Execute the Query and save data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4 check wheather the query is executed and data is saved into database and a display message
        if($res==TRUE)
        {
           // echo "data inserted";
           //create a session variable to display message
           $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
           //redirect page to manage admin
           header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //echo "Failed to insert data";
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

?>