<?php
    // start session and initialize achieved number of points
    session_start();
    
    // Preset path to include folder
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/quizzz-ckue/php');

    // Page includes
    include 'auth.php';
    include 'db-access.php';

    // Get quiz id and register it in the session
    if (isset($_GET['qid'])) {
        $quizID = $_GET['qid'];
    }
    else {
        $quizID = 1;
    }

    $_SESSION['quizID'] = $quizID;
 
    /*  Get page data, code of original quiz:
            $quizData = qchris_data();
            $pageData = $quizData['introduction'];

        Now we get $pageData from the DB!
    */
    $pageData = introductionDataFromDB($quizID);

    // Initialize achieved number of points
    $_SESSION['achievedPoints'] = 0;
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
            ?></span>
            <form action="<?php echo $pageData['nextAction']; ?>" method="post">
                <input type="hidden" name="nextQuestionID" 
                       value="<?php echo $pageData['nextQuestionID']; ?>">
                <input type="submit" value="START">
            </form>
        </div>
    </div>
</body>

</html>