<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-24-2022   Add Input validation and sanitizing to the form, convert most require statements to use constants
#Michael Leduc Clement 2210407  10-25-2022   Clean some hardcoded variables and add function to set the page title
#Michael Leduc Clement 2210407  10-25-2022   Implement error/exception catching and logging them to a file
#Michael Leduc Clement 2210407  10-27-2022   Add print option functionality. Fix some formatting. Add cheatsheet

// CONST
const UTILITIES_LOCATION = "../src/utilities.php";
const MAIN_NAV_LOCATION = "../templates/main_nav.php";
const FOOTER_LOCATION = "../templates/footer.php";
const IMAGES_LOCATION = "../assets/images/";
const CSS_LOCATION = "../public/styles.css";

const DEBUG_MODE = false;

require UTILITIES_LOCATION;

// Force browser to use secure connection (HTTPS://)
if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
    header("Location: https://" . str_replace("8088", "", $_SERVER["HTTP_HOST"]) . $_SERVER["REQUEST_URI"]);
}

// Sets headers of the http request to prevent caching of the page
header("Content-Type: text/html; Charset: UTF-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Uncomment href IF tailwindcss CDN is down -->
    <link rel="stylesheet" href="<?php // echo CSS_LOCATION; ?>">

    <!-- Tailwindcss CDN : Necessary in order to use tailwindcss without local compiling -->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <!------------------------------------------------------------------------------------->
    <title><?= get_page_title(); ?></title>
</head>