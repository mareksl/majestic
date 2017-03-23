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

                        <div class="panel panel-default">
                            <div class="panel-heading" id="resp">Pliki
                              <small>(Maksymalny rozmiar: 10MB)</small></div>
                            <div class="panel-body row">
                                <form enctype="multipart/form-data" name="form-upload-presspack" class="col-md-6 form-group">
                                  <div class="well">
                                  <p>
                                  <?php
                                  $sql = 'SELECT * FROM tbl_files WHERE filetype="presspack"';
                                  $result = $conn->query($sql);
                                  while ($row = $result->fetch_assoc()) {echo $row['filename'] . "<br>" . round(($row['filesize']/1024), 2) . " KB"; }?></p>
                                </div>
                                    <input type="hidden" name="process" value="upload_file">
                                    <input type="hidden" name="filetype" value="presspack">
                                    <fieldset class="form-group">
                                        <label>Press Pack</label>
                                        <input type="file" name="file">
                                    </fieldset>
                                    <fieldset <?php if ($_SESSION['login_level']=='0' ) { echo ' disabled'; }?>>
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </fieldset>
                                </form>

                                <form enctype="multipart/form-data" name="form-upload-rider" class="col-md-6 form-group">
                                  <div class="well">
                                  <p>
                                  <?php
                                  $sql = 'SELECT * FROM tbl_files WHERE filetype="rider"';
                                  $result = $conn->query($sql);
                                  while ($row = $result->fetch_assoc()) {echo $row['filename'] . "<br>" . round(($row['filesize']/1024), 2) . " KB"; }?></p>
                                </div>
                                    <input type="hidden" name="process" value="upload_file">
                                    <input type="hidden" name="filetype" value="rider">
                                    <fieldset class="form-group">
                                        <label>Rider</label>
                                        <input type="file" name="file">
                                    </fieldset>
                                    <fieldset <?php if ($_SESSION['login_level']=='0' ) { echo ' disabled'; }?>>
                                        <button type="submit" class="btn btn-primary">Zapisz</button>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="panel-footer">
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
