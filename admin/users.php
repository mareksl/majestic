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
                        <h1 class="page-header">Panel Admina</h1>
                        <?php if ($_SESSION['login_level'] == '2') {?>

                          <div class="panel panel-default">
                              <div class="panel-heading">Lista użytkowników</div>
                              <div class="panel-body">
                                  <table width="100%" class="table table-striped table-bordered table-hover" id="userTable">
                                      <thead>
                                          <tr>
                                              <th>ID</th>
                                              <th>Username</th>
                                              <th>User Level</th>
                                              <th>Password</th>
                                              <th></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php
                                  $sql = 'SELECT * FROM tbl_users';
                                  $result = $conn->query($sql);
                                      while ($row = $result->fetch_assoc()) {
                                          ?>
                                          <tr>
                                              <td>
                                                  <?php echo $row['ID']; ?>
                                              </td>
                                              <td>
                                                  <?php echo $row['username']; ?>
                                              </td>
                                              <td>
                                                <?php
                                                switch ($row["level"]) {
                                                case '0':
                                                  echo 'User';
                                                  break;
                                                case '1':
                                                  echo 'Moderator';
                                                  break;
                                                  case '2':
                                                  echo 'Admin';
                                                }
                                                ?>
                                              </td>
                                              <td>
                                                <?php if ($row["username"] == $_SESSION['login_user']) {
                                                  echo 'Current User';
                                                }else{
                                                ?><a href="#" title="Reset" data-toggle="modal" data-target="#ResetUser_<?php echo $row["ID"];?>"><i class="fa fa-times" aria-hidden="true"></i> Reset</a>
                                                  <?php };?>
                                                </td>
                                              <td><?php if ($row["username"] == $_SESSION['login_user']) {echo '';}else{?>
                                                <a href="#" title="Edit" data-toggle="modal" data-target="#EditUser_<?php echo $row["ID"];?>"><span class="fa fa-pencil"></span></a> <a href="#" title="Delete" data-toggle="modal" data-target="#DeleteUser_<?php echo $row["ID"];?>"><span class="fa fa-trash"></span></a>
                                                <?php };?>
                                              </td>
                                              </tr>

                                              <!-- Modal -->
                                              <div class="modal fade" id="ResetUser_<?php echo $row["ID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                      <h4 class="modal-title" id="myModalLabel">Reset Password</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="form-group">
                                                        <form name="form-user-reset" id="reset_user_<?php echo $row["ID"];?>">
                                                          <input type="hidden" name="process" value="reset_user">
                                                          <input type="hidden" name="id" value="<?php echo $row["ID"];?>">
                                                          <div class="form-group">
                                                          <label>Username: </label>
                                                          <input class="form-control" placeholder="<?php echo $row["username"];?>" disabled="" type="text">
                                                          </div>
                                                          <div class="form-group input-group">
                                                          <input type="password" id="newpass_<?php echo $row["ID"];?>_in" class="form-control" name="pass" placeholder="Password" disabled="" required />
                                                                                        <span class="input-group-btn">
                                                                                          <button class="btn btn-default newpassbtn" type="button" id="newpass_<?php echo $row["ID"];?>" ><span>Random</span>
                                                                                          </button>
                                                                                      </span>
                                                                                    </div>
                                                          <div class="well" id="newpass_<?php echo $row["ID"];?>_out">

                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary" form="reset_user_<?php echo $row["ID"];?>">Reset Password</button>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                              </div>
                                              <!-- /.modal -->

                                              <!-- Modal -->
                                              <div class="modal fade" id="EditUser_<?php echo $row["ID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                      <h4 class="modal-title" id="myModalLabel">Edit User Level</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="form-group">
                                                        <form name="form-user-edit" id="edit_user_<?php echo $row["ID"];?>">
                                                          <input type="hidden" name="process" value="edit_user">
                                                          <input type="hidden" name="id" value="<?php echo $row["ID"];?>">
                                                          <div class="form-group">
                                                          <label>Username: </label>
                                                          <input class="form-control" placeholder="<?php echo $row["username"];?>" disabled="" type="text">
                                                          </div>
                                                        <div class="form-group">
                                                          <label> User Level: </label>
                                                          <select class="form-control" name="level">
                                                            <option value="0" <?php if($row['level']=="0") echo "selected=\"selected\""; ?>>User</option>
                                                            <option value="1" <?php if($row['level']=="1") echo "selected=\"selected\""; ?>>Moderator</option>
                                                            <option value="2" <?php if($row['level']=="2") echo "selected=\"selected\""; ?>>Admin</option>
                                                          </select>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary" form="edit_user_<?php echo $row["ID"];?>">Edit User Level</button>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                              </div>
                                              <!-- /.modal -->

                                              <div class="modal fade" id="DeleteUser_<?php echo $row["ID"];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                      <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="form-group">
                                                        <form name="form-user-delete" id="delete_user_<?php echo $row["ID"];?>">
                                                          <input type="hidden" name="process" value="delete_user">
                                                          <input type="hidden" name="id" value="<?php echo $row["ID"];?>">
                                                          <div class="alert alert-warning">Are you sure you want to delete this User?</div>
                                                          <div class="well"><h4>Username: <span class="text-primary"><?php echo $row["username"];?></span></h4>
                                                            <p>User Level: <span class="text-primary"><?php
                                                              switch ($row["level"]) {
                                                              case '0':
                                                                echo 'User';
                                                                break;
                                                              case '1':
                                                                echo 'Moderator';
                                                                break;
                                                                case '2':
                                                                echo 'Admin';
                                                              }?></span></p>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      <button type="submit" class="btn btn-primary" form="delete_user_<?php echo $row["ID"];?>">Delete User</button>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                              </div>
                                              <!-- /.modal -->

                                          <?php
                                      } ?>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="panel-footer">
                                  <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#AddUser">Dodaj kontakt</button>
                              </div>
                          </div>
                          <!-- Modal -->
                          <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">Add User</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <form name="form-user-add" id="add_user">
                                      <input type="hidden" name="process" value="add_user">
                                      <div class="form-group">
                                        <label> Username: </label>
                                                                    <div class="form-group input-group">
                                        <input id="username" class="form-control" name="username" placeholder="Username" required /><span class="input-group-addon" id="user-result"></span>
                                      </div></div>
                                        <div class="form-group">
                                        <label> Password: </label>
                                        <div class="form-group input-group">
                                        <input id="pass" type="password" class="form-control" name="pass" placeholder="Password" required />
                                                                      <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button" id="pass-btn" onclick="randomize();"><span>Random</span>
                                                                        </button>
                                                                    </span>
                                                                  </div>
                                                                  <div class="well" id="randompass" style="display:none;"></div>
                                      </div>
                                      <div id="passgroup" class="form-group">
                                        <label> Confirm Password: </label>
                                        <input id="conf_pass" type="password" class="form-control" name="conf_pass" placeholder="Password" required />
                                        <p id="passerror" class="help-block text-danger"></p>
                                      </div>
                                      <div class="form-group">
                                        <label> User Level: </label>
                                        <select class="form-control" name="level">
                                          <option value="0">User</option>
                                          <option value="1">Moderator</option>
                                          <option value="2">Admin</option>
                                        </select>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" form="add_user" onclick="return Validate()">Add User</button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- /.modal -->
                        <?php } else {echo 'Nie masz uprawnień do wyświetlenia tej strony.';} ?>
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
    <script src="js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="js/dataTables.bootstrap.min.js" charset="utf-8"></script>
    <script src="js/dataTables.responsive.js" charset="utf-8"></script>
    <script src="js/edit_info.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                responsive: true,
    			"order": [[ 0, 'asc' ]],
    			"columns": [
    			null,
    			null,
          null,
    			{ "type": "html", "width": "30px", "orderable": false },
          { "type": "html", "width": "25px", "orderable": false }
    		  ]

            });
        });
        </script>
    <?php $conn->close(); ?>
</body>

</html>
