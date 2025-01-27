<?php

final class Order {

    private int $id;
    private int $buyer;
    private int $seller;
    private int $idProduct;
    private DateTime $purchaseAt;
    private int $idOrderState;

    public function __construct(int $id, int $buyer, int $seller, int $idProduct, DateTime $purchaseAt, int $idOrderState)
    {
        $this->id = $id;
        $this->buyer = $buyer;
        $this->seller = $seller;
        $this->idProduct = $idProduct;
        $this->purchaseAt = $purchaseAt;
        $this->$idOrderState = $idOrderState;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of buyer
     */ 
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set the value of buyer
     *
     * @return  self
     */ 
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get the value of seller
     */ 
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set the value of seller
     *
     * @return  self
     */ 
    public function setSeller($seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get the value of idProduct
     */ 
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set the value of idProduct
     *
     * @return  self
     */ 
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get the value of purchaseAt
     */ 
    public function getPurchaseAt()
    {
        return $this->purchaseAt;
    }

    /**
     * Set the value of purchaseAt
     *
     * @return  self
     */ 
    public function setPurchaseAt($purchaseAt)
    {
        $this->purchaseAt = $purchaseAt;

        return $this;
    }

    /**
     * Get the value of idOrderState
     */ 
    public function getIdOrderState()
    {
        return $this->idOrderState;
    }

    /**
     * Set the value of idOrderState
     *
     * @return  self
     */ 
    public function setIdOrderState($idOrderState)
    {
        $this->idOrderState = $idOrderState;

        return $this;
    }
}