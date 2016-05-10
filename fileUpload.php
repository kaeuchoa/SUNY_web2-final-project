<?php
require_once './ImageClass.php';
class FileUpload {
    public static function uploadPicture($file,$fileCaption,$path) {
        //File properties
        $fileName = $file["name"];
        $fileTpm = $file["tmp_name"];
        $fileSize = $file['size'];
        $fileError = $file['error'];


        // File extension
        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));

        $allowed = ['jpg', 'bmp', 'png', 'jpeg'];

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize <= 1310720) {
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = 'images/'. $path . $newFileName;
                    if (move_uploaded_file($fileTpm, $fileDestination)) {
                    Image::insertImage($fileCaption, $fileDestination);

                    return Image::getImageID($fileDestination);
                    }else{
                        //error handling
                    }
                }
            }
        }
    }

}
?>
