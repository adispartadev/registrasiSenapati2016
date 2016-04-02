<?php

/**
 * Created by PhpStorm.
 * User: spartan
 * Date: 24/01/16
 * Time: 14:50
 */



include 'Smartresize.php';


class upload extends Smartresize
{

    public function uploadImg($folder, $file){
        $i = 0;
        $uploaded = array();
        if (!empty($file['name'][0])){

            foreach ($file['name'] as $pos => $name) {
                if (getimagesize($file['tmp_name'][$pos])){


                    $target_file = $folder.basename($file["name"][$pos]);
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                    if ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg' || $imageFileType == 'gif'){

                        $new_name = date('U').date('h_i_s').'_'.rand().'.'.$imageFileType;

                        if (move_uploaded_file($file['tmp_name'][$pos], $folder.$new_name)){

                            // $this->resize($folder.'/'.$new_name,
                            //     null,
                            //     300,
                            //     350,
                            //     false,
                            //     $folder.'/'.$new_name,
                            //     true,
                            //     false,
                            //     $quality = 100);

                            $uploaded[$i] = array(
                                'name' => $new_name,
                            );

                            $i++;

                        }
                    }
                }
            }
        }

        return $uploaded;
    }

}