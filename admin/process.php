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
switch ($process) {
// EDIT DETAILS
case 'edit_details':
// process.php

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
    // if any of these variables don't exist, add an error to our $errors array

    if (empty($_POST['description']))
        $errors['description'] = 'Uzupełnij opis!';

    if (empty($_POST['link_facebook']))
        $errors['link_facebook'] = 'Uzupełnij link do Facebook\'a!';

    if (empty($_POST['link_spotify']))
        $errors['link_spotify'] = 'Uzupełnij link do Spotify\'a!';

    if (empty($_POST['link_youtube']))
        $errors['link_youtube'] = 'Uzupełnij link do YouTube\'a!';



// return a response ===========================================================

    // if there are any errors in our errors array, return a success boolean of false
    if ( ! empty($errors)) {

        // if there are items in our errors array, return those errors
        $data['success'] = false;
        $data['errors']  = $errors;
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
          $data['errors']  = $conn->error;
        }

        // show a message of success and provide a true success variable

    }

    // return all our data to an AJAX call
    echo json_encode($data);

$conn->close();
break;
};
?>
