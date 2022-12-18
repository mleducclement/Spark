<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class order
{
    const MAX_QUANTITY = 999;
    const MAX_PRICE = 10000.00;
    const MAX_COMMENTS_LENGTH = 200;

    private $id;
    private $customer_id;
    private $product_id;
    private $quantity;
    private $price_paid;
    private $comments;
    private $subtotal;
    private $taxes;
    private $total;
    private $create_time;
    private $update_time;

//    GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPricePaid()
    {
        return $this->price_paid;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getSubTotal()
    {
        return $this->subtotal;
    }

    public function getTaxes()
    {
        return $this->taxes;
    }

    public function getTotal()
    {
        return $this->total;
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

    public function setCustomerId($value): void
    {
        $this->customer_id = $value;
    }

    public function setProductId($value): void
    {
        $this->product_id = $value;
    }

    public function setQuantity($value): ?string
    {
        $clean_input = intval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        if ($clean_input > self::MAX_QUANTITY) {
            return "Field value cannot be more than " . self::MAX_QUANTITY;
        }

        $this->quantity = $value;
        return null;
    }

    public function setPricePaid($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        if ($clean_input > self::MAX_PRICE) {
            return "Field value cannot be more than " . self::MAX_PRICE;
        }

        $this->price_paid = $value;
        return null;
    }

    public function setComments($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_COMMENTS_LENGTH) {
            return "Field cannot contain more than " . self::MAX_COMMENTS_LENGTH . " characters";
        }

        $this->comments = $value;
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

    public function setSubtotal($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        $this->subtotal = $value;
        return null;
    }

    public function setTaxes($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        $this->taxes = $value;
        return null;
    }

    public function setTotal($value): ?string
    {
        $clean_input = floatval(sanitize_input($value));
        if (empty($clean_input)) {
            return "Field value cannot be 0";
        }

        $this->total = $value;
        return null;
    }

//    Default constructor function
    public function constructor_args_0(): void
    {

    }

//    Full constructor function
    public function constructor_args_8(
        $customerId,
        $productId,
        $quantity,
        $pricePaid,
        $comments,
        $subtotal,
        $taxes,
        $total
    ): void
    {
        $this->setCustomerId($customerId);
        $this->setProductId($productId);
        $this->setQuantity($quantity);
        $this->setPricePaid($pricePaid);
        $this->setComments($comments);
        $this->setSubtotal($subtotal);
        $this->setTaxes($taxes);
        $this->setTotal($total);
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

        $sqlRequest = "call get_order_by_id(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $id]);

        $order = $PDOStatement->fetch(PDO::FETCH_ASSOC);

        $this->id = $order["id"];
        $this->customer_id = $order["customer_id"];
        $this->product_id = $order["product_id"];
        $this->quantity = $order["quantity"];
        $this->price_paid = $order["price_paid"];
        $this->comments = $order["comments"];
        $this->create_time = $order["create_time"];
        $this->update_time = $order["update_time"];
        $this->subtotal = $order["subtotal"];
        $this->taxes = $order["taxes"];
        $this->total = $order["total"];

        $PDOStatement->closeCursor();
    }

    public function saveData($isInsert): void
    {
        global $driver;

        if ($isInsert) {
            $sqlRequest = "call insert_order(:customerId, :productId, :quantity, :pricePaid, :comments, :subtotal, :taxes, :total)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'customerId' => $this->customer_id,
                'productId' => $this->product_id,
                'quantity' => $this->quantity,
                'pricePaid' => $this->price_paid,
                'comments' => $this->comments,
                'subtotal' => $this->taxes,
                'taxes' => $this->taxes,
                'total' => $this->total]);

            $PDOStatement->closeCursor();
        } else {
            $sqlRequest = "call update_order(:id, :customerId, :productId, :quantity, :pricePaid, :comments, :subtotal, :taxes, :total)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'id' => $this->id,
                'customerId' => $this->customer_id,
                'productId' => $this->product_id,
                'quantity' => $this->quantity,
                'pricePaid' => $this->price_paid,
                'comments' => $this->comments,
                'subtotal' => $this->subtotal,
                'taxes' => $this->taxes,
                'total' => $this->total]);

            $PDOStatement->closeCursor();
        }
    }

    public function deleteData(): void
    {
        global $driver;

        $sqlRequest = "call delete_order(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $this->id]);

        $PDOStatement->closeCursor();
    }

    public function toString(): string
    {
        return
            "<br> id : " . $this->id .
            "<br> customerId : " . $this->customer_id .
            "<br> productId : " . $this->product_id .
            "<br> quantity : " . $this->quantity .
            "<br> pricePaid : " . $this->price_paid .
            "<br> comments : " . $this->comments .
            "<br> subtotal : " . $this->subtotal .
            "<br> taxes : " . $this->taxes .
            "<br> total : " . $this->total .
            "<br>";
    }
}