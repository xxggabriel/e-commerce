<?php 

namespace App\Controller;

class Controller
{
    public function savePhoto($images = array(), $directory = '')
    {
            
        $img = array();
        if(!empty($images))
        {
            for ($i = 0; $i < count($images['name']); $i++) {
                $name = (count($images['name']) == 1)?$images['name'] : $images['name'][$i] ;
                $neme = str_replace(' ', '-', $name);
                
                $temp_name = (count($images['tmp_name']) == 1)? $images['tmp_name']: $images['tmp_name'][$i];
                $finalName = 'uploads/img/'.$directory.'/'.$name.'-'.time(). strrchr($name, ".");
                // var_dump($finalName);exit;
                if(!move_uploaded_file($temp_name, $finalName))
                {
                    throw new \Exception("Erro ao salvar o arquivo.");
                } else {
    
                    $img[] = $finalName;
                }
            }
        }else 
        {
            throw new \Exception("Você não realizou o upload de forma satisfatória.");
        }

        return $img;
        
        
    }

}