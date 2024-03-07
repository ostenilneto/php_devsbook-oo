<?php
class UserRelation {
    Public $id ;
    Public $user_from ;
    Public $user_to ;
}

interface UserRelationDAO {
    public function insert(UserRelation $u);
    public function getFollowing($id);
    public function getFollowers($id);
}