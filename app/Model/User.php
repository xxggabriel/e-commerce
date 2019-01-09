<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class User extends Controller
{
    private $id_user,
            $name,
            $email,
            $password,
            $photo = "uploads/img/user/sem-foto.jpg",
            $status = 2;
    
    

    public function create($data = array())
    {
        $this->setName(!empty($data['name'])? $data['name'] : null);
        $this->setEmail(!empty($data['email'])? $data['email'] : null);
        $this->setPassword(!empty($data['password'])? $data['name'] : null);
        $this->setPhoto(!empty($_FILES['photo'])? $_FILES['photo']: null);
        $this->setStatus(!empty($data['status'])? $data['status'] : null);

        $sql = new Sql();
        
        $sql->query("CALL create_user(:name, :email, :password, :photo, :status)", [
            ":name" => $this->getName(),
            ":email" => $this->getEmail(),
            ":password" => $this->getPassword(),
            ":photo" => $this->getPhoto(),
            ":status" => $this->getStatus()
        ]);
    }

    public function read($id_user = null)
    {
        $sql = new Sql();
        return $sql->select("CALL read_user(:id_user)",[
            ":id_user" => $this->getId_user()
        ]);   
    }

    public function update($id_user, $data = array())
    {
        $sql = new Sql();

        $this->setId_user($id_user);

        foreach($data as $key => $value){
            if($key === "password"){
                $value = password_hash($value, PASSWORD_DEFAULT);
            }          
            
            $sql->query("UPDATE tb_user 
                        SET $key = :value
                        WHERE id_user = :id_user",[
                ":value" => $value,
                ":id_user" => $this->getId_user()
            ]);
           
                
        }
    }


    public function delete($id_user)
    {
        $sql = new Sql();
        $sql->query("CALL delete_user(:id_user)",[
            ":id_user" => $id_user
        ]);
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * 
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

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
     * 
     */ 
    public function setName($name)
    {
        $this->name = $name;

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
     * 
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * 
     */ 
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);

    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * 
     */ 
    public function setPhoto($photo = null)
    {
        ;
        $this->photo = $this->savePhoto($photo,'user');

    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return (!empty($this->status))? $this->status : null;
    }

    /**
     * Set the value of status
     *
     * 
     */ 
    public function setStatus($status = null)
    {
        $this->status = $status;

    }
}