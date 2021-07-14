<?php
    session_start();

    // Preset path to include folder
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/quizzz-ckue/php');

    // Page includes
    include 'auth.php';
    include 'db-access.php';

    // Get quiz data
    // original quiz: $quizData = qchris_data();
    // original quiz: $pageData = $quizData['report'];
    $pageData = reportDataFromDB($_SESSION['quizID']);
    
    // Session object: Update number of achieved points
    if (isset($_POST['radio'])) {
        $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
    }

    // To be able to calculate $percentage: Get the number of questions.
    $questionNum = questionNumFromDB($_SESSION['quizID']);
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
                // Show feedback text, depending on percentage threshold.
                $percentage = $_SESSION['achievedPoints'] / $questionNum * 100;

                echo '<a href="/index.php">' . $pageData['title'] . '</a>';
                echo '<p>You have answered ' . $_SESSION['achievedPoints']; 
                echo ' question(s) correctly (' . $percentage . '%).' . '</p>';

                if ($percentage >= 80) {
                    echo '<p>' . $pageData['feedback_80'] . '</p>';
                }
                else if ($percentage >= 60) {
                    echo '<p>' . $pageData['feedback_60'] . '</p>';
                }
                else {
                    echo '<p>' . $pageData['feedback_40'] . '</p>';
                }
            ?></span>
        </div>
    </div>
</body>

</html>