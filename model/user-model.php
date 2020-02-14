<?php 
    class User {
        public $id;
        public $email;
        public $fullName;
        public $password;
        public $isAdmin;

        public function __construct($id, $email, $fullName, $password, $isAdmin) {
            // if(!is_int($id))          throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`.");
            // if(!is_string($email))    throw new InvalidArgumentException("Parameter '\$email' is not of type `string`.");
            // if(!is_string($fullName)) throw new InvalidArgumentException("Parameter '\$fullName' is not of type `string`.");
            // if(!is_string($password)) throw new InvalidArgumentException("Parameter '\$password' is not of type `string`.");
            // if(!is_bool($isAdmin))    throw new InvalidArgumentException("Parameter '\$isAdmin' is not of type `bool`.");

            // if(!$id >= 0)                                  throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            // if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new UnexpectedValueException("Parameter '\$email' is not a valid email.");

            $this->email = $email;
            $this->fullName = $fullName;
            $this->password = $password;
            $this->isAdmin = $isAdmin;
        }
    }
?>    