<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class customers
{
    private array $customers;

    public function getCustomers(): array
    {
        return $this->customers;
    }

    public function addToCustomers($value): void
    {
        $this->customers[] = $value;
    }

    public function removeFromCustomers($id): void
    {
        $filteredArray = array_filter($this->customers, function ($el) use ($id) {
            return $el->getId() !== $id;
        });

        $this->customers = $filteredArray;
    }

    public function getCustomer($id)
    {
        $customer = NULL;

        foreach ($this->customers as $record) {
            if ($record->getId() === $id) {
                $customer = $record;
                break;
            }
        }

        return $customer;
    }

    public function count(): int
    {
        return count($this->customers);
    }

    public function __construct()
    {
        global $driver;

        $sqlRequest = "call get_all_customers()";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute();

        $this->customers = $PDOStatement->fetchAll(PDO::FETCH_CLASS, customer::class);

        $PDOStatement->closeCursor();
    }
}