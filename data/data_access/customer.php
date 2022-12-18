<?php

#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  12-18-2022   Initial Class Setup

require_once "../src/dbUtils.php";

class customer
{
    const MAX_NAME_LENGTH = 20;
    const MAX_LOCATION_LENGTH = 25;
    const MAX_ZIP_LENGTH = 7;
    const MAX_USER_LENGTH = 15;

    private $id;
    private $first_name;
    private $last_name;
    private $street_address;
    private $city;
    private $province;
    private $postal_code;
    private $username;
    private $password;
    private $picture;
    private $create_time;
    private $update_time;

//    GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getStreetAddress()
    {
        return $this->street_address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPicture()
    {
        return $this->picture;
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

    public function setFirstName($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_NAME_LENGTH) {
            return "Field cannot contain more than " . self::MAX_NAME_LENGTH . " characters";
        }

        $this->first_name = $value;
        return null;
    }

    public function setLastName($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_NAME_LENGTH) {
            return "Field cannot contain more than " . self::MAX_NAME_LENGTH . " characters";
        }

        $this->last_name = $value;
        return null;
    }

    public function setStreetAddress($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_LOCATION_LENGTH) {
            return "Field cannot contain more than " . self::MAX_LOCATION_LENGTH . " characters";
        }

        $this->street_address = $value;
        return null;
    }

    public function setCity($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_LOCATION_LENGTH) {
            return "Field cannot contain more than " . self::MAX_LOCATION_LENGTH . " characters";
        }

        $this->city = $value;
        return null;
    }

    public function setProvince($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_LOCATION_LENGTH) {
            return "Field cannot contain more than " . self::MAX_LOCATION_LENGTH . " characters";
        }

        $this->province = $value;
        return null;
    }

    public function setPostalCode($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_ZIP_LENGTH) {
            return "Field cannot contain more than " . self::MAX_ZIP_LENGTH . " characters";
        }

        $this->postal_code = $value;
        return null;
    }

    public function setUsername($value): ?string
    {
        $clean_input = sanitize_input($value);
        $length = mb_strlen($clean_input);
        if (empty($clean_input)) {
            return "Field cannot be empty";
        }

        if ($length > self::MAX_USER_LENGTH) {
            return "Field cannot contain more than " . self::MAX_USER_LENGTH . " characters";
        }

        $this->username = $value;
        return null;
    }

    public function setPassword($value): void
    {
        $this->password = $value;
    }

    public function setPicture($value): void
    {
        $this->picture = $value;
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

//    Regular constructor function
    public function constructor_args_9(
        $firstName,
        $lastName,
        $address,
        $city,
        $province,
        $postalCode,
        $username,
        $password,
        $picture): void
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setStreetAddress($address);
        $this->setCity($city);
        $this->setProvince($province);
        $this->setPostalCode($postalCode);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setPicture($picture);
    }

//

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

        $sqlRequest = "call get_customer_by_id(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $id]);

        $customer = $PDOStatement->fetch(PDO::FETCH_ASSOC);

        $this->id = $customer["id"];
        $this->first_name = $customer["first_name"];
        $this->last_name = $customer["last_name"];
        $this->street_address = $customer["street_address"];
        $this->city = $customer["city"];
        $this->province = $customer["province"];
        $this->postal_code = $customer["postal_code"];
        $this->username = $customer["username"];
        $this->password = $customer["password"];
        $this->picture = $customer["picture"];
        $this->create_time = $customer["create_time"];
        $this->update_time = $customer["update_time"];

        $PDOStatement->closeCursor();
    }

    public function saveData($isInsert): void
    {
        global $driver;

        if ($isInsert) {
            $sqlRequest = "call insert_customer(:firstName, :lastName, :address, :city, :province, :postalCode, :username, :password, :picture)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'firstName' => $this->first_name,
                'lastName' => $this->last_name,
                'address' => $this->street_address,
                'city' => $this->city,
                'province' => $this->province,
                'postalCode' => $this->postal_code,
                'username' => $this->username,
                'password' => $this->password,
                'picture' => $this->picture]);

            $PDOStatement->closeCursor();
        } else {
            $sqlRequest = "call update_customer(:id, :firstName, :lastName, :address, :city, :province, :postalCode, :username, :password, :picture)";

            $PDOStatement = $driver->prepare($sqlRequest);
            $PDOStatement->execute([
                'id' => $this->id,
                'firstName' => $this->first_name,
                'lastName' => $this->last_name,
                'address' => $this->street_address,
                'city' => $this->city,
                'province' => $this->province,
                'postalCode' => $this->postal_code,
                'username' => $this->username,
                'password' => $this->password,
                'picture' => $this->picture]);

            $PDOStatement->closeCursor();
        }
    }

    public function deleteData(): void
    {
        global $driver;

        $sqlRequest = "call delete_customer(:id)";

        $PDOStatement = $driver->prepare($sqlRequest);
        $PDOStatement->execute(['id' => $this->id]);

        $PDOStatement->closeCursor();
    }

    public function toString(): string
    {
        return
            "<br> Id : " . $this->id .
            "<br> First Name : " . $this->first_name .
            "<br> Last Name : " . $this->last_name .
            "<br> Address : " . $this->street_address .
            "<br> City : " . $this->city .
            "<br> Province : " . $this->province .
            "<br> Postal Code : " . $this->postal_code .
            "<br> Username : " . $this->username .
            "<br> Password : " . $this->password .
            "<br> Create Time : " . $this->create_time .
            "<br> Update Time : " . $this->update_time .
            "<br> Picture : NONE" .
            "<br>";
    }
}