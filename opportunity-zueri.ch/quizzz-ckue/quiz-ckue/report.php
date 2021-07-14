<?php
    session_start();

    // Preset path to include folder
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/quizzz-ckue/php');

    // Page includes
    include 'auth.php';
    // original quiz: include 'quiz-ckue-data.php';
    include 'db-access.php';

    // Get quiz data
    // original quiz: $quizData = qchris_data();
    // original quiz: $pageData = $quizData['report'];
    $pageData = reportDataFromDB($_SESSION['quizID']);

    // Session object: Update number of achieved points
    // var_dump($_POST);
    $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
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
                echo '<a href="/index.php">' . $pageData['title'] . '</a>';
                echo '<p>' . $pageData['feedback_60'] . '</p>';
                echo '<p>You have answered ' . $_SESSION['achievedPoints'] . ' question(s) correctly.</p>';
            ?></span>
        </div>
    </div>
</body>

</html>