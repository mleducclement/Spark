<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page
#Michael Leduc Clement 2210407  10-25-2022   Clean some hardcoded variables and add function to set the page title
#Michael Leduc Clement 2210407  10-25-2022   Implement error/exception catching and logging them to a file
#Michael Leduc Clement 2210407  10-27-2022   Add coloring action to orders. Fix some formatting errors in products form

// Enum to define the page options of orders.php
enum Page_options
{
    case Color;
    case PrintReady;
    case Default;
}

// Constant pointing to the log file
const LOGFILE_LOCATION = "../logs/log.txt";

// Set timezone to have correct timestamp in log file
date_default_timezone_set("America/New_York");

// Function to manage any error coming from the application and log it to a log file
function manage_error($error_number, $error_message, $error_filename, $error_line_number): void
{
    $error_message = date('y-m-d H:i:s') . " - An error occured in {$error_filename} at line {$error_line_number}. {$error_message} ({$error_number})\n";

    if (DEBUG_MODE) {
        echo $error_message;
        exit();
    } else {
        echo "An error occured... We are aware of the problem, there is no further action to be taken by you";
    }

    // If the logs directory doesn't exist, create it
    if (!file_exists(LOGFILE_LOCATION)) {
        mkdir("../logs");
    }

    file_put_contents(LOGFILE_LOCATION, $error_message, FILE_APPEND);
}

set_error_handler("manage_error");

// Function to manage any exception coming from the application and log it to a log file
function manage_exception($error_object): void
{
    $exception_message = date('y-m-d H:i:s') . " - An exception occured in {$error_object->getFile()} at line {$error_object->getLine()}. {$error_object->getMessage()} ({$error_object->getCode()})\n";

    if (DEBUG_MODE) {
        echo $exception_message;
        exit();
    } else {
        echo "An exception occured... We are aware of the problem, there is no further action to be taken by you";
    }

    // If the logs directory doesn't exist, create it
    if (!file_exists(LOGFILE_LOCATION)) {
        mkdir("../logs");
    }

    file_put_contents(LOGFILE_LOCATION, $exception_message, FILE_APPEND);
}

set_exception_handler("manage_exception");

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

function get_page_title(): string
{
    // Convert URI to array and set the filename to the last element of array
    $exploded_URI = explode('/', $_SERVER["REQUEST_URI"]);
    $URI_filename = $exploded_URI[count($exploded_URI) - 1];

    return select_page_title($URI_filename);
}

function get_page_options(): Page_options
{
    $query = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);

    if (!is_null($query) && str_contains(mb_strtolower($query), "action=color")) {
        return Page_options::Color;
    } else if (!is_null($query) && str_contains(mb_strtolower($query), "action=print")) {
        return Page_options::PrintReady;
    }

    return Page_options::Default;
}

function get_text_color($amount): string
{
    switch ($amount) {
        case $amount < 100.00:
            return "text-red-500";
        case $amount >= 100.00 && $amount < 1000.00:
            return "text-amber-500";
        case $amount >= 1000.00 :
            return "text-green-500";
    }

    return "";
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