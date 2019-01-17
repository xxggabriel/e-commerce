<?php 

namespace App\Model;

use App\Model\DB\Sql;
use App\Controller\Controller;

class Product extends Controller
{

    private $name,
            $title       = "Sem titulo",
            $description = "Sem descrição",
            $promotion   = 0,
            $amount      = 1,
            $cost_value  = 0,
            $sale_value  = 0,
            $id_brand    = null,
            $id_provider = null,
            $id_category = null,
            $photo;


    public function create($data)
    {
        $sql = new Sql();

        $this->setName(!empty($data['name'])?$data['name']:null);
        $this->setTitle(!empty($data['title'])?$data['title']:null);
        $this->setDescription(!empty($data['description'])?$data['description']:null);
        $this->setPromotion(!empty($data['promotion'])?$data['promotion']:null);
        $this->setAmount(!empty($data['amount'])?$data['amount']:null);
        $this->setCost_value(!empty($data['cost_value'])?$data['cost_value']:null);
        $this->setSale_value(!empty($data['sale_value'])?$data['sale_value']:null);
        $this->setId_brand(!empty($data['id_brand'])?$data['id_brand']:null);
        $this->setId_category(!empty($data['id_category'])?$data['id_category']:null);
        $this->setId_provider(!empty($data['id_provider'])?$data['id_provider']:null);



        return $sql->select("CALL create_product(:name, :title, :description, :promotion, :amount, :cost_value, :sale_value, :id_brand, :id_provider, :id_category)",[
            ":name" => $this->getName(),
            ":title" => $this->getTitle(),
            ":description" => $this->getDescription(),
            ":promotion" => $this->getPromotion(),
            ":amount" => $this->getAmount(),
            ":cost_value" => $this->getCost_value(),
            ":sale_value" => $this->getSale_value(),
            ":id_brand" => $this->getId_brand(),
            ":id_provider" => $this->getId_provider(),
            ":id_category" => $this->getId_category()
        ])[0];
    }

    public function read($id_product = null)
    {
        $sql = new Sql();

        return $sql->select("CALL read_product(:id_product)",[
            ":id_product" => $id_product
        ]);
    }

    public function update($id_product, $data = array())
    {
        $sql = new Sql();
        foreach($data as $key => $value){

            $sql->query("UPDATE  tb_product
                        SET $key = :value
                        WHERE id_product = :id_product",[
                            ":id_product" => $id_product,
                            ":value" => $value
                        ]);
        }
    }

    public function delete($id_product)
    {
        $sql = new Sql();

        $sql->query("CALL delete_product(:id_product)",[
            ":id_product" => $id_product
        ]);
    }

    public function readPhoto($id_product)
    {
        $sql = new Sql();
        return $sql->select('CALL read_photo_product(:id_product)',[
            ':id_product' => $id_product
        ]);
    }
    public function updatePhotoProduct()
    {
        $this->setPhoto(!empty($_FILES['photo'])?$_FILES['photo']:null);
        $result = $this->getPhoto();
        $sql = new Sql();
        for($i = 0; $i < count($result); $i ++)
        {
            $sql->query("UPDATE tb_photo_product SET id_product = :id_product, directory = :directory, :ranking = :ranking",[
                ":directory" => $result[$i],
                ":id_product" => $id_product,
                ":ranking" => $i
            ]);
        }
    }
    public function savePhotoProduct($id_product)
    {
        
        $this->setPhoto(!empty($_FILES['photo'])?$_FILES['photo']:null);
        $result = $this->getPhoto();
        $sql = new Sql();
        for($i = 0; $i < count($result); $i ++)
        {
            $sql->query("CALL save_photo_product(:id_product, :directory, :ranking)",[
                ":directory" => $result[$i],
                ":id_product" => $id_product,
                ":ranking" => $i
            ]);
        }
    }

    /**
     * Get the value of id_category
     */ 
    public function getId_category()
    {
        return $this->id_category;
    }

    /**
     * Set the value of id_category
     *
     * @return  self
     */ 
    public function setId_category($id_category)
    {
        $this->id_category = (int)$id_category;

    }

    /**
     * Get the value of id_provider
     */ 
    public function getId_provider()
    {
        return $this->id_provider;
    }

    /**
     * Set the value of id_provider
     *
     * @return  self
     */ 
    public function setId_provider($id_provider)
    {
        $this->id_provider = (int)$id_provider;

    }

    /**
     * Get the value of id_brand
     */ 
    public function getId_brand()
    {
        return $this->id_brand;
    }

    /**
     * Set the value of id_brand
     *
     * @return  self
     */ 
    public function setId_brand($id_brand)
    {
        $this->id_brand = (int)$id_brand;

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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

    }

    /**
     * Get the value of promotion
     */ 
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set the value of promotion
     *
     * @return  self
     */ 
    public function setPromotion($promotion)
    {
        $this->promotion = (double)$promotion;

    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = (int)$amount;

    }

    /**
     * Get the value of cost_value
     */ 
    public function getCost_value()
    {
        return $this->cost_value;
    }

    /**
     * Set the value of cost_value
     *
     * @return  self
     */ 
    public function setCost_value($cost_value)
    {
        $this->cost_value = (double)$cost_value;

    }

    /**
     * Get the value of sale_value
     */ 
    public function getSale_value()
    {
        return $this->sale_value;
    }

    /**
     * Set the value of sale_value
     *
     * @return  self
     */ 
    public function setSale_value($sale_value)
    {
        $this->sale_value = (double)$sale_value;

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
     * @return  self
     */ 
    public function setPhoto($photo)
    {
        $this->photo = $this->savePhoto($photo, 'product');

        return $this;
    }
}