<?php

namespace App\core\database;

use PDO;

class DbHandler {
    private static ?DbHandler $instance = null;
    private PDO $db_handle;

    private function __construct() {
        // Read the database connection parameters from environment variables
        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');

        // Read the password file path from an environment variable
        $password_file_path = getenv('PASSWORD_FILE_PATH');

        // Read the password from the file
        $db_pass = trim(file_get_contents($password_file_path));

        // Create a new PDO instance
        $this->db_handle = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    }

    public static function getInstance(): DbHandler
    {
        if (self::$instance == null) {
            self::$instance = new DbHandler();
        }
        return self::$instance;
    }

    public function getDbHandle(): PDO
    {
        return $this->db_handle;
    }
}

