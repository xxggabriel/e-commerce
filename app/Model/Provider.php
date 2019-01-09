<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class Provider extends Controller
{
    private $name, 
            $email,
            $phone,
            $cnpj;


    public function create($data = array())
    {
        $this->setName(!empty($data['name'])?$data['name']:null);
        $this->setEmail(!empty($data['email'])?$data['email']:null);
        $this->setPhone(!empty($data['phone'])?$data['phone']:null);
        $this->setCnpj(!empty($data['cnpj'])?$data['cnpj']:null);

        $sql = new Sql();

        $sql->query("CALL create_provider(:name, :email, :phone, :cnpj)",[
            ":name" => $this->getName(),
            ":email" => $this->getEmail(),
            ":phone" => $this->getPhone(),
            ":cnpj" => $this->getCnpj()
        ]);
    }

    public function read($id_provider = null)
    {
        $sql = new Sql();

        return $sql->select("CALL read_provider(:id_provider)",[
            ":id_provider" => $id_provider
        ]);
    }

    public function update($id_provider, $data = array())
    {
        $sql = new Sql();

        foreach($data as $key => $value){

            $sql->query("UPDATE tb_provider SET $key = :value WHERE id_provider = :id_provider",[
                ":value" => $value,
                ":id_provider" => $id_provider
            ]);
        }
    }

    public function delete($id_provider)
    {
        $sql = new Sql();

        $sql->query("CALL delete_provider(:id_provider)",[
            ":id_provider" => $id_provider
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

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }
}