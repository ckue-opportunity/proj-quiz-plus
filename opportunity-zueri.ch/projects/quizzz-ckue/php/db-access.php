<?php

// 'strpos' or 'string position'
// Careful: Use !== false; strpos() may return Boolean or number >= 0
if (strpos($_SERVER['HTTP_HOST'], 'localhost:') !== false) {
    // DB runs in local Docker container: localhost
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_NAME', getenv('DB_NAME'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASSWORD', getenv('DB_PASSWORD'));
}
else {
    /* HOSTPOINT DB (ipiluwig_ck) ACCESS

    Hostname: ipiluwig.mysql.db.internal
    MySQL version: 10.3-MariaDB

    DB:     ipiluwig_ck
    User:   ipiluwig_01
    Pwd:    mhkcT6BUZymW6e
    */
    define('DB_HOST', 'ipiluwig.mysql.db.internal');
    define('DB_NAME', 'ipiluwig_ck');
    define('DB_USER', 'ipiluwig_01');
    define('DB_PASSWORD', 'mhkcT6BUZymW6e');
}

/**
 * Creates or reuses a single PDO connection object.
 */
function DBConnection() {
    // Reuse single connection object if already available.
    // if (isset($_dbconnection)) return $_dbconnection;

    // PHP Data Objects Extension (PDO)
    // https://www.php.net/manual/de/book.pdo.php
    try {
        $connection = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', 
            DB_USER, 
            DB_PASSWORD
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo '<p>DB connection failed: ' . $e->getMessage() . '</p>';

        echo 'HTTP_HOST = ' . $_SERVER['HTTP_HOST'] . '<br>';
        echo 'DB_NAME = ' . DB_NAME . '<br>';
        echo 'DB_USER = ' . DB_USER . '<br>';
        echo 'DB_PASSWORD = ' . DB_PASSWORD . '<br>';
        echo 'DB_HOST = ' . DB_HOST . '<br>';
        exit;
    }

    return $connection;
}

/**
 * Gets the data for the introduction page.
 * 
 * @param integer $quizID   The id of the quiz the introduction is associated to.
 * 
 * @return Pagedata in form of an associative array.
 */
function introductionDataFromDB($quizID) {      
    // Prepare, bind and execute SELECT statement
    $query = DBConnection()->prepare("SELECT * FROM introduction WHERE quizID = ?");
    $query->bindValue(1, $quizID);
    $query->execute();
    
    // Fetch the record (whole first row) as assoc array.
    $data = $query->fetch(PDO::FETCH_ASSOC); // fetch() instead of fetchAll()

    if (TRACE_DB_ACCESS) {
        print "<h1>INTRODUCTION DATA</h1>";
        prettyEcho($data);
        echo '<p>-------------------------------------</p>'; // echo separator line
    }

    return $data;
}

function questionDataFromDB($quizID, $questionID) {            
    // Prepare, bind and execute SELECT statement
    $query = DBConnection()->prepare("SELECT * FROM question WHERE quizID = ? AND id = ?");
    $query->bindValue(1, $quizID);
    $query->bindValue(2, $questionID);
    $query->execute();

    // Fetch the record (whole first row) as assoc array.
    $data = $query->fetch(PDO::FETCH_ASSOC); // fetch() instead of fetchAll()

    // Associate the answers to the other question data.
    $data['answers'] = answerDataFromDB($questionID);

    if (TRACE_DB_ACCESS) {
        print "<h1>QUESTION DATA</h1>";
        prettyEcho($data);
        echo '<p>-------------------------------------</p>'; // echo separator line
    }

    return $data;
}

function answerDataFromDB($questionID) {
// Prepare, bind and execute SELECT statement
    $query = DBConnection()->prepare("SELECT text, correct FROM answer WHERE questionID = ?");
    $query->bindValue(1, $questionID);
    $query->execute();

    // Fetch array of all answers, each answer as assoc array
    $answers = $query->fetchAll(PDO::FETCH_ASSOC); 

    if (TRACE_DB_ACCESS) {
        print "<h1>ANSWER DATA</h1>";
        prettyEcho($answers);
        echo '<p>-------------------------------------</p>'; // echo separator line
    }

    return $answers;
}

function reportDataFromDB($quizID) {
    // Prepare, bind and execute SELECT statement
    $query = DBConnection()->prepare("SELECT * FROM report WHERE quizID = ?");
    $query->bindValue(1, $quizID);
    $query->execute();
    
    // Fetch the record (whole first row) as assoc array.
    $data = $query->fetch(PDO::FETCH_ASSOC); // fetch() instead of fetchAll()

    if (TRACE_DB_ACCESS) {
        print "<h1>REPORT DATA</h1>";
        prettyEcho($data);
        echo '<p>-------------------------------------</p>'; // echo separator line
    }

    return $data;
}

function questionIdsFromDB($quizID) {
    $query = DBConnection()->prepare("SELECT id FROM question WHERE quizID = ?");
    $query->bindValue(1, $quizID);
    $query->execute();

    // Fetch array of all question ids
    $questionIds = $query->fetchAll(PDO::FETCH_COLUMN, 0);

    if (TRACE_DB_ACCESS) {
        print "<h1>QESTION IDS</h1>";
        prettyEcho($questionIds);
        echo '<p>-------------------------------------</p>'; // echo separator line
    }

    return $questionIds;
}

function questionNumFromDB($quizID) {
    return count( questionIdsFromDB($quizID) );
}

function prettyEcho($data) {
    echo '<pre>' . var_export($data, true) . '</pre>';
}

?>