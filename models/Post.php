<?php
class Post {
    Public $id ;
    Public $id_user ;
    Public $type ; // text ou photo
    Public $created_at ;
    Public $body ;

}

interface PostDAO {
    public function insert(Post $p);
    public function getHomeFeed($id_user);
}