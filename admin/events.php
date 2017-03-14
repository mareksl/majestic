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
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $sql = "SELECT * FROM tbl_events";
                                $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                  <td><?php echo $row["ID"];?></td>
                                  <td><?php echo $row["venue"];?></td>
                                  <td><?php echo $row["city"];?></td>
                                  <td><?php echo $row["link"];?></td>
                                  <td><?php echo $row["date"];?></td>
                                </tr>
                                <?php }; ?>
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
            <h4 class="modal-title" id="myModalLabel">Add Link</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <form role="form" action="process.php" method="post" id="add_event">
                <input type="hidden" name="process" value="add_event">
                <div class="form-group">
                <label> Link: </label>
                <input class="form-control" name="link" placeholder="Link" required />
              </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" form="add_link">Add Link</button>
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
    <script>
    $(document).ready(function() {
        $('#eventTable').DataTable({
            responsive: true,
            "language": {
              "url": "js/langpl.json"
            }
        });
    });
    </script>
    <?php $conn->close(); ?>
</body>

</html>
