<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Majestic | Admin Panel</title>
    <?php require_once 'stylesheets.php'; ?>
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/dataTables.responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
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
                        <h1 class="page-header">Koncerty</h1>
                        <div class="panel panel-default">
                            <div class="panel-heading">Lista koncertów</div>
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="eventTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Wydarzenie</th>
                                            <th>Miejscowość</th>
                                            <th>Link</th>
                                            <th>Data</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                $sql = 'SELECT * FROM tbl_events';
                                $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['ID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['venue']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['city']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['link']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['date']; ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#EditEvent_<?php echo $row['ID']; ?>"><span class="fa fa-fw fa-pencil"></span></a>
                                                <a href="#" data-toggle="modal" data-target="#DeleteEvent_<?php echo $row['ID']; ?>"><span class="fa fa-fw fa-trash"></span></a>
                                            </td>
                                            <div class="modal fade" id="EditEvent_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Edytuj wydarzenie</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <form name="form-edit-event" id="edit_event_<?php echo $row['ID']; ?>" name="form-edit-event">
                                                                    <input type="hidden" name="process" value="edit_event">
                                                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                    <div class="form-group">
                                                                        <label>Wydarzenie: </label>
                                                                        <input class="form-control" name="event" placeholder="Wydarzenie" required value="<?php echo $row['venue']; ?>" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Miejscowość: </label>
                                                                        <input class="form-control" name="city" placeholder="Miejscowość" required value="<?php echo $row['city']; ?>"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Link: </label>
                                                                        <input class="form-control" name="link" placeholder="Link" required value="<?php echo $row['link']; ?>"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Data: </label>
                                                                        <input type="text" class="form-control datetimepicker" name="date" id="datetimepicker" placeholder="YYYY-MM-DD HH:mm:SS" required value="<?php echo $row['date']; ?>"/>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" form="edit_event_<?php echo $row['ID']; ?>">Edit Link</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                            <div class="modal fade" id="DeleteEvent_<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Usuń wydarzenie</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <form name="form-delete-event" id="delete_event_<?php echo $row['ID']; ?>">
                                                                    <input type="hidden" name="process" value="delete_event">
                                                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                                    <div class="alert alert-warning">Czy na pewno chcesz usunąć to wydarzenie? </div>
                                                                    <div class="well">
                                                                        <h4><?php echo $row['venue']; ?></h4>
                                                                        <p>
                                                                            <?php echo $row['city']; ?>
                                                                        </p>
                                                                        <p>
                                                                            <?php echo $row['date']; ?>
                                                                        </p>
                                                                        <p>
                                                                            <a href="<?php echo(parse_url($row['link'], PHP_URL_SCHEME) ? '' : 'http://').$row['link']; ?>">
                                                                                <?php echo $row['link']; ?>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                                            <button type="submit" class="btn btn-primary" form="delete_event_<?php echo $row['ID']; ?>">Usuń wydarzenie</button>
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
                                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#AddEvent">Dodaj Wydarzenie</button>
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

    <div class="modal fade" id="AddEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Dodaj Wydarzenie</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form role="form" action="process.php" method="post" id="add_event" name="form-add-event">
                            <input type="hidden" name="process" value="add_event">
                            <div class="form-group">
                                <label>Wydarzenie: </label>
                                <input class="form-control" name="event" placeholder="Wydarzenie" required />
                            </div>
                            <div class="form-group">
                                <label>Miejscowość: </label>
                                <input class="form-control" name="city" placeholder="Miejscowość" required />
                            </div>
                            <div class="form-group">
                                <label>Link: </label>
                                <input class="form-control" name="link" placeholder="Link" required />
                            </div>
                            <div class="form-group">
                                <label>Data: </label>
                                <input type="text" class="form-control datetimepicker" name="date" id="datetimepicker" placeholder="YYYY-MM-DD HH:mm:SS" required />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                    <button type="submit" class="btn btn-primary" form="add_event">Dodaj wydarzenie</button>
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
    <script src="js/moment.min.js" charset="utf-8"></script>
    <script src="js/moment-pl.js" charset="utf-8"></script>
    <script src="js/bootstrap-datetimepicker.min.js" charset="utf-8"></script>
    <script src="js/edit_info.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            window.table = $('#eventTable').DataTable({
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
                        "type": "date"
                    },
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
    <script>
        $(function() {
            $('.datetimepicker').datetimepicker({
                locale: 'pl',
                format: 'YYYY-MM-DD HH:mm:ss',
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down",
                    next: "fa fa-caret-right",
                    previous: "fa fa-caret-left"
                }
            });;
        });
    </script>
    <?php $conn->close(); ?>
</body>

</html>
