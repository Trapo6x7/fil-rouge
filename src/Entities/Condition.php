<?php

final class Condition
{

    private int $id;
    private string $condition;


    public function __construct(int $id, string $condition)
    {
        $this->id = $id;
        $this->condition = $condition;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function setCondition($condition) : self
    {
        $this->condition = $condition;

        return $this;
    }
}