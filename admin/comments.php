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
                            Comment
                        </h1>

<?php
if(isset($_GET['source'])){

    $source = $_GET['source'];

}else{
    $source = '';
}
switch ($source ) {

       case 'my' :
        include 'includes/post-comments.php';
        break;
    default:
        include 'includes/all-comments.php';
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

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>