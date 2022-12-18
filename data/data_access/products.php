<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class products
{
    private array $products;

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addToProducts($value): void
    {
        $this->products[] = $value;
    }

    public function removeFromProducts($id): void
    {
        $filteredArray = array_filter($this->products, function ($el) use ($id) {
            return $el->getId() !== $id;
        });

        $this->products = $filteredArray;
    }

    public function getProduct($id)
    {
        $product = NULL;

        foreach ($this->products as $record) {
            if ($record->getId() === $id) {
                $product = $record;
                break;
            }
        }

        return $product;
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function __construct()
    {
        global $driver;

        $sqlRequest = "call get_all_products()";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute();

        $this->products = $PDOStatement->fetchAll(PDO::FETCH_CLASS, product::class);

        $PDOStatement->closeCursor();
    }
}