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
                $name = (count($images['name']) === 0)?$images['name'][$i] : $images['name'];
                $neme = str_replace(' ', '-', $name);
                
                $temp_name = (count($images['tmp_name']) === 0)?$images['tmp_name'][$i] : $images['tmp_name'];
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