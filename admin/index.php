<?php include 'includes/header.php';

if($_SESSION['role'] !== 'admin'){
header('location:dashboard.php');
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
                            Welcome to admin 
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->

<?php


// post 
$query = "select * from posts";
$result = mysqli_query($connection , $query);
$post_counts = mysqli_num_rows($result);



$query = "select * from posts where post_status = 'draft'";
$result = mysqli_query($connection , $query);
$drift_post_counts = mysqli_num_rows($result);

//  comment 
$query = "select * from comments";
$result = mysqli_query($connection , $query);
$comment_counts = mysqli_num_rows($result);



$query = "select * from comments where comment_status='unapproved'";
$result = mysqli_query($connection , $query);
$unapp_comment_counts = mysqli_num_rows($result);



$query = "select * from users";
$result = mysqli_query($connection , $query);
$user_counts = mysqli_num_rows($result);

$query = "select * from users where user_role = 'subscriber'";
$result = mysqli_query($connection , $query);
$sub_user_counts = mysqli_num_rows($result);


$query = "select * from categories";
$result = mysqli_query($connection , $query);
$category_counts = mysqli_num_rows($result);



?>


                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">



                    
                  <div class='huge'><?php echo $post_counts?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">



                     <div class='huge'><?php echo $comment_counts?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">


                    <div class='huge'><?php echo $user_counts?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">


                        <div class='huge'><?php echo $category_counts?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->


<div class="row">
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['', 'Count'],
      ['Posts', <?php echo $post_counts?>],
      ['Draft Posts', <?php echo $drift_post_counts?>],
      ['Comments', <?php echo $comment_counts?>],
      ['Unpproved Comments', <?php echo $unapp_comment_counts?>],
      ['Users', <?php echo $user_counts?>],
      ['subscribers', <?php echo $sub_user_counts?>],
      ['Categories', <?php echo $category_counts?>],
      
     
    ]);
    var options = {
      chart: {
        title: '',
        subtitle: '',
      }
    };
    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

<div id="columnchart_material" style="width: 'auto'; height: 380px;"></div>

</div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
