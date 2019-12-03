<?php
    require_once("../config/credentials.php");

    class dataLayer {
        private static $instance;
        private $conn;

        public function __construct() {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        public function doesUserExist($email) {
            $email = $this->conn->escape_string($email);
            
            $query = "SELECT `email` FROM `user` WHERE `email` = '$email'";
            $result = $this->conn->query($query);

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                return $result->num_rows > 0;
            }
        }

        public function registerUser($user) {
            $email = $this->conn->escape_string($user->email);
            $fullname = $this->conn->escape_string($user->fullname);
            $password = password_hash($user->password, PASSWORD_DEFAULT);
            $password = $this->conn->escape_string($password);

            $query = "INSERT INTO `user` (`full_name`, `email`, `password`) ";
            $query .= "VALUES ('$fullname', '$email', '$password')";
            $result = $this->conn->query($query);

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                return true;
            }
        }
    }
?>