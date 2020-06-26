
                        <form action="" method="post">
                        <div class="form-group">
                        <label for="">Edit category</label>

                    <?php

                    if(isset($_GET['edit'])){
    $cat_id = $_GET['edit'];

    $query = "select * from categories where cat_id = $cat_id";
$result = mysqli_query($connection , $query);

    while($row = mysqli_fetch_assoc($result)){

        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
                    
                    ?>




                        <input value="<?php if(isset($cat_title)){echo $cat_title ;} ?>" class="form-control" type="text" name="cat_edit" >
    <?php } }?>
    <?php
    if(isset($_POST['update'])){
        $cat_title = $_POST['cat_edit'];
   
    $query = "update categories set cat_title = '{$cat_title}' where cat_id = {$cat_id}";
   $result = mysqli_query($connection , $query);
   header('location: categories.php');
    
    }
    ?>




                        </div>
                        <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update" value="Update Category" >
                        </div>
                        </form>