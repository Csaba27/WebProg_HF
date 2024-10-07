<?php

/**
 * class CartItem
 */
class CartItem
{
    /**
     * @var Product
     */
    private Product $product;
    /**
     * @var int
     */
    private int $quantity;

    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @throws Exception
     */
    public function increaseQuantity()
    {
        $newQuantity = $this->getQuantity() + 1;
        if ($this->getProduct()->getAvailableQuantity() < $newQuantity) {
            throw new Exception(sprintf('Quantity must not become more than %d', $this->getProduct()->getAvailableQuantity()));
        }
        $this->setQuantity($newQuantity);
    }

    /**
     * @throws Exception
     */
    public function decreaseQuantity()
    {
        if ($this->getQuantity() <= 1) {
            throw new Exception("Quantity must not become less than 1");
        }
        $this->quantity--;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}