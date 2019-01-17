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
        $this->setName();
        $this->setEmail();
        $this->setPassword();
        $this->setPhoto(!empty($_FILES['photo'])? $_FILES['photo']: null);
        $this->setStatus(!empty($data['status'])? $data['status'] : null);
        $sql = new Sql();

        $result = $sql->select("SELECT email FROM tb_user WHERE email = :email",[
            ":email" => $this->getEmail()
        ]);
        if(!empty($result) && isset($result)){
            
            return false;
            exit;
        }else {
            
            $sql->query("CALL create_user(:name, :email, :password, :photo, :status)", [
                ":name" => $this->getName(),
                ":email" => $this->getEmail(),
                ":password" => $this->getPassword(),
                ":photo" => $this->getPhoto()[0],
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
        // Verificar se existe imagem no $_FILES
        if(!empty($_FILES['photo'])){
            $this->setPhoto(!empty($_FILES['photo'])? $_FILES['photo']: null);

            $sql->query("UPDATE tb_user 
                SET photo = :photo
                WHERE id_user = :id_user",[
                ":photo" => $this->getPhoto(),
                ":id_user" => $this->getId_user()
            ]);
        } 
        // Para cada campo faça um update
        foreach($data as $key => $value){
            // Caso seja a senha, faça uma criptografia
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

    public function login($data = array(), $accessLevel = 2)
    {
        $email = $data['email'];
        $password = $data['password'];

        $sql = new Sql(); 
        $user = @$sql->select("SELECT * FROM tb_user WHERE email = :email",[
            ":email" => $email
            ])[0];
        if(!empty($user))
        {
            if($user['status'] == $accessLevel)
            {
                $hash = $user['password'];
                // Validar senha
                if(password_verify($password, $hash))
                {
                    // Criando cookie
                    $this->createCookie([
                        "id_user" => $user['id_user']
                    ]);     
                    // Iniciando Sessão   
                    $this->createSession([
                        "id_user" => $user['id_user']
                    ]); 
                    header('Location: /app/admin'); 
                    exit;
                } else
                {
                    // Senha errada
                    return [
                        'msg' => 'login ou senha inexistente.',
        
                    ];
                } 
            } else {
                // Sem permição 
                return [
                    'msg' => 'Sem permissão para essa parte do site.',
    
                ];
            }
        } else {
            // Caso não encontre o email
            return [
                'msg' => 'login ou senha inexistente.',

            ];
        }
    }

    public function logout()
    {
        session_destroy();
        $sql = new Sql();
        setcookie(User::COOKIE, '', -3600);
        $sql->query('CALL delete_cookie(:hash)',[
            ':hash' => $_COOKIE[User::COOKIE]
        ]);
        
    }

    public function verifyLogin($verify = true)
    {
        if($verify === true)
        {
            if(!empty($_COOKIE[User::COOKIE]))
            {
                $sql = new Sql;
                // Verificar se o usuário tem um hash no cookie
                $result = $sql->select("SELECT * FROM tb_cookie WHERE hash = :hash",[
                    ":hash" => $_COOKIE[User::COOKIE]
                ])[0];
                
                $this->createSession($result['id_user']);

                if(empty($result))
                {
                    $this->logout();
                } 
            }
            else 
            {
                // Caso não estiver na rota /app/login vai redirecinar para /app/login
                if($_SERVER['REQUEST_URI'] != '/app/login')
                {
                    header('Location: /app/login');
                    exit;             
                }
           }
        }
    }

    public function createSession($id_user)
    {
        if($this->verifySesionUser())
        {
            $_SESSION['logged'] = true;
            foreach($this->read($id_user)[0] as $key => $value){
                if($key != 'password'){
                    
                    $_SESSION[$key] = $value;
                }
            }
        }
        

    }

    private function verifySesionUser()
    {
        if(
            $_SESSION['logged'] &&
            isset($_SESSION['name']) &&
            isset($_SESSION['email']) 
            ) // User logged
        {
            return false;
        } else 
        {
            return true;
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
        $this->name = !empty($name)? $name : null;

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
        $this->email = !empty($email)? $email : null;

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
        $password = !empty($password)? $password : null;

        $this->password = password_hash($password, PASSWORD_DEFAULT);

    }

    /**
     * Get the value of photo
     */ 
    public function getPhoto()
    {
        return $this->photo[0];
    }

    /**
     * Set the value of photo
     *
     * 
     */ 
    public function setPhoto($photo)
    {
        $photo = !empty($photo)? $photo : null;
        $this->photo = $this->savePhoto($photo, 'user');

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
    public function setStatus($status)
    {
        $this->status = !empty($status)? $status: null;

    }
}