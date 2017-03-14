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
                        <?php
                        $sql = 'SELECT * FROM tbl_info';
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc()
                      ?>
                        <h1 class="page-header">O nas</h1>
                        <form name="form-info">
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
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Zapisz</button>
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
    <?php require_once 'scripts.php'; ?>
    <script src="js/edit_info.js" charset="utf-8"></script>
    <?php $conn->close(); ?>
</body>

</html>
