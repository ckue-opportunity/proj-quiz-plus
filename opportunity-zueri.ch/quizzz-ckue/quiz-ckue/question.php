<?php
    // Start the session
    session_start();

    // Preset path to include folder
    set_include_path($_SERVER['DOCUMENT_ROOT'] . '/quizzz-ckue/php');

    // Page includes
    include 'auth.php';
    include 'db-access.php';

    // Get quiz data
    // original quiz: $quizData = qchris_data();

    // Get the ID of the question from the post object
    // Get the question data for the given ID
    if (isset($_POST['nextQuestionID'])) {
        $questionID = $_POST['nextQuestionID'];
        $pageData = questionDataFromDB($_SESSION['quizID'], $questionID);
    }

    // Session object: Update number of achieved points
    // var_dump($_POST);
    if (isset($_POST['radio'])) {
        $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
    }
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
                echo '<p>' . $pageData['text'] . '</p>'; 
            ?>
            </span>
            <form action="<?php echo $pageData['nextAction']; ?>" method="post">

                <input type="radio" id="answer0" name="radio" 
                    value="<?php echo $pageData['answers'][0]['correct']; ?>">
                <label for="answer0"><?php echo $pageData['answers'][0]['text']; ?></label><br>

                <input type="radio" id="answer1" name="radio" 
                    value="<?php echo $pageData['answers'][1]['correct']; ?>">
                <label for="answer1"><?php echo $pageData['answers'][1]['text']; ?></label><br>

                <input type="radio" id="answer2" name="radio" 
                    value="<?php echo $pageData['answers'][2]['correct']; ?>">
                <label for="answer2"><?php echo $pageData['answers'][2]['text']; ?></label><br><br>

                <input type="hidden" name="nextQuestionID" 
                       value="<?php echo $pageData['nextQuestionID']; ?>">
                <input type="submit" value="NEXT">

            </form>
        </div>
    </div>
</body>

</html>