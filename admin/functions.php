<?php

function escape($string){

  return  mysqli_real_escape_string($connection , trim($string));

}

function insert_categories(){

    global $connection;
    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];
        
        if($cat_title == "" || empty($cat_title)){
            echo'this field should not be empty';
        }else{
            $query = "insert into categories(cat_title) ";
            $query .= " value('{$cat_title}') ";
        
            $add_category = mysqli_query($connection , $query);
        
            if(!$add_category){
                die('error' .mysqli_error($connection));
            }
        
        }
        
        
        }
}
function select_categories(){

    global $connection;

    $query = "select * from categories";
    $result = mysqli_query($connection , $query);
    
    while($row = mysqli_fetch_assoc($result)){
    
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        
     echo   "<tr>";
     echo       "<th>{$cat_id}</th>";
     echo      "<th>{$cat_title}</th>";

        if($_SESSION['role'] !== 'admin'):

           else:
        echo      "<th><a href='categories.php?delete={$cat_id}'>Delete</a></th>";
     echo      "<th><a href='categories.php?edit={$cat_id}'>Edit</a></th>";
          endif;
     
     echo   "</tr>";
    
    
    
    
    }
}
function delete_categories(){

    global $connection;
    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];
   
    $query = "delete from categories where cat_id = {$cat_id}";
   $result = mysqli_query($connection , $query);
   header('location: categories.php');
   }

   
}








function redirect($location){


    header("Location:" . $location);
    

}

function query($query){

    global $connection;

    return   mysqli_query($connection , $query);

}

function confirmQuery($result) {
    
    global $connection;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($connection));
   
          
      }
    

}


function username_exist($username){

    global $connection ; 

    $query = "SELECT user_name from users where user_name = '{$username}'";
    $result = mysqli_query($connection , $query);

    if(!$result ){

        die(mysqli_error($connection));
    }
    
    if(mysqli_num_rows($result) > 0){
        return true ; 

    }else {
        return false ;
    }

}

function email_exist($email){

    global $connection ; 

    $query = "SELECT user_name from users where user_email = '{$email}'";
    $result = mysqli_query($connection , $query);

    if(!$result ){

        die(mysqli_error($connection));
    }
    
    if(mysqli_num_rows($result) > 0){
        return true ; 

    }else {
        return false ;
    }

}


function itIsMethod($method){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true ;
    }else{
         return false ;
    }
   
}

function isLoggedIn(){

if(isset($_SESSION['role'] )){

    return true ;
}
return false ;


}

function loggedInUser(){

    if(isLoggedIn()){

        $result = query("SELECT * from users where user_name='{$_SESSION["username"]}'");
        $user = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) >=1){

            return $user['user_id'];
        }

    }
    return false;
}

function userLiked($post_id = ''){

$result = query( "SELECT * from likes where user_id=".loggedInUser()." AND post_id={$post_id}");

 return mysqli_num_rows($result) >= 1 ? true : false ;
}




function redirected($direction=null){

    if(isLoggedIn()){

        header('location:' .$direction);

    }
}

function login_user($username, $password){

    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection , $username);
    $password = mysqli_real_escape_string($connection , $password);


    $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));

    }


    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id = $row['user_id'];
        $db_username = $row['user_name'];
        $db_user_password = $row['user_password'];
        $db_user_email = $row['user_email'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];


        if (password_verify($password,$db_user_password)) {
            header('location: admin');
            $_SESSION['user_id'] = $db_user_id;
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['email'] = $db_user_email;
            $_SESSION['role'] = $db_user_role;



            


        } else {


            return false;



        }



    }

    return true;

}


function email_exists($email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }



}