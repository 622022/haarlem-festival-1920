<?php
    require_once(__DIR__ . "/config/credentials.php");
    require_once(__DIR__ . "/model/event-model.php"); 
    require_once(__DIR__ . "/model/programmeItem-model.php");
    require_once(__DIR__ . "/model/image-model.php");
    require_once(__DIR__ . "/model/user-model.php");
    require_once(__DIR__ . "/model/ticket-model.php");
    require_once(__DIR__ . "/model/invoice-model.php");

    class dataLayer {
        private static $instance;
        private $conn;

        public function __construct() {
            self::$instance = $this;
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        // if this self instance then return new data layer otherwise ::(references constants or statics) do this
        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        private function executeQuery($query, $params, ...$variables) {
            $this->conn->set_charset('utf8');
            $stmt = $this->conn->prepare($query);
            if (!$stmt) { echo $this->conn->error; }
            if (isset($params) && count($variables) > 0) {
                try {
                    $stmt->bind_param($params, ...$variables);
                } catch (Exception $e) {
                    throw new Exception("Connection failed (or params are fucked?); $e");
                }
            }
            $stmt->execute();

            $error = $this->conn->error;
            if ($error) {
                throw new Exception("Database error: '$error'");
            }

            return $stmt;
        }

        private function executeSelectQuery($query, $params, ...$variables) {
            return $this->executeQuery($query, $params, ...$variables)->get_result()->fetch_all(MYSQLI_ASSOC);
        }

        private function executeEditQuery($query, $params, ...$variables) {
            return $this->executeQuery($query, $params, ...$variables)->affected_rows;
        }

        public function doesUserExist($email) {
            $query = "
                SELECT email
                FROM user
                WHERE email = ?
            ";

            return count($this->executeSelectQuery($query, 's', $email)) == 1;
        }

        public function registerUser($user) {
            $query = "
                INSERT INTO user (fullName, email, password, isAdmin)
                VALUES (?, ?, ?, 0)
            ";

            return $this->executeEditQuery($query, 'sss', $user->fullname, $user->email, $user->password) == 1;
        }

        public function getHashedPass($email) {
            $query = "
                SELECT password
                FROM user
                WHERE email = ?
            ";

            return $this->executeSelectQuery($query, 's', $email)[0]["password"];
        }

        public function getFullName($email) {
            $query = "
                SELECT fullName
                FROM user
                WHERE email = ?
            ";

            return $this->executeSelectQuery($query, 's', $email)[0]["fullName"];
        }

        public function getEvents($eventType) {
            $query = "
                SELECT E.id , E.artist, E.price, E.ticketsLeft, E.description, E.more, 
                P.id AS programmeId, P.startsAt, P.endsAt, P.location,
                I.id AS imageId, I.url, I.description AS imageDescription
                FROM event AS E
                JOIN programme AS P
                ON E.programmeId = P.id
                JOIN image AS I
                ON E.imageId = I.id
                WHERE E.eventTypeId = ?
            ";
     
            $results = $this->executeSelectQuery($query, 'i', intval($eventType));

            $events = [];
            foreach ($results as $row) {
                $programmeItem = new ProgrammeItem(
                    $row["programmeId"],
                    strtotime($row["startsAt"]),
                    strtotime($row["endsAt"]),
                    $row["location"],
                    $eventType
                );

                $image = new Image(
                    $row["imageId"],
                    $row["url"],
                    $row["imageDescription"]
                );

                $event = new Event(
                    $row["id"],
                    $row["artist"],
                    $row["price"],
                    $row["ticketsLeft"],
                    $programmeItem,
                    $image,
                    $eventType,
                    $row["description"],
                    $row["more"]
                );

                array_push($events, $event);
            }
            return $events;
        }

        public function getEventById($eventId) {
            $query = "
                SELECT E.artist, E.price, E.ticketsLeft, E.eventTypeId, E.description, E.more,
                P.id AS programmeId, P.startsAt, P.endsAt, P.location,
                I.id as imageId, I.url, I.description AS imageDescription
                FROM event AS E
                JOIN programme AS P
                ON E.programmeId = P.id
                JOIN image AS I
                ON E.imageId = I.id
                WHERE E.id = ?
            ";

            $row = $this->executeSelectQuery($query, 'i', intval($eventId))[0];

            $programmeItem = new ProgrammeItem(
                $row["programmeId"],
                strtotime($row["startsAt"]),
                strtotime($row["endsAt"]),
                $row["location"],
                $row["eventTypeId"]
            );

            $image = new Image(
                $row["imageId"],
                $row["url"],
                $row["imageDescription"]
            );

            $event = new Event(
                $eventId,
                $row["artist"],
                $row["price"],
                $row["ticketsLeft"],
                $programmeItem,
                $image,
                $row["eventTypeId"],
                $row["description"],
                $row["more"]
            );

            return $event;
        }

        public function userIsAdmin($email) {
            $query = "
                SELECT isAdmin
                FROM user
                WHERE email = ?
            ";

            return $this->executeSelectQuery($query, 's', $email)[0]["isAdmin"];
        }

        public function sortEvents($eventType) {
            $query = "
                SELECT
                E.id,
                E.artist,
                E.price,
                E.ticketsLeft,
                E.description,
                E.more,
                P.id AS programmeId,
                P.startsAt,
                P.endsAt,
                P.location,
                I.id AS imageId,
                I.url,
                I.description AS imageDescription
                FROM event AS
                E
                JOIN
                programme AS P
                ON
                E.programmeId = P.id
                JOIN
                image AS I
                ON
                E.imageId = I.id
                WHERE
                E.eventTypeId = ?
                ORDER BY
                price ASC
            ";

            $results = $this->executeSelectQuery($query, 'i', intval($eventType));
            $events = [];

            foreach ($results as $row) {
                $programmeItem = new ProgrammeItem(
                    $row["programmeId"],
                    strtotime($row["startsAt"]),
                    strtotime($row["endsAt"]),
                    $row["location"],
                    $eventType
                );

                $image = new Image(
                    $row["imageId"],
                    $row["url"],
                    $row["imageDescription"]
                );

                $event = new Event(
                    $row["id"],
                    $row["artist"],
                    $row["price"],
                    $row["ticketsLeft"],
                    $programmeItem,
                    $image,
                    $eventType,
                    $row["description"],
                    $row["more"]
                );

                array_push($events, $event);
            }
            return $events;
        }

        public function updateEvent($event) {
            $query = "
                UPDATE event
                JOIN programme ON event.id = programme.id
                SET event.artist = ?,
                    event.price = ?,
                    event.ticketsLeft = ?,
                    event.eventTypeId = ?,
                    programme.startsAt = ?,
                    programme.endsAt = ?,
                    programme.location = ?
                WHERE event.id = ?
            ";

            return $this->executeEditQuery($query, 'sdiisssi',
                $event->artist,
                $event->price,
                $event->ticketsLeft,
                $event->eventTypeId,
                date('Y-m-d H:i:s', $event->programmeItem->startsAt),
                date('Y-m-d H:i:s', $event->programmeItem->endsAt),
                $event->programmeItem->location,
                $event->id
            );
        }

        public function getUsers() {
            $query = "
                SELECT id, email, fullName, isAdmin
                FROM user
            ";

            $results = $this->executeSelectQuery($query, '');
            $users = [];

            foreach ($results as $row) {  
                array_push($users, new User($row['id'], $row['email'], $row['fullName'], '', $row['isAdmin'] == '1'));
            }

            return $users;
        }

        public function getUserByEmail($email) {
            $query = "
                SELECT id, email, fullName, isAdmin
                FROM user
                WHERE email = ?
            ";

            $result = $this->executeSelectQuery($query, 's', $email)[0];
            return new User($result['id'], $result['email'], $result['fullName'], '', $result['isAdmin'] == '1');
        }

        public function getUserById($id) {
            $query = "
                SELECT id, email, fullName, isAdmin
                FROM user
                WHERE id = ?
            ";

            $result = $this->executeSelectQuery($query, 'i', intval($id))[0];
            return new User($result['id'], $result['email'], $result['fullName'], '', $result['isAdmin'] == '1');
        }

        public function updateUser($user) {
            $query = "
                UPDATE user
                SET fullName = ?,
                    email = ?,
                    isAdmin = ?
                WHERE id = ?
            ";

            return $this->executeEditQuery($query, 'ssii', $user->fullName, $user->email, intval($user->isAdmin), intval($user->id));
        }

        public function updatePassword($email, $password) {
            $query = "
                UPDATE user
                SET password = ?
                WHERE email = ?
            ";

            return $this->executeEditQuery($query, 'ss', $password, $email);
        }

        // public function insertPayment($method,$status,$details)
        // {
        //     $query = "
        //     INSERT
        //     INTO
        //     `payment`(
        //     `methodId`,
        //     `statusId`,
        //     `details`
        //     )
        //     VALUES(?, ?, ?);
        //     SELECT LAST_INSERT_ID();";

        //     return $this->executeSelectQuery($query, 'iis', $method,$status,$details)[0]["LAST_INSERT_ID()"];
        // }

        public function insertPayment($method, $status, $details)
        {
            $query = "
                INSERT INTO `payment` (
                    `methodId`,
                    `statusId`,
                    `details`
                )
                VALUES(?, ?, ?)";

            $this->executeEditQuery($query, 'iis', $method,$status,$details) == 1;

            $query = "
                SELECT MAX(ID)
                FROM `payment`
            ";
            
            return $this->executeSelectQuery($query, '')[0]['MAX(ID)'];
            //return $this->executeSelectQuery($query, '')[0];
        }

        public function deleteUser($id) {
            $query = "
                DELETE FROM user
                WHERE id = ?
            ";

            return $this->executeEditQuery($query, 'i', intval($id));
        }

        public function ticketExists($uuid) {
            $query = "
                SELECT uid
                FROM ticket
                WHERE uid = ?
            ";

            return count($this->executeSelectQuery($query, 's', $uuid)) >= 1;
        }

        public function getTicket($uuid) {
            $query = "
                SELECT orderId, statusId, price, uid
                FROM ticket
                WHERE uid = ?
            ";

            $result = $this->executeSelectQuery($query, 's', $uuid);
            return new Ticket($result[0]['orderId'], intval($result[0]['statusId']), doubleval($result[0]['price']), $result[0]['uid']);
        }

        public function updateTicket($ticket) {
            $query = "
                UPDATE ticket
                SET orderid = ?,
                    statusId = ?,
                    price = ?
                WHERE uid = ?
            ";

            return $this->executeEditQuery($query, 'iids', $ticket->orderId, $ticket->status, $ticket->price, $ticket->uuid);
        }

        // public function insertCustomer($name,$email) {
        //     $query = "
        //     INSERT INTO `customer` ( `name`, `email`)
        //     VALUES(?, ?);
        //     SELECT LAST_INSERT_ID();";

        //     return $this->executeSelectQuery($query, 'ss', $name,$email)[0]["LAST_INSERT_ID()"];
        // }

        public function insertCustomer($name,$email) {
            $query = "
            INSERT INTO `customer` ( `name`, `email`)
            VALUES(?, ?)";

            $this->executeEditQuery($query, 'ss', $name,$email);

            $query = "
                SELECT MAX(ID)
                FROM `customer`
            ";
            
            return $this->executeSelectQuery($query, '')[0]['MAX(ID)'];
        }

        public function insertOrder($customerId, $paymentId) {
            $query = "
            INSERT INTO `order` ( `customerId`, `paymentId`)
            VALUES(?, ?)";

            $this->executeEditQuery($query, 'ii', $customerId, $paymentId);

            $query = "
                SELECT MAX(ID)
                FROM `order`
            ";
            
            return $this->executeSelectQuery($query, '')[0]['MAX(ID)'];
        }

        public function getInvoices() {
            $query = "
                SELECT `order`.id, statusId, orderedAt, name, email, methodId
                FROM `order`
                JOIN payment ON paymentId = payment.id
                JOIN customer ON customerId = customer.id
            ";

            $invoices = [];

            foreach ($this->executeSelectQuery($query, '') as $result) {
                $orderedAt = new DateTime($result['orderedAt']);
                $orderedAt = $orderedAt->getTimestamp();
                array_push($invoices, new Invoice($result['id'], $result['statusId'], $orderedAt, $result['name'], $result['email'], $result['methodId']));
            }
           
            return $invoices;
        }

        public function insertTicket($eventId, $orderId, $price) {
            $query = "
                INSERT INTO ticket (eventId, orderId, statusId, price, uid)
                VALUES (?, ?, 1, ?, UUID());
            ";

            $this->executeEditQuery($query, 'iid', $eventId, $orderId, $price);

            $query = "
                SELECT MAX(ID)
                FROM `ticket`
            ";
            
            return $this->executeSelectQuery($query, '')[0]['MAX(ID)'];
        }

        public function getallRestaurants() {
            $query = "
                SELECT name, adultPrice, address, firstSession, stars, seats, description
                FROM restaurant
            ";

            $restaurants = [];

            foreach ($this->executeSelectQuery($query, '') as $result) {
                array_push($restaurants, new Restaurant(
                    $result['name'],
                    intval($result['adultPrice']),
                    $result['address'],
                    $result['firstSession'],
                    intval($result['stars']),
                    intval($result['seats']),
                    $result['description']
                ));
            }
           
            return $restaurants;
        }

        public function fetchUid($id){
            $query = "
            SELECT
            uid
            FROM
            `ticket`
            WHERE
            id = ?
            ";

            return $this->executeSelectQuery($query, 'i',$id)[0]['uid'];

        }
    }
?>