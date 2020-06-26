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

if(isset($_GET['category'])){

    $cat_id = $_GET['category'];



$stmt = mysqli_prepare($connection ,"SELECT post_id ,post_title , post_author ,post_date  ,post_image , post_content from posts where category_id= ? and post_status = ?" ) ;
$published = 'published';
mysqli_stmt_bind_param($stmt , 'is' ,$cat_id , $published);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt , $post_id , $post_title , $post_author ,$post_date  ,$post_image , $post_content );
mysqli_stmt_store_result($stmt);



if(mysqli_stmt_num_rows($stmt) === 0 ){

  echo '<h1 class="text-center">No Post in this category </h1> ';
}else{

  ?>
      <h2 class="page-header">
       <?php
        $query = "select * from categories where cat_id = $cat_id";
        $result = mysqli_query($connection , $query);
        
        while($row = mysqli_fetch_assoc($result)){
        
            $cat_title = $row['cat_title'];
            echo $cat_title . '<small> Posts </small>' ;
        }
       ?>
      </h2>
  <?php

while(mysqli_stmt_fetch($stmt)){


 
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
      <img
        class="img-responsive"
        src="img/<?php echo $post_image ?>"
        alt=""
      />
      <hr />
      <p>
      <?php echo $post_content ?>
      </p>
      <a class="btn btn-primary" href="#"
        >Read More <span class="glyphicon glyphicon-chevron-right"></span
      ></a>
      <hr />


<?php
}
}
}
?>

    
    
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