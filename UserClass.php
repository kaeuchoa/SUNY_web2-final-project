<?php

/**
 *
 */
require_once './db.php';

class User {

    var $username;
    var $password;
    var $userID;
    var $firstName;
    var $lastName;
    var $type;
    var $profile_pic;

    function __construct($username, $firstName, $lastName, $password, $type, $profile_pic) {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->type = $type;
        $this->userID = 0;
        $this->profile_pic = $profile_pic;
    }

    public static function insertUser($user) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "INSERT INTO users(username,firstName,lastName,"
                . "password,type,profile_pic) VALUES(?,?,?,?,?,?)"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('sssssi', $user->username, $user->firstName, $user->lastName, $user->password, $user->type, $user->profile_pic)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    static function findUserWhereUsername($username) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'SELECT * FROM users WHERE username = ? '
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("s", $username)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_result($userID, $username, $firstName, $lastName, $password, $type, $profile_pic)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->fetch()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        $user = new User($username, $firstName, $lastName, $password, $type, $profile_pic);
        $user->setID($userID);

        return $user;
    }

    static function updateUser($info) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'UPDATE users SET username = ?,firstName = ?,lastName = ?,type=? '
                . 'WHERE user_id = ? '
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param("ssssi", $info['username'], $info['firstName'], $info['lastName'], $info['type'], $info['userID']
                )) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        header('Location: profile.php');
    }

    static function deleteByID($userID) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                "DELETE FROM users WHERE user_id = ?"
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->bind_param('i', $userID)) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    private function setID($userID) {
        $this->userID = $userID;
    }

    static function getProfilePic($user_id) {
        $connection = DB::connection();
        $statement = $connection->prepare(
                'SELECT i.reference FROM users u JOIN images i ON'
                . ' u.profile_pic = i.img_id WHERE u.user_id = ? '
        );
        if (!$statement) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->bind_param('i', $user_id)) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if (!$statement->execute()) {
            header("HTTP/1.0 500 Internal Server Error");
        }
        if(!$statement->bind_result($img_ref)){
            header("HTTP/1.0 500 Internal Server Error");
        }
        if(!$statement->fetch()){
               header("HTTP/1.0 500 Internal Server Error");
        }
        return $img_ref;
    }

}

?>
