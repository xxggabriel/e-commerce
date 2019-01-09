<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class Brand extends Controller
{
    private $name, $logo;

    public function create($data = array())
    {
        $this->setName(!empty($data['name'])?$data['name']:NULL);
        $this->setLogo(!empty($_FILES['logo'])?$_FILES['logo']:NULL);
        $sql = new Sql();

        $sql->query("CALL create_brand(:name, :logo)", [
            ":name" => $this->getName(),
            ":logo" => $this->getLogo()
        ]);
    }

    public function read($id_brand = null)
    {
        $sql = new Sql();

        return $sql->select("CALL read_brand(:id_brand)",[
            ":id_brand" => $id_brand
        ]);
    }

    public function update($id_brand, $data = array())
    {
        $sql = new Sql();
        foreach($data as $key => $value){        
            
            $sql->query("UPDATE tb_brand 
                        SET $key = :value
                        WHERE id_brand = :id_brand",[
                ":value" => $value,
                ":id_brand" => $id_brand
            ]);
           
                
        }
    }

    public function delete($id_brand)
    {
        $sql = new Sql();

        $sql->query("CALL delete_brand(:id_brand)",[
            "id_brand" => $id_brand
        ]);
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        
    }

    /**
     * Get the value of logo
     */ 
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set the value of logo
     *
     * @return  self
     */ 
    public function setLogo($logo)
    {
        $this->logo = $this->savePhoto($logo,'brand');

        
    }
}