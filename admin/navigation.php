<?php
// Database configuration
require 'config.php';

// Create connection
$conn = new mysqli($conn_server, $conn_user, $conn_pass, $conn_db);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
mysqli_query($conn, 'SET CHARSET utf8');
mysqli_query($conn, 'SET NAMES `utf8` COLLATE `utf8_general_ci`');
session_start();
if (!isset($_SESSION['login_user'])) {
    header('Location: login.php');
}
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="index.php">Majestic | Panel Admina</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="upanel.php"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['login_user']; ?></a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Główna</a>
                </li>
                <li>
                    <a href="info.php"><i class="fa fa-info fa-fw"></i> O nas</a>
                </li>
                <li>
                    <a href="events.php"><i class="fa fa-calendar fa-fw"></i> Wydarzenia</a>
                </li>
                <li>
                    <a href="images.php"><i class="fa fa-picture-o fa-fw"></i> Galeria</a>
                </li>
                <li>
                    <a href="videos.php"><i class="fa fa-play fa-fw"></i> Wideo</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-address-card-o fa-fw"></i> Kontakt<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="contact.php"><i class="fa fa-envelope fa-fw"></i> Informacje</a>
                        </li>
                        <li>
                            <a href="files.php"><i class="fa fa-upload fa-fw"></i> Pliki</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?php if ($_SESSION['login_level'] == '2') {?>
                <li>
                    <a href="users.php"><i class="fa fa-user fa-fw"></i> Użytkownicy</a>
                </li>
                <?php }?>
                <li>
                  <a href="#"><small>&copy; Marek Sładczyk 2017</small></a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
