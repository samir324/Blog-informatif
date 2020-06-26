
<?php
if(isset($_POST['create_post'])){


$post_title = $_POST['title'];
$post_author = $_SESSION['username'];

$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];

if($_SESSION['role'] !== 'admin'){
        $post_status = 'draft';

}else {
    $post_status = $_POST['post_status'];
}

$post_tags = $_POST['post_tags'];
$post_comment_count = 0;
$post_category_id = $_POST['post_category_id'];
$post_content = $_POST['post_content'];

move_uploaded_file($post_image_temp , "../img/$post_image");

$query = "insert into posts(category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
$query .= " value({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";
$creat_post = mysqli_query($connection , $query);
if(!$creat_post){
    die(mysqli_error($connection));
}

header('location:posts.php');

}
?>


<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post title </label>
<input type="text" class="form-control" name="title" required>
</div>

<div class="form-group">
<label for="title">Post category </label>
<select name="post_category_id" class='form-control'  id="">


<?php
$query = "select * from categories";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){

    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
  echo  "<option value='$cat_id'>$cat_title</option>";
}




    ?>

</select>
</div>

<?php   if($_SESSION['role'] !== 'admin'):?>

<?php   else:?>
<div class="form-group">
<label for="post_status">Post Status </label>
<select name="post_status" class="form-control" >
<option value="published">Published</option>
<option value="draft">Draft</option>
</select>
</div>
<?php   endif;?>
        


<div class="form-group">
<label for="author">Post Image </label>
<input type="file"  name="image" >
</div>

<div class="form-group">
<label for="post_tags">Post Tags </label>
<input type="text" class="form-control" name="post_tags" required>
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea type="text" class="form-control" id='body' name="post_content" cols="30" rows="5"></textarea>
</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" class="form-control" name="create_post" value="Publish Post  ">
</div>




</form>