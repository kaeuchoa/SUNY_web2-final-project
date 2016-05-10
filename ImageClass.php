<?php

require_once './db.php';

class Image {

    var $img_id;
    var $img_ref;
    var $caption;

    function __construct($img_ref, $caption) {
        $this->img_id = $img_id;
        $this->img_ref = $img_ref;
        $this->caption = $caption;
    }

    public static function insertImage($caption, $img_ref) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'INSERT INTO images (caption,reference) VALUES (?,?)'
        );

        if (!$statement) {
          header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('ss', $caption, $img_ref)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    public static function getImageID($img_ref) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'SELECT img_id FROM images WHERE reference = ?'
        );

        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('s', $img_ref)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_result($img_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->fetch()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        return $img_id;
    }

    public static function findImageByID($img_id) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'SELECT reference FROM images WHERE img_id = ?'
        );

        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('i', $img_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_result($img_ref)) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->fetch()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        return $img_ref;
    }

}
?>
