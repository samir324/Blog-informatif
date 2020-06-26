<?php  include "db.php";?>
<?php  session_start()?>



<?php

if(isset($_POST['login_user'])){

$user_name =   $_POST['user_name'];
$user_password =  $_POST['user_password'];

$user_name = mysqli_real_escape_string($connection , $user_name);
$user_password = mysqli_real_escape_string($connection , $user_password);

$query = "select * from users where user_name = '{$user_name}'";

$login = mysqli_query($connection , $query) ;
if(!$login){
    die(mysqli_error($connection));
}



while($row = mysqli_fetch_assoc($login)){

    $db_user_id = $row['user_id'];
    $db_user_name = $row['user_name'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_email = $row['user_email'];
    $db_user_password = $row['user_password'];
    $db_user_role = $row['user_role'];
}



if(password_verify($user_password , $db_user_password)){
    header('location: ../admin');
    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_user_name ;
    $_SESSION['firstname'] = $db_user_firstname ;
    $_SESSION['lastname'] = $db_user_lastname ;
    $_SESSION['email'] = $db_user_email;
    $_SESSION['role'] = $db_user_role ;

}else{
    header('location: ../index.php');
}





}

?>