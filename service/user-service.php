<?php
    require_once(__DIR__ . "/../lib/dal.php");
    require_once(__DIR__ . "/../model/user-model.php");

    class userService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
		}

		// Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new userService() : self::$instance;
        }
        
        public function getUsers() {
            return $this->dal->getUsers();
        }

        public function getUser($identifier) {
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                return $this->dal->getUserByEmail($identifier);
            } else {
                return $this->dal->getUserById($identifier);
            }
        }

        public function updateUser($user) {
            if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                return $this->dal->updateUser($user);
            } else {
                throw new Exception('Invalid email address format');
            }
        }

        public function updatePassword($email, $password) {
            return $this->dal->updatePassword($email, password_hash($password, PASSWORD_BCRYPT));
        }

        public function deleteUser($id) {
            return $this->dal->deleteUser($id);
        }
	}
?>