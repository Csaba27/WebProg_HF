<?php

class ApiClient
{
    private string $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getData(string $path)
    {
        $url = $this->baseUrl . $path;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

class Cart
{
    private ApiClient $apiClient;
    private int $userId;

    public function __construct(ApiClient $apiClient, int $userId)
    {
        $this->apiClient = $apiClient;
        $this->userId = $userId;
    }

    public function getUserCart()
    {
        $cartJson = $this->apiClient->getData("carts/user/" . $this->userId);
        return json_decode($cartJson, true);
    }

    public function getProduct(int $productId)
    {
        $productJson = $this->apiClient->getData("products/" . $productId);
        return json_decode($productJson, true);
    }

    public function getTotal()
    {
        $carts = $this->getUserCart();
        $total = 0;

        foreach ($carts[0]['products'] as $product) {
            $productId = $product['productId'];
            $quantity = $product['quantity'];

            $productData = $this->getProduct($productId);
            $price = $productData['price'];

            $total += $price * $quantity;
        }

        return $total;
    }
}

$apiClient = new ApiClient("https://fakestoreapi.com/");

$userId = 1;
$cart = new Cart($apiClient, $userId);

$total = $cart->getTotal();

echo "A kosár összértéke: " . number_format($total, 2) . "\n";
