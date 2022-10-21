<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup

function show_footer()
{
    $student_name = "Michael Leduc Clement";
    $student_number = "2210407";

    echo sprintf("&copy %s (%s) ", $student_name, $student_number);
    echo date("Y");
}