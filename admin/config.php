<?php
$conn_server = "localhost";
$conn_user = "root";
$conn_pass = "marmark";
$conn_db = "db_majestic";

############ Configuration ##############
$config["generate_image_file"]			= true;
$config["generate_thumbnails"]			= true;
$config["image_max_size"] 			= 1200; //Maximum image size (height and width)
$config["thumbnail_size"]  			= 200; //Thumbnails will be cropped to 200x200 pixels
$config["thumbnail_prefix"]			= "thumb_"; //Normal thumb Prefix
$config["destination_folder"]			= '../img/gallery/'; //upload directory ends with / (slash)
$config["thumbnail_destination_folder"]		= '../img/gallery/'; //upload directory ends with / (slash)
$config["upload_url"] 				= "http://localhost/majestic/img/gallery/";
$config["quality"] 				= 75; //jpeg quality
$config["random_file_name"]			= true; //randomize each file name


function nl2p($string)
{
    $paragraphs = '';

    foreach (explode("\n", $string) as $line) {
        if (trim($line)) {
            $paragraphs .= '<p>' . $line . '</p>';
        }
    }

    return $paragraphs;
}
