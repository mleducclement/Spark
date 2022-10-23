<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup

require "../src/utilities.php";
require "../templates/head.php";
?>

<body class="bg-white">

<?php require "../templates/header.php" ?>
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
        <div class="max-w-sm mx-auto rounded shadow-lg bg-white p-3">
            <h2 class="mb-6 text-center">Our Best Seller</h2>
            <figure class="mx-auto">
                <a href="#"><img class="mx-auto max-w-xs mb-3" alt="image of a man
                                 wearing a shirt" src=<?php get_random_image_url(); ?> ></a>
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