<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <?php 
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
             }
             ?>
            <!-- Login form starts here -->
            <form action="" method="POST" class="text-center">
                Username <br>
                <input type="text" name="username" placeholder="Enter Username">
                <br><br>
                Password <br>
                <input type="password" name="password" placeholder="Enter Password">
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>

            <!-- login form ends here -->

            <p class="text-center">Create By - <a href="">Twikirize Achilles</a></p>
        </div>
    </body>
</html>

<?php 
 
if(isset($_POST['submit']))
{
    //Process for login
    //1. Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //User Available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //TO check whether user is logged in or not and logout will unset it
        //Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //User not Available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'admin/login.php');
    }
} 

?>