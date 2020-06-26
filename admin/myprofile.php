<?php include 'includes/header.php';?> 


<?php
if(isset($_SESSION['username'])){

$session_user_name = $_SESSION['username'] ;

$query = "select * from users where user_name= '{$session_user_name}'";
$result = mysqli_query($connection , $query);

while($row = mysqli_fetch_assoc($result)){


    
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

}
}
?>


    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
               
                <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="../img/<?php echo $user_image  ?>" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <h2> <?php echo $user_name  ?></h2>
                        <hr>
                       
                        <h4><?php echo ucfirst($user_firstname)  . ' '. ucfirst($user_lastname)  ?> </h4>
                  
                            <h4><?php echo $user_email ?> </h4>

                            <h4><?php echo ucfirst($user_role) ?> </h4>

                            <hr>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a href="edit-profile.php"><button type="button" class="btn btn-primary">
                                Edit</button></a>
                          
                        </div>
                    </div>
                </div>
            </div>
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



