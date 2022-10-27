<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-21-2022   Initial Project Setup
#Michael Leduc Clement 2210407  10-21-2022   Add Footer/Nav/About sections
#Michael Leduc Clement 2210407  10-24-2022   Add Input validation and sanitizing to the form, convert most require statements to use constants
#Michael Leduc Clement 2210407  10-27-2022   Add print option functionality. Fix some formatting. Add cheatsheet

$page_option = get_page_options();

const JS_LOCATION = "../assets/js/scripts.js";
?>

<div class="<?= $page_option == Page_options::PrintReady ? "bg-white" : "bg-black"; ?>">
    <footer class="max-w-6xl mx-auto">
        <p class="<?= $page_option == Page_options::PrintReady ? "text-black" : "text-white"; ?> text-center py-2">
            <?php show_footer() ?>
        </p>
    </footer>
</div>

<script src=<?php echo JS_LOCATION ?>></script>
</body>
</html>


