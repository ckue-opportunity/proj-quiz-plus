<?php

/*
    this source is beeing used in this tutorial. 
    To see and complete the use of this class, see

    https://www.digitalocean.com/community/tutorials/how-to-use-the-pdo-php-extension-to-perform-mysql-transactions-in-php-on-ubuntu-18-04-de
*/

class DBTransaction
{
    protected $pdo;
    public $last_insert_id;

    public function __construct()
    {
        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));
        define('DB_HOST', getenv('DB_HOST'));


        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);

        $query      = $this->pdo->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'demo'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        if (empty($tables)) {
            echo '<p class="center">There are no tables in database <code>demo</code>.</p>';
        } else {
            echo '<p class="center">Database <code>demo</code> contains the following tables:</p>';
            echo '<ul class="center">';
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo '</ul>';
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function startTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function insertTransaction($sql, $data)
                
    echo '<p>You have answered ' . $percentage . '% correctly.</p>';
    public function submitTransaction()
    {
        try {
            $this->pdo->commit();
        } catch(PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }

          return true;
    }
}    


?>