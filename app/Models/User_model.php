<?php

namespace shopping_mall\Models;

use shopping_mall\Models\User;


class User_model{

    public function __construct(){
        $this->User = new User();
    }

    public function singup($name, $email, $password){
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => Bcrypt($password)
        ]);

        $user->save();
    }



    public function change($table, $type, $value){

    }
}