<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page


// Generate the required info to insert into the footer of the app
function show_footer(): void
{
    $student_name = "Michael Leduc Clement";
    $student_number = "2210407";

    echo sprintf("&copy %s (%s) ", $student_name, $student_number);
    echo date("Y");
}

// Generate a random number and use it to display a random image
function get_random_int(): int
{
    $random_number = rand(1, 5);
    return $random_number;
}

function set_page_title(): string
{

    // Convert URI to array and set the filename to the last element of array
    $exploded_URI = explode('/', $_SERVER["REQUEST_URI"]);
    $URI_filename = $exploded_URI[count($exploded_URI) - 1];

    return select_page_title($URI_filename);
}

function select_page_title($URI_filename): string
{
    // Variables to store file names for cases
    $home_file = "index.php";
    $products_file = "products.php";
    $orders_file = "orders.php";

    // Variables to store corresponding page titles
    $home_title = "SPARK | HOME";
    $products_title = "SPARK | PRODUCTS";
    $orders_title = "SPARK | ORDERS";
    $page_title = "";

    // Switch on $filename to assign the correct title to page
    switch ($URI_filename) {
        case $home_file:
            $page_title = $home_title;
            break;
        case $products_file:
            $page_title = $products_title;
            break;
        case $orders_file:
            $page_title = $orders_title;
            break;
    }

    return $page_title;
}

// Sanitizes the data to make it safe to process (remove trailing and leading whitespaces, removes backslashes
// and replaces the dangerous chars by their entities)
function sanitize_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);

    // Return the sanitized data
    return htmlspecialchars($data);
}