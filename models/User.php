<?php
class User {
    Public $id ;
    Public $email ;
    Public $password ;
    Public $name ;
    Public $birthdate ;
    Public $city ;
    Public $work ;
    Public $avatar ;
    Public $cover ;
    Public $token ;

}

interface UserDAO {
    public function findByToken($token);
    public function findByEmail($email);
    public function update(User $u);
}