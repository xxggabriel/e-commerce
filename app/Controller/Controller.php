<?php 

namespace App\Controller;

class Controller
{
    public function savePhoto($photo, $directory)
    {
        if(!empty($photo)){
            $image = str_replace(' ','-', $photo['name']);
            if(!empty($image)) { 
                $finalName = 'uploads/img/'.$directory.'/'.$image.'-'.time(). strrchr($image, ".");
                if (!move_uploaded_file($photo['tmp_name'], $finalName)) {             
                    throw new \Exception("Erro ao salvar a imagem."); 
                }
                return $finalName;
            } 
            else { 
                throw new \Exception("Você não realizou o upload de forma satisfatória."); 
                
            }      
        }
            
        
    }

}