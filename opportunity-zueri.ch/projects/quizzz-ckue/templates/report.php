<?php
    // Start session; configure and load standard includes
    include '../config.php';

    // Get quiz data
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
<?php include 'head.php'; ?>
<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">
            <?php
                // Show feedback text, depending on percentage threshold.
                $percentage = $_SESSION['achievedPoints'] / $questionNum * 100;

                echo '<p><a href="/index.php">&lt;&lt;</a>&nbsp;&nbsp;' . $pageData['title'] . '</p>'; 
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