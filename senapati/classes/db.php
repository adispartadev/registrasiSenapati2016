<?php

/**
 * Created by PhpStorm.
 * User: spartan
 * Date: 24/01/16
 * Time: 13:13
 */



class db
{

    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbCon;
    private $error;

    private $stmt;

    public function __construct(){
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;

        $option = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbCon = new PDO($dsn, $this->user, $this->pass, $option);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->stmt = $this->dbCon->prepare($query);
    }

    public function bind($param, $value, $type = null){
        $value = $this->_antInject($value);
        $value = stripslashes(htmlentities(trim($value)));

        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function multiple(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function _antInject($param){
        return mysql_real_escape_string(htmlentities(addslashes($param)));
    }

}
