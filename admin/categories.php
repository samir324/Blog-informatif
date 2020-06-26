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
                            Categories
                        </h1>

                        <div class="col-xs-6">


<?php

insert_categories() ;

?>



<?php   if($_SESSION['role'] !== 'admin'):?>

<?php   else:?>
    <form action="" method="post">
                        <div class="form-group">
                        <label for="">Add category</label>
                        <input class="form-control" type="text" name="cat_title" >
                        </div>
                        <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category" >
                        </div>
                        </form>
<?php   endif;?>


                    

<?php
if(isset($_GET['edit'])){

    $cat_id = $_GET['edit'];
    include 'includes/edit-category.php';
}

?>
                        </div>
                        <?php   if($_SESSION['role'] !== 'admin'):?>
 <div class="col-xs-12">
<?php   else:?>
 <div class="col-xs-6">
<?php   endif;?>

<table class='table table-hover'>
    <thead>
        <tr>
            <th>Id</th>
            
            <th>Category Title</th>
        </tr>
    </thead>
    <tbody>
    <?php  


select_categories() ;

delete_categories();



?>
                            

                            </tbody>
                        </table>
                        </div>


                       
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