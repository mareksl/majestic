<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <?php require_once 'stylesheets.php'; ?>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php require_once 'navigation.php'; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Blank</h1>
                        <?php
if (isset($_GET['success'])) {
    if ($_GET['success'] == '1') {
        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Password changed successfully! On next login use new password!</div>
                        <?php
    } elseif ($_GET['success'] == '2') {
        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Old password incorrect!</div>
                        <?php
    }
} ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">User Info</div>
                                            <div class="panel-body">
                                                <p>Username: <span class="text-primary"><?php echo $_SESSION['login_user']?></span></p>
                                                <p>User Level: <span class="text-primary">
              <?php
              switch ($_SESSION['login_level']) {
              case '0':
                echo 'User';
                break;
              case '1':
                echo 'Moderator';
                break;
                case '2':
                echo 'Admin';
              }
              ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Change Password</div>
                                            <div class="panel-body">
                                                <form role="form" action="process.php" method="post" class="" id="change_pass">
                                                    <input type="hidden" name="process" value="change_pass">
                                                    <input type="hidden" name="username" value="<?php echo $_SESSION['login_user']; ?>">
                                                    <div class="form-group">
                                                        <label>Old Password: </label>
                                                        <input id="pass" type="password" class="form-control" name="password" required />
                                                    </div>
                                                    <div id="passgroup" class="form-group">
                                                        <label>Confirm Old Password: </label>
                                                        <input id="conf_pass" type="password" class="form-control" required />
                                                        <p id="passerror" class="help-block text-danger"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>New Password: </label>
                                                        <div class="form-group input-group">
                                                            <input id="pass_new" type="password" class="form-control" name="password_new" required />
                                                            <span class="input-group-btn">
                                              <button class="btn btn-default" type="button" id="pass-btn" onclick="randomize_new();"><span>Random</span>
                                                            </button>
                                                            </span>
                                                        </div>
                                                        <div class="well" id="randompass" style="display:none;"></div>
                                                    </div>
                                                    <div id="passgroup_new" class="form-group">
                                                        <label>Confirm New Password: </label>
                                                        <input id="conf_pass_new" type="password" class="form-control" required />
                                                        <p id="passerror_new" class="help-block text-danger"></p>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button type="submit" class="btn btn-primary" form="change_pass" onclick="return Validate_new();">Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php require_once 'scripts.php'; ?>
    <script src="js/randompass.js" charset="utf-8"></script>
    <?php $conn->close(); ?>
</body>

</html>
