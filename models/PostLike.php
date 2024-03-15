<?php
class PostLike {
    Public $id;
    Public $id_post; 
    Public $id_user;    
    Public $created_at;

}

interface PostLikeDAO {
    public function getLikeCount($id_post);
    public function isLiked($id_post, $id_user);
    public function likeToggle($id_post, $id_user);
}