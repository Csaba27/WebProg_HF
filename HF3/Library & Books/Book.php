<?php

/**
 * class Book
 */
class Book
{
    /**
     * @var string
     */
    public string $title;
    /**
     * @var float
     */
    public float $price;
    /**
     * @var Author|null
     */
    public ?Author $author;

    /**
     * @param string $title
     * @param float $price
     * @param ?Author $author
     */
    public function __construct(string $title, float $price, Author $author = null)
    {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return void
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }
}