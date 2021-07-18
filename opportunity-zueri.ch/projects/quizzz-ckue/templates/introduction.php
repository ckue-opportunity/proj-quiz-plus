<?php
    // Start session; configure and load standard includes
    include '../config.php';

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
<?php include 'head.php'; ?>
<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">
            <?php
                echo '<p><a href="/index.php">&lt;&lt;</a>&nbsp;&nbsp;' . $pageData['title'] . '</p>'; 
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