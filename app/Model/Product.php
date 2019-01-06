<?php 

namespace App\Model;

use App\Model\DB\Sql;

class Product 
{

    private $name,
            $title,
            $description,
            $promotion,
            $amount,
            $cost_value,
            $sale_value,
            $id_brand,
            $id_provider,
            $id_category;


    public function create($name, $sale_value ,$title = null, $description = null, $promotion = null, $amount = null, $cost_value = null, $id_brand = null, $id_provider = null, $id_category = null)
    {
        $sql = new Sql();

        $this->setName($name);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setPromotion($promotion);
        $this->setAmount($amount);
        $this->setCost_value($cost_value);
        $this->setSale_value($sale_value);
        $this->setId_brand($id_brand);
        $this->setId_category($id_category);
        $this->setId_category($id_category);

        $sql->query("CALL create_product(:name, :title, :description, :promotion, :amount, :cost_value, :sale_value, :id_brand, :id_provider, :id_category)",[
            ":name" => $this->getName(),
            ":title" => $this->getTitle(),
            ":description" => $this->getDescription(),
            ":promotion" => $this->getPromotion(),
            ":amount" => $this->getAmount(),
            ":cost_value" => $this->getCost_value(),
            ":sale_value" => $this->getSale_value(),
            ":id_brand" => $this->getId_brand(),
            ":id_provider" => $this->getId_brand(),
            ":id_category" => $this->getId_brand()
        ]);
    }

    public function read($id_product = null)
    {
        $sql = new Sql();

        return $sql->select("CALL read_product(:id_product)",[
            ":id_product" => $id_product
        ]);
    }

    public function updata($id_product, $data = array())
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
        $this->id_category = $id_category;

        return $this;
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
        $this->id_provider = $id_provider;

        return $this;
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
        $this->id_brand = $id_brand;

        return $this;
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

        return $this;
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

        return $this;
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
        $this->promotion = $promotion;

        return $this;
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
        $this->amount = $amount;

        return $this;
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
        $this->cost_value = $cost_value;

        return $this;
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
        $this->sale_value = $sale_value;

        return $this;
    }
}