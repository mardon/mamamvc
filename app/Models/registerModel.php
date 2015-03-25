<?php

class registerModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verifyUser($user)
    {
        $id = $this->_db->query(
            "select id, code from user where user = '$user' "
        );

        return $id->fetch();
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
        $random = rand(1278945634,9999999999);

        $this->_db->prepare(
             "insert into user values" .
             "(null, :name, :user, :password , :email, 'user', 0, now(), :code)"
            )
             ->execute(array(
                 ':name' => $name,
                 ':user' => $user,
                 ':password' => Hash::getHash('sha1', $password, HASH_KEY),
                 ':email' => $email,
                 ':code' =>$random,
             ));
    }

    public function getUser($id, $code)
    {
        $user = $this->_db->query(
            "select * form user where id =$id and code = '$code'";
        );

        return $user->fetch();
    }

    public function activateUser($id, $code)
    {
        $this->_db->query(
            "update user set state = 1 " .
            "where id = $id and code = '$code'"
        );
    }
}