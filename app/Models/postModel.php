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

    public function getPost($id)
    {
        $id = (int) $id;
        $post = $this->_db->query("select * from post where id= $id");
        return $post->fetch();
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

    public function editPost($id, $title, $post)
    {
        $id = (int) $id;

        $this->_db->prepare("UPDATE post SET title = :title, post = :post WHERE id = :id")
            ->execute(
                array(
                    ":id" => $id,
                    ":title" => $title,
                    ":post" => $post
                )
            );
    }

    public function deletePost($id)
    {
        $id = (int) $id;

        $this->_db->query("DELETE FROM post WHERE id = $id");
    }
}