<?php

include 'config.php';
$conn = new mysqli($conn_server, $conn_user, $conn_pass, $conn_db);
// Check connection
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
mysqli_query($conn, 'SET CHARSET utf8');
mysqli_query($conn, 'SET NAMES `utf8` COLLATE `utf8_general_ci`');
$process = $_POST['process'];
$errors = array();      // array to hold validation errors
$data = array();      // array to pass back data
switch ($process) {
// EDIT DETAILS
case 'edit_details':
// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array
    if (empty($_POST['description'])) {
        $errors['description'] = 'Uzupełnij opis!';
    }
    if (empty($_POST['link_facebook'])) {
        $errors['link_facebook'] = 'Uzupełnij link do Facebook\'a!';
    }
    if (empty($_POST['link_spotify'])) {
        $errors['link_spotify'] = 'Uzupełnij link do Spotify\'a!';
    }
    if (empty($_POST['link_youtube'])) {
        $errors['link_youtube'] = 'Uzupełnij link do YouTube\'a!';
    }
// return a response ===========================================================
    // if there are any errors in our errors array, return a success boolean of false
    if (!empty($errors)) {
        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors'] = $errors;
    } else {
        // if there are no errors process our form, then return a message
            $description = $conn->real_escape_string($_POST['description']);
        $link_facebook = $conn->real_escape_string($_POST['link_facebook']);
        $link_spotify = $conn->real_escape_string($_POST['link_spotify']);
        $link_youtube = $conn->real_escape_string($_POST['link_youtube']);
        $sql = "UPDATE tbl_info SET description='$description', link_facebook='$link_facebook', link_spotify='$link_spotify', link_youtube='$link_youtube'";
        if ($conn->query($sql) === true) {
            $data['success'] = true;
            $data['message'] = 'Zaktualizowano dane!';
        } else {
            $data['success'] = false;
            $data['errors'] = $conn->error;
        }
        // show a message of success and provide a true success variable
    }
    // return all our data to an AJAX call
    echo json_encode($data);
break;
case 'add_pictures':

if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    exit;  //try detect AJAX request, simply exist if no Ajax
}
//specify uploaded file variable
$config['file_data'] = $_FILES['__files'];
//include sanwebe impage resize class
include 'resize.class.php';
//create class instance
$im = new ImageResize($config);
try {
    $responses = $im->resize(); //initiate image resize
    echo '<div class="alert alert-success">Picture(s) added successfully!</div>'; ?>
  <script>
  document.getElementById('filelist').innerHTML = '<p class="text-success">Uploaded files:</p>'
  </script>
  <?php
    //output thumbnails
    foreach ($responses['thumbs'] as $response) {
        echo '<div class="col-xs-4"><img class="img-responsive img-add" src="'.$config['upload_url'].$response.'" class="thumbnails" title="'.$response.'" /></div>';
    }
  // ADD DB RECORD
  foreach ($responses['images'] as $response) {
      $sql = "INSERT INTO tbl_pictures (filename)
    VALUES ('$response')";

      if ($conn->query($sql) !== true) {
          echo 'Error: '.$sql.'<br>'.$conn->error;
      } ?>
<script>
document.getElementById('filelist').innerHTML += '<?php echo $response; ?><br>'
</script>
<?php

  }
} catch (Exception $e) {
    echo '<div class="error">';
    echo $e->getMessage();
    echo '</div>';
}
break;
// EDIT PICTURE
case 'edit_picture':
    $id = $_POST['id'];
  $page_id = $_POST['page_id'];
    $title = $conn->real_escape_string($_POST['title']);
$sql = "UPDATE tbl_pictures SET title='$title' WHERE ID='$id'";

if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Zaktualizowano zdjęcie!';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
    echo json_encode($data);
