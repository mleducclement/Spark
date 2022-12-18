<?php

require "../data/data_access/customer.php";
require "../data/data_access/customers.php";
require "../data/data_access/product.php";
require "../data/data_access/products.php";
require "../data/data_access/order.php";
require "../data/data_access/orders.php";

require "../templates/head.php";

$instance = new Orders();

$instance2 = new Order();
$instance2->setQuantity("24");
$instance2->setPricePaid("36.24");
$instance2->setComments("10$ de rabais de chez mufflerman");

$arr = $instance->getOrders();

foreach ($arr as $order) {
    echo $order->toString();
}

$object = $instance->getOrder("0feda5ba-6613-11ed-a6eb-d85ed332db42");

echo "<br>THE ORDER IS : <br>" . $object->toString();

echo "<br> BREAK REMOVE ====================== <br>";

$instance->removeFromOrders("d8094d5d-6607-11ed-a6eb-d85ed332db42");

$arr = $instance->getOrders();

foreach ($arr as $order) {
    echo $order->toString();
}

echo "<br> BREAK ADD ====================== <br>";

$instance->addToOrders($instance2);

$arr = $instance->getOrders();

foreach ($arr as $order) {
    echo $order->toString();
}
