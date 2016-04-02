<?php

/**
 * Created by PhpStorm.
 * User: spartan
 * Date: 24/01/16
 * Time: 15:30
 */


class universal
{
    public function back(){
        $link = $_SERVER['HTTP_REFERER'];
        header("Location: $link");
    }

    public function tanggal_edit($date){
    	$d = explode('/', $date);
    	return $d[2].'-'.$d[1].'-'.$d[0];
    }
}