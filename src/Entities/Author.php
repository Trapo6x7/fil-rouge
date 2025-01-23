<?php

final class Genre
{
    private int $id;
    private string $author;

    public function __construct(int $id, string $author)
    {
        $this->id = $id;
        $this->author = $author;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getAuthor() : string
    {
        return $this->author;
    }

    public function setGenre($author) : self
    {
        $this->genre = $author;

        return $this;
    }
}
