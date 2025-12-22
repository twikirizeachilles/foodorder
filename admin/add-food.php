<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                                //create php code to display categories from database
                                //create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //execute query
                                $res = mysqli_query($conn, $sql);
                                //count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);
                                //if count is greater than 0, we have categories else we don't have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php

                                    }
                                }
                                else
                                {
                                    //we don't have categories
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                                
                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php

        //check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //get the value from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio button for featured is active or not 
            if(isset($_POST['featured']))
            {
                //get the value from form
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                //get the value from form
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            //image uploaded
            //check if the image is selected or not
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                //check wheather the is selected or not and upload image only if selected
                if($image_name != "")
                {
                    //image is selected 
                    //upload the image
                    //get the extension of our image (jpg, png, gif, etc) e.g. food1.jpg
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_name_".rand(0000, 9999).'.'.$ext; //e.g. Food_name_834.jpg
                    
                    // source path and destination path
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/".$image_name;

                    //finally upload the image
                    $upload = move_uploaded_file($src, $dst);

                    //check weather image uploaded or not
                    if($upload==false)
                    {
                        //failed to upload image
                        //redirected to manage food page with error message
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        //stop the process
                        die();
                    }
                }
            }
            else
            {
                $image_name = "";
            }
            //insert into database 
            $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check wheather data inserted or not
            if($res2==true){
                //data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                //redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                //redirect to manage food page
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            
            //redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
        } 


        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>