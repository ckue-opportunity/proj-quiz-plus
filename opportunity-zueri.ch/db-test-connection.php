<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>php pdo intro</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                font-size: larger;
            }

            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
        </style>
    </head>
    <body>
        <?php

        /* HOSTPOINT DB ACCESS DATA

        Hostname: ipiluwig.mysql.db.internal
        External hostname: ipiluwig.mysql.db.hostpoint.ch
        MySQL version: 10.3-MariaDB

        phpMySQL can be reached from within the Hospoint Console

        DB:     ipiluwig_ck
        User:   ipiluwig_01
        Pwd:    mhkcT6BUZymW6e

        */

        echo '<h1>DB constants?!</h1>';

        define('DB_HOST', 'ipiluwig.mysql.db.internal'); // getenv('DB_HOST')
        define('DB_NAME', 'ipiluwig_ck'); // getenv('DB_NAME')
        define('DB_USER', 'ipiluwig_01'); // getenv('DB_USER')
        define('DB_PASSWORD', 'mhkcT6BUZymW6e'); // getenv('DB_PASSWORD')

        echo 'DB_NAME = ' . DB_NAME . '<br>';
        echo 'DB_USER = ' . DB_USER . '<br>';
        echo 'DB_PASSWORD = ' . DB_PASSWORD . '<br>';
        echo 'DB_HOST = ' . DB_HOST . '<br>';

        try {
            $connection = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', 
                DB_USER, 
                DB_PASSWORD
            );
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo '<p>Connection failed: ' . $e->getMessage() . '</p>';
            exit;
        }

        $query = $connection->prepare("SELECT * FROM introduction WHERE quizID = ?");
        $query->bindValue(1, 1);
        $query->execute();
        
        // Fetch the record (whole first row) as assoc array.
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (true) {
            print "<h1>TEST DATA</h1>";
            var_dump($data);
            echo '<p>-------------------------------------</p>';
        }

        ?>
    </body>
</html>