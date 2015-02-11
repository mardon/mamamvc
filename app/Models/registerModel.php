<?php

class registerModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verifyUser($user)
    {
        $id = $this->_db->query(
            "select id from user where user = '$user' "
        );

        if($id->fetch()) {
            return true;
        }
        return false;
    }

    public function verifyEmail($email)
    {
        $id = $this->_db->query(
            "select id from user where email = '$email' "
        );

        if($id->fetch()) {
            return true;
        }
        return false;
    }

    public function registerUser ($name, $user, $password, $email)
    {

    }
}