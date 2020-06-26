<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        
          <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

<?php  
include "db.php";

$query = "select * from categories";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){

$cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

$category_class = '' ;

$registration_class = '' ;

$page_name = basename($_SERVER['PHP_SELF']);

if(isset($_GET['category'])  && $_GET['category'] == $cat_id ){
  $category_class = 'active' ;
}elseif($page_name == 'registration.php'){
  
$registration_class = 'active' ;
}

  

    echo "<li class='$category_class'><a href='category.php?category=$cat_id''>{$cat_title}</a></li>";

}

?>

</ul>
<ul class="nav navbar-nav navbar-right">

<?php if(isset($_SESSION['role'])) : ?>
            <li>
              <a href="admin">Admin</a>
            </li>
            <li>
              <a href="includes/logout.php">logout</a>
            </li>

<?php else : ?>

<li class='<?php echo $registration_class?>'>
              <a href="registration.php">Registration</a>
            </li>
            <li>
              <a href="login.php">Login</a>
            </li>

<?php endif; ?>

            

            

            <!-- <li>
              <a href="#">Services</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li> -->
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>