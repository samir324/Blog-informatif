<?php
include "includes/header.php"
?>
    <!-- Navigation -->
  <?php
include "includes/navigation.php"
?>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-md-8">
    


  <?php

$query = "select * from posts where post_status = 'published' ";
$result = mysqli_query($connection , $query);

$count = mysqli_num_rows($result);

$pages = ceil($count / 5) ; 

if(isset($_GET['page'])){

  $page = $_GET['page'];
  if($page == 0){
    header('location:index.php');
  }

  $page_num = $page * 5;
}else{
  $page_num = 0;
  $page = 0;
}



$query = "SELECT * from posts where post_status = 'published'  limit {$page_num} , 5 ";
$result = mysqli_query($connection , $query);

if(mysqli_num_rows($result) == 0 ){

  echo '<h1 class="text-center">No Post Published</h1> ';
}else{

  ?>
  <h1 class="page-header">
        Home Page
       
      </h1>
  <?php

while($row = mysqli_fetch_assoc($result)){

  $post_id = $row['post_id'];
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_status = $row['post_status'];
  $post_content = substr($row['post_content'],0,200) ;


?>

    
 
      <!-- First Blog Post -->
      <h2>
        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
      </h2>
      <p class="lead">by <a href="author.php?author=<?php echo $post_author ?>"><?php echo $post_author ?></a></p>
      <p>
        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?>
      </p>
      <hr />

      <a href="post.php?p_id=<?php echo $post_id ?>">
      <img
        class="img-responsive"
        src="img/<?php echo $post_image ?>"
        alt=""
      /></a>
      <hr />
      <p>
      <?php echo $post_content ?>
      </p>
      <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>"
        >Read More <span class="glyphicon glyphicon-chevron-right"></span
      ></a>
      <hr />


<?php
}
}

?>

<div class='pager'>



<?php



for($i =0 ; $i < $pages ; $i++ ){

  $j = $i + 1 ;

if($i ==  $page){

echo "<li ><a class='active_link' href='index.php?page={$i}'>{$j}</a></li>";


}else{
    echo "<li ><a href='index.php?page={$i}'>{$j}</a></li>";

}

}
?>
</div>
    
    
      <!-- Second Blog Post -->
    
      <!-- Pager -->
    
    </div>
    <!-- Blog Sidebar Widgets Column -->
  
    <?php
include "includes/sidebar.php"
?>
      </div>
      <!-- /.row -->

      <hr />
<?php
include "includes/footer.php"
?>