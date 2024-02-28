<?php
class Auth {
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
}