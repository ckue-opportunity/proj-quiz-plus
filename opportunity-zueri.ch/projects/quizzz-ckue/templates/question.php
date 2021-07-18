<?php
    // Start session; configure and load standard includes
    include '../config.php';

    // Get quiz data
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
<?php include 'head.php'; ?>
<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">
            <?php
                echo '<p><a href="/index.php">&lt;&lt;</a>&nbsp;&nbsp;' . $pageData['text'] . '</p>'; 
            ?>
            </span>
            <form action="<?php echo $pageData['nextAction']; ?>" method="post">
                <?php
                    // Generate HTML for each answer, using echo commands.
                    $answers = $pageData['answers'];
                    $answerCount = 0; // We need a counter to be able to identify each answer by 'id'.

                    foreach ($answers as $answer) {
                        // An answer is composed of a radio button ...
                        echo '<input type="radio" id="answer' . $answerCount . '" name="radio" value="' . $answer['correct'] . '">';
                        echo PHP_EOL; // echo a hard line break to format the generated HTML.

                        // ... a label ...
                        echo '<label for="answer' . $answerCount . '">' . $answer['text'] . '</label>';

                        // ... and a line break at the end.
                        echo '<br>' . PHP_EOL; // Also add a hard line break to format the generated HTML.

                        // prepare next answer id
                        $answerCount++;
                    }
                ?>
                <input type="hidden" name="nextQuestionID" 
                       value="<?php echo $pageData['nextQuestionID']; ?>">
                <br>
                <input type="submit" value="NEXT">

            </form>
        </div>
    </div>
</body>

</html>