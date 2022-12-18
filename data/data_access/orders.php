<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class orders
{
    private array $orders;

    public function getOrders(): array
    {
        return $this->orders;
    }

    public function addToOrders($value): void
    {
        $this->orders[] = $value;
    }

    public function removeFromOrders($id): void
    {
        $filteredArray = array_filter($this->orders, function ($el) use ($id) {
            return $el->getId() !== $id;
        });

        $this->orders = $filteredArray;
    }

    public function getOrder($id)
    {
        $order = NULL;

        foreach ($this->orders as $record) {
            if ($record->getId() === $id) {
                $order = $record;
                break;
            }
        }

        return $order;
    }

    public function count(): int
    {
        return count($this->orders);
    }

    public function __construct()
    {
        global $driver;

        $sqlRequest = "call get_all_orders()";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute();

        $this->orders = $PDOStatement->fetchAll(PDO::FETCH_CLASS, order::class);

        $PDOStatement->closeCursor();
    }
}