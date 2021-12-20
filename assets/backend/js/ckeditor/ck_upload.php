<?php

// $type = $_GET['type'];
// $CKEditor = $_GET['CKEditor'];
 $funcNum  = $_GET['CKEditorFuncNum'];

// Image upload
    
    $allowed_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    //ini_set('display_errors',1);
    // Get image file extension
    $file_extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
    $time=date('Ymd');
    if(in_array(strtolower($file_extension),$allowed_extension)){

        if(move_uploaded_file($_FILES['upload']['tmp_name'], "uploads/".$_FILES['upload']['name'])){

            // File path
            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            }
            else{
                $protocol = 'http';
            }
            $root =$protocol."://".$_SERVER['HTTP_HOST'];
            $root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
            //$url = 'assets/backend/js/ckeditor/uploads/'.$_FILES['upload']['name'];
            //$url = $protocol."://".$_SERVER['SERVER_NAME'] .'/entiretycourses/assets/backend/js/ckeditor/uploads/'.$_FILES['upload']['name'];
            $url=$root.'uploads/'.$_FILES['upload']['name'];


            echo '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'")</script>';
        }
        
    }
    
    exit;

// File upload