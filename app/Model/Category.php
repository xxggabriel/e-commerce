<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class Category extends Controller
{

    private $name;

    public function create($data = array())
    {
        $this->setname(!empty($data['name'])?$data['name']:null);
        $sql = new Sql();

        $sql->query("CALL create_category(:name)", [
            ":name" => $this->getName()
        ]);
    }

    public function read($id_category = null)
    {
        $sql = new Sql();


        return $sql->select("CALL read_category(:id_category)",[
            ":id_category" => $id_category
        ]);
    }

    public function update($id_category, $data)
    {
        $sql = new Sql();

        foreach($data as $key => $value){

            $sql->query("UPDATE tb_category SET $key = :value WHERE id_category = :id_category",[
                ":value" => $value,
                ":id_category" => $id_category
            ]);
        }
    }

    public function delete($id_category)
    {
        $sql = new Sql();

        $sql->query("CALL delete_category(:id_category)",[
            ":id_category" => $id_category
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

        return $this;
    }
}