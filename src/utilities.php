<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-23-2022   Add data and product figure on index page
#Michael Leduc Clement 2210407  10-25-2022   Clean some hardcoded variables and add function to set the page title
#Michael Leduc Clement 2210407  10-25-2022   Implement error/exception catching and logging them to a file

const LOGFILE_LOCATION = "../logs/log.txt";

function manage_error($error_number, $error_message, $error_filename, $error_line_number): void
{
    $error_message = date('y-m-d H:i:s') . " - An error occured in {$error_filename} at line {$error_line_number}. {$error_message} ({$error_number})\n";

    if (DEBUG_MODE) {
        echo $error_message;
        exit();
    } else {
        echo "An error occured... We are aware of the problem, there is no further action to be taken by you";
    }

    if (!file_exists(LOGFILE_LOCATION)) {
        mkdir("../logs");
    }

    $logfile = fopen(LOGFILE_LOCATION, "a") or die("Unable to open file!");
    fwrite($logfile, $error_message);
}

set_error_handler("manage_error");

function manage_exception($error_object): void
{
    $exception_message = date('y-m-d H:i:s') . " - An exception occured in {$error_object->getFile()} at line {$error_object->getLine()}. {$error_object->getMessage()} ({$error_object->getCode()})\n";

    if (DEBUG_MODE) {
        echo $exception_message;
        exit();
    } else {
        echo "An exception occured... We are aware of the problem, there is no further action to be taken by you";
    }

    if (!file_exists(LOGFILE_LOCATION)) {
        mkdir("../logs");
    }

    $logfile = fopen(LOGFILE_LOCATION, "a") or die("Unable to open file!");
    fwrite($logfile, $exception_message);
    fclose($logfile);
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

function select_page_title($URI_filename): string
{
    // Variables to store file names for cases
    $home_file = "index.php";
    $products_file = "products.php";
    $orders_file = "data.php";

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