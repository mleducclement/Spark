<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page
#Michael Leduc Clement 2210407  10-23-2022   Add form to products page and add classes for regular/premium ads
#Michael Leduc Clement 2210407  10-24-2022   Add Input validation and sanitizing to the form, convert most require statements to use constants
#Michael Leduc Clement 2210407  10-25-2022   Clean some hardcoded variables and add function to set the page title
#Michael Leduc Clement 2210407  10-25-2022   Add JSON encoding to a data file to keep track of orders.
#Michael Leduc Clement 2210407  10-25-2022   Add code to create order table, more comments to files and fix an bug when app would crash if .json file was empty
#Michael Leduc Clement 2210407  10-27-2022   Add coloring action to orders. Fix some formatting errors in products form

// Makes no sense to define a constant on every page for the head.php file and it needs to be defined
// before requiring it in index
require "../templates/head.php";

// Variable to display the success message on the page
$order_success = false;

// Variables to be used for field values
$product_code = "";
$first_name = "";
$last_name = "";
$city = "";
$comments = "";
$price = "";
$quantity = "";

// Variables to be used to store error content
$error_product_code = "";
$error_first_name = "";
$error_last_name = "";
$error_city = "";
$error_comments = "";
$error_price = "";
$error_quantity = "";

// Code used to validate the content of the form
if (isset($_POST["purchase"])) {
    $form_valid = true;

    // Sets value variables to value from $_POST to prevent all input from vanishing when reloading form because of error
    // Also sanitizes the raw data from $_POST and round numerical values
    $product_code = sanitize_input($_POST["product-code"]);
    $first_name = sanitize_input($_POST["first-name"]);
    $last_name = sanitize_input($_POST["last-name"]);
    $city = sanitize_input($_POST["city"]);
    $comments = sanitize_input($_POST["comments"]);
    $price = number_format(round(sanitize_input($_POST["price"]), 2), 2, '.', '');
    $quantity = round(sanitize_input($_POST["quantity"]));

    // Checks if field is empty, doesn't contain the chars 'prd' or contains more than 25 chars (MB)
    if ($product_code == "" || !preg_match("/(prd)/i", mb_strtolower($product_code)) || mb_strlen($product_code) > 25) {
        $error_product_code = "The product code cannot be empty, must not contain more than 25 characters and must contain the code 'prd'";
        $form_valid = false;
    } // Checks if field is empty or contains more than 20 chars (MB)

    if ($first_name == "" || mb_strlen($first_name) > 20) {
        $error_first_name = "The first name cannot be empty and must not contain more than 20 characters";
        $form_valid = false;
    }

    // Checks if field is empty or contains more than 20 chars (MB)
    if ($last_name == "" || mb_strlen($last_name) > 20) {
        $error_last_name = "The last name cannot be empty and must not contain more than 20 characters";
        $form_valid = false;
    }

    // Checks if field is empty or contains more than 30 chars (MB)
    if ($city == "" || mb_strlen($city) > 30) {
        $error_city = "The city cannot be empty and must not contain more than 30 characters";
        $form_valid = false;
    }

    // Checks if textarea contains more than 200 chars (MB)
    if (mb_strlen($comments) > 200) {
        $error_comments = "The comments cannot contain more than 200 characters";
        $form_valid = false;
    }

    // Checks if field is empty, value isn't numeric, is smaller or equal to 0 or larger than 10000
    if ($price == "" || !is_numeric($price) || $price <= 0 || $price > 10000) {
        $error_price = "The price has to be a positive number and cannot be set higher than $10,000.00";
        $form_valid = false;
    }

    // Checks if field is empty, isn't an integer, is 0 or larger than 99
    if ($quantity == "" || !preg_match("/^(\d?[1-9]|[1-9]0)$/", $quantity) || $quantity > 99) {
        $error_quantity = "The quantity has to be an integer, cannot be empty and must not exceed 99";
        $form_valid = false;
    }

    // If form is valid, order is sent and stored in JSON file
    if ($form_valid) {
        // Sets the variable to true so that we can display the success message
        $order_success = true;

        $data = "";
        $filename = "data.json";
        $directory = "../data/";
        $filepath = $directory . $filename;

        $subtotal = number_format(round($price * $quantity, 2), 2, '.', '');
        $taxes = number_format(round($subtotal * 0.124, 2), 2, '.', '');
        $total = number_format(round($subtotal + $taxes, 2), 2, '.', '');

        // Checks if data directory exists, if not, creates it
        if (!is_dir($directory)) {
            mkdir($directory);
        }

        // Checked if data.json file exists if it does, get data already in it
        if (is_file($directory . $filename)) {
            $data = file_get_contents($filepath);
        }

        // Convert JSON from the file to an array
        $json_arr = json_decode($data, true);

        // Push the values from the form to the json_arr
        $json_arr[] = array('code' => $product_code, 'first name' => $first_name, 'last name' => $last_name, 'city' => $city, 'comments' => $comments, 'price' => $price, 'quantity' => $quantity, 'subtotal' => $subtotal, 'taxes' => $taxes, 'total' => $total);

        // Write the entire json_arr to the .json file
        file_put_contents($filepath, json_encode($json_arr));
    }
}
?>

    <body class="bg-white">

<?php require MAIN_NAV_LOCATION ?>

    <section id="products" class="max-w-6xl mx-auto p-6">
        <h2 class="text-lg text-center font-bold p-3">Products</h2>
        <p class="max-w-sm mx-auto bg-green-300 text-center rounded-md <?= $order_success ? "block" : "hidden" ?>">
            The order was placed successfully
        </p>
        <form class=" max-w-2xl mx-auto p-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="product-code">Product Code <span
                            class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_product_code ?></span>
                <input id="product-code"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="product-code" type="text" placeholder="product code" value="<?= $product_code ?>"/>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="first-name">First Name <span class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_first_name ?></span>
                <input id="first-name"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="first-name" type="text" placeholder="first name" value="<?= $first_name ?>"/>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="last-name">Last Name <span class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_last_name ?></span>
                <input id="last-name"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="last-name" type="text" placeholder="last name" value="<?= $last_name ?>"/>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="city">City <span class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_city ?></span>
                <input id="city"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="city" type="text" placeholder="city" value="<?= $city ?>"/>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="comments">Comments</label>
                <span class="text-red-600 font-bold text-sm"><?= $error_comments ?></span>
                <textarea id="comments"
                          class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                          name="comments" rows="2" placeholder="comments" maxlength="200"><?= $comments ?></textarea>
                <p class="text-xs" id="form-textarea-counter">192 / 200 characters</p>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="price">Price <span class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_price ?></span>
                <input id="price"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="price" type="text" placeholder="0.00" value="<?= $price ?>"/>
            </div>
            <div class="max-w-sm form-control my-3 mx-auto">
                <label class="block" for="quantity">Quantity <span class="text-red-600 font-bold">*</span></label>
                <span class="text-red-600 font-bold text-sm"><?= $error_quantity ?></span>
                <input id="quantity"
                       class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500"
                       name="quantity" type="text" placeholder="0" value="<?= $quantity ?>"/>
            </div>
            <button class="text-lg mx-auto rounded-md px-3 py-1 mt-6 bg-amber-400 block hover:bg-amber-500"
                    type="submit"
                    name="purchase">
                Place Order
            </button>
        </form>
    </section>

<?php require FOOTER_LOCATION ?>