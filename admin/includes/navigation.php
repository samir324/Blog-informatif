<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">CMS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            <li><a href="../index.php">HOME</a></li>
     

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'].  " " .$_SESSION['lastname'] ; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                    
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <?php   if($_SESSION['role'] !== 'admin'):?>

                <?php   else:?>
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <?php   endif;?>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> My Data</a>
                    </li>
            
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-file"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts" class="collapse">
                            <li>
                                <a href="posts.php">View All posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa  fa-list"></i> Categories</a>
                    </li>
                    <?php   if($_SESSION['role'] !== 'admin'):?>

<?php   else:?>
   <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo1" class="collapse">
                            <li>
                                <a href="users.php">view All Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add User</a>
                            </li>
                        </ul>
                    </li>
<?php   endif;?>
<?php   if($_SESSION['role'] == 'admin'):?>
 <li >
                        <a href="comments.php"><i class="fa fa-comments"></i></i> Comments</a>
                    </li>
<?php   else:?>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#comment"><i class="fa fa-comments"></i> Comments <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="comment" class="collapse">
                            <li>
                                <a href="comments.php">My Comment</a>
                            </li>
                            <li>
                                <a href="comments.php?source=my">Comment On My Posts</a>
                            </li>
                        </ul>
                    </li>
                    <?php   endif;?>
                    <li>
                        <a href="myprofile.php"><i class="fa fa-user"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>