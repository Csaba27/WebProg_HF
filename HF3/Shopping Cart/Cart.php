<?php

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     * @throws Exception
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        if ($product->getAvailableQuantity() < $quantity) {
            throw new Exception('Quantity must not become more than availableQuantity');
        }

        foreach ($this->items as $item) {
            if ($item instanceof CartItem) {
                $_product = $item->getProduct();
                if ($_product->getId() === $product->getId()) {
                    $item->setQuantity($quantity);
                    return $item;
                }
            }
        }

        $newCartItem = new CartItem($product, $quantity);
        $this->items[] = $newCartItem;
        return $newCartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product)
    {
        foreach ($this->items as $index => $item) {
            if ($item instanceof CartItem) {
                if ($item->getProduct()->getId() === $product->getId()) {
                    unset($this->items[$index]);
                    break;
                }
            }
        }
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        $num = 0;
        foreach ($this->items as $item) {
            if ($item instanceof CartItem) {
                $num += $item->getQuantity();
            }
        }
        return $num;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            if ($item instanceof CartItem) {
                $totalPrice += $item->getProduct()->getPrice() * $item->getQuantity();
            }
        }
        return $totalPrice;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}