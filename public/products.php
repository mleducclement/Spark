<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page
#Michael Leduc Clement 2210407  10-23-2022   Add form to products page and add classes for regular/premium ads

require "../src/utilities.php";
require "../templates/head.php";
?>

<body class="bg-white">

<?php require "../templates/header.php" ?>

<section id="products" class="max-w-6xl mx-auto p-6">
    <h2 class="text-lg text-center font-bold p-3">Products</h2>
    <form class="max-w-2xl mx-auto p-3" action="">
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="product-code">Product Code</label>
            <input id="product-code" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="product-code" type="text" placeholder="product code"/>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="first-name">First Name</label>
            <input id="first-name" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="first-name" type="text" placeholder="first name"/>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="last-name">Last Name</label>
            <input id="last-name" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="last-name" type="text" placeholder="last name"/>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="city">City</label>
            <input id="city" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="city" type="text" placeholder="city"/>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="comments">Comments</label>
            <textarea id="comments" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="comments" rows="2" placeholder="comments" maxlength="200"></textarea>
            <p class="text-xs" id="form-textarea-counter">192 / 200 characters</p>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="price">Price</label>
            <input id="price" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="price" type="text" placeholder="0.00"/>
        </div>
        <div class="max-w-sm form-control my-3 mx-auto">
            <label class="block" for="quantity">Quantity</label>
            <input id="quantity" class="p-2 w-96 rounded-md border-2 border-slate-600 focus:outline-none focus:border-sky-500" name="quantity" type="text" placeholder="0"/>
        </div>
        <button class="text-lg mx-auto rounded-md px-3 py-1 mt-6 bg-amber-400 block hover:bg-amber-500" type="submit">Place Order</button>
    </form>
</section>


<div class="bg-black">
    <?php require("../templates/footer.php") ?>
</div>

</body>
</html>