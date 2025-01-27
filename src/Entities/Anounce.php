<?php

final class Anounce {

    private int $id;
    private int $idProduct;
    private string $description;
    private int $price;
    private int $idCondition;
    private string $imageUrl;

    public function __construct(int $id, int $idProduct, string $description, int $price, int $idCondition, string $imageUrl)
    {
        $this->id = $id;
        $this->idProduct = $idProduct;
        $this->description = $description;
        $this->price = $price;
        $this->idCondition = $idCondition;
        $this->imageUrl = $imageUrl;
    }



    /**
     * Get the value of id
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of idProduct
     */ 
    public function getIdProduct() : int
    {
        return $this->idProduct;
    }

    /**
     * Set the value of idProduct
     *
     * @return  self
     */ 
    public function setIdProduct($idProduct) : self
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description) : self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice() : int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price) : self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of idCondition
     */ 
    public function getIdCondition() : int
    {
        return $this->idCondition;
    }

    /**
     * Set the value of idCondition
     *
     * @return  self
     */ 
    public function setIdCondition($idCondition) : self
    {
        $this->idCondition = $idCondition;

        return $this;
    }

    /**
     * Get the value of imageUrl
     */ 
    public function getImageUrl() : string
    {
        return $this->imageUrl;
    }

    /**
     * Set the value of imageUrl
     *
     * @return  self
     */ 
    public function setImageUrl($imageUrl) : self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}