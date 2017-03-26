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
                        <h1 class="page-header">Panel Admina</h1>
                        <noscript>
                          <p class="lead text-danger">Do prawidłowego funkcjonowania panelu potrzebny jest uruchomiony JavaScript.</p>
                        </noscript>
                        <div class="list-group">
                          <a href="info.php" class="list-group-item">Edytuj informacje o zespole</a>
                          <a href="events.php" class="list-group-item">Dodaj lub edytuj wydarzenia</a>
                          <a href="images.php" class="list-group-item">Dodaj lub edytuj zdjęcia</a>
                          <a href="videos.php" class="list-group-item">Dodaj lub edytuj filmy</a>
                          <a href="contact.php" class="list-group-item">Dodaj lub edytuj informacje kontaktowe</a>
                          <a href="files.php" class="list-group-item">Edytuj pliki</a>
                        </ul>
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
    <?php $conn->close(); ?>
</body>

</html>
