<?php
session_start();
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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // username and password received from loginform
$username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $sql_query = "SELECT id, level FROM tbl_users WHERE username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql_query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result); // If result matched $username and $password, table row must be 1 row
$level = $row['level'];
    if ($count == 1) {
        $_SESSION['login_user'] = $username;
        $_SESSION['login_level'] = $level;
        header('location: index.php');
    } else {
        ?>
<script type="text/javascript">
window.onload = function() {
document.getElementById('invalid').innerHTML ='<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Invalid username or password.</div>';
}
</script>
<?php

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <?php require_once 'stylesheets.php'; ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                      <div id="invalid">
                      </div>
                        <form role="form" method="post" name="form_login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" value="" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" value="" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'scripts.php'; ?>
    <?php $conn->close(); ?>
</body>


</html>
