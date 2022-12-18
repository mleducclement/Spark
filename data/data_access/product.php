<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class product
{
    const MAX_PRODCODE_LENGTH = 12;
    const MAX_DESCRIPTION_LENGTH = 100;
    const MAX_PRICE = 10000.00;
    const MAX_COST = 10000.00;

    private $id;
    private $product_code;
    private $description;
    private $price;
    private $cost;
    private $create_time;
    private $update_time;

//    GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getProductCode()
    {
        return $this->product_code;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getCreateTime()
    {
        return $this->create_time;
    }

    public function getUpdateTime()
    {
        return $this->update_time;
    }

//    SETTERS
    public function setId($value): void
    {
        $this->id = $value;
    }

    public function setProductCode($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_PRODCODE_LENGTH) {
            return "Field cannot contain more than " . self::MAX_PRODCODE_LENGTH . " characters";
        }

        $this->product_code = $value;
        return null;
    }

    public function setDescription($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_DESCRIPTION_LENGTH) {
            return "Field cannot contain more than " . self::MAX_DESCRIPTION_LENGTH . " characters";
        }

        $this->description = $value;
        return null;
    }

    public function setPrice($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        if ($clean_input > self::MAX_PRICE) {
            return "Field value cannot be more than " . self::MAX_PRICE;
        }

        $this->price = $value;
        return null;
    }

    public function setCost($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        if ($clean_input > self::MAX_COST) {
            return "Field value cannot be more than " . self::MAX_COST;
        }

        $this->cost = $value;
        return null;
    }

    public function setCreateTime($value): void
    {
        $this->create_time = $value;
    }

    public function setUpdateTime($value): void
    {
        $this->update_time = $value;
    }

//    Default constructor function
    public function constructor_args_0(): void
    {

    }

//    Full constructor function
    public function constructor_args_4(
        $productCode,
        $description,
        $price,
        $cost): void
    {
        $this->setProductCode($productCode);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setCost($cost);
    }

//    Constructor call relevant method depending on the number of arguments
    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = 'constructor_args_' . $numberOfArguments)) {
            call_user_func_array(
                array($this, $function), $arguments);
        }
    }

    public function loadData($id): void
    {
        global $driver;

        $sqlRequest = "call get_product_by_id(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $id]);

        $product = $PDOStatement->fetch(PDO::FETCH_ASSOC);

        $this->id = $product["id"];
        $this->product_code = $product["product_code"];
        $this->description = $product["description"];
        $this->price = $product["price"];
        $this->cost = $product["cost"];
        $this->create_time = $product["create_time"];
        $this->update_time = $product["update_time"];

        $PDOStatement->closeCursor();
    }

    public function saveData($isInsert): void
    {
        global $driver;

        if ($isInsert) {
            $sqlRequest = "call insert_product(:productCode, :description, :price, :cost)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'productCode' => $this->product_code,
                'description' => $this->description,
                'price' => $this->price,
                'cost' => $this->cost]);

            $PDOStatement->closeCursor();
        } else {
            $sqlRequest = "call update_product(:id, :productCode, :description, :price, :cost)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'id' => $this->id,
                'productCode' => $this->product_code,
                'description' => $this->description,
                'price' => $this->price,
                'cost' => $this->cost]);

            $PDOStatement->closeCursor();
        }
    }

    public function deleteData(): void
    {
        global $driver;

        $sqlRequest = "call delete_product(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $this->id]);

        $PDOStatement->closeCursor();
    }

    public function toString(): string
    {
        return
            "<br> id : " . $this->id .
            "<br> code : " . $this->product_code .
            "<br> description : " . $this->description .
            "<br> price : " . $this->price .
            "<br> cost : " . $this->cost .
            "<br>";
    }
}