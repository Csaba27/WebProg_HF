<?php

class Author
{
    /**
     * @var string
     */
    public string $name;
    /**
     * @var array
     */
    public $books = [];

    /**
     * @param string $name
     * @param array|null $books
     */
    public function __construct(string $name, array $books = null)
    {
        $this->name = $name;
        $this->books = $books ?? [];
    }

    /**
     * @param string $title
     * @param float $price
     * @return Book
     */
    public function addBook(string $title, float $price): Book
    {
        foreach ($this->getBooks() as $book) {
            if ($book->getTitle() === $title) {
                return $book;
            }
        }
        $book = new Book($title, $price, $this);
        $this->books[] = $book;
        return $book;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * @param array $books
     * @return void
     */
    public function setBooks(array $books): void
    {
        $this->books = $books;
    }
}