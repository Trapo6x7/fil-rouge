<?php

final class Order
{

    private int $id;
    private User $buyer;
    private User $seller;
    private Product $product;
    private DateTime $purchaseAt;
    private OrderState $orderState;

    public function __construct(int $id, User $buyer, User $seller,  DateTime $purchaseAt, OrderState $orderState, Product $product)
    {
        
        $this->id = $id;
        $this->buyer = $buyer;
        $this->seller = $seller;
        $this->purchaseAt = $purchaseAt;
        $this->product = $product;
        $this->orderState = $orderState;
        
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of buyer
     */
    public function getBuyer(): User
    {
        return $this->buyer;
    }

    /**
     * Set the value of buyer
     *
     * @return  self
     */
    public function setBuyer(User $buyer): self
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
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Set the value of idProduct
     *
     * @return  self
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;

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
     * Get the value of orderState
     */
    public function getOrderState(): OrderState
    {
        return $this->orderState;
    }

    /**
     * Set the value of orderState
     *
     * @return  self
     */
    public function setOrderState(OrderState $orderState): self
    {
        $this->orderState = $orderState;

        return $this;
    }
}
