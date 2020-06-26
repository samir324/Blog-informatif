<?php include 'includes/header.php'?> 



<?php
if(isset($_SESSION['username'])){

$session_user_name = $_SESSION['username'] ;

$query = "select * from users where user_name= '{$session_user_name}'";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){


    
    $user_name = $row['user_name'];
    $user_image = $row['user_image'];
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
    $user_image = $_FILES['image']['name'];
$user_image_temp = $_FILES['image']['tmp_name'];
    
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($user_image_temp , "../img/$user_image");

    $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost' => 12));



$query = "update users set ";
$query .= "user_firstname = '{$user_firstname}', ";
$query .= "user_lastname = '{$user_lastname}', ";
 if($_SESSION['role'] == 'admin') {
$query .= "user_role = '{$user_role}', ";
 }

$query .= "user_image = '{$user_image}', ";
$query .= "user_name = '{$user_name}', ";
$query .= "user_email = '{$user_email}', ";
$query .= "user_password = '{$user_password}' ";
$query .= "where user_name = '{$session_user_name}' ";

$update_user = mysqli_query($connection , $query);
if(!$update_user){
    die(mysqli_error($connection));
}

header('location: users.php');

}

}

?>








    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit Profile
                        </h1>





                    </div>
                </div>
                <!-- /.row -->


                <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
<label for="author">Post Image </label><br>
<img width='100'  src="../img/<?php echo $user_image ?>" alt="">
<br>
<br>

<input type="file"  name="image">
</div>


<div class="form-group">
<label for="title">FirstName </label>
<input type="text" class="form-control" value="<?php echo $user_firstname?>" name="user_firstname">
</div>



<div class="form-group">
<label for="author">Lastname </label>
<input type="text" class="form-control" value="<?php echo $user_lastname?>" name="user_lastname">
</div>

<div class="form-group">
<label for="author">Username </label>
<input type="text" class="form-control" value="<?php echo $user_name?>" name="user_name">
</div>
<?php if($_SESSION['role'] == 'admin') {?>
<div class="form-group">
<label for="user_role">Role </label>
<select name="user_role" class="form-control" >
<option <?php if($user_role == "admin" ) echo 'selected' ?> value="admin">Admin</option>
<option <?php if($user_role == "subscriber" ) echo 'selected' ?> value="subscriber">Subscriber</option>
</select>
</div>
<?php } ?>


<div class="form-group">
<label for="user_email">Email</label>
<input type="email" class="form-control" value="<?php echo $user_email?>" name="user_email">
</div>

<div class="form-group">
<label for="post_content">Password</label>
<input type="password" class="form-control" name="user_password" required>
</div>

<div class="form-group">

<input class="btn btn-primary" type="submit" class="form-control" name="edit_user" value="Update Profile">
</div>




</form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>