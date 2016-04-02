<?php

/**
 * Created by PhpStorm.
 * User: spartan
 * Date: 24/01/16
 * Time: 15:25
 */



class flashMessage
{
    public function __construct(){
        if( !session_id() )
        {
            session_start();
        }
    }

    public function setMessage($name, $message){
        $_SESSION[$name] = $message;
    }

    public function checkMessage($name){
        if(isset($_SESSION[$name]) && $_SESSION[$name] != ''){
        	return true;
        }
        return false;
    }

    public function showMessage($name){
    	echo $_SESSION[$name];
        unset($_SESSION[$name]);
    }
}