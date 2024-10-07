<?php

/**
 * class Product
 */
class Product
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $title;
    /**
     * @var float
     */
    private float $price;
    /**
     * @var int
     */
    private int $availableQuantity;

    /**
     * @param int $id
     * @param string $title
     * @param float $price
     * @param int $availableQuantity
     */
    public function __construct(int $id, string $title, float $price, int $availableQuantity)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Cart $cart
     * @param int $quantity
     * @return CartItem
     * @throws Exception
     */
    public function addToCart(Cart $cart, int $quantity): CartItem
    {
        return $cart->addProduct($this, $quantity);
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     */
    public function removeFromCart(Cart $cart)
    {
        $cart->removeProduct($this);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     * @return int
     */
    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    /**
     * @param int $availableQuantity
     * @return void
     */
    public function setAvailableQuantity(int $availableQuantity): void
    {
        $this->availableQuantity = $availableQuantity;
    }

}