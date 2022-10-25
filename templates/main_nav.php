<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-24-2022   Add Input validation and sanitizing to the form, convert most require statements to use CONST

// CONST
const INDEX_LOCATION = "../public/index.php";
const PRODUCTS_LOCATION = "../public/products.php";
const ORDERS_LOCATION = "../public/orders.php";

?>

<section id="main-nav" class="bg-amber-400">
    <div class="max-w-6xl mx-auto">
        <nav class="flex p-4">
            <div class="">
                <a href="#"><span class="font-bold text-xl tracking-tight">SPARK{}</span></a>
            </div>
            <div class="flex items-center ml-auto">
                <div class="text-md flex-grow">
                    <a id="home-link" href="<?= INDEX_LOCATION; ?>" data-title="Spark | Home"
                       class="inline-block mr-4 hover:text-white hover:underline">
                        Home
                    </a>
                    <a id="products-link" href="<?= PRODUCTS_LOCATION; ?>" data-title="Spark | Products"
                       class="inline-block mr-4 hover:text-white hover:underline">
                        Products
                    </a>
                    <a id="orders-link" href="<?= ORDERS_LOCATION; ?>" data-title="Spark | Orders"
                       class="inline-block mr-4 hover:text-white hover:underline">
                        Orders
                    </a>
                </div>
            </div>
        </nav>
    </div>
</section>
