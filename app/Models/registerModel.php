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
         $this->_db->prepare(
             "insert into user values" .
             "(:null, :name, :user, :password , :email, 'user', 1, now())"
            )
             ->execute(array(
                 ':name' => $name,
                 ':user' => $user,
                 ':password' => Hash::getHash('sha1', $password, HASH_KEY),
                 ':email' => $email,
             ));
    }
}