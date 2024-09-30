<?php
require_once "AbstractLibrary.php";
require_once "Author.php";

class Library extends AbstractLibrary
{
    /**
     * @param string $authorName
     * @return Author
     */
    public function addAuthor(string $authorName): Author
    {
        $authors = $this->getAuthors();
        foreach ($authors as $author) {
            if ($author->getName() === $authorName) {
                return $author;
            }
        }

        $author = new Author($authorName);
        $authors[] = $author;
        $this->setAuthors($authors);
        return $author;
    }

    /**
     * @param $authorName
     * @param Book $book
     * @return void
     */
    public function addBookForAuthor($authorName, Book $book)
    {
        $author = $this->addAuthor($authorName);
        $author->addBook($book->getTitle(), $book->getPrice());
    }

    /**
     * @param $authorName
     * @return array
     */
    public function getBooksForAuthor($authorName): array
    {
        $authors = $this->getAuthors();
        foreach ($authors as $author) {
            if ($author->getName() === $authorName) {
                return $author->getBooks();
            }
        }

        return [];
    }

    /**
     * @param string $bookName
     * @return Book|null
     */
    public function search(string $bookName): ?Book
    {
        foreach ($this->getAuthors() as $author) {
            foreach ($author->getBooks() as $book) {
                if ($book->getTitle() === $bookName) {
                    return $book;
                }
            }
        }

        return null;
    }

    /**
     * @return void
     */
    public function print()
    {
        foreach ($this->getAuthors() as $author) {
            echo $author->getName() . PHP_EOL;
            echo "----------------------" . PHP_EOL;

            foreach ($author->getBooks() as $book) {
                echo $book->getTitle() . " - " . $book->getPrice() . PHP_EOL;
            }

            echo PHP_EOL;
        }
    }
}