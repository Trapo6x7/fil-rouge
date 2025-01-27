<?php

final class OrderState
{
    private int $id;
    private string $state;

    public function __construct(int $id, string $state)
    {
        $this->id = $id;
        $this->state = $state;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the value of state
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Set the value of state
     */
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }
}
