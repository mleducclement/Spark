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

<section id="about" class="bg-[url('/assets/images/background-abstract.jpg')] bg-cover">
    <div class="max-w-6xl py-6 mx-auto">
        <div class="max-w-xl mx-auto">
            <h2 class="mb-1">What exactly is spark?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, aspernatur blanditiis delectus
                deleniti,
                dolor eaque eligendi excepturi natus nihil nulla odio provident soluta, suscipit tenetur veniam!
                Accusamus
                aspernatur autem consequatur consequuntur debitis dolorum, ducimus earum excepturi ipsam itaque labore
                laboriosam modi molestiae mollitia nemo obcaecati perspiciatis praesentium, quidem reiciendis
                tenetur!</p>
        </div>
    </div>
</section>

<div class="bg-black">
    <?php require("../templates/footer.php") ?>
</div>

</body>
</html>