
<?php 
if(isset($_POST['checkBoxArray'])){

    foreach($_POST['checkBoxArray'] as $post_id){

     $bulk_option = $_POST['bulk_option'] ;

    switch ($bulk_option) {
        case 'published':
            
            $query = "update posts set post_status = '{$bulk_option}' where post_id = $post_id ";
            $result = mysqli_query($connection , $query);

            break;
        case 'draft':
            
            $query = "update posts set post_status = '{$bulk_option}' where post_id = $post_id ";
            $result = mysqli_query($connection , $query);

            break;
        case 'delete':
            
            $query = "delete from posts where post_id = $post_id ";
            $result = mysqli_query($connection , $query);

            break;

        case 'clone':
            
            $query = "select * from posts where post_id = $post_id ";
            $result = mysqli_query($connection , $query);

            while($row = mysqli_fetch_assoc($result)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_status = $row['post_status'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_category_id = $row['category_id'];
            $post_content = $row['post_content'];
        }

        $query = "insert into posts(category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= " value({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";
        $creat_post = mysqli_query($connection , $query);

            break;
        
        default:
            header('location:posts.php');
            break;
    }

    }

}

?>

<form action="" method="post">

<table class='table table-hover'>

<?php if($_SESSION['role']  == 'admin' ) {?>

<div id='bulkOptionContainer' class='col-xs-4'>

<select class='form-control' name="bulk_option" id="">
    <option value="">Select Option</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="delete">Delete</option>
    <option value="clone">Clone</option>
</select>

</div>
<div class="col-xs-4">
    <input type="submit" name='submit' class='btn btn-success' value="Apply">
    <a class='btn btn-primary' href="posts.php?source=add_post">Add New</a>
</div>
<?php }?>
<thead>
    <tr>
        <th><input type="checkbox"  id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Date</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comment</th>
        <th>Views</th>
    </tr>
</thead>
<tbody>
<?php
if($_SESSION['role'] !== 'admin'){
    $username = $_SESSION['username'];
    $author = "where post_author = '{$username}'";

}else{
    $author = '';
}
$query = "select * from posts $author order by  post_id desc ";
$result = mysqli_query($connection , $query);



while($row = mysqli_fetch_assoc($result)){
$post_id = $row['post_id'];
$post_title = $row['post_title'];
$post_author = $row['post_author'];
$post_date = $row['post_date'];
$post_image = $row['post_image'];
$post_status = $row['post_status'];
$post_tags = $row['post_tags'];
$post_category_id = $row['category_id'];
$post_content = $row['post_content'];
$post_views = $row['post_views_count'];



echo '<tr>';

echo"<th><input type='checkbox' class='checkbox' name='checkBoxArray[]' value='$post_id' ></th>";
echo"<th>$post_id</th>";
echo"<th>$post_author</th>";
echo"<th>$post_title</th>";
echo"<th>$post_date</th>";

$query = "select * from categories where cat_id = $post_category_id ";
$results = mysqli_query($connection , $query);

while($rows = mysqli_fetch_assoc($results)){
$cat_title = $rows['cat_title'];
echo "<th>$cat_title</th>";

}





echo "<th>$post_status</th>";
echo "<th><img width='60px' src='../img/$post_image' ></th>";
echo "<th>$post_tags</th>";
$query = "SELECT * from comments where comment_post_id = $post_id";
$results = mysqli_query($connection , $query);

$row_num = mysqli_num_rows($results);
if($row_num == 0){
echo"<th>$row_num</th>";
}else {
    echo"<th><a href='comments.php?p_id=$post_id'>$row_num</a></th>";
}



echo"<th>$post_views</th>";
echo "<th><a href='../post.php?p_id=$post_id'>View Post</a></th>";
echo "<th><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></th>";
echo "<th><a onClick=\" return confirm('are you sure you want to delete this post')\" href='posts.php?delete={$post_id}'>Delete</a></th>";
echo "</tr>";





}

if(isset($_GET['delete'])){
    $post_id = $_GET['delete'];

$query = "delete from posts where post_id = {$post_id}";
$result = mysqli_query($connection , $query);
header('location: posts.php');
}

?>



    </tbody>
</table>
</form>