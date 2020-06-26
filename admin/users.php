<?php include 'includes/header.php'?> 
<?php if($_SESSION['role'] !== 'admin'){

    header('location:dashboard.php');
}?> 

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'?> 



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Users
                        </h1>

<?php
if(isset($_GET['source'])){

    $source = $_GET['source'];

}else{
    $source = '';
}
switch ($source ) {

        case 'add_user':
            include 'includes/add-user.php';
        break;
        case 'edit_user':
            include 'includes/edit-user.php';
        break;
    
    default:
        include 'includes/all-users.php';
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