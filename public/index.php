<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page


// Makes no sense to define a constant on every page for the head.php file and it needs to be defined
// before requiring it in index
require "../templates/head.php";


$random_number = get_random_int();
?>

<body class="bg-white">

<?php require "../templates/main_nav.php" ?>
<section id="about" class="bg-[url('../assets/images/background-abstract.jpg')] bg-cover">
    <div class="max-w-6xl py-6 mx-auto">
        <div class="max-w-xl mx-auto">
            <h2 class="mb-1">What exactly is spark?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, aspernatur blanditiis delectus
                deleniti,
                dolor eaque eligendi excepturi natus nihil nulla odio provident soluta, suscipit tenetur veniam!
                Accusamus
                aspernatur autem consequatur consequuntur debitis dolorum, ducimus earum excepturi ipsam itaque labore
                laboriosam modi molestiae mollitia nemo obcaecati perspiciatis praesentium, quidem reiciendis
                tenetur!
            </p>
        </div>
    </div>
</section>

<section class="bg-amber-100">
    <div class="max-w-6xl py-6 mx-auto">
        <div class="mx-auto rounded shadow-lg bg-white p-3 w-6/12">
            <h2 class="mb-6 text-center">Our Best Seller</h2>
            <figure class="mx-auto">
                <a href="products.php"><img
                            class="mx-auto mb-3 <?php echo $random_number == 3 ? "w-[400px] h-[400px] border-[6px] border-green-200" : "w-[200px] h-[200px]"; ?>"
                            alt="image of a man
                                 wearing a shirt" src="../assets/images/shirt<?php echo $random_number; ?>.jpg"></a>
                <figcaption class="max-w-xs mx-auto text-center">A great example of one of our finest
                    product. Also, it is currently on SALE!
                </figcaption>
            </figure>
        </div>
    </div>
</section>

<div class="bg-black">
    <?php require("../templates/footer.php") ?>
</div>

</body>
</html>