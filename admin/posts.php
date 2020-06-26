<?php include 'includes/header.php'?> 
    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Posts
                        </h1>

<?php
if(isset($_GET['source'])){

    $source = $_GET['source'];

}else{
    $source = '';
}
switch ($source ) {

        case 'add_post':
            include 'includes/add-post.php';
        break;
        case 'edit_post':
            include 'includes/edit-post.php';
        break;
    
    default:
        include 'includes/all-posts.php';
        break;
}

?>



                       
                    </div>
                </div>
                <!-- /.row -->

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