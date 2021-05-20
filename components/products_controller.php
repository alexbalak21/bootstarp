<?php
require_once "components/model.php";

$products = getAll();
require_once "views/product_card.php";

foreach ($products as $product) {
    $img = json_decode($product['img'], true);
    productCard($product['id'], $product['name'], $img, $product['price']);
}
