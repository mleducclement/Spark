<?php
#Revision History
#
#DEV                            DATE         MESSAGE
#Michael Leduc Clement 2210407  10-23-2022   Add orders and product figure on index page

// Makes no sense to define a constant on every page for the head.php file and it needs to be defined
// before requiring it in index
require "../templates/head.php";

// Variables used to get the data from the .json file
$data = "";
$filename = "data.json";
$directory = "../data/";
$filepath = $directory . $filename;

// If the .json file exist, we get the content from it
if (is_file($filepath)) {
    $data = file_get_contents($filepath);
    $data = json_decode($data, true);

    // If the file is not empty, checks first element of data array and gets the key from it to push them into headings
    if ($data != "") {
        foreach ($data[0] as $key => $value) {
            $headings[] = $key;
        }
    }

} else {
    // If no .json file exists, sets headings array manually and set data to be an empty array to prevent errors
    $headings = ['code', 'first name', 'last name', 'city', 'comments', 'price', 'quantity', 'subtotal', 'taxes', 'total'];
    $data = [];
}


?>

    <body class="bg-white">

<?php require MAIN_NAV_LOCATION ?>

    <section id="products" class="max-w-6xl mx-auto p-6">
        <h2 class="text-lg text-center font-bold p-3">Orders</h2>
        <table class="w-full mx-auto border-separate">
            <thead>
            <tr>
                <?php foreach ($headings as $key) { ?>
                    <th class="text-left bg-gray-100 border border-black"><?= $key; ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
                <tr>
                    <?php foreach ($row as $key => $value) {
                        if ($key == "quantity") {
                            echo "<td class='border border-black text-center p-1'>$value</td>";
                        } else if ($key == "price" || $key == "subtotal" || $key == "taxes" || $key == "total") {
                            echo "<td class='border border-black p-1'>$$value</td>";
                        } else {
                            echo "<td class='border border-black p-1'>$value</td>";
                        }
                    } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

<?php require FOOTER_LOCATION ?>