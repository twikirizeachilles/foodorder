<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category </h1>
            <br><br>

            <?php 
             if(isset($_SESSION['add']))
             {
                 echo $_SESSION['add'];
                 unset($_SESSION['add']);
             }
             ?>
                <br><br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php 
                    //create a sql query to get all the categories from database
                    $sql = "SELECT * FROM tbl_category";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    //create serial number variable
                    $sn=1;

                    //check whether we have categories or not in database
                    if($count>0)
                        {
                        //we have categories
                        //get all the categories
                        while($row=mysqli_fetch_assoc($res))
                            {
                            //get the values from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php 
                                    //check whether image name is available or not
                                    if($image_name!="")
                                    {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                        <?php
                                    }
                                    else
                                    {
                                        //display the message
                                        echo "<div class='error'>Image not Added.</div>";
                                    }
                                     ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Category</a>
                                    <a href="#" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                    else
                    {
                        //we do not have categories
                        //we'll display the message inside table
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No Category Added.</div></td>
                        </tr>
                        <?php
                    }
                

                ?>

                
            </table>
            
    </div>
<?php include('partials/footer.php'); ?>