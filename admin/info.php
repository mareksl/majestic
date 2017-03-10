<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.6.3/metisMenu.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <?php
                        $sql = 'SELECT * FROM tbl_info';
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc()
                      ?>
                        <h1 class="page-header">O nas</h1>
                        <form id="form_info">
                          <input type="hidden" name="process" value="edit_details">
                            <div class="panel panel-default">
                                <div class="panel-heading">Informacje o stronie</div>
                                <div class="panel-body row">
                                    <fieldset class="col-md-6 form-group">
                                        <label>O nas</label>
                                        <textarea class="form-control" rows="8" name="description" <?php if ($_SESSION[ 'login_level']=='0' ) {echo 'disabled';}?>><?php echo $row['description']; ?></textarea>
                                    </fieldset>
                                    <fieldset class="col-md-6">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input class="form-control" value="<?php echo $row['link_facebook']; ?>" name="link_facebook" <?php if ($_SESSION[ 'login_level']=='0' ) {echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                            <label>Spotify</label>
                                            <input class="form-control" value="<?php echo $row['link_spotify']; ?>" name="link_spotify" <?php if ($_SESSION[ 'login_level']=='0' ) {echo 'disabled';}?>>
                                        </div>
                                        <div class="form-group">
                                            <label>YouTube</label>
                                            <input class="form-control" value="<?php echo $row['link_youtube']; ?>" name="link_youtube" <?php if ($_SESSION[ 'login_level']=='0' ) {echo 'disabled';}?>>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="panel-footer">
                                    <fieldset <?php if ($_SESSION[ 'login_level']=="0" ) {echo " disabled>";}?>>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" form="form_info">Zapisz</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.6.3/metisMenu.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7+1/js/sb-admin-2.min.js" charset="utf-8"></script>
    <script src="js/script.js" charset="utf-8"></script>
</body>

</html>
