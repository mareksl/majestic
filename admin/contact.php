<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <?php require_once 'stylesheets.php'; ?>
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/dataTables.responsive.css" rel="stylesheet">
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
                            <div class="panel-heading">Lista koncertów</div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="contactTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Osoba</th>
                                            <th>Email</th>
                                            <th>Telefon</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                $sql = 'SELECT * FROM tbl_contact';
                                $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['ID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['person']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['phone']; ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#EditContact_<?php echo $row['ID']; ?>"><span class="fa fa-fw fa-pencil"></span></a>
                                                <a href="#" data-toggle="modal" data-target="#DeleteContact_<?php echo $row['ID']; ?>"><span class="fa fa-fw fa-trash"></span></a>
                                            </td>
                                            <div class="modal fade" id="EditContact_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Edytuj kontakt</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <form id="edit_contact_<?php echo $row['ID']; ?>" name="form-edit-contact">
                                                                    <input type="hidden" name="process" value="edit_contact">
                                                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Osoba: </label>
                                                                        <input class="form-control" name="person" placeholder="Osoba" required value="<?php echo $row['person']; ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email: </label>
                                                                        <input class="form-control" name="email" placeholder="Email" required value="<?php echo $row['email']; ?>"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Telefon: </label>
                                                                        <input class="form-control" name="phone" placeholder="Telefon" required value="<?php echo $row['phone']; ?>"/>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                                            <button type="submit" class="btn btn-primary" form="edit_contact_<?php echo $row['ID']; ?>">Edytuj kontakt</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            <div class="modal fade" id="DeleteContact_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Usuń kontakt</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <form name="form-delete-contact" id="delete_contact_<?php echo $row['ID']; ?>">
                                                                    <input type="hidden" name="process" value="delete_contact">
                                                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                    <div class="alert alert-warning">Czy na pewno chcesz usunąć ten kontakt? </div>
                                                                    <div class="well">
                                                                        <h4><?php echo $row['person']; ?></h4>
                                                                        <p>
                                                                            <?php echo $row['email']; ?>
                                                                        </p>
                                                                        <p>
                                                                            <?php echo $row['phone']; ?>
                                                                        </p>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                                            <button type="submit" class="btn btn-primary" form="delete_contact_<?php echo $row['ID']; ?>">Usuń kontakt</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </tr>
                                        <?php
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#AddContact">Dodaj kontakt</button>
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
    <div class="modal fade" id="AddContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Dodaj kontakt</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form role="form" action="process.php" method="post" id="add_contact" name="form-add-cont">
                            <input type="hidden" name="process" value="add_contact">
                            <div class="form-group">
                                <label>Osoba: </label>
                                <input class="form-control" name="person" placeholder="Osoba" required />
                            </div>
                            <div class="form-group">
                                <label>Mail: </label>
                                <input class="form-control" name="email" placeholder="Mail" required />
                            </div>
                            <div class="form-group">
                                <label>Telefon: </label>
                                <input class="form-control" name="phone" placeholder="Telefon" required />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary" form="add_contact">Dodaj kontakt</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php require_once 'scripts.php'; ?>
    <script src="js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="js/dataTables.bootstrap.min.js" charset="utf-8"></script>
    <script src="js/dataTables.responsive.js" charset="utf-8"></script>
    <script src="js/edit_info.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            window.table = $('#contactTable').DataTable({
                responsive: true,
                "order": [
                    [0, 'asc']
                ],
                "columns": [
                    null,
                    null,
                    null,
                    null,
                    {
                        "type": "html",
                        "width": "25px",
                        "orderable": false
                    }
                ],
                "language": {
                    "url": "js/langpl.json"
                }
            });
        });
    </script>
    <?php $conn->close(); ?>
</body>

</html>
