<table class='table table-hover'>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>

<img  width='20'  src="../img/" alt="">
                            <?php
$query = "select * from users";
$result = mysqli_query($connection , $query);



while($row = mysqli_fetch_assoc($result)){


$user_id = $row['user_id'];
$user_name = $row['user_name'];
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
$user_email = $row['user_email'];
$user_role = $row['user_role'];
$user_image = $row['user_image'];




echo '<tr>';
echo"<th> $user_id</th>";
echo"<th><img  width='20'  src='../img/$user_image' >$user_name</th>";
echo"<th>$user_firstname</th>";
echo"<th>$user_lastname</th>";
echo"<th>$user_email</th>";
echo "<th>$user_role</th>";




echo "<th><a href='users.php?admin={$user_id}'>Admin</a></th>";
echo "<th><a href='users.php?subscriber={$user_id}'>Subscriber</a></th>";
echo "<th><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></th>";
echo "<th><a href='users.php?delete={$user_id}'>Delete</a></th>";


echo "</tr>";




}


if(isset($_GET['admin'])){
    $user_id = $_GET['admin'];

$query = "update users set user_role = 'admin' where user_id = $user_id";
$result = mysqli_query($connection , $query);
header('location: users.php');
}

if(isset($_GET['subscriber'])){
    $user_id = $_GET['subscriber'];

    $query = "update users set user_role = 'subscriber' where user_id = $user_id";
    $result = mysqli_query($connection , $query);
header('location: users.php');
}


if(isset($_GET['delete'])){

    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'admin'){
            
    $user_id = $_GET['delete'];

$query = "delete from users where user_id = {$user_id}";
$result = mysqli_query($connection , $query);




header('location: users.php');
        }
    }

}

?>


                        <a href=""></a>
                            </tbody>
                        </table>