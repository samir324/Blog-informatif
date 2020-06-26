
<?php
if(isset($_POST['create_user'])){


$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_name = $_POST['user_name'];
$user_role = $_POST['user_role'];

$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$password = password_hash($user_password , PASSWORD_BCRYPT , array('cost' => 12));


$query = "insert into users( user_firstname, user_lastname, user_name, user_role,   user_email, user_password) ";
$query .= " value('{$user_firstname}','{$user_lastname}','{$user_name}','{$user_role}','{$user_email}','{$password}' ) ";
$creat_post = mysqli_query($connection , $query);
if(!$creat_post){
    die(mysqli_error($connection));
}

header('location:users.php');

}
?>


<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">FirstName </label>
<input type="text" class="form-control" name="user_firstname" required>
</div>


<div class="form-group">
<label for="author">Lastname </label>
<input type="text" class="form-control" name="user_lastname" required>
</div>

<div class="form-group">
<label for="author">Username </label>
<input type="text" class="form-control" name="user_name" required>
</div>

<div class="form-group">
<label for="user_role">Role </label>
<select name="user_role" class="form-control" >
<option value="admin">Admin</option>
<option value="subscriber">Subscriber</option>
</select>
</div>



<div class="form-group">
<label for="user_email">Email </label>
<input type="email" class="form-control" name="user_email" required>
</div>

<div class="form-group">
<label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password" required>
</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" class="form-control" name="create_user" value="Add User">
</div>




</form>