<?php
    // Start session; configure and load standard includes
    include '../config.php';

    // array(3) { ["message"]=> string(12) "öälkäölk" ["email"]=> string(26) "ckue.opportunity@gmail.com" ["feedback"]=> string(8) "super!!!" }
    // var_dump($_POST);

    // Mail message
    $mMessage = "Zeile 1\r\nZeile 2\r\nZeile 3";

    // Use wordwrap() to keep message lines short
    $mMessage = wordwrap($mMessage, 70, "\r\n");

    // Send mail
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    else {
        $email = 'ckue.opportunity@gmail.com';
    }

    mail($email, 'For your Interest (Quiz-CKUE)', $mMessage);
?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">Thanks for your interest :-)</span>
            <a href="/index.php">&lt;&lt;</a>
        </div>
    </div>
</body>

</html>