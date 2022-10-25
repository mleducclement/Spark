<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections

const JS_LOCATION = "../assets/js/scripts.js";
?>

<footer class="max-w-6xl mx-auto">
    <p class="text-white text-center py-2">
        <?php show_footer() ?>
    </p>
</footer>

<script src=<?php echo JS_LOCATION ?>></script>