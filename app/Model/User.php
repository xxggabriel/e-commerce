<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class User extends Controller
{
    const COOKIE = 'CKE';
    private $id_user,
            $name,
            $email,
            $password,
            $photo = "uploads/img/user/sem-foto.jpg",
            $status = 2;
    
    
    public function startUser()
    {
        if(!empty($_COOKIE[User::COOKIE])){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_user u 
                                    INNER JOIN tb_cookie c
                                    WHERE c.hash = :hash AND c.id_user = u.id_user",[
                ":hash" => $_COOKIE[User::COOKIE]
            ]);
        }
        
    }
    public function create($data = array())
    {
        $this->setName(!empty($data['name'])? $data['name'] : null);
        $this->setEmail(!empty($data['email'])? $data['email'] : null);
        $this->setPassword(!empty($data['password'])? $data['password'] : null);
        $this->setPhoto(!empty($_FILES['photo'])? $_FILES['photo']: null);
        $this->setStatus(!empty($data['status'])? $data['status'] : null);

        $sql = new Sql();

        $result = $sql->select("SELECT email FROM tb_user WHERE email = :email",[
            ":email" => $this->getEmail()
        ]);
        if(empty($result)){
            var_dump($result);exit;
            return false;
            exit;
        }else {
            $sql->query("CALL create_user(:name, :email, :password, :photo, :status)", [
                ":name" => $this->getName(),
                ":email" => $this->getEmail(),
                ":password" => $this->getPassword(),
                ":photo" => $this->getPhoto(),
                ":status" => $this->getStatus()
            ]);
        }
    }

    public function read($id_user = null)
    {
        $this->setId_user($id_user);
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

    public function login($data = array(), $route = '/app/admin')
    {
        $email = $data['email'];
        $password = $data['password'];

        $sql = new Sql(); 
        $user = $sql->select("SELECT * FROM tb_user WHERE email = :email",[
            ":email" => $email
            ])[0];
        
        $hash = $user['password'];
        if(password_verify($password, $hash)){
            $this->createCookie([
                "id_user" => $user['id_user']
            ]);           
            $this->createSession([
                "id_user" => $user['id_user']
            ]); 
            header('Location: '.$route);
            exit;
        } else{
            return false;
        }
    }

    public function logout()
    {
        $sql = new Sql();
        setcookie(User::COOKIE, '', -3600);
        $sql->query('CALL delete_cookie(:hash)',[
            ':hash' => $_COOKIE[User::COOKIE]
        ]);
        
    }

    public function verifyLogin($route = '/app/login', $verify = true)
    {

        if($verify === true){
            if(!empty($_COOKIE[User::COOKIE])){
                $sql = new Sql;
                $result = $sql->select("SELECT * FROM tb_cookie WHERE hash = :hash",[
                    ":hash" => $_COOKIE[User::COOKIE]
                ]);

                if(empty($result)){
                    header('Location: '.$route);
                    exit;
                }
            }
            else {
               header('Location: '.$route);
               exit;
           }
        }else {
            return true;
        }
    }

    public function createSession($data = array())
    {
        
        $this->read($data['id_user']);
        $_SESSION['logged'] = true;
        foreach($this->read($data['id_user'])[0] as $key => $value){
            $_SESSION[$key] = $value;
        }

    }

    public function createCookie($data = array())
    {
        $id_user = $data['id_user'];
        $hash = md5(time());

        $sql = new Sql();

        $sql->query("CALL create_cookie(:cookie,:id_user, :hash)",[
            ":cookie" => User::COOKIE,
            ":id_user" => $id_user,
            ":hash" => $hash
        ]);

        setcookie(User::COOKIE,$hash,time()+ 10 * 24 * 3600);// 10 Day
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