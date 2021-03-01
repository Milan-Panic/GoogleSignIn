<?php
if(isset($_FILES["file"]["name"]))
{
    $file = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $file_name_array = explode(".", $file_name);
    $extension = end($file_name_array);
    $new_image_name = rand() . '.' . $extension;
    chmod('upload', 0777);
    $allowed_extension = array("jpg", "gif", "png", "jpeg");

    if(in_array($extension, $allowed_extension))
    {
        $url = 'upload/' . $new_image_name;
        move_uploaded_file($file, $url);
        echo '[img]'.$url.'[/img]';
    }
}
?>