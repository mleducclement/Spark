<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup

$stylesheetLocation = "../public/styles.css";
$pageTitle = get_page_title();

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
    <link rel="stylesheet" href=<?php echo $stylesheetLocation ?>>

    <!-- Tailwindcss CDN : Necessary in order to use tailwindcss without local compiling -->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <!------------------------------------------------------------------------------------->
    <title>Spark</title>
</head>