<?php
    // Preset path to include folder 
    // echo $_SERVER['DOCUMENT_ROOT'];
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/quizzz-ckue/php');

    // Page includes
    include 'auth.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/quizzz-ckue/css/main.css">
</head>

<body>
    <div class="bgimg-1">
    <div class="caption">
        <span class="border">
            <?php 
                // Write hyperlink with GET parameters.
                echo '<a href="/quizzz-ckue/templates/introduction.php?qid=1">INTRODUCTION</a>'; 
            ?>
        </span>
    </div>
    </div>
</body>

</html>