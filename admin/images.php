<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <?php require_once 'stylesheets.php'; ?>
    <link rel="stylesheet" href="css/style.css">
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
                        <h1 class="page-header">Galeria</h1>
                        <div class="panel panel-default" id="result">
                            <div class="panel-heading">
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#AddPictures">Dodaj Zdjęcia</button>
                                <div class="modal fade" id="AddPictures" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Dodaj zdjęcia <b>(max. 10 plików / 20MB)</b></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <form action="process.php" method="post" enctype="multipart/form-data" id="upload_form">
                                                        <div class="row">
                                                            <input type="hidden" name="process" value="add_pictures">
                                                            <div class="col-xs-6">
                                                                <div id="fileUpload" class="fileUpload btn btn-default"> <span id="uploadFile">Wybierz plik</span>
                                                                    <input id="uploadBtn" name="__files[]" class="upload" type="file" multiple="multiple" accept="image/*" />
                                                                    <!--multiple="multiple"-->
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <input id='fileSubmit' name="__submit__" type="submit" class="btn btn-primary" value="Załaduj" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div id="progress" class="progress progress-striped active">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100">0%</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div id="filelist" style="display:none;" class="well"></div>
                                                            <div id="output">
                                                                <!-- error or success results -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                            </div>
                            <div class="panel-body" id="panel">
                                <div class="row">
                                    <?php
                                $sql = 'SELECT COUNT(*) FROM tbl_pictures';
                                $result = $conn->query($sql);
                                $r = $result->fetch_row();
                                $numrows = $r[0];

                                // number of rows to show per page
                                $rowsperpage = 12;
                                // find out total pages
                                $totalpages = ceil($numrows / $rowsperpage);

                                // get the current page or set a default
                                if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
                                    // cast var as int
                                   $currentpage = (int) $_GET['currentpage'];
                                } else {
                                    // default page num
                                   $currentpage = 1;
                                } // end if

                                // if current page is greater than total pages...
                                if ($currentpage > $totalpages) {
                                    // set current page to last page
                                   $currentpage = $totalpages;
                                } // end if
                                // if current page is less than first page...
                                if ($currentpage < 1) {
                                    // set current page to first page
                                   $currentpage = 1;
                                } // end if

                                // the offset of the list, based on current page
                                $offset = ($currentpage - 1) * $rowsperpage;

                                // get the info from the db
                                $sql = "SELECT * FROM tbl_pictures LIMIT $offset, $rowsperpage";
                                $result = $conn->query($sql);

                                // while there are rows to be fetched...
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-lg-2 col-md-6 col-sm-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <p>
                                                    <?php echo $row['filename']?>
                                                    <p> <b>
                                      <?php if ($row['title'] !== '') {
                                        echo $row['title'];
                                    } else {
                                        echo '<p class="text-danger">Bez tytułu</p>';
                                    } ?>
                                      </b>
                                            </div>
                                            <div class="panel-body">
                                                <div class="image"> <img class="img-responsive" src="../img/gallery/<?php echo 'thumb_'.$row['filename']?>"></img>
                                                    <!-- "thumb_" . -->
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col-xs-6 text-danger"><a href="#" title="Delete" data-toggle="modal" data-target="#DeletePicture_<?php echo $row['ID']; ?>"><span class="fa fa-trash"></span> Usuń</a></div>
                                                    <div class="col-xs-6 text-right"><a href="#" title="Edit" data-toggle="modal" data-target="#EditPicture_<?php echo $row['ID']; ?>"><span class="fa fa-pencil"></span> Edytuj</a></div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="EditPicture_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edytuj Zdjęcie</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form name="form-edit-image" role="form" action="process.php" method="post" class="" id="edit_picture_<?php echo $row['ID']; ?>">
                                                                        <input type="hidden" name="process" value="edit_picture">
                                                                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                        <input type="hidden" name="page_id" value="<?php echo $_GET['currentpage']; ?>">
                                                                        <div class="form-group">
                                                                            <label> Tytuł: </label>
                                                                            <input class="form-control" name="title" <?php if ($row[ 'title'] !=='' ) { echo 'value="'.$row[ 'title']. '"'; } else { echo 'placeholder="Bez tytułu"'; } ?> />
                                                                        </div>
                                                                    </form>
                                                                    <div class="well"> <img class="img-responsive" src="../img/gallery/<?php echo $row['filename']; ?>"></img>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                                                    <button type="submit" class="btn btn-primary" form="edit_picture_<?php echo $row['ID']; ?>">Edytuj Zdjęcie</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                    <div class="modal fade" id="DeletePicture_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Usuń Zdjęcie</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <form name="form-edit-image" role="form" action="process.php" method="post" class="" id="delete_picture_<?php echo $row['ID']; ?>">
                                                                            <input type="hidden" name="process" value="delete_picture">
                                                                            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                            <input type="hidden" name="filename" value="<?php echo $row['filename']; ?>">
                                                                            <input type="hidden" name="page_id" value="<?php echo $_GET['currentpage']; ?>">
                                                                            <div class="alert alert-warning"> Na pewno chcesz usunąć zdjęcie? </div>
                                                                            <div class="well">
                                                                                <?php echo $row['filename']; ?> - <b>
                                                    <?php if ($row['title'] !== '') {
                                        echo $row['title'];
                                    } else {
                                        echo 'Bez tytułu';
                                    } ?>
                                                    </b> </div>
                                                                            <div class="well"> <img class="img-responsive" src="../img/gallery/<?php echo $row['filename']?>"></img>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                                                    <button id="delete" type="submit" class="btn btn-primary" form="delete_picture_<?php echo $row['ID']; ?>">Usuń Zdjęcie</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }?>
                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                <ul class="pagination pagination-lg">
                                    <?php
                        /******  build the pagination links ******/
                        // range of num links to show
                        $range = 3;

                        // if not on page 1, don't show back links
                        if ($currentpage > 1) {
                            // show << link to go back to page 1
                        echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a></li> ";
                        // get previous page num
                        $prevpage = $currentpage - 1;
                        // show < link to go back to 1 page
                        echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a></li> ";
                        } // end if

                        // loop to show links to range of pages around current page
                        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); ++$x) {
                            // if it's a valid page number...
                        if (($x > 0) && ($x <= $totalpages)) {
                            // if we're on current page...
                        if ($x == $currentpage) {
                            // 'highlight' it but don't make a link
                         echo " <li class=\"active\"><a href=\"#\">$x</a></li> ";
                        // if not current page...
                        } else {
                            // make it a link
                         echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li> ";
                        } // end else
                        } // end if
                        } // end for

                        // if not on last page, show forward and last page links
                        if ($currentpage != $totalpages) {
                            // get next page
                        $nextpage = $currentpage + 1;
                        // echo forward link for next page
                        echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a></li> ";
                        // echo forward link for lastpage
                        echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a></li> ";
                        } // end if
                        /****** end build pagination links ******/
                        ?>
                                </ul>
                            </div>
                            <!--<div class="panel-footer">
                        </div>
                        --></div>

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
<script src="js/image_upload.js" charset="utf-8"></script>
<script src="js/edit_info.js" charset="utf-8"></script>
<?php $conn->close(); ?>
</body>

</html>
