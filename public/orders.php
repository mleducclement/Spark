<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-23-2022   Add data and product figure on index page

// Makes no sense to define a constant on every page for the head.php file and it needs to be defined
// before requiring it in index
require "../templates/head.php";
?>

    <body class="bg-white">

<?php require MAIN_NAV_LOCATION ?>

<?php require FOOTER_LOCATION ?>