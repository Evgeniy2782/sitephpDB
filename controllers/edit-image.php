<?php

function randomID() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
);
}
    
      function editImage($pathFolderImage, $file_urlImage) {
       
        $attributes = [];

        if (!$_FILES["picture"]["error"] == UPLOAD_ERR_NO_FILE) {
            $pathFolder = $pathFolderImage;
            $file_path = upload_image($_FILES["picture"], $pathFolder);
            $file_path_exploded = explode("/", $file_path);
            $filename = $file_path_exploded[count($file_path_exploded) - 1];
            $file_url = $file_urlImage.$filename;
            $attributes = $file_url;
        }

        return $attributes;
    }
