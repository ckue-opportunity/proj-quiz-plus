<?php
    // Start session; configure and load standard includes
    include '../config.php';

    // Get quiz data
    $pageData = reportDataFromDB($_SESSION['quizID']);
    
    // Session object: Update number of achieved points
    if (isset($_POST['radio'])) {
        $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];
    }

    // To be able to calculate $percentage: Get tk number of questions.
    $questionNum = questionNumFromDB($_SESSION['quizID']);
?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">
            <?php
                // Show feedback text, depending on percentage threshold.
                $percentage = $_SESSION['achievedPoints'] / $questionNum * 100;
                $bilanz  = '<p><a href="/index.php">&lt;&lt;</a>&nbsp;&nbsp;' . $pageData['title'] . '</p>';
                $bilanz .= '<p>You have answered ' . $_SESSION['achievedPoints']; 
                $bilanz .= ' question(s) correctly (' . $percentage . '%).' . '</p>';
                echo $bilanz;

                

                if ($percentage >= 80) {
                    $feedback = $pageData['feedback_80'];
                }
                else if ($percentage >= 60) {
                    $feedback = $pageData['feedback_60'];
                }
                else {
                    $feedback = $pageData['feedback_40'];
                }
                echo '<p>' . $feedback . '</p>';

            ?></span>
        </div>
        <div>
            <form action="mailer.php" method="post">
                <label for="message">Message: </label><br>
                <textarea name="message" rows="5" cols="80"></textarea>
                <br>
                <label for="message">Mail to: </label><br>
                <input type="email" id="email" name="email"
                       required>

                <input type="hidden" name="feedback" value="<?php echo $feedback; ?>">

                <input type="submit" value="Send Mail">
            </form>
        </div>
    </div>
</body>

</html>