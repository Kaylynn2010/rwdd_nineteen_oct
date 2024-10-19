<?php
// controllerR
require_once __DIR__ . '/../config/configLR.php'; // leave dir alone
require_once __DIR__ . '/../lib/dbconnR.php'; 

class AuthController1
{

    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $this->db = new Database($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    }

    public function register($data)
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';

            // Prepare and execute the SQL query to verify user credentials
            $stmt = $this->db->getConnection()->prepare("SELECT password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashedPassword);
                $stmt->fetch();

                // verify
                if (password_verify($password, $hashedPassword)) {
                    // Login successful
                    echo json_encode(['success' => true]);
                } else {
                    // Invalid credentials
                    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
                }
            } else {
                // User not found
                echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
            }

            $stmt->close(); // Close the statement
        } else {
            // Handle invalid request method
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }

        // Close the database connection
        $this->db->closeConnection();
    }
}
?>