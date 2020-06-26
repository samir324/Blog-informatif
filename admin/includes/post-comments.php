<table class='table table-hover'>
<thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>date</th>
        <th>status</th>
        <th>In Responde to </th>
        <th>Approve</th>
        <th>Unapprove</th>
        
        
    </tr>
</thead>
<tbody>
<?php


$query = "select * from comments where comment_post_author = '{$_SESSION['username']}' ";
$result = mysqli_query($connection , $query);



while($row = mysqli_fetch_assoc($result)){


$comment_id = $row['comment_id'];
$comment_author = $row['comment_author'];
$comment_date = $row['comment_date'];
$comment_email = $row['comment_email'];
$comment_status = $row['comment_status'];
$comment_post_id = $row['comment_post_id'];
$comment_content = $row['comment_content'];



echo '<tr>';
echo"<th>$comment_id</th>";
echo"<th>$comment_author</th>";
echo"<th>$comment_content</th>";
echo"<th>$comment_email</th>";
echo "<th>$comment_date</th>";
echo "<th>$comment_status</th>";

$query = "select * from posts where post_id = $comment_post_id ";
$results = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($results)){

$post_id = $row['post_id'];
$post_title = $row['post_title'];

echo"<th><a href='../post.php?p_id=$post_id'>$post_title</a></th>";
}
if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];
$path = "p_id=$p_id&";
}else {
    $path = '';
}

echo "<th><a href='comments.php?{$path}approve={$comment_id}'>Approve</a></th>";
echo "<th><a href='comments.php?{$path}unapprove={$comment_id}'>Unapprove</a></th>";
echo "<th><a href='comments.php?{$path}delete={$comment_id}'>Delete</a></th>";

echo "</tr>";




}

if(isset($_GET['approve'])){
    $comment_id = $_GET['approve'];

$query = "update comments set comment_status = 'approved' where comment_id = $comment_id";
$result = mysqli_query($connection , $query);
if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];
header("location: comments.php?p_id=$p_id");
}else {
    header('location: comments.php');
}

}

if(isset($_GET['unapprove'])){
    $comment_id = $_GET['unapprove'];

$query = "update comments set comment_status = 'unapproved' where comment_id = $comment_id";
$result = mysqli_query($connection , $query);
if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];
    header("location: comments.php?p_id=$p_id");
}else {
    header('location: comments.php');
}
}

if(isset($_GET['delete'])){

    $comment_id = $_GET['delete'];

$query = "delete from comments where comment_id = {$comment_id}";
$result = mysqli_query($connection , $query);

$query = "update posts set post_comment_count =  post_comment_count - 1  where post_id ={$comment_post_id}";
$update_count = mysqli_query($connection , $query);


if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];
    header("location: comments.php?p_id=$p_id");
}else {
    header('location: comments.php');
}
}

?>


                        <a href=""></a>
                            </tbody>
                        </table>