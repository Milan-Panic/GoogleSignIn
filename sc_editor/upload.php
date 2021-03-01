<?php
 $output = 'upload/';
 $arr_name = explode('.', $_FILES['file']['name']);
 $file_name = $arr_name[0];
 $file_ext = $arr_name[1];
 if(isset($_FILES['file']['name']))  
 {  
    if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$file_name.'.'.$file_ext))  
    {  
        $output .= $file_name.'.'.$file_ext;  
    }  
 }  
 echo $output;  
 ?>  