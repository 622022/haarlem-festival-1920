<?php
    require_once("../config/credentials.php");
    require_once("../model/event-model.php"); require_once("../model/programmeItem-model.php");

    class dataLayer {
        private static $instance;
        private $conn;

        private function __construct() {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        public function doesUserExist($email) {
            $query = $this->conn->prepare("SELECT email FROM user WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                return $result->num_rows > 0;
            }
        }

        public function registerUser($user) {
            $user->password = password_hash($user->password, PASSWORD_DEFAULT);
            $query = $this->conn->prepare("INSERT INTO user (fullName, email, password, isAdmin) VALUES (?, ?, ?, 0)");
            $query->bind_param('sss', $user->fullname, $user->email, $user->password);
            $query->execute();

            return $query->affected_rows == 1;
        }

        public function getHashedPass($email) {
            $query = $this->conn->prepare("SELECT password FROM user WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        public function getFullName($email) {
            $query = $this->conn->prepare("SELECT fullName FROM user WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result(); 

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        public function getAllEvents() { // UNFINISHED
            $query = $this->conn->prepare("SELECT artist, price, event.eventTypeId, location, startsAt, endsAt FROM event JOIN programme ON event.programmeId = programme.id");
            $query->execute();
            $result = $query->get_result();

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                if ($result->num_rows > 0) {
                    return $result->fetch_row()[0];
                } else {
                    return false;
                }
            }
        }

        public function getEvents($eventType) {
            $query = $this->conn->prepare(
                "SELECT `E.id`, `E.artist`, `E.price`, `E.ticketsLeft`, `E.programmeId`, `E.imageId`, `E.description`, `E.more`," .
                "`P.id`, `P.startsAt`, `P.endsAt`, `P.location`". 
                "FROM `event` AS `E`" .
                "WHERE `eventTypeId` = ?" .
                "JOIN `programme` AS `P`" .
                "ON `E.programmeId` = `P.id`"
            );
            $query->bind_param('i', $eventType);
            $query->execute();
            $result = $query->get_result();
            

            if (!$result) {
                $error = $this->conn->error;
                throw new Exception("Database error: '$error'");
            } else {
                if ($result->num_rows > 0) {           
                    $events = [];

                    while($row = $result->fetch_assoc())
                    {
                        $programmeItem = new ProgrammeItem(
                            $row["P.id"],
                            $row["P.startsAt"],
                            $row["P.endsAt"],
                            $row["P.location"]
                        );

                        $event = new Event(
                            $row["E.id"],
                            $row["E.artist"],
                            $row["E.price"],
                            $row["E.ticketsLeft"],
                            $programmeItem,
                            $eventType,
                            $row["E.imageId"],
                            $row["E.description"],
                            $row["E.more"]
                        );

                        array_push($events, $event);
                    }
                    return $events;
                } else {
                    return false;
                }
            }
        }
    }
?>