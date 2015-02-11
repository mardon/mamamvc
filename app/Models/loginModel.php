<?php

class loginModel extends Model
{
    public function __contruct() {
        parent::construct();
    }

    public function getUser($user, $password) {
        $data = $this->_db->query(
            "select * from user " .
            "where user= '$user' " .
            "and pass = '" . Hash::getHash('sha1', $password, HASH_KEY) . "'"
            );

        return $data->fetch();
    }
}
