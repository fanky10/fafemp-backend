<?php

class User {
    private $user;
    private $pass;
    public static $TABLE="usuarios";
    
    function User($user, $pass) {
        $this->user = $user;
        $this->pass = $pass;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }


};

?>