break;
// DELETE PICTURE
case 'delete_picture':
  $id = $_POST['id'];
  $page_id = $_POST['page_id'];
  $filename = '../img/gallery/'.$_POST['filename'];
  $thumbname = '../img/gallery/thumb_'.$_POST['filename'];
  if (!unlink($filename)) {
      echo "Błąd przy usuwaniu $filename";
  }
    if (!unlink($thumbname)) {
        echo "Błąd przy usuwaniu $thumbname";
    }
$sql = "DELETE FROM tbl_pictures WHERE ID='$id'";

if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Usunięto zdjęcie';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
    echo json_encode($data);
break;
//UPLOAD FILE
case 'upload_file':
$file_tmp = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_POST['filetype'];
$file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
if ($_FILES['file']['size'] < 20971520) {
    if (is_uploaded_file($file_tmp)) {
        if ($file_type == 'presspack') {
            $sql = 'SELECT filename FROM tbl_files WHERE filetype = "presspack"';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = $row['filename'];
                    @unlink('../files/'.$file);
                }
            }
            $file_name = 'presspack_'.str_pad(rand(0, 99999), 5, 0, STR_PAD_LEFT).'_'.date('Ymd').'.'.$file_extension;
            if (@move_uploaded_file($file_tmp, "../files/$file_name")) {
                $sql = "INSERT INTO tbl_files (filename,filesize,filetype) VALUES ('$file_name', '$file_size', 'presspack')
  ON DUPLICATE KEY UPDATE filename='$file_name', filesize='$file_size'";
                if ($conn->query($sql) !== true) {
                    $errors['upload'] = $conn->error;
                }
            } else {
                $errors['upload'] = 'Nie udało się załadować pliku!';
            }
        } elseif ($file_type == 'rider') {
            $sql = 'SELECT filename FROM tbl_files WHERE filetype = "rider"';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $file = $row['filename'];
                    @unlink('../files/'.$file);
                }
            }
            $file_name = 'rider_'.str_pad(rand(0, 999), 5, 0, STR_PAD_LEFT).'_'.date('Ymd').'.'.$file_extension;
            if (@move_uploaded_file($file_tmp, "../files/$file_name")) {
                $sql = "INSERT INTO tbl_files (filename,filesize,filetype) VALUES ('$file_name', '$file_size', 'rider')
ON DUPLICATE KEY UPDATE filename='$file_name', filesize='$file_size'";
                if ($conn->query($sql) !== true) {
                    $errors['upload'] = $conn->error;
                }
            } else {
                $errors['upload'] = 'Nie udało się załadować pliku!';
            }
        }
    }
} else {
  $errors['upload'] = 'Rozmiar pliku za duży! Masymalny rozmiar to 20MB.';
}
if (!empty($errors)) {
    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Dodano plik!';
}

echo json_encode($data);

break;
case 'add_event':
$event_name = $_POST['event'];
$event_city = $_POST['city'];
$event_link = $_POST['link'];
$event_date = $_POST['date'];
$sql = "INSERT INTO tbl_events (venue, city, link, date) VALUES ('$event_name', '$event_name', '$event_link', '$event_date')";
if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Dodano wydarzenie!';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
echo json_encode($data);
break;

// ADD Video
case 'add_video':
    $vid = $_POST['vid'];
    $title = $conn->real_escape_string($_POST['title']);
$sql = "INSERT INTO tbl_videos (vid, title)
VALUES ('$vid', '$title')";
if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Dodano wideo!';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
echo json_encode($data);

break;
// EDIT Video
case 'edit_video':
    $id = $_POST['id'];
    $title = $conn->real_escape_string($_POST['title']);
$sql = "UPDATE tbl_videos SET title='$title' WHERE ID='$id'";
if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Edytowano wideo!';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
echo json_encode($data);

break;
// DELETE Video
case 'delete_video':
    $id = $_POST['id'];
$sql = "DELETE FROM tbl_videos WHERE ID='$id'";
if ($conn->query($sql) === true) {
    $data['success'] = true;
    $data['message'] = 'Usunięto wideo!';
} else {
    $data['success'] = false;
    $data['errors'] = $conn->error;
}
echo json_encode($data);

break;
}
$conn->close();
