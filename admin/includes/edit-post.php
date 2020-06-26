<?php

if(isset($_GET['p_id'] )){
    $post_id = $_GET['p_id'];

$query = "select * from posts where post_id=$post_id ";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){


$post_title = $row['post_title'];

$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_status = $row['post_status'];
$post_tags = $row['post_tags'];
$post_category_id = $row['category_id'];
$post_content = $row['post_content'];

}

if(isset($_POST['update_post'])){
$post_title = $_POST['title'];


$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];
$post_status = $_POST['post_status'];
$post_tags = $_POST['post_tags'];

$post_category_id = $_POST['post_category_id'];
$post_content = $_POST['post_content'];

move_uploaded_file($post_image_temp , "../img/$post_image");



$query = "update posts set ";
$query .= "post_title = '{$post_title}', ";
$query .= "category_id = '{$post_category_id}', ";

$query .= "post_date = now(), ";
if($post_image){
    $query .= "post_image = '{$post_image}', ";
}

$query .= "post_content = '{$post_content}', ";
$query .= "post_tags = '{$post_tags}', ";
if($_SESSION['role'] == 'admin'){
$query .= "post_status = '{$post_status}' ";
}
$query .= "where post_id = '{$post_id}' ";

$update_post = mysqli_query($connection , $query);
if(!$update_post){
    die(mysqli_error($connection));
}

header('location: posts.php');

}

}

?>

<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post title </label>
<input type="text" value="<?php echo $post_title?>" class="form-control" name="title" required>
</div>

<div class="form-group">
<label for="title">Post category </label>
<select name="post_category_id"   class='form-control'  id="">

<?php

$query = "select * from categories";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){

    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    if($post_category_id == $cat_id){
        echo  "<option selected  value='$cat_id'>$cat_title</option>";
    }else{
        echo  "<option  value='$cat_id'>$cat_title</option>";
    }
  
}
    ?>

</select>
</div>


<?php
if($_SESSION['role'] == 'admin'){
    ?>
<div class="form-group">
<label for="post_status">Post Status </label>
<select name="post_status" value="<?php echo $post_status?>" class="form-control" >
<option <?php if($post_status == "published" ) echo 'selected' ?>  value="published">Published</option>
<option <?php if($post_status == "draft" ) echo 'selected' ?> value="draft">Draft</option>

</select>

</div>
<?php

}?>
<div class="form-group">
<label for="author">Post Image </label><br>
<img width='100'  src="../img/<?php echo $post_image?>" alt="">
<br>
<br>

<input type="file"  name="image">
</div>

<div class="form-group">
<label for="post_tags">Post Tags </label>
<input type="text" value="<?php echo $post_tags?>" class="form-control" name="post_tags" required>
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea type="text"  class="form-control" name="post_content" cols="30" rows="5">
<?php echo $post_content?>
</textarea>
</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" class="form-control" name="update_post" value="Update Post">
</div>




</form>

