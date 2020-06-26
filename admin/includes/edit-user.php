
<?php

if(isset($_GET['u_id'] )){
    $user_id = $_GET['u_id'];

$query = "select * from users where user_id=$user_id ";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){


    
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];

}

if(isset($_POST['edit_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_name = $_POST['user_name'];
    $user_role = $_POST['user_role'];
    
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $password = password_hash( $user_password , PASSWORD_BCRYPT , array('cost' => 12));



$query = "update users set ";
$query .= "user_firstname = '{$user_firstname}', ";
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_role = '{$user_role}', ";


$query .= "user_name = '{$user_name}', ";
$query .= "user_email = '{$user_email}', ";
$query .= "user_password = '{$password}' ";
$query .= "where user_id = '{$user_id}' ";

$update_user = mysqli_query($connection , $query);
if(!$update_user){
    die(mysqli_error($connection));
}

header('location: users.php');

}

}

?>



<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
<label for="title">FirstName </label>
<input type="text" class="form-control" value="<?php echo $user_firstname?>" name="user_firstname" required>
</div>



<div class="form-group">
<label for="author">Lastname </label>
<input type="text" class="form-control" value="<?php echo $user_lastname?>" name="user_lastname" required>
</div>

<div class="form-group">
<label for="author">Username </label>
<input type="text" class="form-control" value="<?php echo $user_name?>" name="user_name" required>
</div>

<div class="form-group">
<label for="user_role">Role </label>
<select name="user_role" class="form-control" >
<option <?php if($user_role == "admin" ) echo 'selected' ?> value="admin">Admin</option>
<option <?php if($user_role == "subscriber" ) echo 'selected' ?> value="subscriber">Subscriber</option>
</select>
</div>



<div class="form-group">
<label for="user_email">Email</label>
<input type="email" class="form-control" value="<?php echo $user_email?>" name="user_email" required>
</div>

<div class="form-group">
<label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password" required>
</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" class="form-control" name="edit_user" value="update User">
</div>




</form>