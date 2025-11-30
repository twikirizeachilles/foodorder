<?php 
     include('../config/constants.php');
    //echo "Delete Category Page";
    //check whether the id and image_name  value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is available
        if($image_name != ""){
            //image available
            //remove the image
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);
        

            //if failed to remove image then add an error message and stop the process 
            if($remove==false)
            {
                //session message
                $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //check whether the data is deleted from database or not
        if($res==true)
        {
            //category deleted
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //failed to delete category
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page with message
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
        
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
    }
?>