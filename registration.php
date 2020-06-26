
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>


<?php 
$message =  '';




if( isset($_POST['submit'])){
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);



if(username_exist($username)){
    $message =  'User exist';
}elseif(email_exist($email)){
    $message =  'Email exist';
}else {
if(!empty($username) && !empty($email) && !empty($password) ){
    $firstname = mysqli_real_escape_string($connection , $firstname );
    $lastname = mysqli_real_escape_string($connection , $lastname );
    $username = mysqli_real_escape_string($connection , $username );
    $email = mysqli_real_escape_string($connection , $email );
    $password = mysqli_real_escape_string($connection , $password );


$password = password_hash($password , PASSWORD_BCRYPT , array('cost' => 12));

$query = "insert into users( user_firstname , user_lastname ,  user_name,   user_email, user_password, user_role) ";
$query .= " value('{$firstname}','{$lastname}','{$username}','{$email}','{$password}','subscriber' ) ";
$creat_user = mysqli_query($connection , $query); 

header('location:index.php');

    }
    }
    


    }
    
    
    ?>
    

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <?php echo"<h4 class=' text-center bg-danger'> $message</h4>"?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off" >
                        <div class="form-group">
                            <label for="username" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control"  placeholder="Enter Firstname" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Register">
                    </form>
                
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
