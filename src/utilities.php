<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup

// Generate the required info to insert into the footer of the app
function show_footer(): void
{
    $student_name = "Michael Leduc Clement";
    $student_number = "2210407";

    echo sprintf("&copy %s (%s) ", $student_name, $student_number);
    echo date("Y");
}

// Generate a random number and use it to display a random image
function get_random_image_url(): void
{
    $random_number = rand(1, 5);
    $images_location = "../assets/images/";
    echo "{$images_location}shirt$random_number.jpg";
}

function get_page_title(): string
{
    $page_title = "";
    return $page_title;
}