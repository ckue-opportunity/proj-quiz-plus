<?php
    // Define DB constants
        // Use soft convention for constant names: capital letters plus '_'
        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));
        define('DB_HOST', getenv('DB_HOST'));

        // PHP Data Objects Extension (PDO)
        // https://www.php.net/manual/de/book.pdo.php
        $connection = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', 
            DB_USER, 
            DB_PASSWORD
        );

        /*
        // Trace the names of all available DB tables.

        // Build the query object (support object, has NO data yet).
        $query = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . DB_NAME . "'");
        
        // Here we go for the goods: Fetch all table names.
        $tables = $query->fetchAll(PDO::FETCH_COLUMN); // Get indexed array of table names.
        var_dump($tables); // dump array
        echo "length of tables: " . count($tables);

        if (empty($tables)) { 
            // When $tables is empty: notify user.
            echo '<p class="center">There are no tables in database <code>demo</code>.</p>';
        } 
        else {
            // $tables is available: list the names of the tables of my DB.
            echo '<p class="center">Database <code>demo</code> contains the following tables:</p>';
            echo '<ul class="center">';

            foreach ($tables as $tableName) {
                echo "<li>{$tableName}</li>"; // use '{$tableName}' placeholder 
            }

            echo '</ul>';
        }
        */

        print "<h1>Example with FETCH_ASSOC</h1>";

        // Build query object: select all items from table 'question'.
        // '*' stands for 'all items'
        $query = $connection->query("SELECT * from question");
        // var_dump($query);
        // echo '<p>-------------------------------------</p>'; // echo separator line

        $questions = $query->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($questions);

        // Loop through the found question data.
        foreach($questions as $question) {
            print_r("Question id is " . $question['id'] . "<br>");

            // Prepare subquery that will get all answers, 
            // associated with the question $question['id'].
            // The subquery uses a '?' as placeholder for $question['id'].
            $subQuery = $connection->prepare("SELECT * from answer where answer.questionID = ?");

            // Replace the first '?' with the value of $question['id'].
            $subQuery->bindValue(1, $question['id']);

            // Which in the end results the following query string:
            // "SELECT * from answer where answer.questionID = 1"

            // ... now execute ...
            $subQuery->execute();

            // ... and fetch all answer items for $question['id']
            // and format them as an associative array.
            $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
            print_r("Answers are " . var_dump($answers) . "<br>");

            break;
        }

        // print_r($questions);

        /*
        foreach($questions as $question) {
            $subQuery  = $connection->prepare("SELECT * from answer where answer.questionID = ?");
            $subQuery->bindValue(1, $question['id']);
            $subQuery->execute(); 
            $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
            $question['answers'] = $answers;
            print "<pre/>";            
            print_r($question);
            //print_r($question['answers'][0]);
        }  
        */  

        /*
        print "<h1>Example with FETCH_NUM</h1>";

        $query  = $connection->query("SELECT * from Question");
        $questions = $query->fetchAll(PDO::FETCH_NUM);
        foreach($questions as $question) {
            print "<pre/>";            
            print_r($question);
        }    

        print "<h1>Example with FETCH_BOTH</h1>";

        $query  = $connection->query("SELECT * from Question");
        $questions = $query->fetchAll(PDO::FETCH_BOTH);
        foreach($questions as $question) {
            print "<pre/>";            
            print_r($question);
        }            
        */
?>