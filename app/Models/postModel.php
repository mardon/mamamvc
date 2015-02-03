<?php

class postModel extends Model
{
    public function __contruct( ){
        parent::__contruct();
    }

    public function getPosts()
    {
        $post = $this->_db->query("select * from post");
        return $post->fetchAll();
    }

    public function insertPost($title, $post)
    {
        $this->_db->prepare("INSERT INTO post VALUES (null, :title, :post)")
            ->execute(
                array(
                    ":title" => $title,
                    ":post" => $post
                )
            );
    }
}