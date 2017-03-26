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
                        <h1 class="page-header">Ustawienia użytkownika</h1>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Informacje o użytkowniku</div>
                                            <div class="panel-body">
                                                <p>Nazwa użytkownika: <span class="text-primary"><?php echo $_SESSION['login_user']?></span></p>
                                                <p>Poziom użytkownika: <span class="text-primary">
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
                                            <div class="panel-heading">Zmień Hasło</div>
                                            <div class="panel-body">
                                                <form name="form-change-pass" id="change_pass">
                                                    <input type="hidden" name="process" value="change_pass">
                                                    <input type="hidden" name="username" value="<?php echo $_SESSION['login_user']; ?>">
                                                    <div class="form-group">
                                                        <label>Stare hasło: </label>
                                                        <input id="pass" type="password" class="form-control" name="password" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nowe hasło: </label>
                                                        <div class="form-group input-group">
                                                            <input id="pass_new" type="password" class="form-control" name="password_new" required />
                                                            <span class="input-group-btn">
                                              <button class="btn btn-default" type="button" id="pass-btn"><span>Losowe</span>
                                                            </button>
                                                            </span>
                                                        </div>
                                                        <div class="well" id="randompass" style="display:none;"></div>
                                                    </div>
                                                    <div id="passgroup_new" class="form-group">
                                                        <label>Potwierdź nowe hasło: </label>
                                                        <input id="conf_pass_new" type="password" class="form-control" name="password_confirm" required />
                                                        <p id="passerror_new" class="help-block text-danger"></p>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button type="submit" class="btn btn-primary" id="btn-submit-passchange" form="change_pass">Change</button>
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
    <script src="js/edit_info.js" charset="utf-8"></script>
    <?php $conn->close(); ?>
</body>

</html>
