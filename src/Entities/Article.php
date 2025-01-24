<?php

final class Article
{

    private int $id;
    private string $name;
    private string $body;
    private string $imageUrl;

    public function __construct(int $id, string $name, string $body, string $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->body = $body;
        $this->imageUrl = $imageUrl;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of imageUrl
     */ 
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set the value of imageUrl
     *
     * @return  self
     */ 
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }
}
