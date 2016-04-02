<?php
/**
 * Created by PhpStorm.
 * User: spartan
 * Date: 24/01/16
 * Time: 14:42
 */

session_start();

include('../config/db.php');
include('../classes/db.php');
include('../classes/upload.php');
include('../classes/flashMessage.php');
include('../classes/universal.php');

$db = new db();
$univ = new universal();
$flash = new flashMessage();

$action = $_GET['action'];

    switch($action){
       
        case 'login':
            $username = $db->_antInject($_POST['username']);
            $password = $db->_antInject(md5($_POST['password']));
            
            $us = 'sena';
            $pa = md5('senapati2016ngxyz');

            if ($username == $us && $password == $pa){
                $_SESSION['login'] = true;
                $flash->setMessage('message', 'Anda berhasil login');
            }
            else{
                $flash->setMessage('message', 'Kombinasi username dan password salah');
            }
            $univ->back();


        break;
        
        // case 'register':
        //
        //     $db->query("INSERT INTO user VALUES(:id, :username, :password, :status)");
        //     $db->bind(':id', '');
        //     $db->bind(':username', 'root');
        //     $db->bind(':password', md5('adminsuksesijoss'));
        //     $db->bind(':status', 0);
        //     $db->execute();
        //
        // break;

        case 'logout':
            unset($_SESSION['login']);
            $flash->setMessage('message', 'Anda berhasil logout');
            $univ->back();
        break;
        
        
    }
