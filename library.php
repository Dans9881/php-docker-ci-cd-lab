<?php
class AppDB {
    private static ?AppDB $instance = null;
    private $conn;
    private function __construct() {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "project";

        $this->conn = new mysqli($hostname, $username, $password, $database);

        if ($this->conn->connect_error) {
            die(json_encode([
                'status' => false,
                'message' => 'Database connection failed: ' . $this->conn->connect_error
            ]));
        }
    }

    public static function get() : AppDB {
        if (self::$instance === null) {
            self::$instance = new AppDB();
        }
        return self::$instance;
    }

    public function sql(string $query, array $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            http_response_code(500);
            die(json_encode([
                'status' => false,
                'message' => 'Prepare failed: ' . $this->conn->error
            ]));
        }

        if (!empty($params)) {
            $types = array_shift($params);
            if (!$stmt->bind_param($types, ...$params)) {
                http_response_code(500);
                die(json_encode([
                    'status' => false,
                    'message' => 'Bind failed: ' . $stmt->error
                ]));
            }
        }

        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode([
                'status' => false,
                'message' => 'Execute failed: ' . $stmt->error
            ]));
        }

        $queryType = strtoupper(substr(trim($query), 0, 6));

        if ($queryType === 'SELECT') {
            $result = $stmt->get_result();
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            return $rows;
        }

        if ($queryType === 'INSERT') return $this->conn->insert_id;
        return $stmt->affected_rows;
    }
}

$db = AppDB::get();
?>