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

// Get the current page we are to display correct title
function get_page_title(): string
{
    $page_title = "";
    return $page_title;
}

function sanitize_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    echo $data;
    return $data;
}