<?php

final class OrderAnounce
{
    private int $id;
    private int $idOrder;
    private int $idAnounce;

    public function __construct(int $id, int $idOrder, int $idAnounce)
    {
        $this->id = $id;
        $this->idOrder = $idOrder;
        $this->idAnounce = $idAnounce;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of idOrder
     */
    public function getIdOrder(): int
    {
        return $this->idOrder;
    }

    /**
     * Set the value of idOrder
     */
    public function setIdOrder(int $idOrder): self
    {
        $this->idOrder = $idOrder;
        return $this;
    }

    /**
     * Get the value of idAnounce
     */
    public function getIdAnounce(): int
    {
        return $this->idAnounce;
    }

    /**
     * Set the value of idAnounce
     */
    public function setIdAnounce(int $idAnounce): self
    {
        $this->idAnounce = $idAnounce;
        return $this;
    }
}
